<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Http\Utils\CommonUtils;


abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    protected $query;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * @var List field filter
     */
    protected $fieldFilter = [];

    /**
     * @var List field show in query list
     */
    protected $fieldInList = [];

    /**
     * @var List field order
     */
    protected $fieldOrder = [];

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance
     *
     * @return Model
     * @throws \Exception
     *
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    private function exitsProperty($name)
    {
        return array_search('name', $this->model->fillable) >= 0;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($search = [], $perPage = null, $columns = null, $orders = [])
    {
        if ($columns == null) {
            if (isset($this->fieldInList)) {
                $columns = $this->fieldInList;
            } else $columns = ['*'];
        }

        $this->allQuery($search, null, null, $orders);

        return $this->query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null, $orders = [])
    {
        $this->query = $this->model->newQuery();

        if (count($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $method = 'filter' . Str::studly($key);
                    if (method_exists($this, $method)) {
                        $this->{$method}($value);
                    } else if (method_exists($this->model, $method)) {
                        $this->query = $this->model->{$method}($this->query, $value);
                    } else {
                        $this->query->where($key, $value);
                    }
                } else if ($key == "filter") {
                    if (method_exists($this, 'filter')) {
                        $this->filter($value);
                    } else if (count($this->fieldFilter)) {
                        $this->query->where(function ($query) use ($value) {
                            foreach ($this->fieldFilter as $field) {
                                $query->orWhere($field, 'like', "%$value%");
                            }
                        });
                    }
                }
            }
        }

        if (is_array($orders) and count($orders)) {
            foreach ($orders as $orderBy => $orderDir) {
                $orderBy = (in_array($orderBy, $this->fieldOrder)) ? $orderBy : $this->fieldOrder[0];
                $this->query->orderBy($orderBy, $orderDir);
            }
        }

        if (!is_null($limit)) {
            $this->query->limit($limit);

            if (!is_null($skip)) {
                $this->query->skip($skip);
            }
        }

        if (method_exists($this, 'beforeAllQuery')) {
            $this->beforeAllQuery();
        }

        return $this->query;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = null, $orders = [])
    {
        if ($columns == null) {
            if (isset($this->fieldInList)) {
                $columns = $this->fieldInList;
            } else $columns = ['*'];
        }

        $this->allQuery($search, $skip, $limit, $orders);

        return $this->query->get($columns);
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        $user = \Auth::user();
        if (isset($input['id'])) unset($input['id']);
        if (isset($input['created_by'])) unset($input['created_by']);
        if (isset($input['modified_by'])) unset($input['modified_by']);

        $model = $this->model->newInstance($input);
        if ($this->exitsProperty('created_by')) {

            $model->created_by = $user ? $user->id : null;
        }

        if ($this->exitsProperty('modified_by')) {
            $model->modified_by = null;
        }

//        if ($this->exitsProperty('alias') AND !$model->alias) {
//            if (isset($model->name)) {
//                dd(1, $model->name);
//                $model->alias = CommonUtils::makeAlias($model->name);
//            } else if ($this->exitsProperty('title')) {
//                $model->alias = CommonUtils::makeAlias($model->title);
//            }
//        }

        if (method_exists($this, 'beforeCreate')) {
            $this->beforeCreate($model);
        }

        $model->save();

        if (method_exists($this, 'afterCreate')) {
            $this->afterCreate($model);
        }

        return $model;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $this->query = $this->model->newQuery();

        return $this->query->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $user = \Auth::user();
        $this->query = $this->model->newQuery();

        $model = $this->query->findOrFail($id);

        if (isset($input['id'])) unset($input['id']);
        if (isset($input['created_by'])) unset($input['created_by']);
        if (isset($input['modified_by'])) unset($input['modified_by']);

        $model->fill($input);

        if ($this->exitsProperty('created_by') AND !$model->created_by) {
            $model->created_by = $user ? $user->id : null;
        }

        if ($this->exitsProperty('modified_by')) {
            $model->modified_by = $user ? $user->id : null;
        }

        if ($this->exitsProperty('alias') AND !$model->alias) {
            if (isset($model->name)) {
                $model->alias = CommonUtils::makeAlias($model->name);
            } else if ($this->exitsProperty('title')) {
                $model->alias = CommonUtils::makeAlias($model->title);
            }
        }

        if (method_exists($this, 'beforeUpdate')) {
            $this->beforeUpdate($model);
        }

        $model->save();

        if (method_exists($this, 'afterUpdate')) {
            $this->afterUpdate($model);
        }

        return $model;
    }

    /**
     * @param int $id
     *
     * @return bool|mixed|null
     * @throws \Exception
     *
     */
    public function delete($id)
    {
        $this->query = $this->model->newQuery();

        $model = $this->query->findOrFail($id);

        return $model->delete();
    }

    public function getFirst($searchs = [], $orders = [])
    {
        $query = $this->model->newQuery();

        if (count($searchs)) {
            foreach ($searchs as $key => $value) {
                $method = 'filter' . Str::studly($key);
                if (method_exists($this, $method)) {
                    $this->{$method}($value);
                } else if (method_exists($this->model, $method)) {
                    $query = $this->model->{$method}($query, $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        if (is_array($orders) and count($orders)) {
            foreach ($orders as $orderBy => $orderDir) {
                $query->orderBy($orderBy, $orderDir);
            }
        }

        return $query->first();
    }

    public function getSum($field_sum = 'number', $field_where = 'user_id', $field_value = null)
    {
        $query = $this->model->newQuery();
        if ($field_where AND $field_value) {
            return $query->where($field_where, $field_value)->sum($field_sum);
        }
        return $query->sum($field_sum);
    }
}

<?php

namespace App\Repositories;

use App\Models\courses;
use App\Repositories\BaseRepository;

/**
 * Class coursesRepository
 * @package App\Repositories
 * @version January 18, 2021, 9:38 am UTC
 */

class coursesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'course_category_id',
        'description',
        'current_order'
    ];
    protected $fieldInList=[
        'id',
        'course_category_id',
        'description',
        'current_order'
//        'created_at'
    ];
    protected $fieldFilter=[
        'description',
        'course_category_id'
    ];
    public $fieldOrder=[
        'id'
    ];
    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Courses::class;
    }

    public function paginate($search = [], $perPage = null, $columns = null, $orders = [])
    {
        return parent::paginate($search, $perPage, $columns, $orders);
    }

    public function create($input)
    {
        return parent::create($input);
    }
    public function find($id, $columns = ['*'])
    {
        return parent::find($id, $columns);
    }
    public function update($input, $id)
    {
        return parent::update($input, $id);
    }
    public function delete($id)
    {
        return parent::delete($id);
    }
    public function allQuery($search = [], $skip = null, $limit = null, $orders = [])
    {
        return parent::allQuery($search, $skip, $limit, $orders);
    }
}

<?php

namespace App\Repositories;

use App\Models\Departments;
use App\Repositories\BaseRepository;

/**
 * Class DepartmentsRepository
 * @package App\Repositories
 * @version January 18, 2021, 10:00 am UTC
*/

class DepartmentsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'description'
    ];

    protected $fieldInList = [
        'id',
        'name',
        'code',
        'description',
        'created_by',
        'modified_by',
        'created_at',
        'updated_at',
    ];

    protected $fieldFilter = [
        'name',
    ];

    public $fieldOrder = [
        'updated_at',
        'created_at',
        'name',
        'code',
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
        return Departments::class;
    }
    
    public function paginate($search = [], $perPage = null, $columns = null, $orders = [])
    {
        return parent::paginate($search, $perPage, $columns, $orders);
    }

    public function create($input)
    {
        return parent::create($input);
    }

    public function update($input, $id){
        return parent::update($input, $id);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }
}

<?php

namespace App\Repositories;

use App\Models\Departments;
use App\Repositories\BaseRepository;
use phpDocumentor\Reflection\Types\Array_;

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

    public function create($input)
    {
        return parent::create($input);
    }

}

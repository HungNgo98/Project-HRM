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
        'course_category_id',
        'description',
        'current_order'
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
        return courses::class;
    }

    public function  create($input)
    {
        return parent::create($input);
    }
}

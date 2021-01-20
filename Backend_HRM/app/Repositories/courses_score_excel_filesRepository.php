<?php

namespace App\Repositories;

use App\Models\courses_score_excel_files;
use App\Repositories\BaseRepository;

/**
 * Class courses_score_excel_filesRepository
 * @package App\Repositories
 * @version January 18, 2021, 9:57 am UTC
*/

class courses_score_excel_filesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'course_id',
        'user_id',
        'status'
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
        return courses_score_excel_files::class;
    }
}

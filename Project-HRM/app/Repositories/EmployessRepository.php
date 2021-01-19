<?php

namespace App\Repositories;

use App\Models\Employess;
use App\Repositories\BaseRepository;

/**
 * Class EmployessRepository
 * @package App\Repositories
 * @version January 18, 2021, 10:11 am UTC
*/

class EmployessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'department_id',
        'position_id',
        'job_status_id',
        'working_status_id',
        'late_reason_id',
        'direct_manager_id',
        'position_concurrently_id',
        'employee_code',
        'full_name',
        'email',
        'birth_day',
        'identification_number',
        'identification_date',
        'identification_place_of',
        'tax_code',
        'permanent_address',
        'temporary_address',
        'bank_number',
        'bank_name',
        'bank_user_name',
        'bank_branch',
        'phone_number',
        'chatwork_account',
        'skype_account',
        'facebook_link',
        'personal_email',
        'avatar',
        'japanese_certificate',
        'update_date',
        'check_in_date',
        'training_date',
        'official_date',
        'contact_user',
        'distance',
        'gender',
        'check_out_date'
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
        return Employess::class;
    }
}

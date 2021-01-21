<?php

namespace App\Repositories;

use App\Models\Employees;
use App\Repositories\BaseRepository;

/**
 * Class EmployeesRepository
 * @package App\Repositories
 * @version January 21, 2021, 6:54 am UTC
*/

class EmployeesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'employee_code',
        'full_name',
        'email',
        'gender'
    ];

    protected $fieldInList = [
        'id',
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
        'check_out_date',
        'created_by',
        'modified_by',
        'created_at',
        'updated_at'
    ];

    protected $fieldFilter = [
        'full_name'
    ];

    public $fieldOrder = [
        'updated_at',
        'created_at',
        'full_name'
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
        return Employees::class;
    }

    public function paginate($search = [], $perPage = null, $columns = null, $orders = [])
    {
        return parent::paginate($search, $perPage, $columns, $orders);
    }

    public function create($input)
    {
        return parent::create($input);
    }

    public function update($input, $id)
    {
        return parent::update($input, $id);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }
}

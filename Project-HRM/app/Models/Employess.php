<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Employess
 * @package App\Models
 * @version January 18, 2021, 10:11 am UTC
 *
 * @property \App\Models\Department $department
 * @property \App\Models\JobStatus $jobStatus
 * @property \App\Models\Position $position
 * @property integer $user_id
 * @property integer $department_id
 * @property integer $position_id
 * @property integer $job_status_id
 * @property integer $working_status_id
 * @property integer $late_reason_id
 * @property integer $direct_manager_id
 * @property integer $position_concurrently_id
 * @property string $employee_code
 * @property string $full_name
 * @property string $email
 * @property string $birth_day
 * @property string $identification_number
 * @property string $identification_date
 * @property string $identification_place_of
 * @property string $tax_code
 * @property string $permanent_address
 * @property string $temporary_address
 * @property string $bank_number
 * @property string $bank_name
 * @property string $bank_user_name
 * @property string $bank_branch
 * @property string $phone_number
 * @property string $chatwork_account
 * @property string $skype_account
 * @property string $facebook_link
 * @property string $personal_email
 * @property string $avatar
 * @property string $japanese_certificate
 * @property string $update_date
 * @property string $check_in_date
 * @property string $training_date
 * @property string $official_date
 * @property string $contact_user
 * @property string $distance
 * @property boolean $gender
 * @property string $check_out_date
 */
class Employess extends Model
{


    public $table = 'employees';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'department_id' => 'integer',
        'position_id' => 'integer',
        'job_status_id' => 'integer',
        'working_status_id' => 'integer',
        'late_reason_id' => 'integer',
        'direct_manager_id' => 'integer',
        'position_concurrently_id' => 'integer',
        'employee_code' => 'string',
        'full_name' => 'string',
        'email' => 'string',
        'birth_day' => 'date',
        'identification_number' => 'string',
        'identification_date' => 'date',
        'identification_place_of' => 'string',
        'tax_code' => 'string',
        'permanent_address' => 'string',
        'temporary_address' => 'string',
        'bank_number' => 'string',
        'bank_name' => 'string',
        'bank_user_name' => 'string',
        'bank_branch' => 'string',
        'phone_number' => 'string',
        'chatwork_account' => 'string',
        'skype_account' => 'string',
        'facebook_link' => 'string',
        'personal_email' => 'string',
        'avatar' => 'string',
        'japanese_certificate' => 'string',
        'update_date' => 'date',
        'check_in_date' => 'date',
        'training_date' => 'date',
        'official_date' => 'date',
        'contact_user' => 'string',
        'distance' => 'string',
        'gender' => 'boolean',
        'check_out_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'department_id' => 'nullable',
        'position_id' => 'nullable',
        'job_status_id' => 'nullable',
        'working_status_id' => 'nullable',
        'late_reason_id' => 'nullable',
        'direct_manager_id' => 'nullable',
        'position_concurrently_id' => 'nullable',
        'employee_code' => 'required|string|max:255',
        'full_name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'birth_day' => 'nullable',
        'identification_number' => 'nullable|string|max:255',
        'identification_date' => 'nullable',
        'identification_place_of' => 'nullable|string|max:255',
        'tax_code' => 'nullable|string|max:255',
        'permanent_address' => 'nullable|string|max:255',
        'temporary_address' => 'nullable|string|max:255',
        'bank_number' => 'nullable|string|max:255',
        'bank_name' => 'nullable|string|max:255',
        'bank_user_name' => 'nullable|string|max:255',
        'bank_branch' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:255',
        'chatwork_account' => 'nullable|string|max:255',
        'skype_account' => 'nullable|string|max:255',
        'facebook_link' => 'nullable|string|max:255',
        'personal_email' => 'nullable|string|max:255',
        'avatar' => 'nullable|string|max:255',
        'japanese_certificate' => 'nullable|string|max:255',
        'update_date' => 'nullable',
        'check_in_date' => 'nullable',
        'training_date' => 'nullable',
        'official_date' => 'nullable',
        'contact_user' => 'nullable|string',
        'distance' => 'nullable|string|max:255',
        'gender' => 'required|boolean',
        'check_out_date' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function jobStatus()
    {
        return $this->belongsTo(\App\Models\JobStatus::class, 'job_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function position()
    {
        return $this->belongsTo(\App\Models\Position::class, 'position_id');
    }
}

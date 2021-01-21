<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'department_id' => $this->department_id,
            'position_id' => $this->position_id,
            'job_status_id' => $this->job_status_id,
            'working_status_id' => $this->working_status_id,
            'late_reason_id' => $this->late_reason_id,
            'direct_manager_id' => $this->direct_manager_id,
            'position_concurrently_id' => $this->position_concurrently_id,
            'employee_code' => $this->employee_code,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'birth_day' => $this->birth_day,
            'identification_number' => $this->identification_number,
            'identification_date' => $this->identification_date,
            'identification_place_of' => $this->identification_place_of,
            'tax_code' => $this->tax_code,
            'permanent_address' => $this->permanent_address,
            'temporary_address' => $this->temporary_address,
            'bank_number' => $this->bank_number,
            'bank_name' => $this->bank_name,
            'bank_user_name' => $this->bank_user_name,
            'bank_branch' => $this->bank_branch,
            'phone_number' => $this->phone_number,
            'chatwork_account' => $this->chatwork_account,
            'skype_account' => $this->skype_account,
            'facebook_link' => $this->facebook_link,
            'personal_email' => $this->personal_email,
            'avatar' => $this->avatar,
            'japanese_certificate' => $this->japanese_certificate,
            'update_date' => $this->update_date,
            'check_in_date' => $this->check_in_date,
            'training_date' => $this->training_date,
            'official_date' => $this->official_date,
            'contact_user' => $this->contact_user,
            'distance' => $this->distance,
            'gender' => $this->gender,
            'check_out_date' => $this->check_out_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}

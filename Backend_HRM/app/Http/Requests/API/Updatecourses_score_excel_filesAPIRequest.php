<?php

namespace App\Http\Requests\API;

use App\Models\courses_score_excel_files;
use InfyOm\Generator\Request\APIRequest;

class Updatecourses_score_excel_filesAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = courses_score_excel_files::$rules;
        
        return $rules;
    }
}

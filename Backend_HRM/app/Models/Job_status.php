<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Job_status
 * @package App\Models
 * @version January 20, 2021, 2:18 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @property string $name
 * @property string $code
 * @property string $description
 * @property integer $created_by
 * @property integer $modified_by
 */
class Job_status extends Model
{


    public $table = 'job_status';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'code',
        'description',
        'created_by',
        'modified_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'code' => 'string',
        'description' => 'string',
        'created_by' => 'integer',
        'modified_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:255',
        'description' => 'required|string|max:255',
        'created_by' => 'nullable',
        'modified_by' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function employees()
    {
        return $this->hasMany(\App\Models\Employee::class, 'job_status_id');
    }
}

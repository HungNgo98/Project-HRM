<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Departments
 * @package App\Models
 * @version January 18, 2021, 10:00 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $employees
 * @property string $name
 * @property string $code
 * @property string $description
 */
class Departments extends Model
{


    public $table = 'departments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'code',
        'description'
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
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'code' => 'nullable|string|max:255',
        'description' => 'nullable|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function employees()
    {
        return $this->hasMany(\App\Models\Employee::class, 'department_id');
    }
}

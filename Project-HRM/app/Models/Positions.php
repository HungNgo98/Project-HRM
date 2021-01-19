<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Positions
 * @package App\Models
 * @version January 18, 2021, 10:02 am UTC
 *
 * @property string $name
 * @property string $code
 * @property string $description
 */
class Positions extends Model
{


    public $table = 'positions';
    
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
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:255',
        'description' => 'required|string|max:255'
    ];

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class courses_score_excel_files
 * @package App\Models
 * @version January 18, 2021, 9:57 am UTC
 *
 * @property \App\Models\Course $course
 * @property string $name
 * @property integer $course_id
 * @property integer $user_id
 * @property boolean $status
 */
class courses_score_excel_files extends Model
{


    public $table = 'courses_score_excel_files';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'course_id',
        'user_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'course_id' => 'integer',
        'user_id' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'course_id' => 'required',
        'user_id' => 'required',
        'status' => 'nullable|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id');
    }
}

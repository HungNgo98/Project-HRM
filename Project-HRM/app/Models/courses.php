<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class courses
 * @package App\Models
 * @version January 18, 2021, 9:38 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $coursesScoreExcelFiles
 * @property integer $course_category_id
 * @property string $description
 * @property string $current_order
 */
class courses extends Model
{


    public $table = 'courses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'course_category_id',
        'description',
        'current_order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_category_id' => 'integer',
        'description' => 'string',
        'current_order' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_category_id' => 'nullable|integer',
        'description' => 'nullable|string',
        'current_order' => 'nullable|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function coursesScoreExcelFiles()
    {
        return $this->hasMany(\App\Models\CoursesScoreExcelFile::class, 'course_id');
    }
}

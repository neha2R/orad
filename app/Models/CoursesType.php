<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursesType extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function Course(){
        return $this->belongsTo(Courses::class,'course_id','id');
    }

    /**
     * purchased course details 
     */
    public function purchasedCourse(){
        return $this->hasOne(CoursePayments::class, 'course_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function coursetype(){
        return $this->hasMany(CoursesType::class,'course_id','id');
    }
    public function activeCourses(){
        return $this->hasMany(CoursesType::class,'course_id','id')->where('isactive','1');
    }
    public function singleCourses(){
        return $this->hasOne(CoursesType::class,'course_id','id')->where(['isactive'=>'1','show_on_dashboard'=>'1']);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function trainerRelation(){
        return $this->hasOne(User::class,'id','trainerid');
    }

    public function slotRelation(){
        return $this->hasOne(Slot::class,'id','slot');
    }

    public function feedbackRelation(){
        return $this->hasOne(ClassFeedback::class,'class_id','id');
    }

    public function studentRelation(){
        return $this->hasOne(User::class, 'id','leadid');
    }

    public function userRelation(){
        return $this->hasOne(User::class, 'id','leadid');
    }

    public function course(){
        return $this->hasOne(CoursesType::class, 'id','course_id');
    }
}

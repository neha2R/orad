<?php

namespace App\Http\Traits;

use App\Models\CoursesType;

/**
 * Child Course update on parent course updation
 * 
 * This triat only work in live wire 
 */
trait PaymentCourseTrait
{

    // update specific course on parent course change 
    public function updatedParentCourseId(){
        $this->courses = CoursesType::where(['isactive'=>'1', 'course_id'=>$this->parentCourseId])->get();
    }

    // update child course details 
    public function updatedChildCourseId(){
        $childCourses = CoursesType::findorFail($this->childCourseId);
        $this->price = $childCourses->price;
        $this->discount = $childCourses->discount;
        $this->duration = $childCourses->no_of_classes;
    }
}
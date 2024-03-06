<?php

namespace App\Services;

use App\Models\ClassHistory;



// use App\Models\LeadStatus;

class ClassHistoryService{

    public static function classreschedule($classid,$name,$olddate,$oldtime,$newdate,$newtime){
        $message="Class is reschedule by student {{$name}} from {{$olddate}} {{$oldtime}} to {{$newdate}} {{$newtime}} ";
        ClassHistory::create(['class_id'=>$classid,'history'=>$message]);
    }

    
}
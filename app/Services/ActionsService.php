<?php

namespace App\Services;


// use App\Models\LeadStatus;

class ActionsService
{
    public static function newuserregister($userid){
        // InappNotificationService::newuserregisteration($userid);
        SmsService::usercreated($userid);
    }

    public static function newjuniorassignmentundersenior($parentid,$userid){
        InappNotificationService::newassignment($parentid,$userid);
    }

    public static function demosuccessfullycompletedbytrainer($userid){
        SmsService::demosuccessfull($userid,auth()->user()->id); 
        SmsService::clientfeedback($userid,auth()->user()->name,auth()->user()->mobile);
        WhatsappService::afterdemofeedback($userid,auth()->user()->name,auth()->user()->mobile);
        InappNotificationService::democompletedsuccessfullybytrainer($userid);
    }

    public static function reschedulingjrmarketing(){
        
    }
}
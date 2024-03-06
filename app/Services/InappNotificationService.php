<?php

namespace App\Services;

use App\Models\Demo;
use App\Models\LeadStatus;
use App\Models\Slot;
use App\Models\User;
use App\Notifications\NewUserRegisteration;
use App\Models\CoursePayments;

// use App\Models\LeadStatus;

class InappNotificationService
{
    public static function democreatedbyjrmarketing($leadstatus, $slotid, $demodate,$srtrainerid=null)
    {
        try {
            #if jr marketing creat demo
        #Sr marketing
        $data = LeadStatus::find($leadstatus);
        $leaddetail = User::findorFail($data->leadid);
        $clientname = $leaddetail->name;
        $slot = Slot::findorFail($slotid);
        $demotime = "{$slot->from}";
        $jrmarketingname = auth()->user()->name;
        $seniormessagetitle = "Keep an eye on!!!";
        $seniormessage = "{$jrmarketingname} has added a demo of {$clientname} at {$demotime} on {$demodate}";
        User::findorFail(auth()->user()->parent_id)->notify(new NewUserRegisteration($seniormessagetitle, $seniormessage, auth()->user()->parent_id));
        #jr marketing
        $data = LeadStatus::find($leadstatus);
        $leaddetail = User::findorFail($data->leadid);
        $clientname = $leaddetail->name;
        $jrmessagetitle = "A pat on the back!!!";
        $jrmessage = "The demo of {$clientname} has been created and forwarded";
        User::findorFail(auth()->user()->id)->notify(new NewUserRegisteration($jrmessagetitle, $jrmessage, auth()->user()->id));
        #sr trainer
        $data = LeadStatus::find($leadstatus);
        $leaddetail = User::findorFail($data->leadid);
        $clientname = $leaddetail->name;
        $jrmessagetitle = "Gear up, You have bigger fish to fry!!!";
        $jrmessage = "Demo for {$clientname}  yet to be assigned to a trainer at {$demotime} on {$demodate}";
        User::findorFail($srtrainerid)->notify(new NewUserRegisteration($jrmessagetitle, $jrmessage,$srtrainerid));

        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    public static function srmarketingcreatelead($id, $leadcount)
    {
        try {
            #if sr marketing creat lead
        $srmessagetitle = "New lead in the house!!!";
        $srmessage = "Yay!! You've added ${$leadcount} new lead";
        User::findorFail($id)->notify(new NewUserRegisteration($srmessagetitle, $srmessage, $id));
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    public static function srmarketingassignleadtojrmarketing($id, $count, $srmarketingname)
    {
        try {
            $title = "Gear up, You have bigger fish to fry!!!";
        $message = "{$srmarketingname} has assigned you {$count} lead.";
        User::findorFail($id)->notify(new NewUserRegisteration($title, $message, $id));
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }

    public static function trainerassignbysrtrainertojuniortrainer($clientname, $trainername, $demotime, $demodate, $seniorid, $juniorid, $seniormrid, $juniormrid)
    {
        try {
            //code...
        
        $demodate=dateformater($demodate);
        #Sr Trainer
        $title = "Good Job!!!";
        $message = "Demo for {$clientname} is assigned to {$trainername}";
        User::findorFail($seniorid)->notify(new NewUserRegisteration($title, $message, $seniorid));
        #jr Trainer
        $title = "Gear up, You have bigger fish to fry!!!";
        $message = " A new demo for {$clientname} is assigned to you at {$demotime} on {$demodate} ";
        User::findorFail($juniorid)->notify(new NewUserRegisteration($title, $message, $juniorid));
        #Sr marketing
        $title = "New lead in the house!!!";
        $message = " A new demo for {$clientname} is assigned to {$trainername} at {$demotime} on {$demodate} ";
        User::findorFail($seniormrid)->notify(new NewUserRegisteration($title, $message, $seniormrid));
        #Jr. Marketing
        $title = "Yay!!!";
        $message = "A new {$trainername} is assigned to your Client {$clientname}  at {$demotime} on {$demodate} ";
        User::findorFail($juniormrid)->notify(new NewUserRegisteration($title, $message, $juniormrid));
    } catch (\Throwable $th) {
        //throw $th;
    }
    }

    public static function reschedulingjrmarkeing($clientname, $jrtraining, $olddatetime, $newdatetime, $demoid)
    {
        try {
            //code...
       
        // dd($demoid);
        $demodata = Demo::find($demoid);
        $user=User::findorFail($demodata->leadid);
        $stakeholder=$user->stakeholders()->unique()->values()->all();


        // dd($demodata->demoleadstatus);
        #Jr marketing
        if(array_key_exists(1,$stakeholder)){
        $title = "Take a rain check";
        $message = "The demo of {$clientname} has been rescheduled by you  from  {$olddatetime} To {$newdatetime} ";
        $juniormarketingid = $stakeholder[1];
        User::findorFail($juniormarketingid)->notify(new NewUserRegisteration($title, $message, $juniormarketingid));
        }
        #sr. trainer
        if(array_key_exists(2,$stakeholder)){
        $srtrainer=$stakeholder[2];
        $title = "Take a rain check";
        $message = "The demo of {$clientname} has been rescheduled by {$jrtraining}  from {$olddatetime} To {$newdatetime}";
        User::findorFail($srtrainer)->notify(new NewUserRegisteration($title, $message, $srtrainer));
        }
        #jr trainer
        if(array_key_exists(3,$stakeholder)){
            $seniortrainerid = $stakeholder[3];
            $title = "Take a rain check";
            $message = "The demo of {$clientname} has been rescheduled by {$jrtraining}  from {$olddatetime} To {$newdatetime} ";
            // $jrtrainerid = LeadStatus::where(['assignedto' => $juniormarketingid, 'level' => 3, 'department' => 3])->first();
            User::findorFail($seniortrainerid)->notify(new NewUserRegisteration($title, $message, $seniortrainerid));
    
        }
    } 
        catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    public static function reschedulingjrtrainer($clientname,$trainername,$oldtime,$newtime,$demoid)
    {
        try {
           // dd($demoid);
        $demodata=Demo::find($demoid)->demoleadstatus->pluck('assignedto')->toArray();
        // dd($demodata);
        #Jr marketing
        $title = "Take a rain check";
        $message = "The demo of {$clientname} has been rescheduled by {$trainername}  from {$oldtime} To {$newtime}";
        User::findorFail($demodata[1])->notify(new NewUserRegisteration($title, $message, $demodata[1]));

        #sr. trainer
        $title = "Take a rain check";
        $message = "The demo of {$clientname} has been rescheduled by {$trainername}  from {$oldtime} To  {$newtime}";
        User::findorFail($demodata[2])->notify(new NewUserRegisteration($title, $message, $demodata[2]));

        #jr trainer
        
        $title = "Take a rain check";
        $message = "The demo of {$clientname} has been rescheduled by you  from {$oldtime} To {$newtime}";
        User::findorFail($demodata[3])->notify(new NewUserRegisteration($title, $message,$demodata[3]));
        } catch (\Throwable $th) {
            //throw $th;
        }
        

    }

    public static function newuserregisteration($userid){
        try {
            $user=User::findorFail($userid);
        $ceo=User::where(['user_type'=>1,'department'=>1])->first();
        #Ceo 
        $title="Our fam is growing!";
        $message="{$user->name} joined the company in {$user->departmentRelation->name} ";
        User::findorFail($ceo->id)->notify(new NewUserRegisteration($title, $message,$ceo->id));
        #Admin
        $admin=User::where(['user_type'=>1,'department'=>2])->first();
        $title="Yay!!!";
        $message="Account for {$user->name} has been created";
        User::findorFail($ceo->id)->notify(new NewUserRegisteration($title, $message,$admin->id));
        #Self 
        $title="Hey Champ!!";
        $message="Welcome to ORAD";
        User::findorFail($user->id)->notify(new NewUserRegisteration($title, $message,$user->id));
        } catch (\Throwable $th) {
            //throw $th;
        }
       
        
    }

    public static function newassignment($parentid,$userid){
        try {
            $parentuser=User::find($parentid);
            $user=User::find($userid);
            #Ceo
            $title="User assigned!!!";
            $message="{$user->name} is assigned under {$parentuser->name}";
            $ceo=User::where(['user_type'=>1,'department'=>1])->first();
            User::findorFail($ceo->id)->notify(new NewUserRegisteration($title, $message,$ceo->id));
            #Admin
            $title="User assigned!!!";
            $message="You have assigned {$user->name} under {$parentuser->name}";
            $admin=User::where(['user_type'=>1,'department'=>2])->first();
            User::findorFail($admin->id)->notify(new NewUserRegisteration($title, $message,$admin->id));
            #Senior Manager of the person
            $title="A new champ in the team";
            $message="{$user->name} is assigned under you";
            User::findorFail($parentuser->id)->notify(new NewUserRegisteration($title, $message,$parentuser->id));
            #Self or jr
            $title="Hey Champ!!";
            $message="{$parentuser->name} is your Team leader";
            User::findorFail($user->id)->notify(new NewUserRegisteration($title, $message,$user->id));
        } catch (\Throwable $th) {
            //throw $th;
        }
        

    }

    public static function democompletedsuccessfullybytrainer($userid){
        try {
            $user=User::findorFail($userid);
        $clientname=$user->name;
        $trainername=auth()->user()->name;
        $stakeholder=$user->stakeholders()->unique()->values()->all();
        
        if(array_key_exists(0,$stakeholder)){
            #Sr marketing
            $srmarketingid=$stakeholder[0];
            $user=User::findorFail($srmarketingid);
            $title="Yay!!!";
            $message="{$trainername} has successfully completed the assigned demo of {$clientname}";
            $user->notify(new NewUserRegisteration($title, $message,$srmarketingid));
        }
        if(array_key_exists(1,$stakeholder)){
            #Jr. Marketing
            $jrmarketingid=$stakeholder[1];
            $user=User::findorFail($jrmarketingid);
            $title="Gear up, You have bigger fish to fry!!!";
            $message="{$trainername} has successfully completed the assigned demo of {$clientname}";
            $user->notify(new NewUserRegisteration($title, $message,$jrmarketingid));
        }
        if (array_key_exists(2,$stakeholder)) {
             #Sr Trainer
                $srtrainingid=$stakeholder[2];
                $title="Yay!!!";
                $user=User::findorFail($srtrainingid);
                $message="{$trainername} has successfully completed the assigned demo of {$clientname} ";
                $user->notify(new NewUserRegisteration($title, $message,$srtrainingid));
        }
       
        if (array_key_exists(3,$stakeholder)) {
                #jr Trainer
                $jrtrainingid=$stakeholder[3];
                $title="A pat on the back!!!";
                $message="You have successfully completed the assigned demo of {$clientname}";
                User::findorFail($jrtrainingid)->notify(new NewUserRegisteration($title, $message,$jrtrainingid));
        }
        
       
        
        } catch (\Throwable $th) {
            //throw $th;
        }
       
        
        
    }

    public static function paymentdone($courseid){
        try {
            $course=CoursePayments::findorFail($courseid);
        $name=optional($course->user)->name;
        $coursename=optional($course->course->Course)->name ?? '';
        $coursetype=$course->name ?? '';
        $courseduration=$course->days  ?? '';
        $user=User::findorFail($course->lead_id);
        $title="Gotcha ! Roaring success!!";
        $message="Your hardwork gave fruit and {$name} joined the {$coursename} {$coursetype} {$courseduration} days course.";
        $stakeholder=$user->stakeholders()->unique()->values()->all();  
        foreach ($stakeholder as $key => $value) {
            User::findorFail($value)->notify(new NewUserRegisteration($title,$message,$value));
        }
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }

    public static function demounsuccessfull($userid){
        $user=User::findorFail($userid);
        
        $stakeholder=$user->stakeholders()->unique()->values()->all();
        if (array_key_exists(3, $stakeholder)) {
            $trainer=User::findorFail($stakeholder[3]);
        }
        if (array_key_exists(0, $stakeholder)) {
            #sr marketing
            // $user=User::findorFail($stakeholder[0]);
            $title="Ohh no Demo Fail!!!";
            $message="{$trainer->name} was unsuccessfull in completing the assigned demo of {$user->name}";
            User::findorFail($stakeholder[0])->notify(new NewUserRegisteration($title,$message,$stakeholder[0]));
        }

        if (array_key_exists(1, $stakeholder)) {
            #jr marketing
            // $user=User::findorFail($stakeholder[1]);
            $title="Ohh no Demo Fail!!!";
            $message="{$trainer->name} was unsuccessful in completing the assigned demo of {$user->name}";
            User::findorFail($stakeholder[1])->notify(new NewUserRegisteration($title,$message,$stakeholder[1]));
        }


        if (array_key_exists(2, $stakeholder)) {
            #sr trainer
            // $user=User::findorFail($stakeholder[2]);
            $title="Ohh no Demo Fail!!!";
            $message="{$trainer->name} fails to complete the assigned demo of {$user->name}";
            User::findorFail($stakeholder[2])->notify(new NewUserRegisteration($title,$message,$stakeholder[2]));
        }

        if (array_key_exists(3, $stakeholder)) {
            #jr trainer
            // $user=User::findorFail($stakeholder[3]);
            $title="The bottom falls out";
            $message="You haven't completed the assigned demo of {$user->name} ";
            User::findorFail($stakeholder[3])->notify(new NewUserRegisteration($title,$message,$stakeholder[3]));
        }
    }

}

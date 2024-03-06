<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\LeadStatus;

class LeadService
{
    public static function getassignedToseniorsales($authid, $id){
       return LeadStatus::where(['leadid'=>$id,'assignedby'=>$authid]);
    }
}
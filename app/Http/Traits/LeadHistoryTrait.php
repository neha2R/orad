<?php

namespace App\Http\Traits;

use App\Models\LeadStatus;
use App\Models\LeadHistory;


/**
 * Feedback of specific trait
 * 
 * This triat only work in live wire 
 */
trait LeadHistoryTrait
{
     
    // comment variables 
    public $leadhistorycomment='', $leadidfordemo;
 
    public function getleadHistory($leadid,$leadstatusfordemo){
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadidfordemo = $leadid;
        $this->leadstatusfordemo=$leadstatusfordemo;
    } 

    /**
     * store auth user comment in lead history table
     */
    public function leadhistorycommentstore(){
        $leadstatus=LeadStatus::findorFail($this->leadstatusfordemo);
        $leadid=$leadstatus->leadid;
        leadHistorycomment($this->leadhistorycomment,$leadid);
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadhistorycomment='';
        
    }

    public function clearLeadHistory()
    {
        $this->leadhistorydata = [];
    }
}

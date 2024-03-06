<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function userAssignedTo(){
        return $this->hasOne(User::class,'id','assignedto');
    }

    public function demoRelation(){
        return $this->hasOne(Demo::class,'leadstatus','id');
    }

    public function userRelation(){
        return $this->hasOne(User::class,'id','leadid');
    }
    public function demoStatus(){
        return $this->hasOne(Demo::class, 'id', 'demoid');
    }
    
    public function coldLead()
    {
        return $this->hasOne(User::class,'id','leadid')->where('leadtype','2');
        
    }
   
    public function paymentDetails()
    {
        return $this->hasOne(CoursePayments::class, 'lead_id','id');
    }

    public function scheduledClasses(){
        return $this->hasOne(Classes::class, 'leadid', 'leadid');
    }
}

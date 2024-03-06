<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function slotRelation(){
        return $this->hasOne(Slot::class,'id','slot');
    }

    public function trainerRelation(){
        return $this->hasOne(User::class,'id','trainerid');
    }

    public function demoleadstatus(){
        return $this->hasMany(LeadStatus::class,'demoid','id');
    }

    public function payment(){
        return $this->hasOne(CoursePayments::class, 'customer_id','leadid')->has('trainer');
    }
    
    public function userRelation(){
        return $this->hasOne(User::class,'id','leadid');
    }

    public function trainerFeedback()
    {
        return $this->hasOne(FeedBack::class, 'demoid', 'id');
    }
}

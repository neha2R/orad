<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePayments extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function course(){
        return $this->hasOne(CoursesType::class,'id','course_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','lead_id');
    }

    public function leadstatus(){
        return $this->hasOne(LeadStatus::class,'id','lead_status');
    }

    public function trainer(){
        return $this->hasOne(LeadStatus::class, 'assignedto', 'user_id');
    }

    public function student(){
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
    
    /**
     * For class start ddate
     */
    public function classesRelation(){
        return $this->hasOne(Classes::class, 'leadid', 'customer_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departmentRelation()
    {
        return $this->hasOne(SubDepartment::class,'id','department');
    }

    public function assignedusers()
    {
        return $this->hasMany(LeadStatus::class, 'assignedto', 'id');
    }

    public function userDetails(){
        return $this->hasOne(UserDetail::class,'user_id','id');
    }

    public function demoRelation(){
        return $this->hasMany(Demo::class,'leadid','id');
    }

    public function leadStatus(){
        return $this->hasMany(LeadStatus::class,'leadid','id');
    }

    public function assignedtouser($authid,$id){
        // dd($authid,$id);
        // return LeadStatus::where(['leadid'=>$id,'assignedby'=>$authid])->get();
        return LeadStatus::where('assignedby',$authid)->where('leadid',$id)->first();
        
    }

    public function followUpLeads(){
        
    }

    public function demo(){
        return $this->hasOne(Demo::class,'leadid','id');
    }

    public function stakeholders(){
        return $this->hasMany(LeadStatus::class,'leadid','id')->pluck('assignedto');
    }

    public function seniorMarketingRelation(){
        return $this->hasOne(LeadStatus::class,'leadid','id')->where(['department'=>3,'level'=>2]);
    }

    public function juniorMarketingRelation(){
        return $this->hasOne(LeadStatus::class,'leadid','id')->where(['department'=>3,'level'=>3]);
    }

    public function seniorTrainerRelation(){
        return $this->hasOne(LeadStatus::class,'leadid','id')->where(['department'=>4,'level'=>2]);
    }

    public function juniorTrainerRelation(){
        return $this->hasOne(LeadStatus::class,'leadid','id')->where(['department'=>4,'level'=>3]);
    }

    public function leadMessages(){
        return $this->hasMany(LeadMessages::class,'leadid','id');
    }

    public function parent()
    {
        return $this->hasOne(ParentsDetail::class, 'user_id','id');
    }

    public function subDepartment()
    {
        return $this->hasOne(SubDepartment::class, 'id', 'sub_department');
    }

    public function departmentDetails()
    {
        return $this->hasOne(Department::class, 'id', 'department');
    }

    /**
     * Get student's class trainer details
     */
    public function trainer()
    {
        return $this->hasOne(User::class, 'parent_id', 'id');
    }

    /**
     * Get student slot relation for class
     */
    public function slotRelation()
    {
        return $this->hasOne(Slot::class, 'id', 'slot_id');
    }
}

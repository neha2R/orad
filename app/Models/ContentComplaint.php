<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentComplaint extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function contentRelation(){
        return $this->hasOne(OradContent::class,'id','content_id');
    }

    public function complaintcreatorRelation(){
        return $this->hasOne(User::class,'id','complaint_creator');
    }

    public function complaintjuniorTrainer(){
        return $this->hasOne(User::class,'id','assigned_to_junior');
    }
}

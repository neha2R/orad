<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OradContent extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function contentfile(){
        return $this->hasMany(ContentFiles::class,'content_id','id');
    }
    public function assignedto(){
        return $this->hasOne(User::class,'id','creator');
    }

    public function contentCategory(){
        return $this->hasOne(ContentCategory::class,'id','keyword');
    }
}

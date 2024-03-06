<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // protected $fillable = ['id', 'name', 'is_active'];

    protected $guarded=[];

    public function subdepartments()
    {
        return $this->hasMany(SubDepartment::class, 'department', 'id');
    }
}

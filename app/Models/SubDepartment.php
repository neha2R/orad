<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    use HasFactory;

    // protected $fillable = ['id', 'name', 'department', 'is_active'];
    protected $guarded = [];
    public function departmentname()
    {
        return $this->belongsTo(Department::class, 'department');
    }
}

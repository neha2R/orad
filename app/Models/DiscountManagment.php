<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountManagment extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    /**
     * department relationship
     */
    public function departmentRelation(){
        return $this->hasOne(Department::class,'id','department');
    }
    
    public function subdepartmentRelation()
    {
        return $this->hasOne(SubDepartment::class,'id','sub_department');
        # code...
    }

}

<?php

namespace App\Http\Livewire\Website;

use App\Models\User;
use Livewire\Component;
use App\Models\EmployeeOfTheMonth;
use Illuminate\Support\Facades\Auth;

class Career extends Component
{
   
    public function render()
    {
        $employeeOfMonth = EmployeeOfTheMonth::where('is_active','1')->get();
        return view('website.career',compact('employeeOfMonth'))
        ->layout('website.layouts.app');
    }
}

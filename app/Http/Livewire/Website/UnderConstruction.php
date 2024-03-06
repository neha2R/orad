<?php

namespace App\Http\Livewire\Website;

use App\Models\User;
use Livewire\Component;
use App\Models\CoursesType;
use Illuminate\Support\Facades\Auth;

class UnderConstruction extends Component
{
   
    public function render()
    {
        return view('website.under_construction')
        ->layout('website.layouts.app');
    }
}

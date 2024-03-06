<?php

namespace App\Http\Livewire\Website;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Models\Courses as CourseTable;

class Courses extends Component
{
   
    public function render()
    {
        $data = CourseTable::where('isactive','1')->get();

        return view('website.course', compact('data'))
        ->layout('website.layouts.app');
    }
}

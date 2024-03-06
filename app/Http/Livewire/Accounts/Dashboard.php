<?php

namespace App\Http\Livewire\Accounts;

use Livewire\Component;
use App\Models\CoursePayments;

class Dashboard extends Component
{
    public function render()
    {
        $data=CoursePayments::has('user')->get();
        return view('livewire.accounts.dashboard',compact('data'));
    }
}

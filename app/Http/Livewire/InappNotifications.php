<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class InappNotifications extends Component
{
    use WithPagination;
    public $paginate=10;

    public function marknotificationread($notificationid){
        $notification = auth()->user()->notifications()->find($notificationid);
        if($notification) {
            $notification->markAsRead();
        }
    }

    public function markallnotificationasread(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect('/notifications');
    }

    public function render()
    {   
        $notifications = auth()->user()->notifications()->paginate(10);
        
        return view('livewire.inapp-notifications',['notifications'=>$notifications])->layout('layouts.new-app');
    }
}

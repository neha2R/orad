<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExamNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $url, $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_email)
    {
        $user = User::where('email',$user_email)->first();
        
        $this->url = route('login');
        $this->name = $user->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.exam-notification',[
            'name'=>$this->name,
            'url'=>$this->url,
        ]); 
    }
}

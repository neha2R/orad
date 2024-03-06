<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    
    public $url, $username;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $username)
    {
        $this->url=$url;
        $this->username=$username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.forgotpassword',['url'=>$this->url, 'username'=>$this->username]);
    }
}

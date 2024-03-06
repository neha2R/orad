<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Events\DemoNotification;
use App\Notifications\InappNotificationCommon;
use App\Events\PushNotificationEvent;

class PushNotificationChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toPushNotification($notifiable);
        event(new PushNotificationEvent($message['reciverid'],$message['message']));
    }
}
<?php

namespace App\Services;

class LivewireServices{

    public static function createMeeting(){
        $url ="https://conference.livebox.co.in/livebox/appsservice/api/videoConfSettings";
        $response = Http::post($url, [
            'name' => 'Steve',
            'role' => 'Network Administrator',
        ]);
    }    

}
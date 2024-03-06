@component('mail::message')
# Dear {{$name}},
This is an acknowledgement message to inform you that your registration for the ORAD LITTLE CHAMP competition has been completed successfully.
Your exam is scheduled on 05 September 2021 at 12:00 PM. 
We wish you very good luck. Prepare well. 

@component('mail::panel')
UserName : {{$email}} <br />
Password : {{$mobile}}
@endcomponent

@component('mail::button', ['url' => $url])
Click Link to login
@endcomponent

For any query you can reach us at 7023257319 or info@orad.in<br />
Thanks,<br>
{{ config('app.name') }}
@endcomponent

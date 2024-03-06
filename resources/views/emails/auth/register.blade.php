@component('mail::message')
# Hello

Welcome to ORAD family,You have been registered on ORAD system Please login using credentials below.


@component('mail::panel')
UserName : {{$email}}
Password : {{$password}}
@endcomponent

@component('mail::button', ['url' => $url])
Click Link to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

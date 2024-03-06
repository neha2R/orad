@component('mail::message')

# Hello {{$username}}

You are receiving this mail because we have recived a password change request for your account.

@component('mail::button', ['url' => $url])
Forgot Password
@endcomponent


@component('mail::panel')
If you did not reset your password ,no further action is required.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Dear {{$name}},
Greetings of the day ! 

So finally Date 5 Sept is knocking the door. 

Your test time is 01:00 PM. 
Are you all excited for ORAD LITTLE CHAMP TEST or you're panicking ? 
No worries , just take a deep breath it's just a simple English proficiency test where you don't have to prepare anything . For further details we have attached the PDFs on your registered email, just go through them carefully before the test . 

For opening the test you need to login  your ORAD account here. 
@component('mail::button', ['url' => $url])
Click Link to login
@endcomponent

Please login from your registered number. 

Wish you all the very best.
{{ config('app.name') }}
@endcomponent

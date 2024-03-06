<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ORAD Little Champ Competition </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    
    <link rel="stylesheet" href="{{asset('/css/app.css')}}" />
    <link rel="shortcut icon" href="{{asset('/Logo.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('/Logo.png')}}" type="image/x-icon">
    @livewireStyles
    @livewireScripts
    <script type="text/javascript" src="{{ URL::asset('files\assets\js\sweetalert.js') }}"></script>
  </head>

  <body>
    
    <div class="loader">
      <img src="{{ asset('images/icons/Spinner.gif') }}" alt="loader" class="w-20 margin-top-20 mx-auto">
    </div>

    @include('website.layouts.alert')
    {{ $slot }}
    
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
    $(document).ready(function() {
      $('.loader').hide();
    });
  </script>
  </body>
</html>

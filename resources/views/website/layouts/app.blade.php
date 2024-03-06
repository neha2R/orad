<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ORAD - Spoken English Classes Online</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    
    <link rel="stylesheet" href="{{asset('/css/app.css')}}" />
    <link rel="shortcut icon" href="{{asset('images/png/Orad-favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('images/png/Orad-favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.theme.default.min.css')}}">

    {{-- mailchimp  --}}
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/f73247b48aaa111d78d7e67e7/0e66eb62da6e6d2893e908392.js");</script>
    
    {{-- google analatics --}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y2YRYCF9W6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y2YRYCF9W6');
</script>

{{-- facebook pixel  --}}
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '704170790192381');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=704170790192381&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
    @livewireStyles
    
  </head>

  <body>
    
    <div class="loader">
      <img src="{{ asset('images/icons/Spinner.gif') }}" alt="loader" class="w-20 margin-top-20 mx-auto">

    </div>
    @if (!headLessComponent())
      @include('website.layouts.navigation')     
    @endif
    
      @include('website.layouts.alert')
    {{ $slot }}
    @if (!declineRoutes())
      @include('website.layouts.footer')
    @endif
    @include('cookieConsent::index')
    <div class="scholarship-strip">
      <a href="{{ route('scholarship') }}" class="scholarship-text">ORAD Little Champ Competition</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('js/hammer.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js" integrity="sha512-UxP+UhJaGRWuMG2YC6LPWYpFQnsSgnor0VUF3BHdD83PS/pOpN+FYbZmrYN+ISX8jnvgVUciqP/fILOXDjZSwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.6.x/dist/component.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
    <script id="gs-sdk" src='//www.buildquickbots.com/botwidget/v3/demo/static/js/sdk.js?v=3' key="e41ceb65-25f3-461c-99cd-e11e96d8c932" ></script>
    <script src="{{asset('/js/app.js')}}"></script>
    @livewireScripts
    <script>
    $(document).ready(function() {
      $('.loader').hide();
      
    });
  </script>
  </body>
</html>

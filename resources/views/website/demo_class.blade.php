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
    <link rel="shortcut icon" href="{{asset('/Logo.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('/Logo.png')}}" type="image/x-icon">
    
  </head>

  <body>
    <div class="loader">
      <img src="{{ asset('images/icons/Spinner.gif') }}" alt="loader" class="w-20 margin-top-20 mx-auto">

    </div>
    <nav class="flex items-center bg-white text-gray-900 pt-8 px-12 flex-wrap lg:px-16">
        <a href="{{ route('home') }}" class="p-2 mr-4 inline-flex items-center lg:-mt-6">
        <img loading="lazy"  src="{{asset('payment/logo.png')}}" alt="orad" class="w-28 ">
        </a>
        
    </nav>

    <div class="lg:flex gap-5 mx-auto">
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center flex-1 h-auto">
            <div class="mt-4">
            <img src="{{asset('images/png/5218253.png')}}" alt="img" class="w-600 ml-r-110">
            </div>
        </div>
        <div class="lg:w-1/2">
            <div class="flex flex-col justify-between">
                <div class="container px-8 md:px-32">
                    <div class="bg-white shadow-xl rounded-xl mt-4">
                        <div class="bg-primary p-5 text-center text-white rounded-t-xl">
            
                            <h2 class="text-xl font-display font-semibold">Book your free trial</h2>
                            <h6 class="text-sm font-light">1 on 1 trial class</h6>
                        </div>
                        <form class="p-5" method="POST" action="{{ route('bookDemo') }}">
                            @csrf
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input " placeholder="Full Name" name="name"  value="{{old('name')}}" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                                
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Email Address" name="email"  value="{{old('email')}}" required>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                                
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Phone Number" name="mobile"  value="{{old('mobile')}}" required>
                                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                                
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Whatsapp Number" name="whatsapp"  value="{{old('whatsapp')}}" required>
                                    @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                                
                            </div>
                            
                            <div class="mt-8">
                                <button class="btn-primary p-2 w-full rounded tracking-wide
                                font-medium font-display 
                                shadow-lg">
                                    Book Now
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-8 text-center items-center">
                        <a href="{{route('home')}}" class="text-primary text-light underline">Visit our website</a>
                    </div>
                </div>
                <div class="flex justify-center md:grid gap-4 md:grid-rows-1 md:grid-cols-3 px-4 items-center md:justify-items-center mt-12">
                    <a href="#" class="flex text-gray-400 row-start-1 col-start-1">
                        <img src="{{ asset('images/icons/Facebook.svg') }}" alt="facebook" class="w-6 h-6 bg-gray-300">
                        <span class="ml-2 hidden md:block">oradcosultancy</span>
                    </a>
                    <a href="#" class="flex text-gray-400 row-start-1 col-start-2">
                        <img src="{{ asset('images/icons/Instagram.svg') }}" alt="instagram" class="w-6 h-6 bg-gray-300">
                        <span class="ml-2 hidden md:block">spoken_english_orad</span>
                    </a>
                    <a href="#" class="flex text-gray-400 row-start-1 col-start-3">
                        <img src="{{ asset('images/icons/LinkedIn.svg') }}" alt="linkedIn" class="w-6 h-6 bg-gray-300">
                        <span class="ml-2 md:block hidden">oradcosultancy</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
    $(document).ready(function() {
      $('.loader').hide();
    });
  </script>
  </body>
</html>

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
        <img loading="lazy"  src="{{asset('payment/logo.png')}}" alt="orad" class="w-28">
        </a>
        
    </nav>

    <div class="lg:flex gap-5 px-12 md:px-18 pt-2 antialiased">
        <div class="flex lg:w-1/2 ">
            <div class="container ">
                <div class="font-normal text-sm text-gray-500">
                    <p class="pb-5 leading-relax ">
                        On the occassion of 1 year anniversary since establishment of ORAD, we are conducting a scholarship test for school-gooing children in the city of Jaipur. All interested participants are required to fill up the form below to participate in ORAD's Scholarship Test 2021.

                    </p>
                    <div class="leading-releax ">
                        <p class="mb-4">Date of Exam: <span class="text-dark">1st August 2021</span></p>
                        <p>
                            Eligliblity Criteria-
                        </p>
                        <p>Std.: <span class="text-dark">3rd - 9th</span></p>
                        <p>Residency: <span class="text-dark">Jaipur</span></p>
                        <p>Deadline: <span class="text-dark">18th July 2021</span></p>

                    </div>
                </div>
            <img src="{{asset('images/png/Prize.png')}}" alt="img" class="w-96 mt-2 md:-mt-12">
            </div>
        </div>
        <div class="lg:w-1/2 w-full">
            <div class="flex flex-col mt-5 md:mt-0 justify-between">
                <div class="container py-5 lg:py-0 md:px-12">
                    <h6 class="text-md text-center font-normal">ORAD's Scholarship Test 2021</h6>
                    <div class="bg-white shadow-xl rounded-xl my-2">
                        <form class="px-5 md:py-1 py-4" method="POST" action="{{ route('storeScholarship') }}">
                            @csrf
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Full Name" name="name" value="{{old('name')}}" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                                
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Email Address" name="email" value="{{old('email')}}" required> 
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Phone Number" name="mobile" value="{{old('mobile')}}" required> 
                                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Whatsapp Number" name="whatsapp" value="{{old('whatsapp')}}" required> 
                                    @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Father Name" name="father_name" value="{{old('father_name')}}" required> 
                                    @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Father occupation" name="father_occupation" value="{{old('father_occupation')}}" required> 
                                    @error('father_occupation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Mother Name" name="mother_name" value="{{old('mother_name')}}" required> 
                                    @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Mother occupation" name="mother_occupation" value="{{old('mother_occupation')}}" required> 
                                    @error('mother_occupation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="School Name" name="school" value="{{old('school')}}" required> 
                                    @error('school') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            
                            <div class="mt-8">
                                <button class="btn-primary p-2 w-full rounded tracking-wide
                                font-medium font-display 
                                shadow-lg">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>

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

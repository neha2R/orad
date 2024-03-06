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

  <body class="bg-blue-100">
    <div class="loader">
      <img src="{{ asset('images/icons/Spinner.gif') }}" alt="loader" class="w-20 margin-top-20 mx-auto">

    </div>
    <nav class="flex items-center bg-white text-gray-900 py-2 px-12 flex-wrap lg:px-16 shadow-xl">
        <a href="{{ route('home') }}" class="p-2 mr-4 inline-flex items-center ">
        <img loading="lazy"  src="{{asset('payment/logo.png')}}" alt="orad" class="w-28">
        </a>
        
    </nav>
    <div class="container p-5 mx-auto">
        <div class="flex flex-col md:flex-row gap-2">
            <div class=" md:flex-1 w-full md:w-4/5">
                <div class="flex justify-between font-normal">
                    <div class="">
                        Section
                    </div>
                    <div class="flex-1 text-right">
                        Online Exam
                    </div>
                </div>
                <div class=" border border-gray-300">
                    <div class="flex justify-between">
                        <div class="bg-primary py-4 px-12 text-center text-white items-center">
                            English
                        </div>
                        <div class="flex-1 py-4 bg-white text-dark text-right">
                            <h5 class="font-medium mr-4">Time Left:<span>14:53</span></h5>
                        </div>
                    </div>
                   
                </div>

                {{-- question & answer section  --}}
                <div class="border border-gray-300 mt-1">
                   <div class="px-4 flex flex-col md:flex-row md:items-center justify-between bg-white text-dark text-normal border-b border-gray-300" >
                        <h5 class="font-semi-bold">Question No. </h5>
                        <div class="flex md:items-center justify-between mt-3 md:mt-0">
                            <span class="mr-4 w-full">View In:</span>
                            <div class="-ml-1 w-full md:w-24 relative px-2 pb-2 lg:mt-3 flex justify-end">
                                <select class="bg-white w-auto text-gray-900 text-medium pr-2 border border-gray-300">
                                    <option>English</option>
                                    <option>Hindi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="min-h-84 p-4 bg-white">
                        <div class="py-4">
                            <h5>Our country is spiritual contry, theirs_______religious. </h5>
                        </div>
                        <div class="mt-4 flex flex-col gap-4">
                            <div class="flex flex-rows gap-2 items-baseline text-center">
                                <input type="radio" name="" id="">
                                <span>is</span>
                            </div>
                            <div class="flex flex-rows gap-2 items-baseline text-center">
                                <input type="radio" name="" id="">
                                <span>are</span>
                            </div>
                            <div class="flex flex-rows gap-2 items-baseline text-center">
                                <input type="radio" name="" id="">
                                <span>also</span>
                            </div>
                            <div class="flex flex-rows gap-2 items-baseline text-center">
                                <input type="radio" name="" id="">
                                <span>have</span>
                            </div>
                        </div>
                        
                    </div>
        
                </div>

                {{-- save & submit section  --}}
                <div class="border border-gray-300 mt-1">
                    <div class="flex md:flex-row flex-col justify-between items-center text-center bg-white py-3">
                        <div class="flex md:flex-row flex-col md:justify-between md:px-2 py-2 gap-2">
                            <button class="py-1 px-4 bg-white text-dark border border-gray-300">Mark for Review & Next</button> <button class="py-1 px-4 bg-white text-dark border border-gray-300">Clear Response</button>
                        </div>
                        <div class="text-end">

                            <button class="py-1 px-4 bg-primary text-white mr-2">Save & Next</button>
                        </div>
                    </div>
        
                </div>
            </div>
            <div class="flex-col w-full md:w-1/5 bg-white mt-6">
                <div class=" border border-gray-300">
                    <div class="container p-4">
                        <h5 class="mt-3 mb-4">Rohite Mehra</h5>
                        <h5>Choose a Question</h5>
                        <div class="bg-blue-100 h-56 p-5 overflow-y-auto itmes-center">
                            <div class="grid grid-cols-4 gap-2 mb-4 justify-items-center text-center">
                                <span class="answered">1</span>
                                <span class="not-answered-review">2</span>
                                <span class="not-answered">3</span>
                                <span class="not-visit p-2">4</span>
                            </div>
                            <div class="grid grid-cols-4 gap-4 justify-items-center text-center">
                                @for ($i = 5; $i <= 20; $i++)
                                <span class="not-visit p-2 text-center">{{$i}}</span>
                                @endfor
                            </div>
                        </div>

                        <div class="grid grid-rows-3 mt-4 grid-cols-2 text-xs gap-2">
                            <div class="flex flex-row justify-start">
                                <span class="answered">1</span>
                                <span class="ml-2">Answered</span>
                            </div>
                            <div class="flex flex-row justify-start">
                                <span class="not-answered-review">2</span>
                                <span class="ml-2">Marked for review </span>
                            </div>
                            <div class="flex flex-row justify-start">
                                <span class="not-answered">3</span>
                                <span class="ml-2">Not Answered</span>
                            </div>
                            <div class="flex flex-row justify-start">
                                <span class="not-visit item-center">4</span>
                                <span class="ml-2">Not viewed</span>
                            </div>
                            <div class="flex flex-row justify-start col-span-2">
                                <span class="answered-review">5</span>
                                <span class="ml-2">Answered & Marked for Review</span>
                            </div>
                        </div>
                        <div class="flex justify-center mt-4"><button class="btn-primary text-white px-8 py-1">Submit</button></div>
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

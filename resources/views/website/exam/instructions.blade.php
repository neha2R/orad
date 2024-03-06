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
        <div class=" border border-gray-300">
            <div class="px-4 flex items-center justify-between bg-primary text-white text-normal" >
                <h5>Instruction</h5>
                <div class="flex items-center justify-between">
                    <span class="mr-2">View In:</span>
                    <div class="-ml-1 w-full md:w-24 relative px-2 pb-2 lg:mt-3 ">
                        <select class="bg-white w-auto text-gray-900 text-medium pr-2 border border-gray-300">
                            <option>English</option>
                            <option>Hindi</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white text-medium text-gray-900 h-96 overflow-y-auto ">
                <h5 class="text-center pt-5">Please read the instructions carefully</h5>
                <div class="mt-8 px-3">
                    <h5 class="font-bold underline mb-2">General Instructions: </h5>
                    <ol class="pt-5 ml-8 list-decimal font-normal text-sm leading-loose">
                        <li>
                            The clock will be set at the server. The countdown timer in the top rightcorner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination ill end by itself. You will not be requied to end or submit your examination.
                        </li>
                        <li>
                            The Question Palette displayed on the right side of screen will show the status of each question using one of the following symbols.
                        </li>
                    </ol>
                </div>
                <div class="mt-8 px-3 flex flex-col gap-4">
                    <div class="flex flex-rows font-normal text-sm leading-loose ">
                        <div class="flex justify-start gap-2">
                            <span class="not-visit">1</span>
                            <span>You have not visit the question yet</span>
                        </div>
                    </div>
                    <div class="flex flex-rows font-normal text-sm leading-loose">
                        <div class="flex justify-start gap-2">
                            <span class="not-answered">2</span>
                            <span>You have not answered the question</span>
                        </div>
                    </div>
                    <div class="flex flex-rows font-normal text-sm leading-loose">
                        <div class="flex justify-start gap-2">
                            <span class="answered">3</span>
                            <span>You have answered the question</span>
                        </div>
                    </div>
                    <div class="flex flex-rows font-normal text-sm leading-loose">
                        <div class="flex justify-start gap-2">
                            <span class="not-answered-review">4</span>
                            <span>You have NOT answered the question but have marked the question for review</span>
                        </div>
                    </div>
                    <div class="flex flex-rows font-normal text-sm leading-loose">
                        <div class="flex justify-start gap-2">
                            <span class="answered-review">5</span>
                            <span>The question(s) "Answered and Marked for Review" will be considered for evaluation.</span>
                        </div>
                    </div>
                </div>
            </div>
           
    
        </div>
        <div class="border border-gray-300 mt-1">
            <div class="flex justify-center items-center text-center bg-white py-6">
                <button class="py-1 px-4 bg-primary text-white">I am ready to begin</button>
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

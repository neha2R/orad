  <!doctype html>
  <html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <style>
      .btn-primary {
        background-color: #0088ff;
        color: #ffffff;
      }
      .bg-warning{
        background-color: #ffc929;
      }
      .bg-danger{
        background-color: #FF614F;
        color: #ffffff;
      }
    </style>
  </head>
  <body>
    <nav class="flex items-center bg-warning text-gray-900 py-3 flex-wrap px-20">
      <div>
        <a href="#" class="p-2 mr-4 inline-flex items-center">
          <img src="{{asset('payment/logo.png')}}" alt="orad" class="w-28">
        </a>
        <a
            href="#"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-gray-900 hover:text-white"
          >
            <span>Our Courses</span>
          </a>
          <a
            href="#"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-gray-900 hover:text-white"
          >
            <span>For Organization</span>
          </a>
          <a
            href="#"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-white items-center justify-center hover:bg-gray-900 hover:text-white"
          >
            <span>FAQ</span>
          </a>
      </div>
      <div
        class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto"
        id="navigation"
      >
        <div
          class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto"
        >
   
          <div class="mt-3">
            <div class="flex flex-wrap items-stretch w-full mb-4 relative">
              
              <select class=" h-10 w-full px-4 text-gray-900 font-medium bg-warning ">
                <option>English</option>
                <option>Hindi</option>
              </select>
            </div>
          </div>
          <button
        type="button"
        class="border border-red-500 bg-danger rounded px-6 py-2 m-2"
      >
        Sign In
      </button>
        </div>
      </div>
    </nav>
    <div class="lg:flex p-5">
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center flex-1 h-screen">
            <div class="mt-4">
              <img src="{{asset('/payment/Payment.png')}}" alt="img" class="w-auto">
            </div>
        </div>
        <div class="lg:w-1/3 w-auto h-auto bg-white shadow-xl rounded-xl mt-4">
            <div class=" p-5">
                <h2 class="text-center text-xl text-gray-900 font-display font-light lg:text-center
                ">Proceed to Payment</h2>
                <form method="POST">
                  @csrf
                    <div class="mt-3">
                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                            <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative " placeholder="{{optional($data->user)->name ?? ''}}" disabled >
                        </div>	
                        
                    </div>
                    <div class="mt-3">
                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                            <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{$data->email ?? ''}}" disabled>
                        </div>	
                        
                    </div>
                    <div class="mt-3">
                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                            <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{$data->mobile ?? ''}}" disabled>
                        </div>	
                        
                    </div>
                    {{-- <div class="mt-3">
                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                            <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{$trainer ?? ''}}" disabled>
                            
                        </div>	
                        
                    </div> --}}
                    
                    <div class="mt-3">
                      <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                        {{-- <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg> --}}
                        <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{optional($data->course)->Course ? optional($data->course)->Course->name : ''}}" disabled>

                      </div>
                    </div>

                    <div class="mt-3">
                      <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                        {{-- <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg> --}}
                        <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{optional($data->course)->name ?? ''}}" disabled>

                      </div>
                    </div>

                    <div class="mt-3">
                      <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                        {{-- <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg> --}}
                        <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{optional($data->course)->days ?? ''}} days" disabled>

                      </div>
                    </div>

                    <div class="mt-3">
                      
                      
                      @if($data->discounted_price != $data->price)
                      Rs. <strike>{{$data->price}}</strike>
                      <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                        <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{$data->discounted_price ?? ''}}" disabled>                        
                      </div>	
                        @else
                        {{-- {{$ss}} --}}
                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                          <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded-lg px-3 relative" placeholder="{{$data->discounted_price ?? ''}}" disabled>                        
                        </div>	
                      @endif
                        
                        
                    </div>
                    
                    <div class="mt-8">
                        <button class="btn-primary p-2 w-full rounded tracking-wide
                        font-medium font-display 
                        shadow-lg">
                            Pay Now
                        </button>
                    </div>
                </form>
                
                <div class="mt-2 text-sm font-display flex justify-between items-center px-8">
                    <img src="{{asset('payment/MasterCard.png')}}" alt="" class="w-14 m-0.5">
                    <img src="{{asset('payment/Visa.png')}}" alt="" class="w-14 m-0.5">
                    <img src="{{asset('payment/Paytm.png')}}" alt="" class="w-14 m-0.5">
                    <img src="{{asset('payment/UPI.png')}}" alt="" class="w-14 m-0.5">
                </div>
            </div>
        </div>

    </div>

     
  </body>
  </html>
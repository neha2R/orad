
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
              <form action="{{ route('paytm.payment') }}" method="post">
                @csrf
                <input type="hidden" name="cousePaymentId" wire:model="payment_id">
                  <div class="mt-3">
                      <div class="flex flex-col w-full mb-4 relative">
                          <input type="text" class="form-input" placeholder="Full Name" name="name"  value="{{old('name')}}" wire:model="name" required>
                          @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>	
                      
                  </div>
                  <div class="mt-3">
                      <div class="flex flex-col w-full mb-4 relative">
                          <input type="text" class="form-input" name="email" wire:model="email" required  value="{{old('email')}}" placeholder="Email Address">
                          @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>	
                      
                  </div>
                  <div class="mt-3">
                      <div class="flex flex-col w-full mb-4 relative">
                          <input type="text" class="form-input" wire:model="mobile" placeholder="Mobile Number"  value="{{old('mobile')}}" name="mobile" required>
                          @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>	
                      
                  </div>
                  <div class="mt-3">
                      <div class="flex flex-col w-full mb-4 relative">
                          <input type="text" class="form-input" placeholder="Promo Code" value="{{old('promo_code')}}" name="promo_code">
                          @error('promo_code') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>	
                      
                  </div>
                  
                  <div class="mt-3">
                    <div class="flex flex-col w-full mb-4 relative">
                      @if ($payment_id)
                          <input type="text" class="form-input cursor-not-allowed" wire:model="parentCourseName" disabled>
                      @else
                      <select class="w-full pl-5 pr-10 form-input" wire:model="parentCourseId" name="course">
                        <option readonly disabled> Select course </option>
                        @foreach ($parentCourse as $item)
                        <option value="{{ $item->id }}" >{{ucwords($item->title)}} ( {{ ucwords($item->name) }} )</option>
                        @endforeach
                      </select>
                          
                      @endif
                      @error('course') <span class="text-danger">{{ $message }}</span> @enderror
                      
                    </div>
                  </div>
                  
                  <div class="mt-3">
                    <div class="flex flex-col w-full mb-4 relative">
                      @if ($payment_id)
                          <input type="text" class="form-input cursor-not-allowed" wire:model="childCourseName">
                      @else
                      <select class="w-full pl-5 pr-10 form-input"  wire:model="childCourseId" name="course_type" required>
                        <option disabled readonly>Course Type</option>
                        @foreach ($courses as $item)
                        <option value="{{$item->id}}" >{{$item->name}}</option>    
                        
                        @endforeach
                      </select>
                      @endif
                      @error('course_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                  </div>

                  <div class="mt-3">
                    <div class="flex flex-col w-full mb-4 relative">
                       <input type="text" class="form-input cursor-not-allowed" placeholder="Course Duration" wire:model="duration" value="{{ $duration ?? '' }}" readonly disabled>
                    </div>
                  </div>

                  <div class="mt-3">
                      <div class="flex flex-col w-full mb-4 relative">
                        @if ($mrp)
                            <span class="text-gray-500">Rs.
                            <span class="line-through text-red-500">{{ $mrp }}</span></span>
                        @endif
                          <input type="text" class="form-input cursor-not-allowed" placeholder="Price" wire:model="price" value="{{ $price ?? '' }}" readonly disabled>
                          
                      </div>	
                      
                  </div>
                  
                  <div class="mt-8">
                      <button type="submit" class="btn-primary p-2 w-full rounded tracking-wide
                      font-medium font-display 
                      shadow-lg">
                          Pay Now
                      </button>
                  </div>
              </form>
              
              <div class="mt-2 text-sm font-display flex justify-between items-center px-8">
                  <img src="{{asset('payment/MasterCard.png')}}" alt="" class="w-14">
                  <img src="{{asset('payment/Visa.png')}}" alt="" class="w-14">
                  <img src="{{asset('payment/Paytm.png')}}" alt="" class="w-14">
                  <img src="{{asset('payment/UPI.png')}}" alt="" class="w-14">
              </div>
          </div>
      </div>

  </div>

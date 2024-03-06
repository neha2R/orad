<div class="lg:flex mx-auto">
    <div class="hidden lg:flex lg:w-1/2 items-end justify-end flex-1 h-full">
        <div class="pt-12">
          <img src="{{asset('/images/png/SignUp.png')}}" alt="img" class="w-11/12">
        </div>
    </div>
    <div class="lg:w-1/2 w-full h-full bg-white xl:max-w-screen-sm">
        @include('website.layouts.alert')
        <div class="py-4 md:py-18 px-12 sm:px-24 md:px-48 lg:px-12  xl:pl-8 xl:pr-48 xl:max-w-2xl ">

            <div class="mt-8">
                <h4 class="text-gray-900 text-3xl font-normal mb-2">Book your free trial</h4>
                <p class="text-gray-400 mb-2">Sign up for free trial</p>

                <form action="{{route('bookDemo')}}" method="POST">
                    @csrf
                    <div>
                        <div class="flex flex-col w-full mb-2 ">
                          	
                            <input type="text" class="form-input " placeholder="Name of student" name="name"  value="{{old('name')}}" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>	
{{--                         
                         <div class="flex flex-wrap items-stretch w-full mb-4">
                            <input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border rounded-l-lg border-r-0 h-10 border-gray-300 px-3 relative " placeholder="Mobile Number" name="mobile">
                            <div class="flex -mr-px">
                                <button
                                type="button"
                                class="cursor-pointer flex items-center btn-primary leading-normal rounded-lg text-white px-3 whitespace-no-wrap text-grey-dark text-sm"
                                
                                >
                                Send OTP
                                </button>
                            </div>	
                        </div>		 --}}
                        <div class="flex flex-col w-full mb-4 ">
                            <input type="text" class="form-input" placeholder="Mobile Number" name="mobile"   value="{{old('mobile')}}" required>
                            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col w-full mb-4 ">
                            <input type="text" class="form-input" placeholder="Whatsapp Number" name="whatsapp"  value="{{old('whatsapp')}}"  required>
                            @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>		
                    </div>
                    <div class="lg:flex lg:justify-between">
                         <div class="flex flex-col w-full mb-4 ">
                            <input type="text" class="form-input" placeholder="Email Address" name="email"  value="{{old('email')}}" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>	
                         {{-- <div class="flex flex-col w-full lg:w-1/2 mb-2 lg:pr-2">
                           
                            <input type="email" class="form-input " placeholder="Email Address" name="email"  required>
                            
                        </div>	
                        <div class="flex flex-col w-full lg:w-1/2 mb-4 lg:pl-2">
                            <input type="text" class="form-input border-gray-300 px-3" placeholder="State" name="state"  >
                        </div>	 --}}
                    </div>
                    
                    {{-- <div class="lg:flex lg:justify-between" x-data="{ show: true }">
                        <div class="lg:w-1/2 mb-2 lg:pr-2"">

                            <div class="flex flex-wrap items-stretch">
                               
                                <input  :type="show ? 'password' : 'text'" class="password-input" placeholder="Password" name="password">
                                <div class="flex -mr-px">
                                    <span
                                    class="password-eye"
                                    @click="show = !show"
                                    >
                                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"  class="text-gray-400"></i>
                                    </span>
                                </div>	
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>	
                        </div>
                        <div class="lg:w-1/2 mb-4 lg:pl-2">
                            <div class="flex flex-wrap items-stretch">
                                <input  :type="show ? 'password' : 'text'" class="password-input" placeholder="Confirm Password" name="confirm_password">
                                <div class="flex -mr-px">
                                    <span
                                    class="password-eye"
                                    @click="show = !show"
                                    >
                                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-gray-400"></i>
                                    </span>
                                </div>	
                                @error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>	
                        </div>
                    </div>
                    
                    --}}
                    <div class="mt-2">
                        <button class="login-button" type="submit">
                            Sign Up
                        </button>
                    </div>
                </form>
                 <div class="mt-5 text-sm font-display font-medium text-gray-500">
                    Already have an account ? <a href="{{ route('login') }}" class="cursor-pointer text-indigo-700 hover:text-indigo-800">Sign In</a>
                </div>
               
            </div>
        </div>
    </div>

</div>

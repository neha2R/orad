<div class="lg:flex mx-auto">
    <div class="hidden lg:flex lg:w-1/2 items-center justify-center flex-1 h-full">
        <div class="pt-12">
          <img src="{{asset('/images/png/SignIn.png')}}" alt="img" class="w-11/12">
        </div>
    </div>
    <div class="lg:w-1/2 w-full h-full bg-white xl:max-w-screen-sm">
        @include('website.layouts.alert')
        <div class="py-4 md:py-18 px-12 sm:px-24 md:px-48 lg:px-12  xl:pl-8 xl:pr-48  xl:max-w-2xl ">

            <div class="mt-16">
                <h4 class="text-gray-900 text-3xl font-normal mb-4">Welcome back to ORAD</h4>
                <p class="text-gray-400 mb-10">Enter your mobile number or email to sign in</p>
                
                <form wire:submit.prevent="store">
                    <div>
                        <div class="flex flex-wrap items-stretch w-full mb-8">
                          	
                            <input type="text" class="form-input" placeholder="Mobile Number/Email Address" name="mobile"  wire:model="mobile" >
                        </div>	
                        @error('mobile') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                       	
                    </div>
              
                    <div class="" x-data="{ show: true }">
                        
                       <div class="flex flex-wrap items-stretch w-full mb-3">
                               
                            <input  :type="show ? 'password' : 'text'" class="password-input" placeholder="Password" name="password"  wire:model="password" >
                            <div class="flex -mr-px">
                                <span
                                class="password-eye"
                                @click="show = !show"
                                >
                                <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </span>
                            </div>	
                            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>		
                    </div>
                    <div class="mb-8 text-sm font-display font-medium text-gray-500">
                        <a href="{{ route('forgotpassword') }}" class="cursor-pointer text-indigo-500 hover:text-indigo-800">Forgot Password?</a>
                    </div>
                   
                    <div class="mt-2">
                        <button class="login-button" type="submit">
                            Sign In
                        </button>
                    </div>
                </form>
                <div class="mt-5 text-sm font-display font-medium text-gray-500 ">
                    New to ORAD ? <a href="{{ route('register') }}" class="cursor-pointer text-indigo-700 hover:text-indigo-800">Sign Up</a>
                </div>
               
            </div>
        </div>
    </div>

</div>

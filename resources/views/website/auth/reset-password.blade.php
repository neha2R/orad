<div class="flex items-center justify-center py-16 mx-auto">
  <div class="w-full max-w-md">
    @include('website.layouts.alert')
    <form class="bg-white shadow-lg rounded-xl px-12 pt-6 pb-8 mb-4"  wire:submit.prevent="store">
      <!-- @csrf -->
      <div
        class="text-gray-800 text-2xl font-semibold flex justify-center py-2 mb-4"
      >
        Reset Password ?
      </div>
  
      <div class="mb-4">
        <h6
          class="block text-gray-500 text-sm  font-normal mb-2"
        >
          New Password
        </h6>
        <div class="" x-data="{ show: true }">
            <div class="flex flex-wrap items-stretch w-full mb-3">
                <input  :type="show ? 'password' : 'text'" class="password-input" placeholder="Password" name="password"  wire:model="newpassword" >
                <div class="flex -mr-px">
                    <span
                    class="password-eye"
                    @click="show = !show"
                    >
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </span>
                </div>	
                @error('newpassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>		
        </div>
       
      </div>
      <div class="mb-4">
        <h6
          class="block text-gray-500 text-sm font-normal mb-2"
        >
          Confirm Password
        </h6>
        <div class="" x-data="{ show: true }">
            <div class="flex flex-wrap items-stretch w-full mb-3">
                <input  :type="show ? 'password' : 'text'" class="password-input" placeholder="Password" name="password"  wire:model="confirmpassword" >
                <div class="flex -mr-px">
                    <span
                    class="password-eye"
                    @click="show = !show"
                    >
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </span>
                </div>	
                @error('confirmpassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>		
        </div>
       
      </div>
      <p
          class="font-normal text-sm text-gray-400 text-center pb-5"
        >
          Remember Password? <a href="{{ route('login')}}" class="text-blue-500">Sign In </a>
        </p>
      <div class="flex items-center justify-between">
        <button class="px-4 py-2 rounded text-white shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 w-full" type="submit">Send</button>
        
      </div>
    </form>
    
  </div>
</div>
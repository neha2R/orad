<div class="flex items-center justify-center py-16 mx-auto">

  <div class="w-full max-w-md">
    @include('website.layouts.alert')
    <form class="bg-white shadow-lg rounded-xl px-12 pt-6 pb-8 mb-4"  wire:submit.prevent="store">
      <!-- @csrf -->
      <div
        class="text-gray-800 text-2xl font-semibold flex justify-center py-2 mb-4"
      >
        Forgot Password ?
      </div>
      <div class="mb-4">
        <h6
          class="block text-gray-500 text-sm text-center font-normal mb-2"
        >
          Enter the email address associated with <br class="hidden lg:block" /> your account
        </h6>
        <input
          class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-3"
          name="email"
          v-model="form.email"
          type="email"
          required
          autofocus
            wire:model="email" 
          placeholder="Enter Email Address"
        />
        @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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


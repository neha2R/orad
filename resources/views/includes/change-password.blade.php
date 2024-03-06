<div class="mt-6 lg:w-1/2 mx-auto ">
     <h2 class="text-2xl text-gray-500 font-display font-normal mb-5">Change Password</h2>
     <div class="rounded-lg shadow-lg bg-white p-5 ">
         <form wire:submit.prevent="{{ $formRoute }}" >
     
             <div class="lg:flex flex-col lg:justify-between mt-3">
                <div class="flex flex-wrap items-stretch w-full mb-2" >
                    <input type="password" class="form-input" wire:model.debounce.500ms="currentpassword" placeholder="Old Password">
                     @error('currentpassword') <span class="text-danger">{{ $message }} @enderror
                </div>	
                <div class="flex flex-wrap items-stretch w-full mb-2">
                    <input type="password" class="form-input" wire:model.debounce.500ms="newpassword" placeholder="New Password">
                    @error('newpassword') <span class="text-danger">{{ $message }} @enderror
                </div>	
                <div class="flex flex-wrap items-stretch w-full mb-2">
                    <input type="password" class="form-input" wire:model.debounce.500ms="confirmnewpassword" placeholder="Confirm Password">
                    @error('confirmnewpassword') <span class="text-danger">{{ $message }} @enderror
                </div>	
             </div>
             <div class="mt-2 flex justify-end">
                <button class="btn-primary p-2 text-center rounded tracking-wide
                font-semibold font-display 
                shadow-lg">
                    Save
                </button>
             </div>
         </form>
     </div>
</div>
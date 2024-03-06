<div class="mt-6 lg:w-3/4 mx-auto ">
    <h2 class="text-2xl text-gray-500 font-display font-normal mb-5">Edit Profile</h2>

    <div class="mt-6 rounded-lg shadow-lg bg-white p-5">

        <form wire:submit.prevent="{{$formRoute}}" method="POST">
            <div class="">
                <label class="w-24 h-25 flex justify-start items-baseline bg-white text-blue rounded-full tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" alt="avatar" class="rounded-full w-24 h-24 ">
                    @else
                    <img src="{{ userPhoto($userId) }}" alt="avatar" class="rounded-full w-24 h-24 ">
                    @endif
                    <img src="{{ asset('img/icons/blue/Edit.svg') }}" alt="edit" class="w-6 -ml-5">
                    <input type='file' wire:model="photo" class="hidden" />
                </label>
            </div>
        
            <div class="lg:flex lg:justify-between mt-3">
                <div class="flex flex-wrap items-stretch w-full lg:w-1/3 mb-2 lg:pr-2">
                    <input type="text" class="form-input " wire:model.debounce.500ms="name" name="name" placeholder="Name" minlength="2" maxlength="255">
                    @error('name') <span class="text-danger">{{ $message }} @enderror
            
                </div>	
                <div class="flex flex-wrap items-stretch w-full lg:w-1/3 mb-2 lg:pl-2">
                    <input type="text" class="form-input cursor-not-allowed" wire:model="email" readonly disabled placeholder="Email" readonly>
                </div>	
                <div class="flex flex-wrap items-stretch w-full lg:w-1/3 mb-2 lg:pl-2">
                    <input type="text" class="form-input" wire:model.debounce.500ms="mobile" name="mobile" placeholder="Mobile No." minlength="10" maxlength="14">
                 @error('mobile') <span class="text-danger">{{ $message }} @enderror
                </div>	
            </div>
            <div class="lg:flex lg:justify-between mt-3">
                <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                    <input type="text" class="form-input cursor-not-allowed" name="department " placeholder="Department" wire:model.defer="department" disabled readonly>
                </div>	
                <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                    <input type="text" class="form-input cursor-not-allowed" name="role" placeholder="Role" wire:model.defer="role" disabled readonly>
                </div>
            </div>

            <div class="mt-2 flex justify-end">
                <button type="submit" class="btn-primary p-2 w-1/5 text-center rounded tracking-wide
                font-semibold font-display 
                shadow-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

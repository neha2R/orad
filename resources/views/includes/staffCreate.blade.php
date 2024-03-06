
<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="staff.isOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': staff.isOpening(), 'opacity-100': staff.isOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': staff.isOpening(), 'mt-8': staff.isOpen() }"
                class="model-dialog max-w-xl ">

                <!-- MODAL CONTAINER -->
                <div class="model-container" id="importstaffcreate" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">{{ $edit_id == null ? 'Create':'Update'}} Staff</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="staff.close()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="store"  method="POST">
                        <input type="hidden" class="edit-id" name="edit_id" wire:model="edit_id">
                        
                        <div class="px-10 py-5 text-gray-600">
                            <h3 class="font-normal text-dark my-3 text-lg"> User's Default Password will be their mobile number </h3>
                            {{-- name  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Name :</label>
                                <input type="text" class="form-input" name="name" wire:model="name" required>
                                @error('name') <span class="text-danger">{{ $message }} @enderror                                
                            </div>

                            {{-- email address  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Email :</label>
                                <input type="text" class="form-input" name="email" wire:model.defer="email" required>
                                @error('email') <span class="text-danger">{{ $message }} @enderror
                            </div>

                            {{-- mobile number  --}}
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-full">
                                    <label for="" class="block font-bold ">Mobile :</label>
                                    <div class="flex flex-row gap-2">
                                        <div class="w-1/4">
                                            <select wire:model="mobilecode" id="mobilecode"
                                                class="w-full pl-5 pr-10 appearance-none form-input {{ $errors->first('countrycode') ? ' form-control-danger' : '' }}">
                                                <option value="">--Select--</option>
                                                @foreach (countryCodes() as $key => $item)
                                                    <option value="+{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('mobilecode') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-3/4">
                                            <input type="text" class="form-input" name="mobile" wire:model="mobile" required>
                                            @error('mobile') <span class="text-danger">{{ $message }} @enderror
                                        </div>
                                    </div>
                                </div>
                                
                    
                            </div>

                            {{-- department & sub department  --}}
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Department :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="department" onchange="this.dispatchEvent(new InputEvent('input'))" name="course">
                                            <option > Select Department</option>
                                            @foreach (department() as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Sub Department :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="sub_department" onchange="this.dispatchEvent(new InputEvent('input'))" name="sub_department">
                                            <option> Sub Department</option>
                                            @foreach (sub_department($department) as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('sub_department') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                            </div>

                            {{-- Role  --}}
                            <div class="py-1 w-full">
                                <label for="" class="block font-bold ">Role :</label>
                                <div class="flex flex-col w-full mb-4 relative">
                                    
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="role" onchange="this.dispatchEvent(new InputEvent('input'))" name="role">
                                        <option> Select Role</option>
                                        <option value="2">Senior</option>
                                        <option value="3">Junior</option>
                                    </select>
                                </div>
                                @error('role') <span class="text-danger">{{ $message }} @enderror
                            </div>

                            {{-- Job Type  --}}
                            <div class="py-1 w-full">
                                <label for="" class="block font-bold ">Job Type :</label>
                                <div class="flex flex-col w-full mb-4 relative">
                                    
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model.defer="job_type" onchange="this.dispatchEvent(new InputEvent('input'))" name="job_type">
                                        <option> Select Job Type</option>
                                        <option value="1">Job</option>
                                        <option value="2">Intern</option>
                                    </select>
                                </div>
                                @error('job_type') <span class="text-danger">{{ $message }} @enderror
                            </div>

                            {{-- Assign To --}}
                            @if ($role == '3')
                            <div class="py-1 w-full">
                                <label for="" class="block font-bold ">Assigne to :</label>
                                <div class="flex flex-col w-full mb-4 relative">
                                    
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="senior" onchange="this.dispatchEvent(new InputEvent('input'))" name="senior">
                                        <option> Select only one value</option>
                                        @foreach ($senior_data as $item)
                                        @if($item->id==$senior)
                                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                        @else
                                        <option  value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('senior') <span class="text-danger">{{ $message }} @enderror
                            </div>
                                
                            @endif

                            
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="staff.close()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >{{ $edit_id == null ? 'Create':'Update'}}</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': staff.isOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
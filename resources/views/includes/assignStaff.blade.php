
<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="assign.isAssignOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': assign.isAssignOpening(), 'opacity-100': assign.isAssignOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': assign.isAssignOpening(), 'mt-8': assign.isAssignOpen() }"
                class="model-dialog max-w-xl ">

                <!-- MODAL CONTAINER -->
                <div class="model-container" id="importstaffassign" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Assign Staff</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="assign.assignClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle  btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="store"  method="POST">
                        <input type="hidden" class="edit-id" name="edit_id" wire:model="edit_id">
                        
                        <div class="px-10 py-5 text-gray-600">
                            

                            {{-- department & sub department  --}}
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Department :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="department" onchange="this.dispatchEvent(new InputEvent('input'))" name="course">
                                            <option> Select Department</option>
                                            @foreach (department() as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
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

                            {{-- Assign To --}}
                            <div class="py-1 w-full">
                                <label for="" class="block font-bold ">Select Senior :</label>
                                <div class="flex flex-col w-full mb-4 relative">
                                    
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="senior" onchange="this.dispatchEvent(new InputEvent('input'))" name="senior">
                                        <option> Select only one value</option>
                                        @foreach ($senior_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('senior') <span class="text-danger">{{ $message }} @enderror
                            </div>

                            {{-- Juniors --}}
                            <div class="py-1 w-full">
                                <label for="" class="block font-bold ">Select Juniors :</label>
                                <div class="flex flex-col w-full mb-4 relative">
                                    
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="junior_assignids" onchange="this.dispatchEvent(new InputEvent('input'))" name="junior_assignids" multiple>
                                        <option> Select one or multiple</option>
                                        @foreach ($junior_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->subDepartment->name ?? 'N/A' }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('junior_ids') <span class="text-danger">{{ $message }} @enderror
                            </div>

                            
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="assign.assignClose()" type="button"
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
        <div :class="{ 'opacity-25': assign.isAssignOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
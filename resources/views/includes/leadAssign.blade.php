<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="assign.isAssignOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': assign.isAssignOpening(), 'opacity-100': assign.isAssignOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': assign.isAssignOpening(), 'mt-8': assign.isAssignOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container" id="importstaff" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Assign Lead to {{ $transferto ??''}}</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="assign.assignClose()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- form section start here -->
                    <form method="post"  wire:submit.prevent="assignLead" class="px-5 mt-5">
                        <div class="flex flex-row gap-x-2 py-1 justify-between">
                            <div class="w-1/3">
                                <label for="" class="block font-normal ">From :</label>
                                <select wire:model="leadStartFrom" id="leadStartFrom"
                                    class="w-full pl-5 pr-10 appearance-none form-input">
                                    <option value="">--Select--</option>
                                    @foreach ($unAssignedLead as $key => $item)
                                        <option value="{{ $item->id }}"> {{++$key}} {{ ($item->name != null ? $item->name : $item->userRelation->name ??'') }}</option>
                                    @endforeach
                                </select>
                                @error('leadStartFrom') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            
                            <div class="w-1/3">
                                <label for="" class="block font-normal ">To :</label>
                                <select wire:model="leadEndTo" id="leadEndTo"
                                    class="w-full pl-5 pr-10 appearance-none form-input">
                                    <option value="">--Select--</option>
                                    @foreach ($unAssignedLead as $key => $item)
                                        <option value="{{ $item->id }}"> {{++$key}}  {{ ($item->name != null ? $item->name : $item->userRelation->name ??'') }}</option>
                                    @endforeach
                                </select>
                                @error('leadEndTo') <span class="text-danger">{{ $message }} @enderror
                            </div>
                           
                            <div class="w-1/3">
                                <label for="" class="block font-normal ">Date :</label>
                                <input type="date" name="assignDate" id="assignDate" wire:model="assign_date" class="form-input">
                                @error('assign_date') <span class="text-danger">{{ $message }} @enderror
                            </div>
                        </div>
                        <div class="flex flex-col  py-1 justify-between mt-3">
                            <label for="" class="block font-normal ">Assign To :</label>
                            <select wire:model="assign_to" id="assignto"
                                class="w-full pl-5 pr-10 appearance-none form-input">
                                <option value="">--Select--</option>
                                @foreach ($assigntousers as $key => $item)
                                    <option value="{{ $item->id }}"> {{ $item->name ?? 'N/A'  }}</option>
                                @endforeach
                            </select>
                            @error('assign_to') <span class="text-danger">{{ $message }} @enderror
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="assign.assignClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputsLead()">Cancel</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button">Assign</button>
                            
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
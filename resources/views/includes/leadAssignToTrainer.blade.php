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
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Assign Lead to {{$trainer}}</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="assign.assignClose()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- form section start here -->
                    <form method="post"  wire:submit.prevent="assignLead" class="px-5 mt-5">
                        @if ($errormessage)
                            <div class="w-full">
                                <span class="text-danger text-center"> {{$errormessage}} </span>
                            </div>
                        @endif
                        <div class="w-full">
                            <label for="" class="block font-normal ">Select Lead :</label>
                            <select wire:model="demoid" id="demoid"
                                class="w-full pl-5 pr-10 appearance-none form-input">
                                <option value="">--Select Lead--</option>
                                @foreach ($unAssignedLead as $key => $item)
                                    <option value="{{ $item->id }}"> {{ucwords($item->userRelation->name ?? '')}} </option>
                                @endforeach
                            </select>
                            @error('leadid') <span class="text-danger">{{ $message }} @enderror
                        </div>
                        
                        <div class="flex flex-row gap-x-2 py-1 justify-between">
                            <div class="w-1/2">
                                <label for="" class="block font-normal ">Date :</label>
                                <input type="date" name="assignDate" id="assignDate" wire:model="assignDate" class="form-input">
                                @error('assignDate') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-1/2">
                                <label for="" class="block font-normal ">Select Slot :</label>
                                <select wire:model="slot" id="slot"
                                    class="w-full pl-5 pr-10 appearance-none form-input">
                                    <option value="">--Select--</option>
                                    @foreach ($demo_slots as $key => $item)
                                        <option value="{{ $item->id }}"> {{date('g:iA',strtotime($item->from))}} - {{date('g:iA',strtotime($item->to))}}</option>
                                    @endforeach
                                </select>
                                @error('slot') <span class="text-danger">{{ $message }} @enderror
                            </div>
                           
                        </div>
                        <div class="w-full py-1">
                            <label for="" class="block font-normal ">Assign To :</label>
                            <select wire:model="assignto" id="assignto"
                                class="w-full pl-5 pr-10 appearance-none form-input">
                                <option value="">--Select--</option>
                                @foreach ($assigntousers as $key => $item)
                                    <option value="{{ $item->id }}"> {{ ucwords($item->name ?? 'N/A')  }}</option>
                                @endforeach
                            </select>
                            @error('assignto') <span class="text-danger">{{ $message }} @enderror
                        </div>
                        {{-- <div class="w-full py-1">
                            <label for="" class="block font-normal ">Joining Link :</label>
                            <input type="text" name="join_link" id="join_link" wire:model="join_link" class="form-input">
                            @error('join_link') <span class="text-danger">{{ $message }} @enderror
                        </div> --}}
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
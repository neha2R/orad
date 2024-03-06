<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="reschedule.isRescheduleOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': reschedule.isRescheduleOpening(), 'opacity-100': reschedule.isRescheduleOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': reschedule.isRescheduleOpening(), 'mt-8': reschedule.isRescheduleOpen() }"
                class="model-dialog max-w-xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Reschedule</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="reschedule.rescheduleClose()" wire:click="resetInput()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="{{$method}}"  method="POST">
                   
                        <div class="px-10 py-5 text-gray-600">
                            @if ($errormessage)
                                <div class="w-full py-1 text-center">
                                    <span class="text-danger">{{ $errormessage }}</span>
                                </div>
                            @endif
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Select Lead :</label>
                                <select name="" id="" class="form-input" wire:model="demoid">
                                    <option value="">--Select Lead--</option>
                                    @foreach ($rescheduleLeads as $item)
                                        <option value="{{$item->id}}">{{ucwords($item->userRelation->name ?? '')}}</option>
                                    @endforeach
                                </select>
                                @error('leadid') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="flex w-full py-2 gap-x-2 justify-beteen items-center">
                                <div class="w-1/2 py-1">
                                    <label for="" class="block font-bold ">Demo Date :</label>
                                    <input type="date" name="" id="" wire:model="demoDate" class="form-input">
                                    @error('demoDate') <span class="text-danger">{{ $message }} @enderror
                                </div>
                                <div class="w-1/2 py-1">
                                    <label for="" class="block font-bold ">Select Demo Slot :</label>
                                    <select name="" id="" class="form-input" wire:model="slot">
                                        <option>--select any one--</option>
                                        @foreach ($trainerSlots as $key => $item)
                                        <option value="{{$item->slot_id}}">{{slotHelper($item)}}</option>
                                            
                                        @endforeach
                                    </select>
                                    @error('slot') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                           
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="reschedule.rescheduleClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInput()">Close</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button" >Reschedule</button>
                            
                        </div>
                   
                    </form>
                    
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': reschedule.isRescheduleOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function rescheduleModel() {

        return {
            state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            rescheduleOpen() {
                this.state = 'TRANSITION'
                setTimeout(() => { this.state = 'OPEN' }, 50)
            },
            rescheduleClose() {
                this.state = 'TRANSITION';
                setTimeout(() => { this.state = 'CLOSED' }, 300)
            },
            isRescheduleOpen() { return this.state === 'OPEN' },
            isRescheduleOpening() { return this.state !== 'CLOSED' },
        }
    }
</script>
<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="schedule.isScheduleOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': schedule.isScheduleOpening(), 'opacity-100': schedule.isScheduleOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': schedule.isScheduleOpening(), 'mt-8': schedule.isScheduleOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Schedule a trial class</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="schedule.scheduleClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- form section start here -->
                    <form method="post"  wire:submit.prevent="{{$method}}" class="px-5 mt-5">
                        <h4 class="font-bold text-gray-700 text-lg edit-title">Preferred Date & Time</h4>
                        @if ($errormessage)
                            <span class="text-danger text-center py-2">{{$errormessage}}</span>
                        @endif
                        <div class="flex flex-row gap-x-2 py-1 justify-between">  
                            <div class="w-1/2">
                                <label for="" class="block font-normal ">Date :</label>
                                <input type="date" name="date" id="date" wire:model="date" class="form-input">
                                @error('date') <span class="text-danger">{{ $message }} @enderror
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
                        
                        <div class="flex items-center justify-end p-4 ">
                            <button x-on:click="schedule.scheduleClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputs()">Cancel</button>
                            <button type="submit" class="inline-block btn-primary edit-button">Assign</button>
                        </div>
                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': schedule.isScheduleOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function scheduleModal() {
        
        return {
            scheduleState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            scheduleOpen() {
                this.scheduleState = 'TRANSITION'
                setTimeout(() => { this.scheduleState = 'OPEN' }, 50)
            },
            scheduleClose() {
                this.scheduleState = 'TRANSITION';
                setTimeout(() => { this.scheduleState = 'CLOSED' }, 300)
            },
            isScheduleOpen() { return this.scheduleState === 'OPEN' },
            isScheduleOpening() { return this.scheduleState !== 'CLOSED' },
        }
    }
</script>
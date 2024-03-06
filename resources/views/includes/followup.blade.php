{{-- Follow up model  --}}
<div x-show="followup.isFollowupOpening()">

    <!-- MODAL -->
    <div :class="{ 'opacity-0': followup.isFollowupOpening(), 'opacity-100': followup.isFollowupOpen() }"
        class="model-head"
        tabindex="-1" role="dialog">

        <!-- MODAL DIALOG -->
        <div :class="{ 'mt-4': followup.isFollowupOpening(), 'mt-8': followup.isFollowupOpen() }"
            class="model-dialog max-w-md">

            <!-- MODAL CONTAINER -->
            <div  class="model-container">

                <div class="flex justify-between px-5 py-4">
                    <div>
                        <span class="font-bold text-gray-700 text-lg edit-title">Set Follow up: </span>
                    </div>
                    <div>
                        <button type="button" class="close" x-on:click="followup.followupClose()" wire:click="resetInputsLead()">
                            <i class="fa fa-times-circle btn-close"></i>
                        </button>
                    </div>
                </div>

                <!-- form section start here -->
                <form wire:submit.prevent="storeFollowup()"  method="POST">
                    <div class="px-10 py-5 text-gray-600">
                        {{-- Date  --}}
                        <div class="w-full py-1">
                            <label for="agenda" class="block font-bold ">Date :</label>
                            <input type="date" class="form-input" wire:model="followup" id="followup">
                            @error('followup') <span class="text-danger">{{ $message }}</span> @enderror                        
                        </div>
                    </div>
                
                    <div class="flex items-center justify-end p-4 ">

                        <button x-on:click="followup.followupClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputsLead()">Close</button>

                        <button type="submit" class="inline-block btn-primary" >Submit</button>
                        
                    </div>

                </form>
                <!-- form section end here -->
            </div>
        </div>
    </div>

    <!-- BACKDROP -->
    <div :class="{ 'opacity-25': followup.isFollowupOpen() }"
        class="model-backdrop">
    </div>
</div>
<script>
    // pop model open & close for lead create
    function followupModal() {
        
        return {
            followupState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            followupOpen() {
                this.followupState = 'TRANSITION'
                setTimeout(() => { this.followupState = 'OPEN' }, 50)
            },
            followupClose() {
                this.followupState = 'TRANSITION';
                setTimeout(() => { this.followupState = 'CLOSED' }, 300)
            },
            isFollowupOpen() { return this.followupState === 'OPEN' },
            isFollowupOpening() { return this.followupState !== 'CLOSED' },
        }
    }
</script>
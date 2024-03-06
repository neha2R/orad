<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="demolink.isdemolinkOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': demolink.isdemolinkOpening(), 'opacity-100': demolink.isdemolinkOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': demolink.isdemolinkOpening(), 'mt-8': demolink.isdemolinkOpen() }"
                class="model-dialog max-w-xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Add Demo Link</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="demolink.demolinkClose()" wire:click="resetInput()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="storeLink"  method="POST">
                   
                        <div class="px-10 py-5 text-gray-600">
                            @if ($errormessage)
                                <div class="w-full py-1 text-center">
                                    <span class="text-danger">{{ $errormessage }}</span>
                                </div>
                            @endif
                            <div class="flex flex-col w-full py-2 items-start">
                                <label for="" class="block font-bold ">Enter Link :</label>
                                <input type="text" class="form-input" wire:model="join_link" required>
                                @error('join_link') <span class="text-danger">{{ $message }} @enderror
                            </div>
                           
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="demolink.demolinkClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInput()">Close</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button" >Submit</button>
                            
                        </div>
                   
                    </form>
                    
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': demolink.isdemolinkOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function demoLinkModel() {

        return {
            state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            demolinkOpen() {
                this.state = 'TRANSITION'
                setTimeout(() => { this.state = 'OPEN' }, 50)
            },
            demolinkClose() {
                this.state = 'TRANSITION';
                setTimeout(() => { this.state = 'CLOSED' }, 300)
            },
            isdemolinkOpen() { return this.state === 'OPEN' },
            isdemolinkOpening() { return this.state !== 'CLOSED' },
        }
    }
</script>
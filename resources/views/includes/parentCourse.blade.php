
<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="parent.isParentOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': parent.isParentOpening(), 'opacity-100': parent.isParentOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': parent.isParentOpening(), 'mt-8': parent.isParentOpen() }"
                class="model-dialog max-w-xl ">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">{{ $editId == null ? 'Create':'Update'}} parent Course</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="parent.parentClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="storeParent"  method="POST">
                        <input type="hidden" name="editId" wire:model="editId">
                        <div class="px-10 py-5 text-gray-600">
                            {{-- name  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Course Name :</label>
                                <input type="text" class="form-input" name="name" wire:model="name" required>
                                @error('name') <span class="text-danger">{{ $message }} @enderror                                
                            </div>

                            {{-- Parent Course  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Parent Course:</label>
                                <select wire:model="course_type" id="course_type" class="w-full pl-5 pr-10 appearance-none form-input ">
                                    <option value="">--Select--</option>
                                    @foreach (courseType() as $key => $item)
                                        <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('course_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- course description  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Description :</label>
                                <textarea class="form-input" name="description" wire:model.debounce.500ms="description" required style="height: 85px"></textarea>
                                @error('description') <span class="text-danger">{{ $message }} @enderror
                            </div>
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="parent.parentClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >{{ $editId == null ? 'Create':'Update'}}</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': parent.isParentOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->

   
<script>
    // pop model open & close for lead create
    function parentModal() {
        
        return {
            parentState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            parentOpen() {
                this.parentState = 'TRANSITION'
                setTimeout(() => { this.parentState = 'OPEN' }, 50)
            },
            parentClose() {
                this.parentState = 'TRANSITION';
                setTimeout(() => { this.parentState = 'CLOSED' }, 300)
            },
            isParentOpen() { return this.parentState === 'OPEN' },
            isParentOpening() { return this.parentState !== 'CLOSED' },
        }
    }
</script>
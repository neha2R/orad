
<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="child.isChildOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': child.isChildOpening(), 'opacity-100': child.isChildOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': child.isChildOpening(), 'mt-8': child.isChildOpen() }"
                class="model-dialog max-w-xl ">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">{{ $editId == null ? 'Create':'Update'}} Child Course</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="child.childClose()" wire:click="resetChildInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="{{!$editId ? 'storeChild':'update'}}"  method="POST">
                        
                        <div class="px-10 py-5 text-gray-600">
                            {{-- Carriculam File  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Carriculam File :</label>
                                <input type="file" class="form-input" name="carriculam_file" wire:model="carriculam_file" >
                                @error('carriculam_file') <span class="text-danger">{{ $message }} @enderror                                
                            </div>
                            {{-- name  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Course Name :</label>
                                <input type="text" class="form-input" name="name" wire:model="name" required>
                                @error('name') <span class="text-danger">{{ $message }} @enderror                                
                            </div>

                            {{-- Parent Course  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Parent Course:</label>
                                <select wire:model="{{$editId ? 'course' : 'multipleCourse'}}" id="course" class="w-full pl-5 pr-10 appearance-none form-input " {{ !$editId ? "multiple" : ''}} style="height: {{ !$editId ? 80 : 40 }}px">
                                    <option value="">--Select--</option>
                                    @foreach ($parentCourse as $key => $childCourse)
                                    <optgroup label="{{ $key ? 'Personal Classes' : 'Group Classes'}}">
                                        @foreach ($childCourse as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    
                                    </optgroup>
                                    @endforeach
                                </select>
                                @error('course') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- course description  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Description :</label>
                                <textarea class="form-input" name="description" wire:model.defer="description" style="height: 80px" required></textarea>
                                @error('description') <span class="text-danger">{{ $message }} @enderror
                            </div>

                            {{-- Course MRP  --}}
                            <div class="w-full py-1">
                                <label class="block font-bold ">MRP</label>
                                <input type="text" class="form-input" wire:model="price" id="name">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Discount  --}}
                            <div class="w-full py-1">
                                <label class="block font-bold ">Discount</label>
                                
                                <input type="text" class="form-input" wire:model="discount" id="name">
                                @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Course Duration  --}}
                            <div class="w-full py-1">
                                <label class="block font-bold ">Course Duration (in Days)</label>
                                
                                <input type="text" class="form-input" wire:model="days" id="name">
                                @error('days') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- No of Classes  --}}
                            <div class="w-full py-1">
                                <label class="block font-bold ">No of Classes</label>
                                
                                <input type="text" class="form-input" wire:model="no_of_classes" id="no_of_classes">
                                @error('no_of_classes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            {{-- Class Duration  --}}
                            <div class="w-full py-1">
                                <label class="block font-bold ">Class Duration  (in Mins.)</label>
                                
                                <input type="text" class="form-input" wire:model="class_duration" id="class_duration">
                                @error('class_duration') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="child.childClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetChildInputs()">Close</button>
                            
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >{{ $editId == null ? 'Create':'Update'}}</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': child.isChildOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->

<script>
    // pop model open & close for lead create
    function childModal() {
        return {
            childState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            childOpen() {
                this.childState = 'TRANSITION'
                setTimeout(() => { this.childState = 'OPEN' }, 50)
            },
            childClose() {
                this.childState = 'TRANSITION';
                setTimeout(() => { this.childState = 'CLOSED' }, 300)
            },
            isChildOpen() { return this.childState === 'OPEN' },
            isChildOpening() { return this.childState !== 'CLOSED' },
        }
    }
</script>
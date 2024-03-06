<section x-data="{discount:discountModal()}">

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Exam Instructions:</h3>
                    <div class="">
                        <button class="btn-primary" x-on:click="discount.discountOpen()">
                            Create
                        </button>
                        
                    </div>
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="th" align="left">#</th>
                            <th class="th" align="left">Title</th>
                            <th class="th" align="left">Description</th>
                            <th class="th" align="left">Class</th>
                            <th class="th" align="left">Start Date</th>
                            <th class="th" align="left">End Date</th>
                            <th class="th" align="left">Duration</th>
                            <th class="th" align="left">Status</th>
                            <th class="th" align="left">Update</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->title }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->description ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->class_name ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->start_date ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->end_date ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->duration ?? '' }} </p></td>
                                <td class="td">
                                    <div class="toggle-div">
                                        <input type="checkbox" name="toggle" id="toggle" class="toggle-input" wire:click="changestatus({{ $item->id }}, {{ $item->is_active }})" {{ $item->is_active ? 'checked' : '' }}/>
                                        <label for="toggle" class="toggle-label-tag"></label>
                                    </div>
                                </td>
                                <td class="td">
                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                        data-target="#createuser"
                                        wire:click="edit({{ $item->id }})" x-on:click="discount.discountOpen()">Update</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="td" colspan="9">
                                    <p class="p text-center">No record found...</p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-2" style="float: right">{{ $data->links() }}</div>
        </div>
    </div>

<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="discount.isDiscountOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': discount.isDiscountOpening(), 'opacity-100': discount.isDiscountOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': discount.isDiscountOpening(), 'mt-8': discount.isDiscountOpen() }"
                class="model-dialog max-w-xl ">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">{{ $editId == null ? 'Create':'Update'}} Data</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="discount.discountClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="store"  method="POST">
                        <input type="hidden" name="editId" wire:model="editId">
                        <div class="px-10 py-5 text-gray-600">
                            
                            {{-- name  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Title :</label>
                                <input type="text" class="form-input" wire:model="title" id="title">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>
                            {{-- Description  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Description :</label>
                                <textarea class="form-input" name="amount" wire:model.debounce.500ms="description" required style="height: 80px"></textarea>
                                @error('description') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full py-1">
                                <label class="block font-bold">Class</label>
                                <input type="text" class="form-input" wire:model.debounce.500ms="class_name">
                                @error('class_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="w-full py-1 flex flex-row gap-2">
                                <div class="w-1/2">
                                    <label class="block font-bold">Starting Date</label>
                                    <input type="date" class="form-input" wire:model="start_date">
                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="w-1/2">
                                    <label class="block font-bold">Ending Date</label>
                                    <input type="date" class="form-input" wire:model="end_date">
                                    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>
                            <div class="w-full py-1 flex flex-row gap-2">
                                <div class="w-1/2">
                                    <label class="block font-bold">Starting Time</label>
                                    <input type="time" class="form-input" wire:model="start_time">
                                    @error('start_time') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-1/2">
                                    <label class="block font-bold">Ending Time</label>
                                    <input type="time" class="form-input" wire:model="end_time">
                                    @error('end_time') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="w-full py-2">
                                @if ($error_message)
                                    <span class="text-danger">{{ $error_message }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="discount.discountClose()" type="button"
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
        <div :class="{ 'opacity-25': discount.isDiscountOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->

   
<script>
    // pop model open & close for lead create
    function discountModal() {
        
        return {
            discountState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            discountOpen() {
                this.discountState = 'TRANSITION'
                setTimeout(() => { this.discountState = 'OPEN' }, 50)
            },
            discountClose() {
                this.discountState = 'TRANSITION';
                setTimeout(() => { this.discountState = 'CLOSED' }, 300)
            },
            isDiscountOpen() { return this.discountState === 'OPEN' },
            isDiscountOpening() { return this.discountState !== 'CLOSED' },
        }
    }
</script>
</section>

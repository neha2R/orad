<section x-data="{discount:discountModal()}">

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Our Clients:</h3>
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
                            <th class="th" align="left">Photo</th>
                            <th class="th" align="left">Name</th>
                            <th class="th" align="left">Description</th>
                            <th class="th" align="left">Status</th>
                            <th class="th" align="left">Update</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                                <td class="td">
                                    <img class="user-img img-radius"
                                        src='{{ asset("storage/$item->photo") }}'
                                        alt="user-img" height="100px" width="100px">
                                </td>
                                <td class="td"><p class="text-mute">{{ $item->name }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->description ?? '' }} </p></td>
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
                                <td class="td" colspan="6">
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
                            @if ($photo)
                            <div class="w-full py-1">
                                Photo Preview:
                                <img src="{{ $photo->temporaryUrl() }}"
                                height="100px" width="100px">
                            </div>
                            @endif
                             <div class="w-full py-1">
                                <label class="block font-bold">Photo</label>
                                <input type="file" class="form-input" wire:model="photo" id="photo">
                                <img class="user-img img-radius"
                                        src='{{ asset("storage/$item->photo") }}'
                                        alt="user-img" height="100px" width="100px">
                                @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            {{-- name  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Name :</label>
                                <input type="text" class="form-input" wire:model="name" id="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>
                            {{-- Description  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Description :</label>
                                <textarea class="form-input" name="amount" wire:model.debounce.500ms="description" required style="height: 80px"></textarea>
                                @error('description') <span class="text-danger">{{ $message }} @enderror
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

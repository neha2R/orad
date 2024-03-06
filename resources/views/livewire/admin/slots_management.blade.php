<section x-data="{discount:discountModal()}">

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Slot Management:</h3>
                    <div class="flex justify-between items-end gap-x-12">
                       
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
                            <th class="th" align="left">Name</th>
                            <th class="th" align="left">Slot</th>
                            <th class="th" align="left">Class Type</th>
                            <th class="th" align="left">Status</th>
                            <th class="th" align="left">Created at</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                               
                                <td class="td"><p class="text-mute">{{ $item->trainer->name ?? 'N/A' }} </p></td>
                                <td class="td"><p class="text-mute">{{ slotDetails($item->slot_id) }} </p></td>
                                <td class="td"><p class="text-mute">{{ !$item->type ? 'Demo Class' : ($item->type == 2 ? 'Group' : 'Personal') }} </p></td>
                                {{-- <td class="td"><p class="text-mute">{{ $item->available_seats }} </p></td> --}}
                                <td class="td">
                                    <div class="toggle-div">
                                        <input type="checkbox" name="toggle" id="toggle" class="toggle-input" wire:click="changestatus({{ $item->id }}, {{ $item->is_active }})" {{ $item->is_active ? 'checked' : '' }}/>
                                        <label for="toggle" class="toggle-label-tag"></label>
                                    </div>
                                </td>
                                <td class="td"><p class="text-mute">{{ $item->created_at->diffForHumans() }} </p></td>
                               
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
                <div class="model-container" id="importstaff" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Create Trainer Time Slots</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="discount.discountClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="store"  method="POST">
                        <div class="px-10 py-5 text-gray-600">
                            
                            {{-- Employee  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Select Employees :</label>
                                <select name="employee_id" id="" wire:model="employee_id" class="form-input" multiple style="height: 85px">
                                    <option value="">Select Employees</option>
                                    @forelse ($trainers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} ( {{ $item->sub_department == '3' ? 'Demo Trainer' : 'Class Trainer'}} )</option>
                                    @empty
                                        <option value="">no record found...</option>
                                    @endforelse
                                </select>
                                @error('employee_id') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>

                            {{-- Slots  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Select Slots :</label>
                                <select name="slots_id" id="" wire:model="slots_id" class="form-input" multiple style="height: 85px">
                                    
                                    @foreach ($slots as $item)
                                        <option value="{{ $item->id }}">{{ date('g:iA',strtotime($item->from)) }} - {{ date('g:iA',strtotime($item->to))}}</option>
                                    @endforeach
                                        
                                </select>
                                @error('slots_id') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>
                           
                            {{-- select class type  --}}
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Select Class Type :</label>
                                <select name="class_type" id="" wire:model="class_type" class="form-input">
                                        <option value=""> Select any one value</option>
                                    @foreach (classType() as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                      
                                </select>
                                @error('class_type') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>

                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="discount.discountClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >Create</button>
                            
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
                document.getElementById("importstaff").style.display = "block";

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

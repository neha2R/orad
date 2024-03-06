<section x-data="{discount:discountModal(), excel:importModal()}">

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
                        <button class="btn-primary" x-on:click="excel.excelOpen()">
                            Import
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
                            <th class="th" align="left">Exam</th>
                            <th class="th" align="left">Question</th>
                            <th class="th" align="left">Option A</th>
                            <th class="th" align="left">Option B</th>
                            <th class="th" align="left">Option C</th>
                            <th class="th" align="left">Option D</th>
                            <th class="th" align="left">Answer</th>
                            <th class="th" align="left">Status</th>
                            <th class="th" align="left">Update</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->instruction->title ?? 'N/A' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->question ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->option_a ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->option_b ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->option_c ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->option_d ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->answer ?? '' }} </p></td>
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
                                <td class="td" colspan="10">
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
                            <span class="font-bold text-gray-700 text-lg edit-title">{{ $edit_id == null ? 'Create':'Update'}} Data</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="discount.discountClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="store"  method="POST">
                                                    
                        <input type="hidden" name="edit_id" wire:model="edit_id" id="">
                        <div class="px-10 py-5 text-gray-600">
                            <div class="w-full py-1">
                                <label class="block font-bold">Select Instruction</label>
                                <select name="instruction" id="instruction" wire:model="exam_instruction_id" class="form-input">
                                    <option value="">Select Any One</option>
                                    @forelse ($instruction_data as $item)
                                        <option value="{{ $item->id }}" >{{ $item->title }}</option>
                                    @empty
                                        <option value="">no record found...</option>
                                    @endforelse
                                </select>
                                @error('exam_instruction_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="w-full py-1">
                                <label class="block font-bold">Question</label>
                                <textarea class="form-input" wire:model.debounce.500ms="question" style="height: 80px"></textarea>
                                @error('question') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                           
                            <div class="w-full py-1 flex flex-row">
                                <div class="w-1/2">
                                    <div class="w-full py-1">
                                        <label class="block font-bold">Option A</label>
                                        <input type="text" class="form-input" wire:model="option_a">
                                        @error('option_a') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                                <div class="w-1/2">
                                    <div class="w-full py-1">
                                        <label class="block font-bold">Option B</label>
                                        <input type="text" class="form-input" wire:model="option_b">
                                        @error('option_b') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                            </div>
                           
                            <div class="w-full py-1 flex flex-row">
                                <div class="w-1/2">
                                    <div class="w-full py-1">
                                        <label class="block font-bold">Option C</label>
                                        <input type="text" class="form-input" wire:model="option_c">
                                        @error('option_c') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                                <div class="w-1/2">
                                    <div class="w-full py-1">
                                        <label class="block font-bold">Option D</label>
                                        <input type="text" class="form-input" wire:model="option_d">
                                        @error('option_d') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="w-full py-1">
                                <label class="block font-bold">Select Answer</label>
                                <select name="instruction" id="instruction" class="form-input" wire:model="answer">
                                    <option value="">Select Any One</option>
                                    @foreach (optionHelper() as $key => $item)
                                    <option value="{{ $key }}">{{$item}}</option>
                                        
                                    @endforeach
                                </select>
                                @error('answer') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="discount.discountClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >{{ $edit_id == null ? 'Create':'Update'}}</button>
                            
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

<!-- MODAL Import CONTAINER WITH BACKDROP -->
    <div x-show="excel.isExcelOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': excel.isExcelOpening(), 'opacity-100': excel.isExcelOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': excel.isExcelOpening(), 'mt-8': excel.isExcelOpen() }"
                class="model-dialog max-w-xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Add Bulk Question</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="excel.excelClose()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex justify-center px-5 py-4">
                        <a href="{{ asset('question-paper.xlsx')}}" download class="px-12 py-2 btn-primary btn-block">Download Sample File</a>
                    </div>

                    <!-- form section start here -->
                    <form method="post"  wire:submit.prevent="importSheet" class="px-5 mt-5">
                        <div class="w-full py-1">
                            <label class="block font-bold">Select Instruction</label>
                            <select name="instruction" id="exam_instruction_id" class="form-input" wire:model="exam_instruction_id">
                                <option value="">Select Any One</option>
                                @forelse ($instruction_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @empty
                                    <option value="">no record found...</option>
                                @endforelse
                            </select>
                            @error('exam_instruction_id') <span style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex justify-center">
                            <div class="file_upload p-5 relative border-4 border-dotted border-gray-300 rounded-lg w-full">
                                <svg class="text-primary w-24 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                                <div class="input_field flex flex-col w-max mx-auto text-center">
                                    <label>
                                        <input class="text-sm cursor-pointer w-36 hidden" type="file" wire:model="file_import" id="upload{{ $iteration }}">
                                        <div class="text bg-primary text-white border border-gray-300 rounded font-semibold cursor-pointer p-1 px-3 hover:bg-indigo-500">Browse File</div>
                                    </label>
                                    <span wire:loading wire:target="file_import" class="text-primary">Uploading...</span>
                                </div>   
                                @if(count($error_message))
                                <div style="text-align: center">
                                    @foreach ($error_message as $item)
                                    <span class="text-danger">{{$item ?? ''}}</span>
                                @endforeach
                                </div>
                                
                                @endif  
                            </div>     
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="excel.excelClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button">Upload</button>
                            
                        </div>
                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': excel.isExcelOpen() }"
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
        // pop model open & close for lead create
    function importModal() {
        
        return {
            excelState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            excelOpen() {
                document.getElementById("importstaff").style.display = "block";

                this.excelState = 'TRANSITION'
                setTimeout(() => { this.excelState = 'OPEN' }, 50)
            },
            excelClose() {
                this.excelState = 'TRANSITION';
                setTimeout(() => { this.excelState = 'CLOSED' }, 300)
            },
            isExcelOpen() { return this.excelState === 'OPEN' },
            isExcelOpening() { return this.excelState !== 'CLOSED' },
        }
    }
</script>
</section>

<section x-data="{discount:discountModal(), feedback:feedbackModal()}">

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">PR Meetings:</h3>
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
                            <th class="th" align="left">Date</th>
                            <th class="th" align="left">Time</th>
                            <th class="th" align="left">Agenda</th>
                            <th class="th" align="left">Join Meeting</th>
                            <th class="th" align="left">Created By</th>
                            <th class="th" align="left">Feedback</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                               
                                <td class="td"><p class="text-mute">{{ date('M d, Y',strtotime($item->date)) }} </p></td>
                                <td class="td"><p class="text-mute">{{ date('g:iA',strtotime($item->time)) }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->agenda }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->admin->name ?? 'N/A' }} </p></td>
                                <td class="td">
                                    <a target="_blank" class="btn-success" href="{{ $item->joineLink->join_link ?? 'N/A' }}">
                                        Join Meeting
                                    </a>
                                </td>
                                <td class="td">
                                    <button class="btn-warning" x-on:click="feedback.feedbackOpen()" wire:click="show({{ $item->id }})">
                                        Feedback
                                    </button>
                                </td>
                               
                            </tr>
                        @empty
                            <tr>
                                <td class="td" colspan="5">
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

<!--CREATE MODAL CONTAINER WITH BACKDROP -->
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
                            <span class="font-bold text-gray-700 text-lg edit-title">Create PR Meeting</span>
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

                            {{-- Date of meeting  --}}
                            <div class="w-full py-1">
                                <div class="flex justify-between flex-rows items-center gap-x-2">
                                    <div class="w-1/2">
                                        <label for="agenda" class="block font-bold ">Date :</label>
                                        <input type="date" class="form-input" wire:model="date" id="date">
                                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror                        

                                    </div>

                                    {{-- time of meeting  --}}
                                    <div class="w-1/2">
                                        <label for="time" class="block font-bold ">Time :</label>
                                        <input type="time" class="form-input" wire:model="time" id="time">
                                        @error('time') <span class="text-danger">{{ $message }}</span> @enderror                        
                                    </div>
                                </div>
                            </div>


                            {{-- Agenda of meeting  --}}
                            <div class="w-full py-1">
                                <label for="agenda" class="block font-bold ">Agenda of meeting :</label>
                                <input type="text" class="form-input" wire:model="agenda" id="agenda">
                                @error('agenda') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>

                            {{-- Joining Link of meeting  --}}
                            <div class="w-full py-1">
                                <label for="join_link" class="block font-bold ">Joining Link :</label>
                                <input type="text" class="form-input" wire:model="join_link" id="join_link">
                                @error('join_link') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>
                            
                            {{-- departments  --}}
                            @if (auth()->user()->department == '2')
                            <div class="w-full py-1">
                                <label for="department" class="block font-bold ">Select Department :</label>
                                <select name="department" id="department" wire:model='department' class="form-input" multiple style="height: 85px">
                                    @forelse ($departments_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        <option value="">no record found...</option>
                                    @endforelse
                                </select>
                                @error('department') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>
                            @else
                            <input type="hidden" name="department" wire:model="{{ auth()->user()->department }}">
                            @endif
                            {{-- employee  --}}
                            <div class=" w-full py-1">
                                <label for="employee" class="block font-bold ">Select Employee :</label>
                                <select name="employee" id="employee" wire:model="employee" class="form-input" multiple style="height: 85px">
                                    @forelse ($employees_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name}} ({{ $item->subDepartment->name?? ($item->departmentDetails->name ?? 'N/A') }}) {{ (auth()->user()->department != '2') ? ($item->role == 2 ? '(Senior)' : '(Junior)') : '' }}</option>
                                    @empty
                                        <option value="">no record found...</option>
                                    @endforelse
                                </select>
                                @error('employee') <span class="text-danger">{{ $message }}</span> @enderror        
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


<!-- FeedBack user model end here  -->
    <div x-show="feedback.isFeedbackOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': feedback.isFeedbackOpening(), 'opacity-100': feedback.isFeedbackOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': feedback.isFeedbackOpening(), 'mt-8': feedback.isFeedbackOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div  class="model-container" id="importstaff" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Feedback: </span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="feedback.feedbackClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form>
                        <div class="px-5 mt-5">
                            <div class="flex justify-center">
                                <div class="w-full">
                                    <div class="headings flex justify-between items-center mb-3">
                                        <h5 class="font-bold text-gray-700 text-lg edit-title"">{{$meetingname ?? 'Meeting'}}'s Feedback</h5>
                                    </div>
                                    @forelse ($feedbacks as $item)
                                        <div class="shadow-md cardhistory p-3">
                                            <div class="flex justify-between items-center">
                                                <div class="user flex flex-row items-center"> 
                                                    <img src="{{userPhoto($item->employee_id)}}" width="30" class="user-img rounded-circle mr-2"> 
                                                    <span>
                                                    
                                                        <div class="font-weight-bold flex flex-cols">
                                                            <small>Ratings: </small> 
                                                            <span class="flex flex-cols"> 
                                                                @for ($i = 1; $i <= $item->rating; $i++)
                                                                <img src="{{ asset('/img/icons/svg/Star.svg') }}" class="w-5 h-4"/> 
                                                                @endfor
                                                            </span> 
                                                        </div>
                                                        <small class="font-weight-bold">Comments: {{$item->comments ?? ''}}</small>
                                                    </span> 
                                                </div> 
                                                <small>{{dateformat($item->created_at) ?? ''}}</small>
                                            </div>
                                            <div class="action flex justify-between mt-2 items-center">
                                                <div class="reply px-4"> 
                                                    <small>{{ucwords($item->employee->name ?? '')}}</small> 
                                                    <span class="dots"></span> 
                                                    <small>{{ $item->employee != null && $item->employee->subDepartment != null ? ($item->employee->subDepartment->name ?? '') : ''}}</small> <span class="dots"></span> 
                                                    <small>{{$item->employee ? rolesHelper($item->employee->role) : ''}}</small> 
                                                </div>
                                            </div>
                                        </div>
                                            
                                    @empty
                                        <h5 class="font-bold text-gray-700 text-lg edit-title"">No record found...</h5>   
                                    @endforelse
                                </div>
                            </div>
                        </div>
                       
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="feedback.feedbackClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': feedback.isFeedbackOpen() }"
            class="model-backdrop">
        </div>
    </div>

   
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

    // pop model open & close for lead create
    function feedbackModal() {
        
        return {
            feedbackState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            feedbackOpen() {
                document.getElementById("importstaff").style.display = "block";

                this.feedbackState = 'TRANSITION'
                setTimeout(() => { this.feedbackState = 'OPEN' }, 50)
            },
            feedbackClose() {
                this.feedbackState = 'TRANSITION';
                setTimeout(() => { this.feedbackState = 'CLOSED' }, 300)
            },
            isFeedbackOpen() { return this.feedbackState === 'OPEN' },
            isFeedbackOpening() { return this.feedbackState !== 'CLOSED' },
        }
    }
</script>
</section>

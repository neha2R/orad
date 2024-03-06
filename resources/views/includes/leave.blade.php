<!-- tables section  start here  -->

<div class="table-section " x-data="{apply:leaveModal(), reason:reasonModal()}">
    <!-- recent registration section start here  -->
    <div class="py-8" >
        <div>
            <div class="flex justify-between items-center">
                
                <h3 class="font-normal text-gray-500 my-3 text-xl">Your Leaves</h3>
                <div class="">
                    
                    <button class="btn-primary" x-on:click="apply.leaveOpen()">
                        Apply For Leave
                    </button>
                </div>
            </div>
            @include('includes.table-header')
        </div>
        <div class=" min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="th" align="left"> Sr. No. </th>
                    <th class="th" align="left"> Leave Type </th>
                    <th class="th" align="left"> Reason </th>
                    <th class="th" align="left"> From Date </th>
                    <th class="th" align="left"> To Date </th>
                    <th class="th" align="left"> Applied On </th>
                    <th class="th" align="left"> Status </th>
                </tr>
                </thead>
                <tbody class="transition duration-700 ease-in-out">
                    @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        <tr>
                            <td class="td">
                                <p class="p">{{ $i+=$key }} </p>
                            </td>
                            <td class="td">
                                <p class="p">{{ $item->leave_type }}</p>
                            </td>
                            <td class="td">
                                <p class="p">{{ $item->reason }}</p>
                            </td>
                            <td class="td">
                                <p class="p">{{ date('d/m/Y',strtotime($item->from)) }}</p>
                            </td>
                            <td class="td">
                                <p class="p">
                                    {{ date('d/m/Y',strtotime($item->to)) }}
                                </p>
                            </td>
                            <td class="td">
                                <p class="p">
                                {{ dateformat($item->created_at)}}
                                </p>
                            </td>
                            <td class="td">
                                <p class="p">
                                    {{$item->status == '1' ? 'Approved' : ($item->status == '2' ? 'Rejected' : 'Pending')}}
                                </p>
                            </td>
                            
                        </tr>
                            
                        
                    @empty
                    <tr>
                        <td class="td" colspan="7" align="center">
                            <p class="p">No record found...</p>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="py-3" style="float: right;">{{ $data->links() }}</div>
    </div>

    <!-- Leave MODAL CONTAINER WITH BACKDROP -->
    <div x-show="apply.isLeaveOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': apply.isLeaveOpening(), 'opacity-100': apply.isLeaveOpen() }"
            class="fixed z-50 top-0 left-0 w-full h-full outline-none transition-opacity duration-200 linear overflow-y-auto"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': apply.isLeaveOpening(), 'mt-8': apply.isLeaveOpen() }"
                class="relative w-auto pointer-events-none max-w-2xl mt-8 mx-auto transition-all duration-200 ease-out">

                <!-- MODAL CONTAINER -->
                <div
                    class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl" id="importstaff" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700 text-lg edit-title">Apply For Leave</span>
                            @if($errormessage) <span class="text-danger  text-center text-md font-bold mt-3">{{ $errormessage }} @endif
                        </div>
                        <div>
                            <button type="button" class="close" wire:click="resetInputs()" x-on:click="apply.leaveClose()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="storeLeave"  method="POST">
                        <div class="px-10 py-5 text-gray-600">
                            <div class="flex flex-col gap-x-2 py-1 justify-between">
                                <label for="" class="block font-bold ">Leave Type :</label>
                                <select wire:model="leaveType" id="leaveType"
                                    class="w-full pl-5 pr-10 appearance-none form-input }}">
                                    <option value="">--Select--</option>
                                    @foreach (leaveType() as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('leaveType') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">From :</label>
                                    <input type="date" class="form-input" name="from" wire:model="from" required>
                                    @error('from') <span class="text-danger">{{ $message }} @enderror
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">To :</label>
                                    <input type="date" class="form-input" name="to" wire:model.defer="to" required>
                                    @error('to') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Leave For :</label>
                                    <select wire:model="leaveFor" id="leaveFor"
                                    class="w-full pl-5 pr-10 appearance-none form-input }}">
                                        <option value="">--Select--</option>
                                        @foreach (leaveFor() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('leaveFor') <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Days :</label>
                                    <input type="text" class="form-input cursor-not-allowed" name="totalDays" wire:model.defer="totalDays" required>
                                    @error('totalDays') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            <div class="flex flex-col gap-x-2 py-1 justify-between">
                                <label for="" class="block font-bold ">Leave Reason :</label>
                                <textarea class="form-input " name="leaveReason" wire:model.defer="leaveReason" required style="height: 64px"></textarea>
                                @error('leaveReason') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            
                        
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="apply.leaveClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button" wire:click="storeLeave">Apply</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': apply.isLeaveOpen() }"
            class="z-40 fixed top-0 left-0 bottom-0 right-0 bg-black opacity-0 transition-opacity duration-200 linear">
        </div>
    </div>
<!-- Edit user model end here  -->

<script>
    // pop model open & close for lead create
    function leaveModal() {

        return {
            state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            leaveOpen() {
                document.getElementById("importstaff").style.display = "block";

                this.state = 'TRANSITION'
                setTimeout(() => { this.state = 'OPEN' }, 50)
            },
            leaveClose() {
                this.state = 'TRANSITION';
                setTimeout(() => { this.state = 'CLOSED' }, 300)
            },
            isLeaveOpen() { return this.state === 'OPEN' },
            isLeaveOpening() { return this.state !== 'CLOSED' },
        }
    }
    // pop model open & close for lead create
    function reasonModal() {

        return {
            reasonState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            reasonOpen() {
                this.reasonState = 'TRANSITION'
                setTimeout(() => { this.reasonState = 'OPEN' }, 50)
            },
            reasonClose() {
                this.reasonState = 'TRANSITION';
                setTimeout(() => { this.reasonState = 'CLOSED' }, 300)
            },
            isReasonOpen() { return this.reasonState === 'OPEN' },
            isReasonOpening() { return this.reasonState !== 'CLOSED' },
        }
    }
</script>
</div>
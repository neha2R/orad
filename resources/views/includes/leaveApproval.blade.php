<!-- tables section  start here  -->

<div class="table-section " x-data="{view:leaveModal()}">
    <!-- recent registration section start here  -->
    <div class="py-8" >
        <div>
            <div class="flex justify-between items-center">
                
                <h3 class="font-normal text-gray-500 my-3 text-xl">Leave Requests</h3>
                
            </div>
            @include('includes.table-header')
        </div>
        <div class=" min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="th" align="left"> Sr. No. </th>
                    <th class="th" align="left"> Name </th>
                    <th class="th" align="left"> Leave Type </th>
                    <th class="th" align="left"> From </th>
                    <th class="th" align="left"> To </th>
                    <th class="th" align="left"> Days </th>
                    <th class="th" align="left"> View </th>
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
                                <p class="p">{{ $item->user->name ?? 'N/A' }}</p>
                            </td>
                            <td class="td">
                                <p class="p">{{ $item->leave_type }}</p>
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
                                <button class="btn-primary"  wire:click="leaveStatus({{ $item->id }})" x-on:click="view.viewOpen()">
                                    {{$item->status == '1' ? 'Approved' : ($item->status == '2' ? 'Rejected' : 'Pending')}}
                                </button>
                            </td>
                            
                        </tr>
                            
                        
                    @empty
                    <tr>
                        <td class="td" colspan="7">
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
    <div x-show="view.isViewOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': view.isViewOpening(), 'opacity-100': view.isViewOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': view.isViewOpening(), 'mt-8': view.isViewOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div
                    class="model-container" id="importstaff" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700 text-lg edit-title">Leave Request</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="view.viewClose()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="storeLeave"  method="POST">
                        <input type="hidden" name="leave_id" wire:model="leave_id">
                        <div class="px-10 py-5 text-gray-600">
                            <div class="flex flex-col gap-x-2 py-1 justify-between">
                                <label for="" class="block font-bold ">Name :</label>
                                <input type="text" class="form-input" name="from" wire:model="user_name" readonly disabled >
                            </div>
                            <div class="flex flex-col gap-x-2 py-1 justify-between">
                                <label for="" class="block font-bold ">Department :</label>
                                <input type="text" class="form-input" name="from" wire:model="department" readonly disabled >
                            </div>
                            <div class="flex flex-col gap-x-2 py-1 justify-between">
                                <label for="" class="block font-bold ">Leave Type :</label>
                                <input type="text" class="form-input" name="from" wire:model="leave_type" readonly disabled >
                            </div>

                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">From :</label>
                                    <input type="date" class="form-input" name="from" wire:model="from" readonly disabled>
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">To :</label>
                                    <input type="date" class="form-input" name="to" wire:model.defer="to" readonly disabled>
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Leave For :</label>
                                    <input type="text" class="form-input" name="to" wire:model.defer="leave_for" readonly disabled>
                                    
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Days :</label>
                                    <input type="text" class="form-input cursor-not-allowed" name="total_days" wire:model.defer="total_days" disabled readonly>
                                    @error('totalDays') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            <div class="flex flex-col gap-x-2 py-1 justify-between">
                                <label for="" class="block font-bold ">Leave Reason :</label>
                                <textarea class="form-input " name="leave_reason" wire:model.defer="leave_reason" required disabled style="height: 64px"></textarea>
                                @error('leave_reason') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button type="submit" class="inline-block btn-mute mr-2" wire:click="approvalStatus(2)">Reject</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button" wire:click="approvalStatus(1)">Approve</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': view.isViewOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
</div>

<script>
    // pop model open & close for lead create
    function leaveModal() {

        return {
            state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            viewOpen() {
                document.getElementById("importstaff").style.display = "block";

                this.state = 'TRANSITION'
                setTimeout(() => { this.state = 'OPEN' }, 50)
            },
            viewClose() {
                this.state = 'TRANSITION';
                setTimeout(() => { this.state = 'CLOSED' }, 300)
            },
            isViewOpen() { return this.state === 'OPEN' },
            isViewOpening() { return this.state !== 'CLOSED' },
        }
    }

</script>
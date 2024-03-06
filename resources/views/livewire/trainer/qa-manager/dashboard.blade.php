<section x-data="{lead:leadModal(), history:historyModal(),  assign:assignmentModal()}">
    <h3 class="font-normal text-gray-500 my-3 text-xl"> Dashboard </h3>
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-cols-2 grid-col-1 ">

        <div class="card-header {{$assignedtable == 0 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(0)">
            <span class="card-title">
                {{ $unassignedleads ?? '' }}</span>
            <p class="card-subtitle">Unassigned</p>
        </div>
  
        <div  class="card-header {{$assignedtable == 1 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(1)">
            <span class="card-title">
            {{ $assignedleads ?? '' }} </span>

            <p class="card-subtitle">Assigned</p>
        </div>

    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Leads For Assignments</h3>
                    <div class="">
                        <button class="btn-primary" x-on:click="assign.assignOpen()">
                            Schedule
                        </button>
                    </div>
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="th" align="left"> # </th>
                        <th class="th" align="left"> Name </th>
                        <th class="th" align="left"> Contact </th>
                        <th class="th" align="left"> Lead Details </th>
                        <th class="th" align="left"> Assigned To </th>
                        <th class="th" align="left"> Slots </th>
                        <th class="th" align="left"> Lead Track </th>
                    </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        @forelse ($data as $key => $item)
                            @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                            <tr>
                                <td class="td">
                                    <p class="text-gray-500">{{ $i+=$key }} </p>
                                </td>
                                <td class="td">
                                    <p class="text-gray-500">{{ optional($item->userRelation)->name ?? 'N/A' }}</p>
                                </td>
                               
                                <td class="td">
                                    <p class="text-gray-500">{{ optional($item->userRelation)->mobile ?? 'N/A' }}</p>
                                </td>
                                <td class="td">
                                     
                                    <button class="btn-primary" wire:click="edit({{$item->leadid}})" x-on:click="lead.open()" >
                                        View
                                    </button >
                                </td>
                                <td class="td">
                                    <p class="text-gray-500">{{ userName($item->userRelation->parent_id) ?? 'N/A' }}</p>
                                </td>
                               
                                <td class="td">
                                    <p class="text-gray-500">{{ slotDetails($item->userRelation->slot_id ?? '') }}</p>
                                </td>
                               
                                <td class="td">
                                    <button class="btn-danger"  wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})" x-on:click="history.historyOpen()">
                                        History
                                    </button>
                                </td>
                                
                            </tr>
                                
                            
                        @empty
                        <tr>
                            <td class="td" colspan="7">
                                <p class="text-gray-500 text-center">No record found...</p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{ $data->links() }}</div>
        </div>

        <!-- recent registration section end here  -->

        {{-- lead registration and update model  --}}
        @include('includes.leadRegistrationForm',['method'=>'update','readonly'=>1])

        {{-- lead history model  --}}
        @include('includes.leadHistory')

        {{-- lead assign to junior sales model  --}}
        @include('includes.leadAssignToClassTrainer')
    </div>
    <!-- tables section end here  -->
</section>

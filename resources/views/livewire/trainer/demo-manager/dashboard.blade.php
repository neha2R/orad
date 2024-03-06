<section x-data="{lead:leadModal(), history:historyModal(),  assign:assignmentModal(), }">
    <h3 class="font-normal text-gray-500 my-3 text-xl"> Dashboard </h3>
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-row-2 lg:grid-cols-4 grid-col-1 ">

        <div class="card-header {{$assignedtable == 0 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(0)">
            <span class="card-title new-lead">
                {{ $unassignedleads ?? '' }}</span>
            <p class="card-subtitle">Unassigned</p>
        </div>
  
        <div  class="card-header {{$assignedtable == 1 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(1)">
            <span class="card-title">
            {{ $assignedleads ?? '' }} </span>

            <p class="card-subtitle">Assigned</p>
        </div>
        <div class="card-header {{$assignedtable == 2 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(2)">
            <span class="card-title">
                {{ $demodone ?? '' }}</span>
            <p class="card-subtitle">Demo Completed</p>
        </div>
  
        <div  class="card-header {{$assignedtable == 3 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(3)">
            <span class="card-title">
            {{ $converted ?? '' }} </span>

            <p class="card-subtitle">Converted</p>
        </div>
        <div class="card-header {{$assignedtable == 4 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(4)">
            <span class="card-title">
                {{ $notconverted ?? '' }}</span>
            <p class="card-subtitle">Not Converted</p>
        </div>
    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Lists of {{$activeuser}}:</h3>
                    <div class="">
                        <button class="btn-primary" x-on:click="assign.assignOpen()">
                            Assign
                        </button>
                    </div>
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="th" align="left">Sr. No. </th>
                        <th class="th" align="left">Name </th>
                        <th class="th" align="left">Demo Date</th>
                        <th class="th" align="left">Slot </th>
                        <th class="th" align="left">Assigned To </th>
                        <th class="th" align="left">Update </th>
                        <th class="th" align="left">Feedback</th>
                        <th class="th" align="left">Lead Track </th>
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
                                    <p class="text-gray-500">{{ ucwords(optional($item->userRelation)->name ?? 'N/A') }}</p>
                                </td>
                                <td class="td">
                                    <p class="text-gray-500">{{date('M d, Y',strtotime($item->date))}} </p>
                                </td>
                                <td class="td">
                                    <p class="p">
                                       {{ slotHelper($item) }}
                                    </p>
                                </td>
                                <td class="td">
                                    <p class="p">
                                        {{ $item->trainerRelation != null ? ucwords(optional($item->trainerRelation)->name ?? '') : 'N/A' }}
                                    </p>
                                </td>
                                <td class="td">
                                    <button class="btn-success" wire:click="edit({{$item->leadid}})" x-on:click="lead.open()">
                                        Update
                                    </button>
                                </td>
                                <td class="td">
                                    <button class="btn-warning"  wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})" x-on:click="feedback.feedbackOpen()">
                                        Feedback
                                    </button>
                                </td>
                                
                                <td class="td">
                                    <button class="btn-danger"  wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})" x-on:click="history.historyOpen() ">
                                        History
                                    </button>
                                </td>
                                
                            </tr>
                                
                            
                        @empty
                        <tr>
                            <td class="td" colspan="8">
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
        @include('includes.leadRegistrationForm',['method'=>'update','readonly'=>0])

        {{-- lead history model  --}}
        @include('includes.leadHistory')

        {{-- lead assign to junior sales model  --}}
        @include('includes.leadAssignToTrainer',['trainer'=>'Demo Trainer'])

        {{-- Feedback model  --}}
        {{-- @include('includes.feedback') --}}
    </div>
    <!-- tables section end here  -->
</section>

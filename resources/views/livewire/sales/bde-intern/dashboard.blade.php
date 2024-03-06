<section x-data="{lead:leadModal(), history:historyModal(), excel:excelImportModal(), followup:followupModal(), schedule:scheduleModal() }">
    <h3 class="font-normal p my-3 text-xl"> Dashboard </h3>
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-row-2 lg:grid-cols-4 grid-col-1 ">

        <div class="card-header {{$assignedtable == 1 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(1)">
            <span class="card-title new-lead">  {{ $newleads ?? '' }}</span>
            <p class="card-subtitle">New Leads</p>
        </div>
  
        <div  class="card-header {{$assignedtable == 2 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(2)">
            <span class="card-title"> {{ $notresponding ?? '' }} </span>
            <p class="card-subtitle">Not Responding</p>
        </div>

        <div class="card-header {{$assignedtable == 3 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(3)">
            <span class="card-title">  {{ $askforporposal ?? '' }}</span>
            <p class="card-subtitle">Ask for porposal</p>
        </div>
  
        <div  class="card-header {{$assignedtable == 4 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(4)">
            <span class="card-title"> {{ $demoforwarded ?? '' }} </span>
            <p class="card-subtitle">Demo Forwarded</p>
        </div>

        <div class="card-header {{$assignedtable == 5 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(5)">
            <span class="card-title">  {{ $followuplead ?? '' }}</span>
            <p class="card-subtitle">Follow up </p>
        </div>
  
        <div  class="card-header {{$assignedtable == 6 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(6)">
            <span class="card-title"> {{ $todaysfollowup ?? '' }} </span>
            <p class="card-subtitle">Today's Follow up</p>
        </div>

    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal p my-3 text-xl">Lists Of {{$activeuser}}</h3>
                    <div class="">
                        <button class="btn-primary" x-on:click="lead.open()">
                            Add Lead
                        </button>
                        <button class="btn-primary" x-on:click="excel.excelOpen()">
                            Import Lead
                        </button>
                        <button class="btn-primary" x-on:click="schedule.scheduleOpen()">
                            Schedule Demo
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
                        <th class="th" align="left"> Name </th>
                        <th class="th" align="left"> Email </th>
                        <th class="th" align="left"> Contact </th>
                        <th class="th" align="left"> Assigned On </th>
                        <th class="th" align="left"> Update </th>
                        <th class="th" align="left"> Follow Up </th>
                        <th class="th" align="left"> Lead Track </th>
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
                                    <p class="p">{{ $item->userRelation->name ?? 'N/A' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{ $item->userRelation->email ?? 'N/A' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{ $item->userRelation->mobilecode ?? '' }}{{ $item->userRelation->mobile ?? 'N/A' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">
                                        {{ $item->userRelation->created_at->diffForHumans() ?? '' }}
                                    </p>
                                </td>
                                <td class="td">
                                    <button class="btn-primary" wire:click="edit({{$item->leadid}})" x-on:click="lead.open()">
                                        Update
                                    </button>
                                </td>
                                <td class="td">
                                    <button class="btn-warning" wire:click="setleadid({{$item->id}})" x-on:click="followup.followupOpen()">
                                        Followup
                                    </button>
                                </td>
                                <td class="td">
                                    <button class="btn-danger"  wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})" x-on:click="history.historyOpen()">
                                        History
                                    </button>
                                </td>
                                
                            </tr>
                                
                            
                        @empty
                        <tr>
                            <td class="td" colspan="8">
                                <p class="p text-center">No record found...</p>
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

        {{-- lead excel import model  --}}
        @include('includes.leadImport')

        {{-- Follow up model  --}}
        @include('includes.followup')

        {{-- schedule model  --}}
        @include('includes.scheduleDemo')


    </div>
    <!-- tables section end here  -->
</section>

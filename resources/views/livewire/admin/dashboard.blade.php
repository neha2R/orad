<section x-data="{lead:leadModal(), history:historyModal(), excel:excelImportModal(), assign:assignmentModal()}">
    <h3 class="font-normal text-mute my-3 text-xl"> Dashboard </h3>
    <!-- cards start here -->
    {{-- <div class="card-section grid gap-4 lg:grid-cols-2 grid-col-1 ">

        <div class="card-header {{$assignedtable == 0 ? 'shadow-2xl' : 'shadow-md'}} " wire:click="leadstatusstatsactive(0)">
            <span class="card-title">
                {{ $unassignedleads ?? '' }}</span>
            <p class="card-subtitle">Unassigned</p>
        </div>
  
        <div
            class="card-header {{$assignedtable == 1 ? 'shadow-2xl' : 'shadow-md'}} " wire:click="leadstatusstatsactive(1)">
            <span class="card-title">
            {{ $assignedleads ?? '' }} </span>

            <p class="card-subtitle">Assigned</p>
        </div>

    </div> --}}
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">
        <h3 class="font-normal text-mute my-3 text-xl text-center"> Comming Soon... </h3>
        <!-- recent registration section start here  -->
        {{-- <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-mute my-3 text-xl">Leads For Assignments</h3>
                    <div class="">
                        <button class="btn-primary" x-on:click="lead.open()">
                            Add Lead
                        </button>
                        <button class="btn-primary" x-on:click="excel.excelOpen()">
                            Import Lead
                        </button>
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
                        <th
                        class="th"
                        align="left">
                        Sr. No.
                        </th>
                        <th
                        class="th"
                        align="left">
                        Name
                        </th>
                        <th
                        class="th"
                        align="left">
                        Email
                        </th>
                        <th
                        class="th"
                        align="left">
                        Contact
                        </th>
                        <th
                        class="th"
                        align="left">
                        Assigned On
                        </th>
                        <th
                        class="th"
                        align="left">
                        Update
                        </th>
                        <th
                        class="th"
                        align="left">
                        Lead Track
                        </th>
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
                                    <p class="p">{{ optional($item->userRelation)->name ?? 'N/A' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{ optional($item->userRelation)->email ?? 'N/A' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? 'N/A' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">
                                        {{ $item->userRelation != null ? optional($item->userRelation)->created_at->diffForHumans() ?? '' : 'N/A' }}
                                    </p>
                                </td>
                                <td class="td">
                                    <button class="btn-primary" wire:click="edit({{$item->leadid}})" x-on:click="lead.open()">
                                        Update
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
                            <td class="td" colspan="7">
                                <p class="p text-center">No record found...</p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{ $data->links() }}</div>
        </div> --}}

        <!-- recent registration section end here  -->

        {{-- lead registration and update model  --}}
        {{-- @include('includes.leadRegistrationForm',['method'=>'update','readonly'=>0]) --}}

        {{-- lead history model  --}}
        {{-- @include('includes.leadHistory') --}}

        {{-- lead excel import model  --}}
        {{-- @include('includes.leadImport') --}}

        {{-- lead assign to junior sales model  --}}
        {{-- @include('includes.leadAssign') --}}
    </div>
    <!-- tables section end here  -->
</section>

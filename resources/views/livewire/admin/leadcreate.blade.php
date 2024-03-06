<section x-data="{lead:leadModal(), history:historyModal(), excel:excelImportModal(), assign:assignmentModal()}">
    <!-- recent registration section end here  -->

    {{-- lead registration and update model  --}}
    @include('includes.leadRegistrationForm',['method'=>'update','readonly'=>0])

    {{-- lead history model  --}}
    @include('includes.leadHistory')

    {{-- lead excel import model  --}}
    @include('includes.leadImport')

    {{-- lead assign to junior sales model  --}}
    @include('includes.leadAssign',['transferto'=>'BDE Team Lead'])

    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-rows-1 lg:grid-cols-3 grid-col-1 ">
        
        <div class="card-header {{ $active_user== 0 && $scholarship_user == 0 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(1)">
            <span class="card-title"> {{ $unassigned_leads_count }}</span>
            <p class="card-subtitle">Unassigned Leads</p>
        </div>
  
        <div class=" card-header {{ $active_user== 1 && $scholarship_user == 0  ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(2)">
            <span class="card-title">{{ $assigned_leads_count }} </span>
            <p class="card-subtitle">Assigned Leads</p>
        </div>

        <div class="card-header {{ $active_user==0 && $scholarship_user == 1 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="leadstatusstatsactive(3)">
            <span class="card-title"> {{ $scholarship_user_count }}</span>
            <p class="card-subtitle">Scholarship Leads</p>
        </div>
  
    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-end items-center mb-3">
                    <button class="btn-success" wire:click="export()">
                        Export
                    </button>

                </div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">{{ $type_of_lead }} Leads:</h3>
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
                           <th class="th" align="left"> Sr. No. </th>
                            <th class="th" align="left"> Name </th>
                            <th class="th" align="left"> Email</th>
                            <th class="th" align="left"> Contact </th>
                            <th class="th" align="left"> Assigned On </th>
                            <th class="th" align="left"> Update </th>
                            <th class="th" align="left"> Lead Track </th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($lead_data as $key => $item)
                        @php $i =  $lead_data->perPage() * ($lead_data->currentPage() - 1); $key++;@endphp
                            <tr>
                                <td class="td"><p class="p">{{ $i+=$key }} </p></td>
                                <td class="td"><p class="p">{{ $item->name ?? 'N/A' }} 
                                    @if($item->is_scholorship_user && !$scholarship_user)
                                    <small class="bg-primary text-white rounded-full px-2">{{ $item->is_scholorship_user ? 'scholarship' :'' }}</small>
                                    @endif
                                </p></td>
                                <td class="td"><p class="p">{{ $item->email ?? 'N/A' }}</p></td>
                                <td class="td"><p class="p">{{ $item->mobilecode ?? '' }}{{ $item->mobile ?? 'N/A' }}</p></td>
                                <td class="td"><p class="p"> {{ $item->created_at->diffForHumans() ?? 'N/A' }}</p></td>
                                <td class="td"><button class="btn-primary" wire:click="edit({{$item->id}})" x-on:click="lead.open()">Update</button></td>
                                <td class="td">
                                    <button class="btn-danger"  wire:click="getleadHistory({{ $item->id }},{{$item->id}})" x-on:click="history.historyOpen()">
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
            <div class="py-2" style="float: right">{{ $lead_data->links() }}</div>
        </div>
    </div>
   
</section>

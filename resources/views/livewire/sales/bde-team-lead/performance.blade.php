<section  x-data="{performance:performanceModal(), history:historyModal(), lead:leadModal(),}">
    <div class="flex w-full justify-between items-end py-2">
        <div>
            <h3 class="font-normal p my-3 text-xl">{{ucwords($username)}} Performance </h3>
        </div>
        <div >
            <label for="" class="block ">Select Performer</label>
            <select class="form-input cursor-pointer" wire:model="performerid">
                <option value="{{auth()->user()->id}}">My Performance</option>                    
                @foreach ($employees as $item)
                <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="flex w-full justify-between items-end pb-3">
        <div>
            {{-- <label for="" class="block ">Select Month</label> --}}
            <select class="form-input" wire:model="currentMonth">
                @foreach ($interval as $key => $item)
                <option value="{{ date('Y-m', strtotime($item)) }}">{{ date('M Y', strtotime($item)) }}</option>
                @endforeach
            </select>
        </div>
        {{-- @if ($performerid != auth()->user()->id) --}}
        <div>
            <button class="btn-success" x-on:click="performance.performanceOpen()" wire:model="edit({{$performerid}})">See Work</button>
        </div>
        {{-- @endif --}}

    </div>
        
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-cols-4 grid-col-1 ">

        <div class="card-header shadow-md">
            <div class="flex flex-col justify-between gap-y-8 h-full">
                <div class="flex flex-rows justify-between">
                    <span class="font-normal text-mute">Overall Conversion</span>
                    <span class="text-xl font-semibold inline-block text-dark">
                        {{$overallConversion}}%
                    </span>
                </div>

                <div class="relative ">
                    <div class="flex flex-col">
                        <span class="text-xs text-mute">
                            Your Performance
                        </span>
                        <div class="flex flex-rows justify-between items-start">
                            <div class="overflow-hidden h-2 text-xs flex rounded bg-purple-200 w-4/5 mt-1">
                                <div style="width:{{$conversionRate}}%"
                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center  bg-danger">
                                </div>
                            </div>
                            <span class="text-xs ">{{$conversionRate}}%</span>
                        </div>
                    
                    </div>

                    <div class="flex flex-col">
                        <span class="text-xs text-mute">
                            Target Conversion Rate
                        </span>
                        <div class="flex flex-rows justify-between items-start">
                            <div class="overflow-hidden h-2 text-xs flex rounded bg-purple-200 w-4/5 mt-1">
                                <div style="width:{{$targetedConversionRate}}%"
                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center  bg-success">
                                </div>
                            </div>
                            <span class="text-xs ">{{$targetedConversionRate}}%</span>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
  
        <div  class="card-header shadow-md">
            <span class="card-title"> {{ $totalLeads ?? '' }} </span>
            <p class="card-subtitle">Total Leads</p>
        </div>

        <div class="card-header shadow-md">
            <span class="card-title">  {{ $totalDemoAssigned ?? '' }}</span>
            <p class="card-subtitle">Total Demo Assigned</p>
        </div>
  
        <div  class="card-header shadow-md">
            <span class="card-title"> {{ $totalDemoDone ?? '' }} </span>
            <p class="card-subtitle">Total Demo Done</p>
        </div>

    </div>


<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="performance.isPerformanceOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': performance.isPerformanceOpening(), 'opacity-100': performance.isPerformanceOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': performance.isPerformanceOpening(), 'mt-8': performance.isPerformanceOpen() }"
                class="model-dialog max-w-3xl ">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between p-4">
                        <div class="flex justify-start gap-x-8 items-center">
                            <h3 class="font-normal text-mute my-3 text-xl {{$assignedtable == 0 ? 'border-b-2 border-gray-300' : ''}} cursor-pointer" wire:click="leadstatus(0)" >Leads Status</h3>
                            <h3 class="font-normal text-mute my-3 text-xl {{$assignedtable == 1 ? 'border-b-2 border-gray-300' : ''}} cursor-pointer" wire:click="leadstatus(1)">Today's Follow Up</h3>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="performance.performanceClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle  btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <section>
                        <div class="p-4 text-gray-600">
                            <div class="py-8" >
                                {{-- <div>
                                    
                                    <div class="py-2 w-1/3">
                                        <input type="date" name="date" id="date" class="form-input" wire:model="currentDate">
                                    </div>
                                </div> --}}
                                <div class=" min-w-full shadow rounded-lg overflow-hidden">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                        <tr>
                                            <th class="th" align="left"> Sr. No. </th>
                                            <th class="th" align="left"> Name </th>
                                            <th class="th" align="left"> Email </th>
                                            <th class="th" align="left"> Contact </th>
                                            <th class="th" align="left"> {{$assignedtable ? 'Current Status' : 'Type'}} </th>
                                            <th class="th" align="left"> {{$assignedtable ? 'Lead Track' : 'View Details'}}  </th>
                                        </tr>
                                        </thead>
                                        <tbody class="transition duration-700 ease-in-out">
                                            @forelse ($leadData as $key => $item)
                                                @php $i =  $leadData->perPage() * ($leadData->currentPage() - 1); $key++;@endphp
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
                                                            {{ $item->userRelation != null ? leadTypeDetails($item->userRelation->leadtype) ?? '' : 'N/A' }}
                                                        </p>
                                                    </td>
                                                   
                                                    @if ($assignedtable)
                                                    <td class="td">
                                                        <button class="btn-danger"  wire:click="getleadHistory({{ $item->leadid }})" x-on:click="history.historyOpen()">
                                                            History
                                                        </button>
                                                    </td>
                                                    @else
                                                    <td class="td">
                                                        <button class="btn-primary" wire:click="edit({{$item->leadid}})" x-on:click="lead.open()">
                                                            View
                                                        </button>
                                                    </td>
                                                    @endif
                                                    
                                                </tr>
                                                    
                                                
                                            @empty
                                            <tr>
                                                <td class="td" colspan="6" align="center">
                                                    <p class="p text-center" >No record found...</p>
                                                </td>
                                            </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-3" style="float: right;">{{ $leadData->links() }}</div>
                            </div>
                            
                        </div>
                    </section>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': performance.isPerformanceOpen() }"
            class="model-backdrop">
        </div>

        {{-- lead history model  --}}
        @include('includes.leadHistory')


        {{-- lead registration and update model  --}}
        @include('includes.leadRegistrationForm',['method'=>'update','readonly'=>1])
    </div>
<!-- Edit user model end here  -->
</section>
<script>
    // pop model open & close for lead create
    function performanceModal() {
        
        return {
            performanceState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            performanceOpen() {
                this.performanceState = 'TRANSITION'
                setTimeout(() => { this.performanceState = 'OPEN' }, 50)
            },
            performanceClose() {
                this.performanceState = 'TRANSITION';
                setTimeout(() => { this.performanceState = 'CLOSED' }, 300)
            },
            isPerformanceOpen() { return this.performanceState === 'OPEN' },
            isPerformanceOpening() { return this.performanceState !== 'CLOSED' },
        }
    }
</script>
<section x-data="{lead:leadModal(), history:historyModal(), feedback:feedbackModel(), reschedule:rescheduleModel(), demolink:demoLinkModel()  }">
    <h3 class="font-normal text-gray-500 my-3 text-xl"> Dashboard </h3>
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-cols-2 grid-col-1 ">

        <div class="card-header {{$leadStatus == 0 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="demoStatus(0)">
            <span class="card-title new-lead">
                {{ $pendingDemo ?? '' }}</span>
            <p class="card-subtitle">Pending Classes</p>
        </div>
  
        <div  class="card-header {{$leadStatus == 1 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="demoStatus(1)">
            <span class="card-title">
            {{ $demoDone?? '' }} </span>

            <p class="card-subtitle">Classes Done</p>
        </div>

    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Lists of {{$activeLeads}} </h3>
                    <div class="">
                      
                        <button class="btn-warning" x-on:click="reschedule.rescheduleOpen()">
                            Reschedule
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
                        <!-- <th class="th" align="left">Contact </th> -->
                        <th class="th" align="left">Date</th>
                        <th class="th" align="left">Class Slot</th>
                        <th class="th" align="left">Feedback </th>
                        <th class="th" align="left">Details </th>
                        <th class="th" align="left">Join Link </th>
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
                                    <p class="text-gray-500">{{ optional($item->studentRelation)->name ?? 'N/A' }}</p>
                                </td>
                               
                               {{-- 
                                <td class="td">
                                    <p class="text-gray-500">{{ optional($item->studentRelation)->mobilecode ?? '' }}{{ optional($item->studentRelation)->mobile ?? 'N/A' }}</p>
                                </td>
                                --}}
                               
                                <td class="td">
                                    <p class="p">
                                        {{ date('M d, Y', strtotime($item->class_date)) }}
                                    </p>
                                </td>
                                <td class="td">
                                    <p class="p">
                                        {{ slotHelper($item) }}
                                    </p>
                                </td>
                                 <td class="td">
                                    <button class="btn-primary" wire:click="showFeedback({{ $item->id }})" x-on:click="feedback.feedbackOpen()">
                                        Feedback
                                    </button>
                                </td>
                                <td class="td">
                                    <button class="btn-success" wire:click="edit({{$item->leadid}})" x-on:click="lead.open()">
                                        view
                                    </button>
                                </td>
                                <td class="td">
                                    @if($item->classlink)
                                    <a class="btn-success" target ="_blank" href="{{ $item->classlink }}">
                                        Join Link
                                    </a>
                                    @else
                                    <button class="btn-primary" wire:click="updateDemoLink({{$item->id}})" x-on:click="demolink.demolinkOpen()">
                                        Add Link
                                    </button>
                                    @endif
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

        {{-- Feedback model  --}}
        @include('includes.classFeedback', ['method'=>'storeFeedback','readonly'=>1])

        {{-- Reschedule model  --}}
        @include('includes.class-reschedule', ['method'=>'rescheduleDemo'])


        {{-- Add Demo link model  --}}
        @include('includes.addDemoLink')
    </div>
    <!-- tables section end here  -->
</section>

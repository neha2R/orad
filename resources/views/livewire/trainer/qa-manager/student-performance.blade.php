<section x-data="{create:createAssesmentModal(), show:showAssesmentModal(), feedback:feedbackModel(),  assign:assignmentModal()}">
    <div class="flex flex-row justify-between item-end pb-8">
        <h3 class="font-normal text-gray-500 my-3 text-xl"> Hello, {{$username}} </h3>
        <div>
            <label for="leadid">Change Lead</label>
            <select class="form-input" wire:model="lead_id">
                @forelse ($students as $item)
                
                <option value="{{ $item->leadid}}">{{userName($item->leadid)}}</option>
                @empty
                <option value="" disabled>No record found...</option>
                @endforelse
            </select>
        </div>

    </div>
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-cols-3 grid-col-1 ">

        <div class="card-header shadow-md">
            <div class="flex flex-col justify-between gap-y-8 h-full">
                <h3 class="font-normal text-mute">Student Performance</h3>

                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <span class="text-xl font-semibold inline-block text-primary">
                            {{$performance}}%
                        </span>
    
                       <button class="btn-{{ ceil($performance) < 70 ? 'primary':'mute'}}" {{ ceil($performance) >= 70 ? 'disabled readonly':''}} @if(ceil($performance) < 70) x-on:click="assign.assignOpen()" @endif>
                            Revision
                       </button>
                    </div>
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-purple-200">
                        <div style="width:{{$performance}}%"
                        class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary">
                        </div>
                    </div>
                </div>
                
            </div>
           
        </div>
  
        <div  class="card-header  shadow-md" >
            <div class="flex flex-col justify-between gap-y-8 h-full text-center">
                <h3 class="font-normal text-mute">Classes Feedback</h3>
                <div>
                    <span class="font-bold text-mute text-lg text-center">{{ $classfeedback  }} / 5</span>
                    <div class="flex flex-rows justify-center text-xs">
                        @for ($i = 1; $i <= 5; $i++)
                        @php
                            $activeStars = $classfeedback >= $i ? 'starRating' : 'starRatingOutline';
                        @endphp
                        <img src='{{ asset("images/icons/$activeStars.svg") }}' alt="register-demo" class="w-8 ">
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div  class="card-header shadow-md">
             <div class="flex flex-col justify-between gap-y-8 h-full text-center">
                <h3 class="font-normal text-mute">Weekly Assessment</h3>
                <div class="flex flex-rows justify-around gap-x-8">
                    <button class="btn-mute w-full" x-on:click="show.assesmentOpen()">Show</button>
                    <button class="btn-primary w-full" x-on:click="create.scheduleOpen()">Create</button>
                </div>
            </div>
            
        </div>

    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="font-normal text-gray-500 my-3 text-xl">{{$username}} Scheduled Classes</h3>
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="th" align="left"> Date </th>
                        <th class="th" align="left"> Time </th>
                        <th class="th" align="left"> Attend </th>
                        <th class="th" align="left"> Feedback</th>
                        <th class="th" align="left"> Trainer </th>
                    </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        @forelse ($classDetails as $key => $item)
                            <tr>
                               
                                <td class="td">
                                    <p class="p">{{ date('M d, Y',strtotime($item->class_date)) }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{  slotDetails($item->slot) }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{ $item->class_feedback_id ? 'Yes' : 'No' }}</p>
                                </td>
                                
                                <td class="td">
                                    @if ($item->class_feedback_id)
                                    <button class="btn-primary" wire:click="showFeedback({{ $item->id}} )"  x-on:click="feedback.feedbackOpen()">Feedback</button>
                                    @else
                                    <p class="p">N/A</p>
                                    @endif
                                </td>
                                <td class="td">
                                    <p class="p">
                                        {{ userName($item->trainerid) }}
                                    </p>
                                </td>
                                
                                
                            </tr>    
                            
                        @empty
                        <tr>
                            <td class="td" colspan="5">
                                <p class="text-mute text-center">No record found...</p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{ $classDetails->links() }}</div>
        </div>

    </div>
    <!-- tables section end here  -->


    {{-- create assesment model  --}}
    @include('includes.createAssesment',['method'=>'storeAssesment'])

    {{-- show assement model model  --}}
    @include('includes.showAssesment', ['method'=>'showAssesment'])

    {{-- show feedback  --}}
    @include('includes.classFeedback',['method'=>'storeFeedback','readonly'=> 1])

    {{-- lead assign to junior sales model  --}}
    @include('includes.leadAssignToClassTrainer')

</section>

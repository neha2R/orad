<div x-data="{feedback:feedbackModel()}">
     <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <h3 class="font-normal text-gray-500 my-3 text-xl">{{$trainername}}'s availabile slots: </h3>
                <div class="flex {{auth()->user()->role == 2 ? 'justify-between' : 'justify-end'}} items-end mb-2">
                    @if (auth()->user()->role == 2)
                    <div class="">
                        <label for="trainerid" class="block text-mute">Select Trainer</label>
                        <select name="trainerid" id="trainerid" wire:model="trainerid" class="form-input">
                            @foreach ($trainers as $item)
                                <option value="{{$item->id}}">{{ ucwords($item->name) }}</option>
                            @endforeach
                        </select>

                    </div>
                        
                    @endif
                    <div class="flex justify-between items-end gap-x-2">
                        
                        <input type="date" name="" id="" class="form-input" wire:model="startDate">
                        <input type="date" name="" id="" class="form-input" wire:model="endDate">
                        
                    </div>
                    
                </div>
                <div class="flex justify-end">
                    @if ($errormessage)
                        <span class="text-danger">{{$errormessage}}</span>
                    @endif
                </div>
                {{-- @include('includes.table-header') --}}
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal border-collapse border border-gray-800">
                    <thead>
                    <tr>
                        <th class="th border border-gray-600" align="left"> Time\Date</th> 
                        @foreach ($interval as $key => $item)
                        <th class="th border border-gray-600" align="left">
                            {{ $item->format('M d, Y') }}
                        </th>
                        
                        @endforeach
                        
                    </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        @forelse ($alloted_slots as $key => $item)
                        <tr>
                            <td class="td border border-gray-600">
                                <p class="p">
                                    {{ slotHelper($item)}}
                                </p>
                            </td>
                            @foreach ($interval as $index => $value)
                                @php
                                    $bgcolor="";
                                    $availability="";
                                    $slotid = $userrole == '2' ? $item->slot : $item->slot_id;
                                    $dateKey = $value->format('Y-m-d');
                                    $currentDate = date('Y-m-d');
                                    if(isset($data[$dateKey])){
                                        if( isset($data[$dateKey][$slotid])){
                                            $classSchedule = $data[$dateKey][$slotid];
                                            if ($dateKey == $currentDate) {
                                                
                                                $availability = "Join";
                                                $bgcolor="background-color:#38c350";
                                                $color="white";
                                            }elseif ($dateKey < $currentDate) {
                                                $availability = $classSchedule->class_feedback_id ? "Feedback" :'';
                                                // $availability = "Feedback";
                                                $bgcolor="background-color:#a2f3b0";
                                                $color="white";
                                            }else {
                                                $availability = '';
                                                $availability = "Disabled";
                                                $bgcolor="background-color:#38c350";
                                                $color="white";
                                            }
                                        }else {
                                            if ($dateKey < $currentDate) {
                                                $availability = "Utilized";
                                                $bgcolor="background-color:#fbde75";
                                                $color="mute";
                                            }else {
                                                $bgcolor="background-color:#ffcb0d";
                                                $availability="Available";
                                                $color="white";
                                            }
                                        }
                                    }
                                @endphp
                                <td class="td border border-gray-600" style="{{$bgcolor}}">
                                    @if ($availability)
                                        @switch($availability)
                                            @case('Available')
                                            @case('Utilized')
                                                <p class="text-{{$color}}">{{$availability}}</p>
                                                @break
                                            @case('Join')
                                                @if ($userrole=='2')
                                                <div class="flex flex-col justify-between gap-y-2">
                                                    <a class="btn-primary" href="{{ $classSchedule->classlink }}" target="_blank">Join</a>
                                                    <button class="btn-primary" wire:click="showFeedback({{ $classSchedule->id}})" x-on:click="feedback.feedbackOpen()">Feedback</button>

                                                </div>
                                                @else
                                                    @if ($classSchedule->class_feedback_id)
                                                        <button class="btn-primary" wire:click="showFeedback({{ $classSchedule->id}})" x-on:click="feedback.feedbackOpen()">Feedback</button>
                                                    @else
                                                        <a class="btn-primary" href="{{ $classSchedule->classlink }}" target="_blank">Join</a>
                                                        
                                                    @endif
                                                @endif
                                                @break
                                            @case('Disabled')
                                                <a class="btn-disabled" disabled>Join</a>
                                                @break
                                            @default
                                                <button class="btn-primary" wire:click="showFeedback({{ $classSchedule->id}} )"  x-on:click="feedback.feedbackOpen()">Feedback</button>
                                        @endswitch
                                       
                                    @endif
                                </td>
                                
                               
                            @endforeach
                        </tr>
                                
                            
                        @empty
                        <tr>
                            <td class="td" colspan="{{ count($interval)+1}}">
                                <p class="p text-center">No record found...</p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- tables section end here  -->
    @include('includes.classFeedback',['method'=>'storeFeedback','readonly'=> $userrole == '2' ? 0 : 1])
</div>

<div>
     <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <h3 class="font-normal text-gray-500 my-3 text-xl">{{$trainername}}'s availabile slots: </h3>
                <div class="flex {{auth()->user()->role != 3 ? 'justify-between' : 'justify-end'}} items-end mb-2">
                    @if (auth()->user()->role != 3)
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
                                    if(isset($data[$value->format('Y-m-d')])){
                                        if( isset($data[$value->format('Y-m-d')][$item->slot_id])){
                                            if($data[$value->format('Y-m-d')][$item->slot_id] !=null){
                                                $availability = "Booked";
                                                $bgcolor="background-color:#38c350";
                                            } else {
                                                $availability = "Available";
                                                $bgcolor="background-color:#ffcb0d";
                                                
                                            }
                                        }else {
                                            $bgcolor="background-color:#ffcb0d";
                                            $availability="Available";
                                        }
                                    }
                                @endphp
                                <td class="td border border-gray-600" style="{{$bgcolor}}">
                                    <p class="text-white">
                                        {{ $availability }}
                                    </p>
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
</div>

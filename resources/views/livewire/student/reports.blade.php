<section class="px-5 mt-5">
    <h3 class="font-normal text-gray-500 my-3 text-xl"> Hello, {{$username}} </h3>
    <div class="flex flex-row gap-x-2 py-2 justify-between">  
        <div class="w-1/2">
            <label for="" class="block font-normal ">Date :</label>
            <span class="text-mute">{{ $date ? date('M d, Y', strtotime($date)) : 'N/A'}}</span>
        </div>
        <div class="w-1/2 ">
            <label for="" class="block font-normal ">Select Assessment :</label>
            <select name="" id="" class="form-input" wire:model="activeAssesment">
                <option disabled>Select only one value</option>
                @forelse ($assesments as $key => $item)
                    <option value="{{ $item->id }}">Assesment {{ ++$key }}</option>
                @empty
                    <option disabled readonly>no record found...</option>
                @endforelse
            </select>
        </div>
        
        
    </div>
    <div class="w-full py-2">
        <label for="" class="block font-normal ">Topics For Assessment :</label>
        <p class="text-mute">{{$topics}}</p>
    </div>
    <div class="w-full py-2">
        <div class=" min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse leading-normal">
                <thead>
                <tr>
                    <th class="th border border-mute" align="left"> Parameters </th>
                    <th class="th border border-mute" align="left"> Max Marks </th>
                    <th class="th border border-mute" align="left"> Your Performance </th>
                </tr>
                </thead>
                <tbody >
                    <tr>
                        <th class="th border-mute">
                            <p class="text-mute text-left">Listening</p>
                        </th>
                        <td class="td border-mute">
                                <p class="text-mute">{{$listening_marks}}</p>
                        </td>
                        <td class="td border-mute">
                            <p class="text-mute ">{{$listening_obtain}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="th border-mute">
                            <p class="text-mute text-left">Reading Comprehension</p>
                        </th>
                        <td class="td border-mute">
                            <p class="text-mute ">{{$reading_marks}}</p>
                        <td class="td border-mute">
                            <p class="text-mute ">{{$reading_obtain}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="th border-mute">
                            <p class="text-mute text-left">Speaking</p>
                        </th>
                        <td class="td border-mute">
                            <p class="text-mute">{{$speaking_marks}}</p>
                        </td>
                        <td class="td border-mute">
                            <p class="text-mute">{{$speaking_obtain}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="th border-mute">
                            <p class="text-mute text-left">Writing</p>
                        </th>
                        <td class="td border-mute">
                            <p class="text-mute">{{$writing_marks}}</p>
                        </td>
                        <td class="td border-mute">
                            <p class="text-mute">{{$writing_obtain}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="th border-mute">
                            <p class="text-mute text-left">Avg Marks</p>
                        </th>
                        <td class="td border-mute">
                            <p class="text-mute">{{$avg_of_marks}}</p>
                        </td>
                        <td class="td border-mute">
                            <p class="text-mute">{{$avg_of_obtain}}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="th border-mute">
                            <p class="text-mute text-left">Total Marks</p>
                        </th>
                        
                        <td class="td border-mute" colspan="2">
                            <p class="text-mute">{{$total}}</p>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="th border-mute">
                            <p class="text-mute">Feedback:</p>
                        </td>
                        <td colspan="2"  class="th border-mute">
                            <p class="text-mute"> {{ucwords($feedback)}}</p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</section>
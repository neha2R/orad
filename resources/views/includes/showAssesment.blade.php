<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="show.isAssesmentOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': show.isAssesmentOpening(), 'opacity-100': show.isAssesmentOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': show.isAssesmentOpening(), 'mt-8': show.isAssesmentOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Show {{$username}} Assessment:</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="show.assesmentClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- form section start here -->
                    <section method="post" class="px-5 mt-5">
                        
                        <div class="flex flex-row gap-x-2 py-2 justify-between">  
                            <div class="w-1/2 ">
                                <label for="" class="block font-normal ">Select Assessment :</label>
                                <select name="" id="" class="form-input" wire:model="activeAssesment">
                                    <option >Select only one value</option>
                                    @forelse ($assesments as $key => $item)
                                        <option value="{{ $item->id }}">Assesment {{ ++$key }}</option>
                                    @empty
                                        <option disabled readonly>no record found...</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label for="" class="block font-normal ">Date :</label>
                                <input type="date" name="date" id="date" wire:model="date" class="form-input" disabled readonly>
                            </div>
                           
                        </div>
                        <div class="w-full py-2">
                            <label for="" class="block font-normal ">Topics For Assessment :</label>
                            <textarea name="" id="" class="form-input" wire:model="topics" style="height: 85px" readonly disabled></textarea>
                            @error('topics') <span class="text-danger">{{ $message }} @enderror
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
                                            <td colspan="3" class=" border-mute">
                                                <div class="w-full">
                                                    <label for="" class="block py-1">Feedback:</label>
                                                    <textarea name="" id="" class="form-input" wire:model="feedback" style="height: 85px" readonly disabled></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end p-4 ">
                            <button x-on:click="show.assesmentClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputs()">Cancel</button>
                        </div>
                    </section>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': show.isAssesmentOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function showAssesmentModal() {
        
        return {
            assesmentState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            assesmentOpen() {
                this.assesmentState = 'TRANSITION'
                setTimeout(() => { this.assesmentState = 'OPEN' }, 50)
            },
            assesmentClose() {
                this.assesmentState = 'TRANSITION';
                setTimeout(() => { this.assesmentState = 'CLOSED' }, 300)
            },
            isAssesmentOpen() { return this.assesmentState === 'OPEN' },
            isAssesmentOpening() { return this.assesmentState !== 'CLOSED' },
        }
    }
</script>
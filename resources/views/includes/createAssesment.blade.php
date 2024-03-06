<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="create.isScheduleOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': create.isScheduleOpening(), 'opacity-100': create.isScheduleOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': create.isScheduleOpening(), 'mt-8': create.isScheduleOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Create Assessment:</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="create.scheduleClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- form section start here -->
                    <form method="post"  wire:submit.prevent="{{$method}}" class="px-5 mt-5">
                        @if ($errormessage)
                            <span class="text-danger text-center py-2">{{$errormessage}}</span>
                        @endif
                        <div class="flex flex-col gap-x-2 py-1 justify-between">  
                            <div class="w-full">
                                <label for="" class="block font-normal ">Date :</label>
                                <input type="date" name="date" id="date" wire:model="date" class="form-input">
                                @error('date') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full">
                                <label for="" class="block font-normal ">Topics For Assessment :</label>
                                <textarea name="" id="" class="form-input" wire:model="topics" style="height: 85px"></textarea>
                                @error('topics') <span class="text-danger">{{ $message }} @enderror
                            </div>
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
                                                <input type="text" class="form-input" wire:model="listening_marks">
                                            </td>
                                            <td class="td border-mute">
                                                <input type="text" class="form-input" wire:model="listening_obtain">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th border-mute">
                                                <p class="text-mute text-left">Reading Comprehension</p>
                                            </th>
                                            <td class="td border-mute">
                                                <input type="text" class="form-input" wire:model="reading_marks">
                                            </td>
                                            <td class="td border-mute">
                                                <input type="text" class="form-input" wire:model="reading_obtain">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th border-mute">
                                                <p class="text-mute text-left">Speaking</p>
                                            </th>
                                            <td class="td border-mute">
                                                <input type="text" class="form-input" wire:model="speaking_marks">
                                            </td>
                                            <td class="td border-mute">
                                                <input type="text" class="form-input" wire:model="speaking_obtain">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="th border-mute">
                                                <p class="text-mute text-left">Writing</p>
                                            </th>
                                            <td class="td border-mute">
                                                <input type="text" class="form-input" wire:model="writing_marks">
                                            </td>
                                            <td class="td border-mute">
                                                <input type="text" class="form-input" wire:model="writing_obtain">
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class=" border-mute">
                                                <div class="w-full">
                                                    <label for="" class="block py-1">Feedback:</label>
                                                    <textarea name="" id="" class="form-input" wire:model="feedback" style="height: 85px"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end p-4 ">
                            <button x-on:click="create.scheduleClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputs()">Cancel</button>
                            <button type="submit" class="inline-block btn-primary edit-button">Save</button>
                        </div>
                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': create.isScheduleOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function createAssesmentModal() {
        
        return {
            scheduleState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            scheduleOpen() {
                this.scheduleState = 'TRANSITION'
                setTimeout(() => { this.scheduleState = 'OPEN' }, 50)
            },
            scheduleClose() {
                this.scheduleState = 'TRANSITION';
                setTimeout(() => { this.scheduleState = 'CLOSED' }, 300)
            },
            isScheduleOpen() { return this.scheduleState === 'OPEN' },
            isScheduleOpening() { return this.scheduleState !== 'CLOSED' },
        }
    }
</script>
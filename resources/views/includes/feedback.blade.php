<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="feedback.isFeedbackOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': feedback.isFeedbackOpening(), 'opacity-100': feedback.isFeedbackOpen() }"
            class="fixed z-50 top-0 left-0 w-full h-full outline-none transition-opacity duration-200 linear overflow-y-auto"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': feedback.isFeedbackOpening(), 'mt-8': feedback.isFeedbackOpen() }"
                class="relative w-auto pointer-events-none max-w-2xl mt-8 mx-auto transition-all duration-200 ease-out">

                <!-- MODAL CONTAINER -->
                <div
                    class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Trainer FeedBack</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="feedback.feedbackClose()" wire:click="resetFeedbackInput()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    @if (!$readonly)
                    <form wire:submit.prevent="{{$method}}"  method="POST">
                    @else
                    <section>
                    @endif
                        <div class="px-10 py-5 text-gray-600">
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Select Lead :</label>
                                <select name="" id="" class="form-input" wire:model="demoid">
                                    <option value="">--Select Lead--</option>
                                    @foreach ($demoLeads as $item)
                                        <option value="{{$item->id}}">{{ucwords($item->userRelation->name ?? '')}}</option>
                                    @endforeach
                                </select>
                                @error('demoid') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Demo Done :</label>
                                <select name="" id="" class="form-input" wire:model="is_demodone">
                                    <option value="{{0}}">No</option>
                                    <option value="{{1}}">Yes</option>
                                </select>
                                @error('is_demodone') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Comment :</label>
                                <textarea name="" id="" wire:model="comment" class="form-input" style="height: 85px"></textarea>
                                @error('comment') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Uploaded Video Link :</label>
                                <input type="text"  wire:model="video_link" class="form-input">
                                @error('video_link') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Behaviour :</label>
                                <select name="" id="" class="form-input" wire:model="behaviour">
                                    <option>--select any one--</option>
                                    @foreach (behaviourCode() as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                        
                                    @endforeach
                                </select>
                                @error('behaviour') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Did the parent attend the class ?</label>
                                <select name="" id="" class="form-input" wire:model="parent_attend">
                                    <option>--select any one--</option>
                                    <option value="{{0}}">No</option>
                                    <option value="{{1}}">Yes</option>
                                </select>
                                @error('parent_attend') <span class="text-danger">{{ $message }} @enderror
                            </div>
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">How likely is the child/parent to but the class ?</label>
                                <select name="" id="" class="form-input" wire:model="course_like">
                                    <option>--select any one--</option>
                                    @foreach (courselike() as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                        
                                    @endforeach
                                </select>
                                @error('course_like') <span class="text-danger">{{ $message }} @enderror
                            </div>
                          
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">What time should the agent call the parent ?</label>
                                <div class="flex justify-between gap-x-2">
                                    <div class="w-1/2">
                                        <input type="date" class="form-input" wire:model="call_date">
                                        @error('call_date') <span class="text-danger">{{ $message }} @enderror
                                    </div>
                                    <div class="w-1/2">
                                        <input type="time" class="form-input" wire:model="call_time">
                                        @error('call_time') <span class="text-danger">{{ $message }} @enderror

                                    </div>
                                </div>
                            </div>
                          
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="feedback.feedbackClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetFeedbackInput()">Close</button>
                            @if(!$readonly)
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >Submit</button>
                            @endif
                        </div>
                    @if (!$readonly)
                        
                    </form>
                    @else
                    </section>
                    @endif
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': feedback.isFeedbackOpen() }"
            class="z-40 fixed top-0 left-0 bottom-0 right-0 bg-black opacity-0 transition-opacity duration-200 linear">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function feedbackModel() {

        return {
            state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            feedbackOpen() {
                this.state = 'TRANSITION'
                setTimeout(() => { this.state = 'OPEN' }, 50)
            },
            feedbackClose() {
                this.state = 'TRANSITION';
                setTimeout(() => { this.state = 'CLOSED' }, 300)
            },
            isFeedbackOpen() { return this.state === 'OPEN' },
            isFeedbackOpening() { return this.state !== 'CLOSED' },
        }
    }
</script>
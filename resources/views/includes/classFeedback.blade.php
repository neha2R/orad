<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="feedback.isFeedbackOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': feedback.isFeedbackOpening(), 'opacity-100': feedback.isFeedbackOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': feedback.isFeedbackOpening(), 'mt-8': feedback.isFeedbackOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Student FeedBack</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="feedback.feedbackClose()" wire:click="resetFeedbackInput()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    @if (!$readonly && !$feedbackid)
                    <form wire:submit.prevent="{{$method}}"  method="POST">
                    @else
                    <section>
                    @endif
                        <div class="px-10 py-5 text-gray-600">
                            @if ($userrole!=2)
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Student Name :</label>
                                <span class="text-mute">{{$studentname}}</span>
                            </div>

                            @endif
                            <div class="w-full py-2">
                                <label for="" class="block font-bold">Ratings:</label>
                                <div class="flex flex-row items-center justify-start gap-x-2">
                                    {{-- <img src="{{ asset('images/icons/starRating.svg') }}" alt="register-demo" class="w-8 {{$userrole == '2' && !$feedbackid ? 'cursor-pointer' : ''}}" @if($userrole != 2 && !$feedbackid) wire:click="ratingStatus(1)" @endif> --}}
                                    @for ($i = 1; $i <= 5; $i++)
                                    @php
                                        $activeStars = $rating >= $i ? 'starRating' : 'starRatingOutline';
                                    @endphp
                                    <img src='{{ asset("images/icons/$activeStars.svg") }}' alt="register-demo" class="w-8 {{$userrole == 2 && !$feedbackid ? 'cursor-pointer' : ''}}" @if($userrole == 2 && !$feedbackid) wire:click="ratingStatus({{$i}})" @endif>
                                    @endfor
                                </div>
                            </div>
                            <div class="w-full py-1">
                                <label for="" class="block font-bold ">Feedback :</label>
                                <textarea name="feedback" id="" wire:model="feedback" class="form-input {{$readonly || $feedbackid ? 'cursor-not-allowed' : '' }}" style="height: 85px" {{$readonly || $feedbackid ? 'readonly disabled' : '' }}></textarea>
                                @error('feedback') <span class="text-danger">{{ $message }} @enderror
                            </div>
                        </div>
                        @if(!$readonly && !$feedbackid)
                        <div class="flex items-center justify-end p-4 ">
                             <button type="button" class="btn-mute mr-2 close" wire:click="resetFeedbackInput()" x-on:click="feedback.feedbackClose()" >
                                Close
                            </button>
                            <button type="submit" class="inline-block btn-primary edit-button" >Submit</button>
                        </div>
                        @endif
                    @if (!$readonly && !$feedbackid)
                        
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
            class="model-backdrop">
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
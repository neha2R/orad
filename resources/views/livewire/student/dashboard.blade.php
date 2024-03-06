<section x-data="{schedule:scheduleModal(), course:courseModal() }">
    <h3 class="font-normal p my-3 text-xl"> Dashboard </h3>
    <!-- cards start here -->
    <div class="py-2 w-full  flex flex-col md:flex-row justify-between items-center">
        <div class="group flex flex-col items-center gap-y-1 " >
            @if ($activeState >= 1)
            <img src="{{ asset('images/icons/Verified.svg') }}" class="w-6 " alt="verified">
            @endif
            <p class="text-{{$activeState >= 1 ? 'success':'mute'}}">Book Your Trial Class</p>
        </div>
        <div class=" my-auto pt-6">
            {!! borderDashed() !!}
        </div>

        <div class="group flex flex-col items-center gap-y-1" >
             @if ($activeState >= 2)
            <img src="{{ asset('images/icons/Verified.svg') }}" class="w-6 " alt="verified">
            @endif
            <p class="text-{{$activeState >= 2 ? 'success':'mute'}}">Trial Class</p>
        </div>
        
        <div class=" my-auto pt-6">
            {!! borderDashed() !!}
        </div>

        <div class="group flex flex-col items-center gap-y-1" >
            @if ($activeState >= 3)
            <img src="{{ asset('images/icons/Verified.svg') }}" class="w-6 " alt="verified">
            @endif
            <p class="text-{{$activeState >= 3 ? 'success':'mute'}}">Payment</p>
        </div>
      
    </div>


    <!-- cards end here  -->
    <div class="mt-8">
        <h4 class="text-primary py-5 font-bold text-lg">Hello {{ucwords(auth()->user()->name)}} !</h4>
    @if (!$activeState)
        {{-- <!-- Book schedule section  start here  --> --}}

        <div class="flex flex-col items-center justify-center gap-y-5">
            <p class="font-medium text-lg">You have successfully register with us, Now You can schedule free trial class.</p>
            <img src="{{ asset('images/png/register-demo.png') }}" alt="register-demo" class="w-1/3">
            <button class="btn-primary px-5 py-2 mt-8"  x-on:click="schedule.scheduleOpen()"><span class="text-2xl font-bold px-12">Schedule Class</span></button>
        </div>

        {{-- <!-- schedule section end here  --> --}}
    @elseif ($activeState == 1)
        {{-- Join schedule class section start here  --}}
        <div class="flex flex-col items-center justify-center gap-y-5">
            <div class="flex card-header flex-row justify-between items-center">
                <div class="flex flex-row gap-x-3">
                    <img src="{{ asset('images/png/join-demo.png') }}" alt="join-demo" class="w-1/5 -ml-4 -mb-4">
                    <div class="flex flex-col gap-y-2">
                        <h4 class="text-lg font-semibold text-danger">Trial Class:</h4>
                        <h4 class="text-xl font-semibold text-primary">Instruction:</h4>
                    </div>
                </div>
                <a href="https://zoom.us/download" target="_blank" class="border-2 border-red-500 h-12 rounded-full flex items-center"><span class="px-12 font-bold text-xl text-danger">Download Zoom</span></a>

            </div>
            <p class="font-medium text-lg">
                @if (!$userDemo->trainerid)
                    Your Trial class Preference has been Saved.
                @else
                    You class is schedule for: {{date('M d, Y',strtotime($userDemo->date))}} at {{slotHelper($userDemo)}}.
                @endif
            </p>
            <img src="{{ asset('images/png/schedule.png') }}" alt="join-demo" class="w-1/3">
            <p class="font-medium text-lg py-3">
                @if (!$userDemo->trainerid)
                    Our executive will call you soon.
                @else
                    We are waiting for you to join trial class.
                @endif
            </p>
            <a href="{{ $userDemo->demolink }}" target="_blank" class="btn-{{$userDemo->trainerid ? 'danger' : 'fadedanger'}} px-5 py-2 mt-8"><span class="text-2xl font-bold px-12">Join Class</span></a>
            
            <div class="flex flex-row gap-2 items-center pb-8">
                <span>Reschedule </span>
                @if ($userDemo->trainerid && !$userDemo->is_demodone)
                <small class="bg-danger rounded-full h-8 w-8 flex items-center justify-center text-white cursor-pointer" x-on:click="schedule.scheduleOpen()" > > </small>
                @else 
                <small class="bg-fadedanger rounded-full h-8 w-8 flex items-center justify-center text-white cursor-not-allowed" > > </small>
                @endif
            </div>
        </div>
        {{-- Join schedule class section end here  --}}
    @elseif ($activeState == 2)
        {{-- feedback section start here  --}}
        <div class="flex flex-col items-center justify-center gap-y-5">
            <p class="font-medium text-lg"><span>You have completed your trial class.</span> 
                @if ($userDemo->student_feedback)
                <span>Thank you for you feedback.</span>
                @else
                <span>Please rate your experience.</span>
                @endif
            </p>
            <div class="flex flex-row items-center justify-center gap-x-2">
                <img src="{{ asset('images/icons/starRating.svg') }}" alt="register-demo" class="w-8 {{!$userDemo->student_feedback ? 'cursor-pointer' : ''}}" @if(!$userDemo->student_feedback) wire:click="ratingStatus(1)" @endif>
                @for ($i = 2; $i <= 5; $i++)
                @php
                    $activeStars = $rating >= $i ? 'starRating' : 'starRatingOutline';
                @endphp
                <img src='{{ asset("images/icons/$activeStars.svg") }}' alt="register-demo" class="w-8 {{!$userDemo->student_feedback ? 'cursor-pointer' : ''}}" @if(!$userDemo->student_feedback) wire:click="ratingStatus({{$i}})" @endif>
                @endfor
            </div>
            {{-- <button class="btn-primary px-5 py-2 mt-4" wire:click="submitFeedback()"><span class="text-xl font-bold px-10">Submit Feedback</span></button> --}}
            <button class="btn-primary px-5 py-2 mt-4" @if (!$userDemo->student_feedback) wire:click="submitFeedback()" @endif><span class="text-xl font-bold px-10">{{!$userDemo->student_feedback ? 'Submit' : 'Submitted'}}</span></button>
        </div>
        {{-- feedback section end here  --}}

        {{-- Course section start here  --}}
        <div class="pt-8">
            <p class="font-medium text-lg text-center pb-2">
                @if($discountOnCourse != null)
                Choose your course, To proceed click the book now button showing below course details
                @else
                Thank you for participating in the demo, our team will suggest a better course for your bright future.
                @endif
            </p>
            <div class="owl-carousel " wire:ignore>
                @foreach ($courses as $key => $value)
                    <div class="transation-effect w-full p-4 md-w-full md:max-w-lg md:mb-0 mb-6 flex flex-col justify-center items-center  mx-auto">
                        <div class="h-auto w-full rounded-sm shadow-lg bg-white">
                            <div class="pt-8 pb-9 px-2 text-center bg-danger text-white">
                                <h3 class="text-xl font-bold">{{ucwords($value->name)}}</h3>
                                
                            </div>
                            <div class="text-left p-8 font-normal text-dark">
                            <p class="pt-3">Duration: {{ $value->days / 30}} Months</p>
                            <p class="pt-3">No of classes: {{ $value->no_of_classes }}</p>
                            <p class="pt-3">Class time/day: {{$value->class_duration}} Mins</p>
                            <p class="pt-3">MRP: {{ceil($value->price)}} /-</p>
                            @if ($value->discount) 
                                <p class="pt-3">Discount:  {{"$value->discount %" }}</p> 
                                @else
                                <p class="pt-9"></p> 
                            @endif
                            @if (in_array($value->id,  array_keys($discountOnCourse)))
                            <h4 class="text-danger text-xl font-bold py-4">
                                <span class="flex flex-rows justify-between">

                                    <span>RS.
                                        <span class="line-through">{{ceil($value->discounted_price)}}</span>
                                        <span>/-</span>
                                    </span>
                                    <span class="">{{ceil( $discountOnCourse[$value->id] )}}</span>
                                </span>
                            </h4>
                            @else
                            <h4 class="text-danger text-xl font-bold py-4">RS. {{ceil($value->discounted_price)}}/-</h4>
                            @endif
                            </div>
                        </div>
    
                        @if (in_array($value->id, array_keys($discountOnCourse)))
                        <button wire:click="courseDetails({{$value->id}})"  x-on:click="course.courseOpen()" class="tracking-px bg-danger text-white -mt-6 shadow-lg rounded-md focus:outline-none px-20 py-3  text-sm">
                            BUY NOW
                        </button>
                        @else
                        <button class="tracking-px bg-fadedanger text-white -mt-6 shadow-lg focus:outline-none rounded-md px-20 py-3  text-sm">
                            View
                        </button>
                        @endif
                    </div>
                    
                @endforeach
            </div>
        </div>
        {{-- Course section end here  --}}
    @else
        {{-- Parent Course Details section start here  --}}
        @if ($purchasedCourse)
        <div class="flex flex-col  gap-y-5">
            <p class="font-medium text-md"><span>Your purchased course.</span></p>
            <p class="font-bold"><span class="text-lg text-danger">{{$purchasedCourse->Course->name ?? ''}}</span><span class="text-md text-mute"> ({{$purchasedCourse->Course != null ? $purchasedCourse->Course->course_type ? 'Personal Course' : 'Group Course' : ''}})</span></p>
            <p class="text-dark font-normal ">{{ $purchasedCourse->Course->description ?? '' }}</p>
        </div>
        {{-- Parent Course Details section end here  --}}

        {{-- child course details section start here  --}}
        <div class="w-full p-4 flex flex-row justify-between items-center gap-x-4">

            {{-- course detail section start here  --}}
            <div class="h-auto w-1/2 rounded-sm shadow-lg bg-white">
                <div class="pt-8 pb-9 px-2 text-center bg-danger text-white">
                    <h3 class="text-xl font-bold">{{ucwords($purchasedCourse->name)}}</h3>
                    
                </div>
                <div class="text-left p-8 font-normal text-dark">
                <p class="pt-3">Duration: {{ $purchasedCourse->days / 30}} Months</p>
                <p class="pt-3">No of classes: {{ $purchasedCourse->no_of_classes }}</p>
                <p class="pt-3">Class time/day: {{$purchasedCourse->class_duration}} Mins</p>
                <p class="pt-3">MRP: {{ceil($purchasedCourse->price)}} /-</p>
                @if ($purchasedCourse->discount) 
                    <p class="pt-3">Discount:  {{"$purchasedCourse->discount %" }}</p> 
                    @else
                    <p class="pt-9"></p> 
                @endif
                @if (in_array($purchasedCourse->id,  array_keys($discountOnCourse)))
                <h4 class="text-danger text-xl font-bold py-4">
                    <span class="flex flex-rows justify-between">

                        <span>RS.
                            <span class="line-through">{{ceil($purchasedCourse->discounted_price)}}</span>
                            <span>/-</span>
                        </span>
                        <span class="">{{ceil( $discountOnCourse[$purchasedCourse->id] )}}</span>
                    </span>
                </h4>
                @else
                <h4 class="text-danger text-xl font-bold py-4">RS. {{ceil($purchasedCourse->discounted_price)}}/-</h4>
                @endif
                </div>
            </div>
            {{-- course details section end here  --}}

            {{-- trainer section start here  --}}
            <div class="h-auto w-1/2">
                @if (auth()->user()->parent_id)
                <div class="pt-8 pb-9 px-2 text-center text-mute">
                    <h3 class="text-xl font-bold">{{userName(auth()->user()->parent_id ?? '')}}</h3>
                    <div class="inline-flex shadow-lg border border-gray-200 rounded-xl overflow-hidden h-40 w-40">
                        <img src="{{userPhoto(auth()->user()->parent_id)}}" alt="photo" class="w-45">
                    </div>
                </div>
                    
                @else
                    <p>Thank you for purchasing the course. We will appoint you your trainer very soon...</p>
                @endif
            </div>
            {{-- trainer section end here --}}
        </div>
        {{-- child course details section end here  --}}

        <div class="flex justify-center items-center my-5">
            <a href="{{route('classSchedule') }}" class="btn-{{auth()->user()->parent_id ? 'danger' : 'fadedanger'}} px-5 py-2 mt-8"><span class="text-2xl font-bold px-12">View Class Schedule</span></a>
        </div>
            
        @else
        <p class="text-center text-mute py-5">no record found...</p>
        @endif

    @endif
        <span class="flex justify-center text-mute text-center mt-2">Need help? Reach us on 7023257319</span>
    </div>

    {{-- schedule model  --}}
    @include('includes.scheduleTrial',['method'=>'scheduleDemo'])

    {{-- course model  --}}
    @include('includes.courseModel', ['method'=>'coursePayment'])

</section>

<div>
    <div class="container p-5 mx-auto">
        <div class="flex flex-col md:flex-row gap-2">
            <div class=" md:flex-1 w-full md:w-4/5">
                <div class="flex justify-between font-normal">
                    <div class="">
                        Section
                    </div>
                    <div class="flex-1 text-right">
                        Online Exam
                    </div>
                </div>
                <div class=" border border-gray-300">
                    <div class="flex justify-between">
                        <div class="bg-primary py-4 px-12 text-center text-white items-center">
                            English
                        </div>
                        <div class="flex-1 py-4 bg-white text-dark text-right">
                            <h5 class="font-medium mr-4">Time Left : <span class="timer">{{$duration}}</span></h5>
                        </div>
                    </div>
                    
                </div>
    
                {{-- question & answer section  --}}
                <div class="border border-gray-300 mt-1">
                    <div class="px-4 flex flex-col md:flex-row md:items-center justify-between bg-white text-dark text-normal border-b border-gray-300 py-3" >
                        <h5 class="font-semi-bold">Question No. {{ $sr_no }}</h5>
                        
                    </div>
                    <div class="min-h-84 p-4 bg-white">
                        <div class="py-4">
                            <h5>{!! $question->question !!}</h5>
                        </div>
                        <div class="mt-4 flex flex-col gap-4">
                            <div class="flex flex-rows gap-2  items-baseline text-center">
                                <input type="radio" name="answer" class="cursor-pointer" id="a" wire:model="answer" value="a">
                                <span>{{$question->option_a}}</span>
                            </div>
                            <div class="flex flex-rows gap-2  items-baseline text-center">
                                <input type="radio" name="answer" class="cursor-pointer" id="b" wire:model="answer" value="b">
                                <span>{{$question->option_b}}</span>
                            </div>
                            <div class="flex flex-rows gap-2  items-baseline text-center">
                                <input type="radio" name="answer" class="cursor-pointer" id="c" wire:model="answer" value="c">
                                <span>{{$question->option_c}}</span>
                            </div>
                            <div class="flex flex-rows gap-2  items-baseline text-center">
                                <input type="radio" name="answer" class="cursor-pointer" id="d" wire:model="answer" value="d">
                                <span>{{$question->option_d}}</span>
                            </div>
                        </div>
                        
                    </div>
        
                </div>
    
                {{-- save & submit section  --}}
                <div class="border border-gray-300 mt-1">
                    <div class="flex md:flex-row flex-col justify-between items-center text-center bg-white py-3">
                        <div class="flex md:flex-row flex-col md:justify-between md:px-2 py-2 gap-2">
                            {{-- <button class="py-1 px-4 bg-white text-dark border border-gray-300">Mark for Review & Next</button>  --}}
                            <button type="button" class="py-1 px-4 bg-white text-dark border border-gray-300" wire:click="clearResponse({{ $question->id }})">Clear Response</button>
                        </div>
                        <div class="text-end">
                            @if ($last_question->id == $question->id)
                            <button type="button" class="py-1 px-4 bg-primary text-white mr-2 focus:outline-none" wire:click="$emit('triggerSubmit')">Save & Submit</button>
                            @else 
                            <button type="button" class="py-1 px-4 bg-primary text-white mr-2 focus:outline-none" wire:click="saveNext({{ $question->id }}, {{$sr_no+1}})">Save & Next</button>
                            @endif
                        </div>
                    </div>
        
                </div>
            </div>
            <div class="flex-col w-full md:w-1/5 bg-white mt-6">
                <div class=" border border-gray-300">
                    <h5 class="p-4 bg-primary text-white">{{ucwords(auth()->user()->name)}}</h5>
                    <div class="container p-4">
                        <h5>Choose a Question</h5>
                        <div class="bg-blue-100 h-56 p-5 overflow-y-auto itmes-center">
                           
                            <div class="grid grid-cols-4 gap-4 justify-items-center text-center">
                                
                                @foreach($question_paper as $key => $value)
                                <span class="{{ array_key_exists($value->id, $answered_questions) ? 'answered' : ($value->id == $question->id ? 'not-answered-review' : 'not-visit')}} p-2 text-center cursor-pointer" wire:click="changeQuestion({{ $value->id }}, {{++$key}})">{{$key}}</span>
                                @endforeach
                            </div>
                        </div>
    
                        <div class="grid grid-rows-3 mt-4 grid-cols-2 text-xs gap-2">
                            <div class="flex flex-row justify-start">
                                <span class="answered">1</span>
                                <span class="ml-2">Answered</span>
                            </div>
                           
                            <div class="flex flex-row justify-start">
                                <span class="not-answered-review">2</span>
                                <span class="ml-2">Active Question</span>
                            </div>
                            <div class="flex flex-row justify-start">
                                <span class="not-visit item-center">3</span>
                                <span class="ml-2">Not viewed</span>
                            </div>
                            
                        </div>
                        <div class="flex justify-center mt-4"><button class="btn-primary text-white px-8 py-1" wire:click="$emit('triggerSubmit')">Submit</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // timer function 
    function startTimer(duration, display) {
       var countDownDate = new Date(duration).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();
            
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
            
        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
        // Output the result in an element with id="demo"
        document.querySelector(".timer").innerHTML = hours + "h "
        + minutes + "m " + seconds + "s ";
            
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);

            document.querySelector(".timer").innerHTML = "EXPIRED";
            
            // calling store method to save paper
            @this.call('store')
        }
        }, 1000);
    }

    window.onload = function () {
        var duration = $(".timer").text(),
        display = document.querySelector('.timer');
        startTimer(duration, display);
    };

    // submit button alert 
    document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerSubmit', () => {
            Swal.fire({
                title: 'Are You Sure?',
                text: 'You want to submit the exam!',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'btn-success',
                cancelButtonColor: 'btn-default',
                confirmButtonText: 'Submit'
            }).then((result) => {
		        //if user clicks on delete
                if (result.value) {
		            // calling store method to save paper
                    @this.call('store')
		            // success response
                    responseAlert({title: session('message'), type: 'success'});
                    
                } else {
                    responseAlert({
                        title: 'Submittion cancel !',
                        type: 'success'
                    });
                }
            });
        });
    })
</script>
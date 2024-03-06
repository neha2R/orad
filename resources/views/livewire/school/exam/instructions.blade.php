
<div class="container p-5 mx-auto">
    <div class=" border border-gray-300">
        <div class="px-4 flex items-center justify-between bg-primary text-white text-normal py-2" >
            <h5>Instruction</h5>
            {{-- <div class="flex items-center justify-between">
                <span class="mr-2">View In:</span>
                <div class="-ml-1 w-full md:w-24 relative px-2 pb-2 lg:mt-3 ">
                    <select class="bg-white w-auto text-gray-900 text-medium pr-2 border border-gray-300">
                        <option>English</option>
                        <option>Hindi</option>
                    </select>
                </div>
            </div> --}}
        </div>
        <div class="p-4 bg-white text-medium text-gray-900 h-96 overflow-y-auto ">
            <h5 class="text-center pt-5">Please read the instructions carefully</h5>
            <div class="mt-8 px-3">
                <h5 class="font-bold underline mb-2">{{$instruction->title ?? ''}}</h5>
                <ol class="pt-5 ml-8 list-decimal font-normal text-sm leading-loose">
                    {!! $instruction->description !!}
                    
                </ol>
            </div>
            <div class="mt-8 px-3 flex flex-col gap-4">
                <div class="flex flex-rows font-normal text-sm leading-loose ">
                    <div class="flex justify-start gap-2">
                        <span class="not-visit">1</span>
                        <span>You have not visit the question yet</span>
                    </div>
                </div>
                <div class="flex flex-rows font-normal text-sm leading-loose">
                    <div class="flex justify-start gap-2">
                        <span class="not-answered-review">2</span>
                        <span>Currently active question</span>
                    </div>
                </div>
                <div class="flex flex-rows font-normal text-sm leading-loose">
                    <div class="flex justify-start gap-2">
                        <span class="answered">3</span>
                        <span>You have answered the question</span>
                    </div>
                </div>
                {{-- <div class="flex flex-rows font-normal text-sm leading-loose">
                    <div class="flex justify-start gap-2">
                        <span class="not-answered-review">4</span>
                        <span>You have NOT answered the question but have marked the question for review</span>
                    </div>
                </div>
                <div class="flex flex-rows font-normal text-sm leading-loose">
                    <div class="flex justify-start gap-2">
                        <span class="answered-review">5</span>
                        <span>The question(s) "Answered and Marked for Review" will be considered for evaluation.</span>
                    </div>
                </div> --}}
            </div>
        </div>
        

    </div>
    <div class="border border-gray-300 mt-1">
        @php
            $route = $instruction_id ? route('student.exam',$instruction_id) : '#';
        @endphp
        <div class="flex justify-center items-center text-center bg-white py-6">
            <a href="{{ $route }}" class="py-1 px-4 bg-primary text-white">I am ready to begin</a>
        </div>

    </div>
</div>
   
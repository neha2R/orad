<div x-data="classModal()">
    <div class="card">

        @include('website.layouts.alert')

        <div class="flex flex-col justify-center items-center text-center container">
            <h4 class="text-danger pb-3"><strong> Welcome, {{ ucfirst(auth()->user()->name) }} </strong> </h4>
            <h4 class="pb-3">About ORAD Little Champ Competition</h4>
            <p class="text-mute">As the saying goes, "learn well today, live well tomorrow !", younger generations are the prime source for world's future development.
            We, the ORAD team, are coming up with a super cool event called "ORAD Little Champ Competition", especially for students in india.  This event mainly focuses on testing the English knowledge of students and unreveal the most potential kid from this huge crowd.
            We welcome all the students around the Nation to grab this chance and exhibit their talent.</p>

            <h4 class="pt-5 pb-2">Your Examination is scheduled for: Sept 05, 2021 at 01:00 PM</h4>
            <h4 class="pt-5 pb-2">You can expect your result by Monday 30 Sept</h4>
            <img src="{{ asset('images/png/scholarship-dashboard.png') }}" alt="img" class="img " width="350px">
            <h4 class="py-3">We wish you very good luck. Prepare well.</h4>

            @if (!$is_exam_started)
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="You can login one hour prior to examination" data-placement="right">
                
            @endif
                @php
                    $background= $is_exam_started ? "#ff422d" : "#ff9084";
                    $route =  $is_exam_started ? route('scholarship.exam-instructions') : '#'
                @endphp
                <button  x-on:click="classOpen()"  class="btn py-2 px-5 btn-lg outline-none focus:outline-none" style="background-color: {{ $background}}; color:#ffffff" style="pointer-events: none;" {{ $is_exam_started ? "" : "disabled"}}>Join Test</button>
                {{-- <button data-toggle="modal" data-target="#createdepartment"  class="btn py-2 px-5 btn-lg" style="background-color: {{ $background}}; color:#ffffff" style="pointer-events: none;" {{ $is_exam_started ? "" : "disabled"}}>Join Test</button> --}}
            @if (!$is_exam_started)
            </span>    
            @endif
            <br />
            <h6 class="pt-4"><strong>Please refersh the page if link is disabled.</strong></h6>

            <h6 class="pt-4"><strong>Need help? Reach us on 7023257320</strong></h6>
        </div>



    </div>


    {{-- create modal --}}
    <!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="isClassOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': isClassOpening(), 'opacity-100': isClassOpen() }"
            class="fixed z-50 top-0 left-0 w-full h-full outline-none transition-opacity duration-200 linear overflow-y-auto"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': isClassOpening(), 'mt-8': isClassOpen() }"
                class="relative w-auto pointer-events-none max-w-md mt-8 mx-auto transition-all duration-200 ease-out">

                <!-- MODAL CONTAINER -->
                <div
                    class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Select Class Group </span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="isClassClose()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form action="{{route("scholarship.exam-instructions",$class_group)}}" method="get">
                        <div class="flex items-center justify-center p-4 ">
                            <div class="" >
                                <label for="exampleFormControlTextarea1" class="font-normal text-gray-700 text-lg">Select Class Group :</label>
                                <select name="class_group" class="w-full pl-5 pr-10 appearance-none form-input" id="class" wire:model="class_group">
                                    <option value="6">From grade 3 to grade 6</option>
                                    <option value="9">From grade 7 to grade 9</option>
                                    <option value="12">From grade 10 to grade 12</option>
                                </select>
                                
                                @error('class_group') <span style="color:red;">{{ $message }}</span> @enderror
                                
                            </div>
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="isClassClose()" type="button" class="inline-block btn-mute mr-2" >Close</button>
                            <button type="submit" class="inline-block btn-primary edit-button" wire:click="leadhistorycommentstore">Submit</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': isClassOpen() }"
            class="z-40 fixed top-0 left-0 bottom-0 right-0 bg-black opacity-0 transition-opacity duration-200 linear">
        </div>
    </div>
<!-- Edit user model end here  -->

</div>
<script>


        // pop model open & close for lead history
    function classModal() {

        return {
            classState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            classOpen() {
                this.classState = 'TRANSITION'
                setTimeout(() => { this.classState = 'OPEN' }, 50)
            },
            classClose() {
                this.classState = 'TRANSITION'
                setTimeout(() => { this.classState = 'CLOSED' }, 50)
            },
            isClassOpen() { return this.classState === 'OPEN' },
            isClassOpening() { return this.classState !== 'CLOSED' },
        }
    }
</script>

<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="course.isCourseOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': course.isCourseOpening(), 'opacity-100': course.isCourseOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': course.isCourseOpening(), 'mt-8': course.isCourseOpen() }"
                class="model-dialog max-w-md">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <h2 class="text-center text-xl text-gray-700 font-display font-light lg:text-center">Proceed to Payment</h2>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="course.courseClose()" wire:click="resetCourse()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- form section start here -->
                    <div class="p-5">
                        {{-- we redirect this page to paytm payment gateway for payment process  --}}
                        <form action="{{ route('paytm.payment') }}" method="post">
                            @csrf
                            <input type="hidden" name="cousePaymentId" value="{{$cousePaymentId}}">

                            <div class="w-full my-2">
                                <input type="text" class="form-input" name="name" placeholder="Full Name" wire:model="studentName" value="{{ old('name',$studentName) }}" required>
                                @error('studentName') <span class="text-danger">{{ $message }}</span> @enderror
                                
                            </div>
                            <div class="w-full my-2">
                                <input type="text" class="form-input" name="email" required wire:model="email" placeholder="Email Address" value="{{ old('email',$email) }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                
                            </div>
                            <div class="w-full my-2">
                                <input type="text" class="form-input" placeholder="Mobile Number"  wire:model="mobile" name="mobile" value="{{old('mobile',$mobile)}}" required>
                                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                
                            </div>
                            
                            <div class="w-full my-2">
                                <input type="text" name="course" class="form-input cursor-not-allowed" wire:model="parentCourseName" disabled>
                            </div>
                            
                            <div class="w-full my-2">
                                <input type="text" name="course" class="form-input cursor-not-allowed" wire:model="childCourseName" disabled>
                            </div>

                            <div class="w-full my-2">
                                <input type="text" class="form-input cursor-not-allowed" placeholder="Course Duration" wire:model="duration" readonly disabled>
                            </div>

                            <div class="w-full my-2">
                                <input type="text" class="form-input cursor-not-allowed" placeholder="Price" wire:model="price" readonly disabled>
                            </div>
                            <div class="py-4 w-full">
                                <button type="submit" class="btn-primary p-2 w-full rounded tracking-wide
                                font-medium font-display 
                                shadow-lg">
                                    Pay Now
                                </button>
                            </div>
                        </form>
                        
                        <div class="mt-2 text-sm font-display flex justify-between items-center px-8">
                            <img src="{{asset('payment/MasterCard.png')}}" alt="" class="w-14">
                            <img src="{{asset('payment/Visa.png')}}" alt="" class="w-14">
                            <img src="{{asset('payment/Paytm.png')}}" alt="" class="w-14">
                            <img src="{{asset('payment/UPI.png')}}" alt="" class="w-14">
                        </div>
                    </div>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': course.isCourseOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function courseModal() {
        
        return {
            courseState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            courseOpen() {
                this.courseState = 'TRANSITION'
                setTimeout(() => { this.courseState = 'OPEN' }, 50)
            },
            courseClose() {
                this.courseState = 'TRANSITION';
                setTimeout(() => { this.courseState = 'CLOSED' }, 300)
            },
            isCourseOpen() { return this.courseState === 'OPEN' },
            isCourseOpening() { return this.courseState !== 'CLOSED' },
        }
    }
</script>
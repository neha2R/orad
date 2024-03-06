<div id="root">
    @if ($loader)
    <div class="loader">
      <img src="{{ asset('images/icons/Spinner.gif') }}" alt="loader" class="w-20 margin-top-20 mx-auto">
    </div>
    @endif

    <div class="lg:flex gap-5 px-8 md:px-12 md:px-18 pt-2 antialiased my-auto mt-4 md:mt-12 ">
        <div class="flex lg:w-1/2 ">
            <div class="container my-auto">
                <div class="font-normal text-sm text-gray-500 text-center">
                    <a href="{{ route('home') }}" class="p-2 mr-4 inline-flex items-center lg:-mt-6">
                        <img loading="lazy"  src="{{asset('payment/logo.png')}}" alt="orad" class="w-32 md:w-48">
                    </a>
                   <div class="pb-8 pt-5 leading-relax ">
                        <a class="courser-default scholarship-color focus:outline-none text-white rounded-full px-4 md:px-12 py-4">
                            <span class="text-md md:text-lg"> ORAD Little Champ Competition</span>
                        </a>
                    </div>
                    <p class="pb-5 leading-relax text-lg font-light text-center">
                        Registration is totally free
                    </p>
                    <div class="pb-5 leading-relax ">
                        <span class="date-color px-2 py-1 text-dark">
                            Date of Exam: 05 September 2021
                        </span>
                    </div>
                    <div class="leading-releax ">
                        <p>
                            Eligliblity Criteria- Std.: <span class="text-dark">3rd - 12th</span> <strong class="font-bold">|</strong> Deadline: <span class="text-dark">03 September 2021</span>
                        </p>

                    </div>
                </div>
                <div class="mt-2">
                    <img src="{{asset('images/png/Group-prize.png')}}" alt="img" class="w-auto mt-2 ">
                </div>
            </div>
        </div>
        <div class="lg:w-1/2 w-full">
            <div class="flex flex-col mt-5 md:mt-0 justify-between">
                <div class="container py-5 lg:py-0 md:px-12">
                    {{-- <h6 class="text-md text-center font-normal">ORAD's Scholarship Test 2021</h6> --}}
                    <div class="bg-white shadow-xl rounded-xl mt-4 mb-2">
                        <form class="px-5 md:py-1 py-4" method="POST" action="{{ route('storeScholarship') }}">
                            @csrf
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" wire:model.lazy="name"  class="form-input" placeholder="Full Name" name="name" value="{{old('name')}}" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                                
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" wire:model.debounce.500ms="email"  class="form-input" placeholder="Email Address" name="email" value="{{old('email')}}" required> 
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" wire:model.lazy="mobile"  class="form-input" placeholder="Phone Number" name="mobile" value="{{old('mobile')}}" required> 
                                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" wire:model.lazy="whatsapp"  class="form-input" placeholder="Whatsapp Number" name="whatsapp" value="{{old('whatsapp')}}" required> 
                                    @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            {{-- <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Father Name" name="father_name" value="{{old('father_name')}}" required> 
                                    @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Father occupation" name="father_occupation" value="{{old('father_occupation')}}" required> 
                                    @error('father_occupation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                             --}}
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Guardian Name" name="guardian_name" wire:model.lazy="guardian_name"  value="{{old('guardian_name')}}" required> 
                                    @error('guardian_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="Guardian occupation" name="guardian_occupation" wire:model.lazy="guardian_occupation"  value="{{old('guardian_occupation')}}" required> 
                                    @error('guardian_occupation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <input type="text" class="form-input" placeholder="School Name" name="school" value="{{old('school')}}" wire:model.lazy="school" required> 
                                    @error('school') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>
                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="class"  name="class">
                                        <option >Select Class</option>
                                        @foreach (classHelper() as $key => $item)
                                        <option value="{{ $key }}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-input" wire:model.lazy="class" placeholder="Class" name="class" value="{{old('class')}}" required>  --}}
                                    @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>	
                            </div>

                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="selectedState"  name="selectedState">
                                        <option >Select State</option>
                                        @foreach ($state as $item)
                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('selectedState') <span class="text-danger">{{ $message }}</span> @enderror
                                    
                                </div>	
                            </div>

                            <div class="mt-3">
                                <div class="flex flex-col w-full mb-4 relative">
                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="selectedCity" name="selectedCity">
                                        <option >Select City</option>
                                        @foreach ($city as $item)
                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedCity') <span class="text-danger">{{ $message }}</span> @enderror
                                    
                                </div>	
                            </div>
                            
                            
                            
                            <div class="mt-8">
                                <button class="btn-primary p-2 w-full rounded tracking-wide
                                font-medium font-display 
                                shadow-lg">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
     <script>
        Livewire.on('flashMessage', message => {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 1500
            });
        })
    </script>
</div>
   
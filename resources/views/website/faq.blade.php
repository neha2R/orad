<div>
  <div class="mb-10">
    <img loading="lazy"  src="{{asset('images/png/FAQBanner.jpg')}}" alt="">
  </div>

  <section class="space-y-4 mx-8 md:mx-32">
    @forelse ($faqsData as $item)
      <div class="flex flex-col mx-auto" x-data={show:false}>
        <div class="text-gray-500 border border-gray-400 rounded-md p-2">
          <div class="flex flex-row justify-between">
            <p @click="show=!show" type="button" class="hover:text-blue-500 cursor-pointer">
              {{$item->title}}
            </p>
            <div class="mr-4">
              <img loading="lazy"  x-show="!show" @click="show=!show" src="{{ asset('images/icons/UpArrow.svg') }}" class="h-5 w-5 cursor-pointer" alt="">
              <img loading="lazy"  x-show="show"  @click="show=!show" src="{{ asset('images/icons/DownArrow.svg') }}" class="h-5 w-5 cursor-pointer" alt="">
            </div>
          </div>
          <div x-show="show" 
          x-transition:enter="transition ease-out duration-500"
          x-transition:enter-start="opacity-0 transform scale-90"
          x-transition:enter-end="opacity-100 transform scale-100"
          x-transition:leave="transition ease-in duration-500"
          x-transition:leave-start="opacity-100 transform scale-100"
          x-transition:leave-end="opacity-0 transform scale-90"
          class=" col-span-2 w-full text-gray-500 mt-4 leading-relaxed">
            {!!$item->description !!}
          </div>
        </div>
      </div>   
    
    @empty
        <h4 class="text-normal text-2xl text-center">No record found...</h4>
    @endforelse
    @if (!$policyData->isEmpty())
      <h3 class="text-dark text-xl mb-2">Our Policies:- </h3>
    @endif
      @forelse ($policyData as $item)
      <div class="flex flex-col mx-auto" x-data={show:false}>
        <div class="text-gray-500 border border-gray-400 rounded-md p-2">
          <div class="flex flex-row justify-between">
            <p @click="show=!show" type="button" class="hover:text-blue-500 cursor-pointer">
              {{$item->title}}
            </p>
            <div class="mr-4">
              <img loading="lazy"  x-show="!show" @click="show=!show" src="{{ asset('images/icons/UpArrow.svg') }}" class="h-5 w-5 cursor-pointer" alt="">
              <img loading="lazy"  x-show="show"  @click="show=!show" src="{{ asset('images/icons/DownArrow.svg') }}" class="h-5 w-5 cursor-pointer" alt="">
            </div>
          </div>
          <div x-show="show" 
          x-transition:enter="transition ease-out duration-500"
          x-transition:enter-start="opacity-0 transform scale-90"
          x-transition:enter-end="opacity-100 transform scale-100"
          x-transition:leave="transition ease-in duration-500"
          x-transition:leave-start="opacity-100 transform scale-100"
          x-transition:leave-end="opacity-0 transform scale-90"
          class=" col-span-2 w-full text-gray-500 mt-4">
            {!! $item->description !!}
          </div>
        </div>
      </div>     
      @empty
          
      @endforelse 
  
  </section>

</div>
<section >
    <div class="flex w-full justify-between items-end py-2">
        <div>
            <h3 class="font-normal p my-3 text-xl">{{ucwords($username)}} Performance </h3>
        </div>
        <div >
            <label for="" class="block ">Select Performer</label>
            <select class="form-input cursor-pointer" wire:model="performerid">
                <option value="{{auth()->user()->id}}">My Performance</option>                    
                @foreach ($employees as $item)
                <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="flex w-full justify-between items-end py-3">
        <div>
            <select class="form-input" wire:model="currentMonth">
                @forelse ($interval as $key => $item)
                <option value="{{ date('Y-m', strtotime($item)) }}">{{ date('M Y', strtotime($item)) }}</option>
                @empty 
                <option disabled>no record found...</option>
                @endforelse
            </select>
        </div>
      

    </div>
        
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-cols-3 grid-col-1 ">
        <div  class="card-header shadow-md">
            <span class="card-title"> {{ $totalLead ?? '' }} </span>
            <p class="card-subtitle">Total Leads</p>
        </div>

        <div class="card-header shadow-md">
            <span class="card-title">  {{ $totalClasses ?? '' }}</span>
            <p class="card-subtitle">Total Class Monitored</p>
        </div>
  
        <div  class="card-header shadow-md">
            <div class="flex flex-col justify-between gap-y-8 h-full text-center">
                <h3 class="font-normal text-mute">Class Feedback</h3>
                <div>
                    <span class="font-bold text-mute text-lg text-center">{{ $feedback  }} / 5</span>
                    <div class="flex flex-rows justify-center text-xs">
                        @for ($i = 1; $i <= 5; $i++)
                        @php
                            $activeStars = $feedback >= $i ? 'starRating' : 'starRatingOutline';
                        @endphp
                        <img src='{{ asset("images/icons/$activeStars.svg") }}' alt="register-demo" class="w-8 ">
                        @endfor
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
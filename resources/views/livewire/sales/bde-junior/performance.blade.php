<section >
    <div class="flex flex-rows justify-between w-full pb-4">
        <div class="w-1/2">
            <p class="font-normal p my-3 text-xl"> My Performance </p>
        </div>
        <div class="w-1/5">
            <select name="" id="" class="form-input" wire:model="currentMonth">
                @forelse ($interval as $item)
                
                <option value="{{ date("Y-m",strtotime($item)) }}">{{date("M Y",strtotime($item))}}</option>
                @empty
                    <option>no record found...</option>
                @endforelse
            </select>
        </div>
    </div>
    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-cols-3 grid-col-1 ">

        <div class="card-header shadow-md">
            <div class="flex flex-col justify-between gap-y-8 h-full">
                <div class="flex flex-rows justify-between">
                    <span class="font-normal text-mute">Overall Conversion</span>
                    <span class="text-xl font-semibold inline-block text-dark">
                        {{$overallConversion}}%
                    </span>
                </div>

                <div class="relative ">
                    <div class="flex flex-col">
                        <span class="text-xs text-mute">
                            Your Performance
                        </span>
                        <div class="flex flex-rows justify-between items-start">
                            <div class="overflow-hidden h-2 text-xs flex rounded bg-purple-200 w-4/5 mt-1">
                                <div style="width:{{$conversionRate}}%"
                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center  bg-danger">
                                </div>
                            </div>
                            <span class="text-xs ">{{$conversionRate}}%</span>
                        </div>
                    
                    </div>

                    <div class="flex flex-col">
                        <span class="text-xs text-mute">
                            Target Conversion Rate
                        </span>
                        <div class="flex flex-rows justify-between items-start">
                            <div class="overflow-hidden h-2 text-xs flex rounded bg-purple-200 w-4/5 mt-1">
                                <div style="width:{{$targetedConversionRate}}%"
                                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center  bg-success">
                                </div>
                            </div>
                            <span class="text-xs ">{{$targetedConversionRate}}%</span>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
  
        <div  class="card-header shadow-md">
            <span class="card-title"> {{ $totalLeads ?? '' }} </span>
            <p class="card-subtitle">Total Leads</p>
        </div>

        <div  class="card-header shadow-md">
            <span class="card-title"> {{ $convertedLeads ?? '' }} </span>
            <p class="card-subtitle">Converted Leads</p>
        </div>

    </div>
</section>
<style>
        body {
            background: white;
        }

        .steps {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding: 20px;
            margin: 0px;
            list-style: none;
            font-family: sans-serif;
            font-size: smaller;
        }

        .steps li {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
            padding: 0px 20px;
            position: relative;
        }

        .steps li div {
            position: relative;
            padding: 1px 0px;
            background: #e0e0e0;
            box-sizing: border-box;
            transform: scale(0.999999);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .steps li div span {
            display: block;
            transition: all 0.3s ease;
        }

        .steps li div span:nth-child(1) {
            position: absolute;
            left: 100%;
            top: 0px;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 20px solid #e0e0e0;
        }

        .steps li div span:nth-child(2) {
            position: absolute;
            right: 100%;
            top: 0px;
            border-bottom: 20px solid transparent;
            border-right: 20px solid #e0e0e0;
        }

        .steps li div span:nth-child(3) {
            position: absolute;
            right: 100%;
            bottom: 0px;
            border-top: 20px solid transparent;
            border-right: 20px solid #e0e0e0;
        }

        .steps li div span:nth-child(4) {
            position: absolute;
            right: 10px;
            top: 50%;
            height: 12px;
            width: 12px;
            margin-top: -6px;
            border-radius: 100%;
            background: transparent;
            z-index: 2;
            border: 1px solid #e0e0e0;
        }

        .steps li div span:nth-child(5) {
            position: absolute;
            left: 100%;
            top: 1px;
            border-top: 19px solid transparent;
            border-bottom: 19px solid transparent;
            border-left: 19px solid #e0e0e0;
        }

        .steps li div span:nth-child(6) {
            position: absolute;
            right: 100%;
            top: 1px;
            border-bottom: 19px solid transparent;
            border-right: 19px solid #e0e0e0;
            margin-right: -1px;
        }

        .steps li div span:nth-child(7) {
            position: absolute;
            right: 100%;
            bottom: 1px;
            border-top: 19px solid transparent;
            border-right: 19px solid #e0e0e0;
            margin-right: -1px;
        }

        .steps li div span:nth-child(8) {
            display: block;
            padding: 0px 10px;
            position: relative;
            height: 38px;
            line-height: 17px;
            background: #e0e0e0;
            color: black;
        }

        .steps li:hover div {
            background: #ddd;
        }

        .steps li:hover div span:nth-child(1) {
            border-left-color: #ddd;
        }

        .steps li:hover div span:nth-child(2),
        .steps li:hover div span:nth-child(3) {
            border-right-color: #ddd;
        }

        .steps li:hover div span:nth-child(4) {
            background: white;
            border-color: #ddd;
        }

        .steps li:hover div span:nth-child(5) {
            border-left-color: #ddd;
        }

        .steps li:hover div span:nth-child(6),
        .steps li:hover div span:nth-child(7) {
            border-right-color: #ddd;
        }

        .steps li:hover div span:nth-child(8) {
            background: #ddd;
            color: black;
        }

        .steps li.active div {
            background: #2fbe6e;
        }
        

        .steps li.active div span:nth-child(1) {
            border-left-color: #2fbe6e;
        }

        .steps li.active div span:nth-child(2),
        .steps li.active div span:nth-child(3) {
            border-right-color: #2fbe6e;
        }

        .steps li.active div span:nth-child(4) {
            background: white;
            border-color: #2fbe6e;
        }

        .steps li.active div span:nth-child(5) {
            border-left-color: #2fbe6e;
        }

        .steps li.active div span:nth-child(6),
        .steps li.active div span:nth-child(7) {
            border-right-color: #2fbe6e;
        }

        .steps li.active div span:nth-child(8) {
            background: #2fbe6e;
            color: white;
        }



        .steps li.done div {
            background: #ebe416;
        }
        

        .steps li.done div span:nth-child(1) {
            border-left-color: #ebe416;
        }

        .steps li.done div span:nth-child(2),
        .steps li.done div span:nth-child(3) {
            border-right-color: #ebe416;
        }

        .steps li.done div span:nth-child(4) {
            background: white;
            border-color: #ebe416;
        }

        .steps li.done div span:nth-child(5) {
            border-left-color: #ebe416;
        }

        .steps li.done div span:nth-child(6),
        .steps li.done div span:nth-child(7) {
            border-right-color: #ebe416;
        }

        .steps li.done div span:nth-child(8) {
            background: #ebe416;
            color: white;
        }


        

        .steps li:first-child {
            padding-left: 0px;
        }

        .steps li:first-child div {
            padding-left: 1px;
        }

        .steps li:first-child div span:nth-child(2),
        .steps li:first-child div span:nth-child(3),
        .steps li:first-child div span:nth-child(6),
        .steps li:first-child div span:nth-child(7) {
            display: none;
        }

        .steps li:last-child {
            padding-right: 0px;
        }

        .steps li:last-child div {
            padding-right: 1px;
        }

        .steps li:last-child div span:nth-child(1),
        .steps li:last-child div span:nth-child(5) {
            display: none;
        }

    </style>
    <div class="card">
        <div class="card-header">

            <h4> Current Month : {{$currentMonth ?? ''}} - {{$currentYear ?? ''}} </h4>
            <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">Current Sale of month</p>
                                <h4 class="m-b-0">{{$currentearning ?? ''}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-user f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">Current incentive</p>
                                <h4 class="m-b-0">{{$currentincentive ?? ''}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-user f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <form wire:submit.prevent="filter">
            <label class="col-form-label">Monthly Filter</label>
            <select  class="form-control" wire:model="datetimefilter">
                <option value="">Select One Value Only
                </option>
                @foreach ($period as $item)
                <option value="{{$item->format("n-Y") ?? ''}}">{{$item->format("m-Y") ?? ''}}</option>
                @endforeach  
            </select>
            <button class="btn btn-primary m-10" type="submit" >Filter</button>
            </form>
            
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Milestone and achievements</h3>
            <h5>Current Month Contribution : Rs {{$currentearning ?? ''}}</h5>
            <h5>Current Month Incentive : Rs {{$currentincentive ?? ''}}</h5>
        </div>
        <div class="card-body">
            <ul class="steps">
                @foreach ($data as $item)
                @if($currentearning > $item->to)
                <li class="done">  
                @else
                @if($currentearning >= $item->from && $currentearning <= $item->to)
                    <li class="active" >
                @else
                        <li>
                @endif
                @endif
                        <div>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            @if ($loop->last)
                                <span>Rs {{ $item->from ?? '' }} or More<br>Incentive-{{ $item->incentivepercentage }}%</span>
                            @else
                                <span>Rs {{ $item->from ?? '' }} - Rs
                                    {{ $item->to ?? '' }}<br>Incentive-{{ $item->incentivepercentage }}%</span>
                            @endif
        
                        </div>
                    </li>
                @endforeach
        
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3>Perks</h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-xl-4">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                            <span class="text-c-blue f-w-600">First 7 Days target monthly</span>
                            <h4>50k>more</h4>
                            <div>
                                <span class="f-left m-t-10 text-muted">
                                    <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>
                                    Perk: 1 day salary
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="feather icon-pie-chart bg-c-pink card1-icon"></i>
                            <span class="text-c-pink f-w-600">15 Days target monthly</span>
                            <h4>17k/25k</h4>
                            <div>
                                <span class="f-left m-t-10 text-muted">
                                    <i class="text-c-pink f-16 feather icon-alert-triangle m-r-10"></i>
                                    Perk: 25k sale
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="feather icon-pie-chart bg-c-green card1-icon"></i>
                            <span class="text-c-green f-w-600">28 Days target monthly</span>
                            <h4>17k/80k</h4>
                            <div>
                                <span class="f-left m-t-10 text-muted">
                                    <i class="text-c-green f-16 feather icon-alert-triangle m-r-10"></i>
                                    Perk: 80k sale
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
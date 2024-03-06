<div>
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
<div class="modal fade" wire:ignore.self id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Daily Work</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="date" wire:model="dateforthedailywork" class="form-control">
         <button class="btn btn-primary m-10" wire:click="datefilterleads" >Filter</button>
         <div class="row">
            <div class="col-md-12">
                <h2>Follow Up for today</h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Type</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($leadsforselectedfollowup as $key => $item)
                            
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ optional($item->userRelation)->name ?? '' }}</td>
                                <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                <td>{{ optional($item->userRelation)->mobilecode ?? '' }} {{ optional($item->userRelation)->mobile ?? '' }}</td>
                                <td>{{ leadtype()[optional($item->userRelation)->leadtype] ?? ''}}</td>
                                
                            </tr>
                                
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-12">
            <h2>Lead Status</h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Type</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($leadsforselectedjunior as $key => $item)
                            
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ optional($item->userRelation)->name ?? '' }}</td>
                                <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                <td>{{ optional($item->userRelation)->mobilecode ?? '' }} {{ optional($item->userRelation)->mobile ?? '' }}</td>
                                <td>{{ leadtype()[optional($item->userRelation)->leadtype] ?? ''}}</td>
                                
                            </tr>
                                
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
     <div class="card">
        <div class="card-header">
            <h4> Now Showing Report For : {{$currentdatemonth ?? ''}}</h4>
            <label class="col-form-label">Monthly Filter</label>
            <select wire:model="currentdatemonth" class="form-control">
                <option value="">Select One Value Only
                </option>
                @foreach ($period as $item)
                <option value="{{$item->format("n-Y") ?? ''}}">{{$item->format("m-Y") ?? ''}}</option>
                @endforeach  
            </select>
            <button class="btn btn-primary m-10" wire:click="filterdata">Filter</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Milestone and achievements</h3>
            <h5>Selected Month Contribution : Rs {{$currentearning ?? ''}}</h5>
            <h5>Selected Month Incentive : Rs {{$currentincentive ?? ''}}</h5>
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
    
        <div class="card-header">
            <h3>Juniors</h3>
        </div>
        <div class="card-body">
    
            <div class="card-block table-border-style">
    
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>View Profile</th>
                                        <th>today's work</th>
    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userdata as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name ?? '' }}</td>
                                        <td>{{ $item->email ?? '' }}</td>
                                        <td>{{ $item->mobilecode ?? '' }} {{ $item->mobile ?? '' }}</td>
                                        <td><a href="{{route('sales.juniorreportatglance',['id'=>$item->id])}}" target="_blank">View Profile</a> </td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" wire:click="selectjuniorfor('{{$item->id}}')">See Daily Work</button></td>
                                    </tr>
                                       
                                    @endforeach
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
                {{-- <div class="py-3" style="float: right;">{{ $data->links() }}</div> --}}
            </div>
        </div>
    </div>
</div>

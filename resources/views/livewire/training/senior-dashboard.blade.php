<div>
    @include('includes.leadhistory')
    <div class="row">
        <div class="col-xl-6 col-md-6" wire:click="statusswitchhandel(0)">
            <div class="text-white card bg-c-yellow makepointer  
            @if($statsstatusswitch ==0)
            active-border
            @endif
            ">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Un Assigned</p>
                            <h4 class="m-b-0">{{$unassignedleads ?? ''}}</h4>
                        </div>
                        <div class="col-auto text-right col">
                            <i class="feather icon-user f-50 text-c-yellow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6" wire:click="statusswitchhandel(1)">
            <div class="text-white card bg-c-green makepointer 
            @if($statsstatusswitch ==1)
            active-border
            
            @endif">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Assigned</p>
                            <h4 class="m-b-0">{{$assignedleads ?? ''}}</h4>
                        </div>
                        <div class="col-auto text-right col">
                            <i class="feather icon-credit-card f-50 text-c-green"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6" wire:click="statusswitchhandel(2)">
            <div class="text-white card bg-c-green makepointer 
            @if($statsstatusswitch==2)
            active-border
            @else
            
            @endif">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Converted</p>
                            <h4 class="m-b-0">{{$paidleads ?? ''}}</h4>
                        </div>
                        <div class="col-auto text-right col">
                            <i class="feather icon-credit-card f-50 text-c-green"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @switch($statsstatusswitch)
            @case(0)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="margin-top: 20px;" class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <input type="text" placeholder="Search" wire:model.debounce.500ms="search"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Update</th>
                                        <th>Time in System</th>
                                        <th>Assign</th>
                                        <th>Lead Track</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $item)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{optional($item->userRelation)->name ?? ''}}</td>
                                        <td>{{optional($item->userRelation)->email ?? ''}}</td>
                                        <td>{{optional($item->userRelation)->mobilecode ?? ''}}{{optional($item->userRelation)->mobile ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect"
                                                data-toggle="modal" data-target="#updatelead"
                                                wire:click="edit({{ optional($item->userRelation)->id }})">Update</button>
                                        </td>
                                        <td>
                                            {{$item->created_at->diffForHumans() ?? ''}}
                                        </td>
                                        <td>
                                           
                                            <button wire:click="assign({{$item->id}},{{$item->demoid}})" class="btn btn-primary">assign</button>
                                        </td>
                                        <td>
                                            <button type="button" class="{{demoHelperColor($item->id)}}" data-toggle="modal"
                                            data-target="#leadhistory"
                                            wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})">Lead History</button>
                                        </td>
                                    </tr>
                                    @empty
                                        <th>
                                            <td colspan="6" style="text-align:center">No Record Found</td>
                                        </th>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="py-3" style="float: right;">{{$data->links()}}</div>
                    </div>
                </div>
            </div>
                @break
            @case(1)
            <div class="col-md-12">
                <form wire:submit.prevent="store" method="POST">
                    <div class="card">
                        <div class="card-header">
                            <div style="margin-top: 20px;" class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Search" wire:model.debounce.500ms="search"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Update</th>
                                            <th>Created At</th>
                                            <th>Assigned To</th>
                                            <!-- <th>Demo Status</th> -->
                                            <th>Trainer Feedback</th>
                                            <th>Student Feedback</th>
                                            <th>Lead Track</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $item )
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>
                                                {{optional($item->userRelation)->name ?? ''}}
                                                
                                            <td>{{optional($item->userRelation)->email ?? ''}}</td>
                                            <td>{{optional($item->userRelation)->mobilecode ?? ''}}{{optional($item->userRelation)->mobile ?? ''}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect"
                                                    data-toggle="modal" data-target="#updatelead"
                                                    wire:click="edit({{ optional($item->userRelation)->id }})">Update</button>
                                            </td>
                                            <td>
                                                {{$item->created_at->diffForHumans() ?? ''}}
                                            </td>
                                            <td>
                                                {{$item->demoStatus->trainerRelation->name ?? ''}}
                                            </td>
                                           
                                              <td>{!!feedBackHelpers(optional($item->demoStatus)->id,1)!!}</td>
                                              <td>{!!feedBackHelpers(optional($item->demoStatus)->id,0)!!}</td>
                                              <td>
                                                <button type="button" class="{{demoHelperColor($item->id)}}" data-toggle="modal"
                                                data-target="#leadhistory"
                                                wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})">Lead History</button>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr >
                                                <td colspan="10" style="text-align: center">No Data Found</td>
                                            </tr>
                                        @endforelse
                                      
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-3" style="float: right;">{{$data->links()}}</div>
                        </div>
                    </div>
        
                </form>
            </div>
                @break
            @case(2)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="margin-top: 20px;" class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <input type="text" placeholder="Search" wire:model.debounce.500ms="search"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Class Report</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $item)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{optional($item->userRelation)->name ?? ''}}</td>
                                        <td>{{optional($item->userRelation)->email ?? ''}}</td>
                                        <td>{{optional($item->userRelation)->mobilecode ?? ''}}{{optional($item->userRelation)->mobile ?? ''}}</td>
                                        <td>
                                            <span>Converted</span>
                                        </td>
                                      <td>
                                          <a href="{{route('training.createclass',['id'=>$item->leadid])}}" class="btn btn-primary">Manage Class</a>
                                      </td>
    
                                    </tr>
                                    @empty
                                        <th>
                                            <td colspan="6" style="text-align:center">No Record Found</td>
                                        </th>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="py-3" style="float: right;">{{$data->links()}}</div>
                    </div>
                </div>
            </div>
            @break
            @default
                
        @endswitch
    </div>

    {{-- assign modal --}}
    <div wire:ignore.self class="modal fade " id="assignleadtojunior" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Lead to Junior Trainer Executive </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if($reassignstatus)
                <form wire:submit.prevent="reupdate" method="POST">
                    @else
                    <form wire:submit.prevent="update" method="POST">
                @endif
                
                    @csrf
                    <div class="modal-body">
                        <h5 class="text-info" style="margin-top: 20px">Preferred Demo Date and Slot of the Lead</h5>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Date :</div>
                            <div class="col-md-4">
                                <input type="date" wire:model.defer="date"
                                    class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }} input-opacity" >
                                @error('date') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2">Time Slot :</div>
                            <div class="col-md-4">
                                <select wire:model.defer="slot" id="slot"
                                    class="form-control {{ $errors->first('slot') ? ' form-control-danger' : '' }} input-opacity" >
                                    <option value="">--Select--</option>
                                    @foreach ($slots as $key => $item)
                                    <option value="{{$item->id}}">{{$item->from}} - {{$item->to}}</option>
                                    @endforeach
                                </select>
                                @error('slot') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <h5 class="text-info" style="margin-top: 20px">Assign Lead to the Trainer</h5>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Assign to :</div>
                            <div class="col-md-5">
                                <select wire:model.defer="assignto" id="growth"
                                    class="form-control {{ $errors->first('assignto') ? ' form-control-danger' : '' }}">
                                    <option value="">--Select--</option>
                                    {{-- {{dump($trainers)}} --}}
                                    @foreach ($trainers as $item)
                                    <option value="{{$item->id}}">{{$item->name}} (Assigned
                                        leads-{{$item->assignedusers_count}})</option>
                                    @endforeach
                                </select>
                                @error('assignto') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade " id="updatelead" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Lead Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @include('includes.leadform',['method'=>'updateLead','createleads'=>0,'readonly'=>0,'activelang'=>0])
            </div>
        </div>
    </div>
    <script>
        Livewire.on('showmodal', message => {
            $('#assignleadtojunior').modal('show');
        })
        Livewire.on('flashmessage', message => {
            $('#assignleadtojunior').modal('hide');
            $('#updatelead').modal('hide');
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

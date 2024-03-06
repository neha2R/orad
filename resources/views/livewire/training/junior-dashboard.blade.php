<div>
    @include('includes.leadhistory')
    @include('includes.demoreassgin',['slots'=>$slots,'seniortrainers'=>$seniortrainers])
    <div class="row">
        <div class="col-xl-6 col-md-6" wire:click="statsswitchHandel(0)">
            <div class="text-white card bg-c-yellow makepointer  
            @if($statsswitch == 0)
            active-border
            @endif ">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Demo Pending </p>
                            <h4 class="m-b-0">{{$demopending ?? ''}}</h4>
                        </div>
                        <div class="col-auto text-right col">
                            <i class="feather icon-user f-50 text-c-yellow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6" wire:click="statsswitchHandel(1)">
            <div class="text-white card bg-c-blue makepointer
            @if($statsswitch == 1)
             active-border
            @endif
            ">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Demo Done</p>
                            <h4 class="m-b-0">{{$demodone ?? ''}}</h4>
                        </div>
                        <div class="col-auto text-right col">
                            <i class="feather icon-credit-card f-50 text-c-blue"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6" wire:click="statsswitchHandel(2)">
            <div class="text-white card bg-c-green makepointer
            @if($statsswitch == 2)
             active-border
            @endif
            ">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Converted Demo</p>
                            <h4 class="m-b-0">{{$converteddemo ?? ''}}</h4>
                        </div>
                        <div class="col-auto text-right col">
                            <i class="feather icon-credit-card f-50 text-c-green"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($demostatus)
  
    @else
   
    @endif

    @switch($statsswitch)
        @case(0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="margin-top: 20px;" class="row">
                            <div class="col-md-9"><h3>Showing Result For Done Pending</h3></div>
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
                                        <th>Lead Details</th>
                                        <th>Time in System</th>
                                        <th>Date</th>
                                        <th>Time Slot</th>
                                        <th>Join Link</th>
                                        <th>Feedback</th>
                                        <th>Lead Track</th>
                                        <th>Re Assign</th>
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
                                            {{$item->demoRelation->date ?? ''}}
                                        </td>
                                        <td>
                                            {{$item->demoRelation->slotRelation->from ?? ''}}-
                                            {{$item->demoRelation->slotRelation->to ?? ''}}
                                        </td>
                                        <td>
                                            {{-- {{dd($item->demo)}} --}}
                                            @if(optional($item->demoRelation)->demolink)
                                               {{optional($item->demoRelation)->demolink ?? ''}}
                                               <input type="text" wire:model="demolink.{{$key}}"  class="form form-control"  /> 
                                            <button class="btn btn-primary" wire:click="demoschdule({{$item->demoid}})" style="margin:3px" >Join Link</button>
                                            @else
                                            <input type="text" wire:model="demolink.{{$key}}"  class="form form-control"  /> 
                                            <button class="btn btn-primary" wire:click="demoschdule({{$item->demoid}})" style="margin:3px" >Join Link</button>
                                            @endif
                                        </td>
                                        <td>
                                            @if (optional($item->demoRelation)->feedback)
                                            <span>Feedback Given Thankyou</span>   
                                            @else
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click="feedbackshow({{$item->id}},{{optional($item->demoRelation)->id}},{{$item->leadid}})">
                                                Feedback
                                            </button>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="{{demoHelperColor($item->id)}})" data-toggle="modal"
                                            data-target="#leadhistory"
                                            wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})">Lead History</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect"
                                                                data-toggle="modal" data-target="#reassignlead"
                                                                wire:click="editassign({{ $item->demoid }})">Reschedule</button>
                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr ><td colspan="12" style="text-align: center">No Records Found</td> </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="py-3" style="float: right;">{{$data->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
        
            @break
        @case(1)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="margin-top: 20px;" class="row">
                            <div class="col-md-9"><h3>Showing Result For Done Demos</h3></div>
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
                                        <th>Lead Track</th>
                                       <th>Lead Conversion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $item)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{optional($item->userRelation)->name ?? ''}}</td>
                                        <td>{{optional($item->userRelation)->email ?? ''}}</td>
                                        <td>{{optional($item->userRelation)->mobilecode ?? ''}}{{optional($item->userRelation)->mobile ?? ''}}</td>
                                        <td><span class="badge badge-success" style="font-size: 15px">Demo Completed</span></td>
                                        <td>
                                            <button type="button" class="{{demoHelperColor($item->id)}}" data-toggle="modal"
                                            data-target="#leadhistory"
                                            wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})">Lead History</button>
                                        </td>
                                        <td>
                                            @if($item->follow_up != null)
                                            <span class="badge badge-success blink" style="font-size: 14px;">{{$item->follow_up ?? ''}}</span>    
                                               @else 
                                               @if($item->is_paid)
                                               <span class="badge badge-success " style="font-size: 14px;">Converted</span>    
                                                   @else
                                                <span class="badge badge-danger " style="font-size: 14px;">Not Converted</span>    
                                               @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr ><td colspan="6" style="text-align: center">No Records Found</td> </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="py-3" style="float: right;">{{$data->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
        @break
        @case(2)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="margin-top: 20px;" class="row">
                            <div class="col-md-9"><h3>Showing Result For Converted Leads</h3></div>
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
                                        <th>Lead Details</th>
                                        <th>Lead Track</th>
                                        {{-- <th>Class Report</th> --}}
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
                                        <label class="label label-info">Converted Leads</label>
                                        </td>
                                        <td>
                                            <button type="button" class="{{demoHelperColor($item->id)}}" data-toggle="modal"
                                            data-target="#leadhistory"
                                            wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})">Lead History</button>
                                        </td>
                                        <td>
                                            {{-- <a href="{{route('training.classes',['id'=>$item->leadid])}}">View Class</a> --}}
                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr ><td colspan="12" style="text-align: center">No Records Found</td> </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="py-3" style="float: right;">{{$data->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
            @break
        @default
            
    @endswitch
    <div wire:ignore.self class="modal fade " id="updatelead" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Lead Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @include('includes.leadform',['method'=>'update','createleads'=>0,'readonly'=>1,'activelang'=>0])
            </div>
        </div>
        </div>
    <div  wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Demo Feedback</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Demo Done</label>
                        <div class="col-sm-10">
                            <select wire:model="demo_taken" id="department"
                                class="form-control {{ $errors->first('demo_taken') ? ' form-control-danger' : '' }}">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @error('demo_taken') <span style="color:red">{{ $message }}</span>
                            @enderror
    
                        </div>
                      
                    </div>

                    @if($demo_taken)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Comment</label>
                        {{-- {{$name}} --}}
                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control {{ $errors->first('comment') ? ' form-control-danger' : '' }}"
                                wire:model="comment">
                            @error('comment') <span style="color:red">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Behaviour</label>
                        {{-- {{$name}} --}}
                        <div class="col-sm-10">
                            <select wire:model="behaviour" id="department"
                                class="form-control {{ $errors->first('countrycode') ? ' form-control-danger' : '' }}">
                                <option value="">--Select--</option>
                                @foreach (behaviourCode() as $key => $item)
                                    <option value="{{$item}}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('behaviour') <span style="color:red">{{ $message }}</span>
                            @enderror
    
                        </div>
                      
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Interested</label>
                       
                        <div class="col-sm-10">
                            <select wire:model="interested" id="department"
                                class="form-control {{ $errors->first('interested') ? ' form-control-danger' : '' }}">
                                <option value="">--Select--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            @error('interested') <span style="color:red">{{ $message }}</span>
                            @enderror
    
                        </div>
                      
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Interested in Course</label>
                       
                        <div class="col-sm-10">
                            <select name="courseselected" id="cars" class="form-control" wire:model="selectedcourse">
                                @foreach (courseHelper() as $item)
                                    <optgroup label="{{ $item->name ?? '' }}">
                                        <option value="">Please-select-course</option>
                                        @foreach ($item->coursetype as $course)
                                            <option value="{{$item->name}}-{{ $course->name ?? 0 }}">{{ $course->name ?? '' }}
                                                Rs{{ $course->price ?? '' }}</option>
                                        @endforeach
    
                                    </optgroup>
                                @endforeach
                                @error('selectedcourse') <span style="color:red">{{ $message }}</span>
                                @enderror
    
                            </select>
    
                        </div>
                      
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Decison Maker Name</label>
                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control {{ $errors->first('fathername') ? ' form-control-danger' : '' }}"
                                wire:model="fathername">
                            @error('fathername') <span style="color:red">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Father Occupation</label>
                       
                        <div class="col-sm-10">
                            <select wire:model="fatheroccupation" id="department"
                                class="form-control {{ $errors->first('fatheroccupation') ? ' form-control-danger' : '' }}">
                                <option value="">--Select--</option>
                                @foreach (fatheroccupationHelper() as $item)
                                <option value="{{$item ?? ''}}">{{$item ?? ''}}</option>
                                @endforeach
                                <input type="text"
                                class="form-control {{ $errors->first('fatheroccupation') ? ' form-control-danger' : '' }}"
                                wire:model="fatheroccupation">
                            </select>
                            @error('fatheroccupation') <span style="color:red">{{ $message }}</span>
                            @enderror
    
                        </div>
                      
                    </div>
                    @else   
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Drop Down Reasong</label>
                       
                        <div class="col-sm-10">
                            <select wire:model="dropreason" id="department"
                                class="form-control {{ $errors->first('dropreason') ? ' form-control-danger' : '' }}">
                                <option value="">--Select--</option>
                                @foreach (dropreasonHelper() as $item)
                                <option value="{{$item ?? ''}}">{{$item ?? ''}}</option>
                                @endforeach
                                <input type="text"
                                class="form-control {{ $errors->first('dropreason') ? ' form-control-danger' : '' }}"
                                wire:model="dropreason">
                            </select>
                            @error('dropreason') <span style="color:red">{{ $message }}</span>
                            @enderror
    
                        </div>
                      
                    </div>
                    @endif
                    
                </div>
            
           
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
          </div>
        </div>
      </div>
      <script>
           Livewire.on('flashmessage', message => {
            $('#exampleModal').modal('hide');
            $('#reassignlead').modal('hide');
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
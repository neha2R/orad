<div>
    @include('includes.leadhistory')

    <div class="row">

        <div class="col-xl-3 col-md-3" wire:click="leadstatusstatsactive(0)">
            <div class="card bg-c-pink text-white makepointer
                    @if ($assignedtable==0) active-border @else @endif ">
                <div class=" card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Unassigned</p>
                        <h4 class="m-b-0">{{ $unassigned ?? '' }}</h4>
                    </div>
                    <div class="col-auto text-right col">
                        <i class="feather icon-credit-card f-50 text-c-pink"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3" wire:click="leadstatusstatsactive(1)">
        <div class="text-white card bg-c-yellow makepointer  
            @if ($assignedtable==1) active-border 
                                @else @endif ">
                <div class=" card-block">
            <div class="row align-items-center">
                <div class="col">
                    <p class="m-b-5">Assigned</p>
                   
                    <h4 class="m-b-0">{{ $assigned ?? '' }}</h4>
                </div>
                <div class="col-auto text-right col">
                    <i class="feather icon-credit-card f-50 text-c-yellow"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-3" wire:click="leadstatusstatsactive(2)">
    <div class="text-white card bg-c-green makepointer  
            @if ($assignedtable==2) active-border 
    @else @endif ">
                <div class=" card-block">
        <div class="row align-items-center">
            <div class="col">
                <p class="m-b-5">Converted Leads</p>
                <h4 class="m-b-0">{{ $convertedleads ?? '' }}</h4>
            </div>
            <div class="col-auto text-right col">
                <i class="feather icon-credit-card f-50 text-c-green"></i>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-xl-3 col-md-3" wire:click="leadstatusstatsactive(3)">
    <div class="text-white card bg-c-blue makepointer  
            @if ($assignedtable==3) active-border 
    @else @endif ">
                <div class=" card-block">
        <div class="row align-items-center">
            <div class="col">
                <p class="m-b-5">Followup Leads</p>
                <h4 class="m-b-0">{{ $followupleadstats ?? '' }}</h4>
            </div>
            <div class="col-auto text-right col">
                <i class="feather icon-credit-card f-50 text-c-blue"></i>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Leads For Assignment</h3>
                <div style="margin-top: 20px;" class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <input type="text" placeholder="Search" wire:model.debounce.500ms="search" class="form-control">
                    </div>
                </div>
            </div>
            
            @switch($assignedtable)
                @case(1)
                
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Time in System</th>
                                        <th>Assigned To</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Send Payment Link</th>
                                        <th>Update</th>
                                        <th>Reschedule</th>
                                        <th>Followup</th>
                                        <th>Trainer Feedback</th>
                                        <th>Client Feedback</th>
                                        <th>Lead Track</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($data)}} --}}
                                    @forelse ( $data as $key => $item )
                                        {{-- {{dd(auth()->user()->id)}} --}}
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ optional($item->userRelation)->name ?? '' }}</td>
                                            <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                            <td>{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? '' }}
                                            </td>
                                            <td>
                                                {{$item->created_at->isToday() ? 'Today' : dateformat($item->created_at) }}
                                            </td>
                                            <td>
                                                {{-- {{dd(optional($item->userRelation)->seniorTrainerRelation->)}} --}}
                                                {{ userHelper($item) }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect"
                                                    data-toggle="modal" data-target="#sendpaymentlink"
                                                    wire:click="paymentselecteduser({{ $item->id }})">Send
                                                    Payment
                                                    Link</button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect"
                                                    data-toggle="modal" data-target="#updatelead"
                                                    wire:click="edit({{ optional($item->userRelation)->id }})">
                                                    @switch(optional($item->userRelation)->leadtype)
                                               
                                               @case(1)
                                                   Marked as Not Called Yet
                                                   @break

                                               @case(2)
                                               Marked as Cold
                                                   @break
                                               @case(3)
                                               Marked as Warm
                                                   @break
                                               @case(4)
                                               Marked as  Hot
                                               @break
                                               @default
                                                   Update 
                                           @endswitch
                                                </button>
                                            </td>


                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect"
                                                    data-toggle="modal" data-target="#reassignlead"
                                                    wire:click="editassign({{ $item->demoid }})">Reschedule</button>

                                            </td>
                                            <td>
                                                @if ($item->is_paid)
                                                    <label class="label label-success">Lead Paid</label>
                                                @else
                                                    @if (optional($item->demoStatus)->is_demodone)
                                                        @if ($item->is_rescheduled)
                                                            N/A
                                                        @else
                                                            <button type="button" class="btn btn-primary waves-effect"
                                                                data-toggle="modal" data-target="#followup"
                                                                wire:click="followupselectedlead({{ $item->id }})">Follow
                                                                up</button>
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{!! feedBackHelpers(optional($item->demoStatus)->id, 1) !!}</td>
                                            <td>{!! feedBackHelpers(optional($item->demoStatus)->id, 0) !!}</td>
                                            <td>
                                                <button type="button" class="{{demoHelperColor($item->id)}}"
                                                    data-toggle="modal" data-target="#leadhistory"
                                                    wire:click="getleadHistory({{ $item->leadid }},{{ $item->id }})">Lead
                                                    History</button>
                                            </td>
                                           
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" style="text-align: center">No Data Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <div class="py-3" style="float: right;">{{ $data->links() }}</div>
                    </div>
                @break
            @case(0)
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Assigned On</th>
                                    <th>Update</th>
                                    <th>Assign</th>
                                    <th>Lead Track</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $data as $key => $item )
                                
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ optional($item->userRelation)->name ?? '' }}</td>
                                        <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                        <td>{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? '' }}
                                        </td>

                                        <td>
                                            {{$item->created_at->isToday() ? 'Today' : dateformat($item->created_at) }}

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect"
                                                data-toggle="modal" data-target="#updatelead"
                                                wire:click="edit({{ optional($item->userRelation)->id }})">
                                                
                                                Update
                                                   
                                            
                                                </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary waves-effect"
                                                data-toggle="modal" data-target="#assignlead"
                                                wire:click="editassign({{ optional($item->userRelation)->id }})">Schedule
                                                demo class</button>
                                        </td>
                                        <td>
                                            <button type="button" class="{{demoHelperColor($item->id)}}"
                                                data-toggle="modal" data-target="#leadhistory"
                                                wire:click="getleadHistory({{ $item->leadid }},{{ $item->id }})">Lead
                                                History</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="text-align: center">No Data Found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="py-3" style="float: right;">{{ $data->links() }}</div>
                </div>
            @break
        @case(2)
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $data as $key => $item )
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ optional($item->userRelation)->name ?? '' }}</td>
                                    <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                    <td>{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? '' }}
                                    </td>
                                    <td>
                                        <label class="label label-info">Converted Leads</label>
                                    </td>
                                    <td>
                                        <button type="button" class="{{demoHelperColor($item->id)}}"
                                            data-toggle="modal" data-target="#leadhistory"
                                            wire:click="getleadHistory({{ $item->leadid }},{{ $item->id }})">Lead
                                            History</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center">No Data Found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="py-3" style="float: right;">{{ $data->links() }}</div>
            </div>
        @break
    @case(3)
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Follow Up Date</th>
                            <th>Make Lead Active</th>
                            <th>Lead Track</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $data as $key => $item )
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ optional($item->userRelation)->name ?? '' }}</td>
                                <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                <td>{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? '' }}
                                </td>
                                <td>
                                    {{-- <label class="label label-info">Converted Leads</label> --}}
                                    {{ $item->follow_up ?? '' }}
                                </td>
                                <td>
                                    <button wire:click="makeleadactivefromfollowup({{ $item->id }})"
                                        class="btn btn-primary">Make Lead Active</button>
                                </td>
                                <td>
                                    <button type="button" class="{{demoHelperColor($item->id)}}"
                                        data-toggle="modal" data-target="#leadhistory"
                                        wire:click="getleadHistory({{ $item->leadid }},{{ $item->id }})">Lead
                                        History</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center">No Data Found</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{ $data->links() }}</div>
        </div>
    @break
    @default

@endswitch

</div>
</div>
</div>

{{-- create modal --}}
<div wire:ignore.self class="modal fade " id="createlead" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">Generate Lead</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form wire:submit.prevent="store" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-2">Name :</div>
            <div class="col-md-4">
                <input type="text"
                    class="form-control {{ $errors->first('name') ? ' form-control-danger' : '' }}"
                    wire:model="name">
                @error('name') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Email :</div>
            <div class="col-md-4">
                <input type="text"
                    class="form-control {{ $errors->first('email') ? ' form-control-danger' : '' }}"
                    wire:model="email">
                @error('email') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">Contact :</div>
            <div class="col-md-3">
                <select wire:model="countrycode" id="department"
                    class="form-control {{ $errors->first('countrycode') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (countryCodes() as $key => $item)
                        <option value="+{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('countrycode') <span style="color:red">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <input type="text"
                    class="form-control {{ $errors->first('mobile') ? ' form-control-danger' : '' }}"
                    wire:model="mobile">
                @error('mobile') <span style="color:red">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">State :</div>
            <div class="col-md-4">
                <select wire:model="state" id="state"
                    class="form-control {{ $errors->first('state') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (indianStates() as $key => $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('state') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Reference :</div>
            <div class="col-md-4">
                <select wire:model="reference" id="reference"
                    class="form-control {{ $errors->first('reference') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (referencearray() as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('reference') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Growth :</div>
            <div class="col-md-4">
                <select wire:model.defer="growth" id="growth"
                    class="form-control {{ $errors->first('growth') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (growthOptions() as $key => $item)
                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('growth') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Edu Level :</div>
            <div class="col-md-4">
                <select wire:model.defer="edulevel" id="edulevel"
                    class="form-control {{ $errors->first('edulevel') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (edulevelOptions() as $key => $item)
                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('edulevel') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <h6 class="animate__animated animate__pulse animate__infinite text-info" style="
text-align: center;
padding-top: 10px;">Type language and press enter</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">Gender :</div>
            <div class="col-md-4">
                <select wire:model.defer="gender" id="gender"
                    class="form-control {{ $errors->first('gender') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (genderOptions() as $key => $item)
                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('gender') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Languages Known :</div>
            <div class="col-md-4">
                <input type="text" wire:model.defer="langaugesknown" id="lang"
                    wire:click="$emit('taginputevent')" data-role="tagsinput"
                    onchange="this.dispatchEvent(new InputEvent('input'))"
                    class="form-control {{ $errors->first('langaugesknown') ? ' form-control-danger' : '' }}">
                @error('langaugesknown') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Comments :</div>
            <div class="col-md-10">
                <textarea wire:model.defer="comments" id="comments" rows="5"
                    class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light ">Create</button>
    </div>
</form>
</div>
</div>
</div>

{{-- update modal --}}
<div wire:ignore.self class="modal fade " id="updatelead" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">Update Lead Info</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@include('includes.leadform',['method'=>'update','createleads'=>0,'readonly'=>0,'activelang'=>1])
</div>
</div>
</div>

{{-- assign modal --}}
<div wire:ignore.self class="modal fade " id="assignlead" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">Assign Lead to Senior Trainer Executive</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form wire:submit.prevent="assign" method="POST">
    @csrf
    <div class="modal-body">
        <h5 class="text-info" style="margin-top: 20px">Preferred Demo Date and Slot of the Lead</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Date :</div>
            <div class="col-md-4">
                <input type="date" wire:model.defer="date" min="{{ date('Y-m-d') }}"
                    class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }}">
                @error('date') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Time Slot :</div>
            <div class="col-md-4">
                <select wire:model.defer="slot" id="slot"
                    class="form-control {{ $errors->first('slot') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach ($slots as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->from }} - {{ $item->to }}
                        </option>
                    @endforeach
                </select>
                @error('slot') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <h5 class="text-info" style="margin-top: 20px">Assign Lead to Senior Trainer Executive</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Assign to :</div>
            <div class="col-md-5">
                <select wire:model.defer="assignto" id="growth"
                    class="form-control {{ $errors->first('assignto') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach ($seniortrainers as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} (Assigned
                            leads-{{ $item->assignedusers_count }})</option>
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
{{-- reassign modal --}}
<div wire:ignore.self class="modal fade " id="reassignlead" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">Assign Lead to Senior Trainer Executive</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form wire:submit.prevent="reassign" method="POST">
    @csrf
    <div class="modal-body">
        <h5 class="text-info" style="margin-top: 20px">Preferred Demo Date and Slot of the Lead</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Date :</div>
            <div class="col-md-4">
                <input type="date" wire:model.defer="date" min="{{ date('Y-m-d') }}"
                    class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }}">
                @error('date') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Time Slot :</div>
            <div class="col-md-4">
                <select wire:model.defer="slot" id="slot"
                    class="form-control {{ $errors->first('slot') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach ($slots as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->from }} - {{ $item->to }}
                        </option>
                    @endforeach
                </select>
                @error('slot') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <h5 class="text-info" style="margin-top: 20px">Assign Lead to Senior Trainer Executive</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Assign to :</div>
            <div class="col-md-5">
                <select wire:model.defer="assignto" id="growth"
                    class="form-control {{ $errors->first('assignto') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach ($seniortrainers as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} (Assigned
                            leads-{{ $item->assignedusers_count }})</option>
                    @endforeach
                </select>
                @error('assignto') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-5"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light ">Reassign</button>
    </div>
</form>
</div>
</div>
</div>

<div wire:ignore.self class="modal fade " id="sendpaymentlink" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">Send Payment Link</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form wire:submit.prevent="sendpaymentlink" method="POST">
    @csrf
    <div class="modal-body">
        <table class="table table-hover">
            <tr>
                {{-- <td>Sr No</td> --}}
                <td>Date</td>
                <td>Link</td>
                <td>Course</td>
                <td>Mobile</td>
                <td>Amount</td>
                <td>Resend Link on Whatsapp</td>
                <td>Resend Link on Sms</td>
            </tr>
            @forelse ($previouspaymentattempts as $item)
                <tr>
                    {{-- <td>{{ $key + 1 }}</td> --}}
                    {{-- {{dd($item->course->name)}} --}}
                    <td>{{ $item->created_at ?? '' }}</td>
                    <td>{{ url('/') }}/short-url/{{ $item->linkId ?? '' }}</td>
                    <td>{{ $item->course->name ?? '' }}</td>
                    <td>{{ $item->mobile ?? '' }}</td>
                    <td>{{ $item->discounted_price ?? '' }}</td>
                    <td>
                        <button class="btn btn-primary">send</button>
                    </td>
                    <td>
                        <button class="btn btn-primary">send</button>
                    </td>
                </tr>
            @empty

            @endforelse
        </table>
        <h5 class="text-info" style="margin-top: 20px">Preferred Demo Date and Slot of the Lead</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2"><label for="cars">Choose Course:</label></div>
            <div class="col-md-4">
                <select name="cars" id="cars" class="form-control" wire:model="selectedcourse">
                    @foreach ($courses as $item)
                        {{-- {{dd($item->coursetype)}} --}}
                        <optgroup label="{{ $item->name ?? '' }}">
                            <option value="">Please-select-course</option>
                            @foreach ($item->coursetype as $course)
                                <option value="{{ $course->id ?? 0 }}">{{ $course->name ?? '' }}
                                    Rs{{ $course->price ?? '' }}</option>
                            @endforeach

                        </optgroup>
                    @endforeach


                </select>
            </div>
        </div>
        <h5 class="text-info" style="margin-top: 20px">You Can Send Link For course</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Send Link Price :</div>
            <div class="col-md-3">
                <input type="text" class="form-control" wire:model="priceoffered">
                @if ($validamountsendlink)
                @else
                    <span style="color: red">You can not sell this course for less than
                        {{ $validamounttosendlink }}</span>
                @endif
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" wire:model="mobilerforpaytmlink"
                    placeholder="Paytm Number">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" wire:model="emailforpaytmlink"
                    placeholder="Email for Paytm">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
        @if ($validamountsendlink)
            <button type="submit" class="btn btn-primary waves-effect waves-light ">Send Link</button>
        @else
            <button type="button" disabled class="btn btn-primary waves-effect waves-light ">Send
                Link</button>
        @endif
        {{-- <button type="submit" class="btn btn-primary waves-effect waves-light ">Send Link</button> --}}

    </div>
</form>

</div>
</div>
</div>


<div wire:ignore.self class="modal fade " id="followup" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h4 class="modal-title">Follow Up Lead</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form wire:submit.prevent="followupleadhandel" method="POST">
    @csrf
    <div class="modal-body">
        <h5 class="text-info" style="margin-top: 20px">Preferred Date for Follow Up</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Date :</div>
            <div class="col-md-4">
                <input type="date" wire:model.defer="followupleadhandeldata" min="{{ date('Y-m-d') }}"
                    class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }}">
                @error('followupleadhandeldata') <span style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light ">Set Follow Up</button>
    </div>
</form>
</div>
</div>
</div>

<script>
Livewire.on('taginput', message => {
$("#lang").tagsinput('destroy');
$("#lang").tagsinput('items');
$("#langup").tagsinput('destroy');
$("#langup").tagsinput('items');
})
Livewire.on('flashmessage', message => {
$('#updatelead').modal('hide');
$('#assignlead').modal('hide');
$('#createlead').modal('hide');
$('#reassignlead').modal('hide');
$('#sendpaymentlink').modal('hide');
$('#followup').modal('hide');
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

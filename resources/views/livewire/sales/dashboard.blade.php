<div class="row">
    @include('includes.leadhistory')
    <div class="col-xl-6 col-md-6" wire:click="leadstatusstatsactive(0)">
        <div class="text-white card bg-c-pink makepointer  
        @if ($assignedtable == 0) 
        active-border @endif ">
            <div class=" card-block">
            <div class="row align-items-center">
                <div class="col">
                    <p class="m-b-5">Un Assigned</p>
                    <h4 class="m-b-0">{{ $unassignedleads ?? '' }}</h4>
                </div>
                <div class="col-auto text-right col">
                    <i class="feather icon-user f-50 text-c-pink"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-6" wire:click="leadstatusstatsactive(1)">
    <div class="text-white card bg-c-yellow makepointer 
        @if ($assignedtable==1) active-border
                @endif">
        <div class="card-block">
            <div class="row align-items-center">
                <div class="col">
                    <p class="m-b-5">Assigned</p>
                    <h4 class="m-b-0">{{ $assignedleads ?? '' }}</h4>
                </div>
                <div class="col-auto text-right col">
                    <i class="feather icon-credit-card f-50 text-c-yellow"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-6" wire:click="leadstatusstatsactive(2)">
    <div class="text-white card bg-c-green makepointer 
        @if ($assignedtable==2) active-border
                @endif">
        <div class="card-block">
            <div class="row align-items-center">
                <div class="col">
                    <p class="m-b-5">Converted</p>
                    <h4 class="m-b-0">{{ $convertedleads ?? '' }}</h4>
                </div>
                <div class="col-auto text-right col">
                    <i class="feather icon-credit-card f-50 text-c-green"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-6" wire:click="leadstatusstatsactive(3)">
    <div class="text-white card bg-c-blue makepointer 
        @if ($assignedtable==3) active-border
                @endif">
        <div class="card-block">
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
<div class="col-md-12">

    <div class="row" style="margin-bottom: 12px;">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <input type="text" placeholder="Search" wire:model.debounce.500ms="search" class="form-control">
        </div>
    </div>

</div>

@switch($assignedtable)
    @case(0)
         <div class="col-md-12">
            <form wire:submit.prevent="store" method="POST">
                <div class="card">
                    <div class="card-header">
                        <div style="margin-top: 20px;" class="row">
                            <div class="col-md-3">
                                {{-- <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                data-target="#createlead" id="createbtn" wire:click="$emit('reset')">Generate
                                Lead</button> --}}
                            </div>
                            <div class="col-md-3">
                                <select wire:model="assignto" id="assignto"
                                    class="form-control {{ $errors->first('assignto') ? ' form-control-danger' : '' }}">
                                    <option value="">--Select--</option>
                                    @foreach ($assigntousers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} (Assigned
                                            leads-{{ $item->assignedusers_count }})</option>
                                    @endforeach
                                </select>
                                @error('assignto')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="submit"
                                    class="btn {{ $errors->first('users') ? ' btn-danger' : 'btn-outline-primary' }}"
                                    value="Assign" />
                                @error('users')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                {{-- <input type="text" placeholder="Search" wire:model.debounce.500ms="search"
                                class="form-control"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Assigned At</th>
                                        <th>Update</th>
                                        <th>Details</th>
                                        <th>Lead Track</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $item )
                                        <tr>
                                            <td>
                                                <input type="checkbox"
                                                    wire:model="users.{{ optional($item->userRelation)->id }}"
                                                    value="{{ optional($item->userRelation)->id }}">
                                            </td>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>
                                                {{ optional($item->userRelation)->name ?? '' }}
                                            </td>
                                            <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                            <td>{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? '' }}
                                            </td>
                                            <td>
                                                {{-- {{ optional($item->userRelation)->created_at->diffForHumans() ?? '' }} --}}
                                                {{$item->created_at->isToday() ? "Today" : dateformat($item->created_at) }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect"
                                                    data-toggle="modal" data-target="#updatelead"
                                                    wire:click="edit({{ optional($item->userRelation)->id }})">Update</button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect"
                                                    data-toggle="modal" data-target="#leaddetails"
                                                    wire:click="edit({{ optional($item->userRelation)->id }})">Details</button>
                                            </td>
                                            <td>
                                                <button type="button" class="{{demoHelperColor($item->id)}}"
                                                    data-toggle="modal" data-target="#leadhistory"
                                                    wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})">Lead History</button>
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
                </div>

            </form>
        </div>
        @break
    @case(1)
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div style="margin-top: 20px;" class="row">
                    <div class="col-md-3">
                        {{-- <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                data-target="#createlead" id="createbtn" wire:click="$emit('reset')">Generate
                                Lead</button> --}}
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">

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
                                <th>Assigned To</th>
                                <th>Trainer Feedback</th>
                                <th>Student Feedback</th>
                                <th>Lead Track</th>
                                <th>Allow Extra Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item )
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>
                                        {{ optional($item->userRelation)->name ?? '' }}
                                    </td>
                                    <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                    <td>{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? '' }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                            data-target="#updatelead"
                                            wire:click="edit({{ optional($item->userRelation)->id }})">Update</button>
                                    </td>
                                    <td>
                                        {{ optional($item->userRelation)->created_at->diffForHumans() ?? '' }}
                                    </td>
                                    <td>
                                        {{ assingntoName($item) }}
                                    </td>
                                    <td>{!! feedBackHelpers(optional($item->demoStatus)->id, 1) !!}</td>
                                    <td>{!! feedBackHelpers(optional($item->demoStatus)->id, 0) !!}</td>
                                    <td>
                                        <button type="button" class="{{demoHelperColor($item->id)}}" data-toggle="modal"
                                            data-target="#leadhistory"
                                            wire:click="getleadHistory({{ $item->leadid }},{{$item->id}})">Lead History</button>
                                    </td>
                                    <td>
                                            <label class="switch">
                                                <input type="checkbox"
                                                    wire:click="changediscountStatus('{{$item->leadid}}', '{{optional($item->userRelation)->add_extra_discount}}')"
                                                    {{optional($item->userRelation)->add_extra_discount =='1' ? 'checked' : ''}}>
                                                <span class="slider round"></span>
                                            </label>
                                            </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" style="text-align: center">No Data Found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="py-3" style="float: right;">{{ $data->links() }}</div>
                </div>
            </div>
        </div>
        @break
        @case(2)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="margin-top: 20px;" class="row">
                        <div class="col-md-3">
                            {{-- <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                    data-target="#createlead" id="createbtn" wire:click="$emit('reset')">Generate
                                    Lead</button> --}}
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
    
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
            </div>
        </div>
       
        @break 
        @case(3)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="margin-top: 20px;" class="row">
                        <div class="col-md-3">
                            {{-- <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                    data-target="#createlead" id="createbtn" wire:click="$emit('reset')">Generate
                                    Lead</button> --}}
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
    
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
            </div>
        </div>
        @break   
    @default
        
@endswitch




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
                {{-- <form wire:submit.prevent="storelead" method="POST">
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
                </form> --}}
                @include('includes.leadform',['method'=>'storelead','createleads'=>0,'readonly'=>0,'activelang'=>1])
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
                {{-- <form wire:submit.prevent="update" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">Name :</div>
                            <div class="col-md-4"> <input type="text" wire:model="name" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">Email :</div>
                            <div class="col-md-4"> <input type="text" wire:model="email" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-2">Contact :</div>
                            <div class="col-md-2"> <input type="text" wire:model="mobilecode" class="form-control" readonly>
                            </div>
                            <div class="col-md-4"> <input type="text" wire:model="mobile" class="form-control" readonly>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-2">State :</div>
                            <div class="col-md-4"> <input type="text" wire:model="state" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">Reference :</div>
                            <div class="col-md-4"> <input type="text" wire:model="reference" class="form-control" readonly>
                            </div>
                        </div>
                        <h5 class="text-info" style="margin-top: 20px">Update following info</h5>
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
                                <input type="text" wire:model.defer="langaugesknown" id="langup"
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
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Update</button>
                    </div>
                </form> --}}
                @include('includes.leadform',['method'=>'update','createleads'=>0,'readonly'=>0,'activelang'=>1])
            </div>
        </div>
    </div>
    {{-- details modal --}}
    <div wire:ignore.self class="modal fade " id="leaddetails" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lead Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">Name :</div>
                            <div class="col-md-4"> <input type="text" wire:model="name" class="form-control input-opacity"
                                    disabled>
                            </div>
                            <div class="col-md-2">Email :</div>
                            <div class="col-md-4"> <input type="text" wire:model="email" class="form-control input-opacity"
                                    disabled>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-2">Contact :</div>
                            <div class="col-md-2"> <input type="text" wire:model="mobilecode"
                                    class="form-control input-opacity" disabled> </div>
                            <div class="col-md-4"> <input type="text" wire:model="mobile" class="form-control input-opacity"
                                    disabled>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-2">State :</div>
                            <div class="col-md-4"> <input type="text" wire:model="state" class="form-control input-opacity"
                                    disabled>
                            </div>
                            <div class="col-md-2">Reference :</div>
                            <div class="col-md-4"> <input type="text" wire:model="reference"
                                    class="form-control input-opacity" disabled> </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Growth :</div>
                            <div class="col-md-4">
                                <select wire:model.defer="growth" id="growth"
                                    class="form-control {{ $errors->first('growth') ? ' form-control-danger' : '' }} input-opacity"
                                    disabled>
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
                                    class="form-control {{ $errors->first('edulevel') ? ' form-control-danger' : '' }} input-opacity"
                                    disabled>
                                    <option value="">--Select--</option>
                                    @foreach (edulevelOptions() as $key => $item)
                                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('edulevel') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Gender :</div>
                            <div class="col-md-4">
                                <select wire:model.defer="gender" id="gender"
                                    class="form-control {{ $errors->first('gender') ? ' form-control-danger' : '' }} input-opacity"
                                    disabled>
                                    <option value="">--Select--</option>
                                    @foreach (genderOptions() as $key => $item)
                                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('gender') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2">Languages Known :</div>
                            <div class="col-md-4">
                                <input type="text" wire:model.defer="langaugesknown" wire:click="$emit('taginputevent')"
                                    data-role="tagsinput" onchange="this.dispatchEvent(new InputEvent('input'))"
                                    class="form-control {{ $errors->first('langaugesknown') ? ' form-control-danger' : '' }} input-opacity"
                                    disabled>
                                @error('langaugesknown') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Comments :</div>
                            <div class="col-md-10">
                                <textarea wire:model.defer="comments" id="comments" rows="5"
                                    class="form-control input-opacity" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">OK</button>
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
            $('#createlead').modal('hide');
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

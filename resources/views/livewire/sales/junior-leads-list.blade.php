<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="margin-top: 20px;" class="row">
                        <div class="col-md-1">
                            <a href="{{ route('sales.seniorsalesteam') }}" title="Go Back" data-toggle="tooltip" data-placement="right"><i class="fa fa-arrow-circle-o-left" style="font-size: 30px; color: #01a9ac;"></i> </a>
                        </div>
                        <div class="col-md-8"></div>
                        <div class="col-md-3">
                            <input type="text" placeholder="Search" wire:model.debounce.500ms="search" class="form-control">
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
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                        data-target="#leaddetails" wire:click="edit({{$item->id}})">Details</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="py-3" style="float: right;">{{$data->links()}}</div>
                </div>
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
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">Name :</div>
                            <div class="col-md-4"> <input type="text" wire:model="name" class="form-control input-opacity" disabled>
                            </div>
                            <div class="col-md-2">Email :</div>
                            <div class="col-md-4"> <input type="text" wire:model="email" class="form-control input-opacity" disabled>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-2">Contact :</div>
                            <div class="col-md-2"> <input type="text" wire:model="mobilecode" class="form-control input-opacity"
                                disabled> </div>
                            <div class="col-md-4"> <input type="text" wire:model="mobile" class="form-control input-opacity" disabled>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-2">State :</div>
                            <div class="col-md-4"> <input type="text" wire:model="state" class="form-control input-opacity" disabled>
                            </div>
                            <div class="col-md-2">Reference :</div>
                            <div class="col-md-4"> <input type="text" wire:model="reference" class="form-control input-opacity"
                                disabled> </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Growth :</div>
                            <div class="col-md-4">
                                <select wire:model.defer="growth" id="growth"
                                    class="form-control {{ $errors->first('growth') ? ' form-control-danger' : '' }} input-opacity" disabled>
                                    <option value="">--Select--</option>
                                    @foreach (growthOptions() as $key => $item)
                                    <option value="{{ $key+1 }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('growth') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2">Edu Level :</div>
                            <div class="col-md-4">
                                <select wire:model.defer="edulevel" id="edulevel"
                                    class="form-control {{ $errors->first('edulevel') ? ' form-control-danger' : '' }} input-opacity" disabled>
                                    <option value="">--Select--</option>
                                    @foreach (edulevelOptions() as $key => $item)
                                    <option value="{{ $key+1 }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('edulevel') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Gender :</div>
                            <div class="col-md-4">
                                <select wire:model.defer="gender" id="gender"
                                    class="form-control {{ $errors->first('gender') ? ' form-control-danger' : '' }} input-opacity" disabled>
                                    <option value="">--Select--</option>
                                    @foreach (genderOptions() as $key => $item)
                                    <option value="{{ $key+1 }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('gender') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2">Languages Known :</div>
                            <div class="col-md-4">
                                <input type="text" wire:model.defer="langaugesknown"
                                    wire:click="$emit('taginputevent')" data-role="tagsinput"
                                    onchange="this.dispatchEvent(new InputEvent('input'))"
                                    class="form-control {{ $errors->first('langaugesknown') ? ' form-control-danger' : '' }} input-opacity" disabled>
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
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Date :</div>
                            <div class="col-md-4">
                                <input type="date" wire:model.defer="date"
                                    class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }}  input-opacity" disabled>
                                @error('date') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2">Time Slot :</div>
                            <div class="col-md-4">
                                <select wire:model.defer="slot" id="slot"
                                    class="form-control {{ $errors->first('slot') ? ' form-control-danger' : '' }}  input-opacity" disabled>
                                    <option value="">--Select--</option>
                                    @foreach ($slots as $key => $item)
                                    <option value="{{$item->id}}">{{$item->from}} - {{$item->to}}</option>
                                    @endforeach
                                </select>
                                @error('slot') <span style="color:red">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">Assign to :</div>
                            <div class="col-md-5">
                                <select wire:model.defer="assignto" id="growth"
                                    class="form-control {{ $errors->first('assignto') ? ' form-control-danger' : '' }}  input-opacity" disabled>
                                    <option value="">--Select--</option>
                                    @foreach ($seniortrainers as $item)
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
                        <button type="button" class="btn btn-primary waves-effect " data-dismiss="modal">OK</button>
                    </div>
            </div>
        </div>
    </div>

</div>

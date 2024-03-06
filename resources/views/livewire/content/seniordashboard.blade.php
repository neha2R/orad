<div class="row">

    <!-- statustic-card start -->
    <div class="col-xl-4 col-md-6" wire:click="statswitchhandel(0)">
        <div class="card bg-c-yellow text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Content Request</p>
                        <h4 class="m-b-0">{{$totalcount ?? ''}}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-user f-50 text-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6" wire:click="statswitchhandel(1)">
        <div class="card bg-c-green text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Proof Read </p>
                        <h4 class="m-b-0">{{$proofread ?? ''}}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-credit-card f-50 text-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6" wire:click="statswitchhandel(2)">
        <div class="card bg-c-pink text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Complaint</p>
                        <h4 class="m-b-0">{{$totalcompalint ?? ''}}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-book f-50 text-c-pink"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <div class="col-md-12">
        @switch($statsswitch)
    @case(0)
    <div class="card">
        <div class="card-header">
            <div style="margin-top: 20px;" class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                        data-target="#createcat" id="createbtn" wire:click="$emit('reset')">Create Content Request</button>
                </div>
                <div class="col-md-6"></div>
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
                            <th>Content Explanation</th>
                            <th>Content Name</th>
                            <th>Content Type</th>
                            <th>Content File</th>
                            <th>Assign To</th>
                            <th>Assign Date</th>
                            <th>Update Pending</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->contentexplaination ?? ''}}</td>
                            <td>{{$item->name ?? 'Not Updated Yet'}}</td>
                            <td>{{optional($item->contentCategory)->name ?? 'Not Updated Yet'}}</td>
                            <td>{{$item->contentfile->first()->file ?? 'Not Updated Yet'}}</td>
                            <td>{{$item->assignedto->name ?? ''}}</td>
                            <td>{{$item->created_at->isToday() ? 'Today' : dateformat($item->created_at) }}</td>
                            <td> <span class="badge badge-danger blink" style="font-size: 14px;">Pending</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" style="text-align: center">No Record Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{$data->links()}}</div>
        </div>
    </div>
        @break
    @case(1)
    <div class="card">
        <div class="card-header">
            <div style="margin-top: 20px;" class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                        data-target="#createcat" id="createbtn" wire:click="$emit('reset')">Create Content</button>
                </div>
                <div class="col-md-6"></div>
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
                            <th>Content Explanation</th>
                            <th>Content Name</th>
                            <th>Content Type</th>
                            <th>Content File</th>
                            <th>Submitted By</th>
                            <th>Proof Read Status</th>
                            <th>Mark As Read</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->contentexplaination ?? ''}}</td>
                            <td>{{$item->name ?? 'Not Updated Yet'}}</td>
                            <td>{{optional($item->contentCategory)->name ?? 'Not Updated Yet'}}</td>
                            <td>{{$item->contentfile->first()->file ?? 'Not Updated Yet'}}</td>
                            <td>{{$item->assignedto->name ?? ''}}</td>
                            <td>
                                @if($item->proofreadsenior)
                                <span class="badge badge-success" style="font-size: 14px;">Completed</span>
                                @else    
                                <span class="badge badge-danger blink" style="font-size: 14px;">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($item->proofreadsenior)
                                Thanks for proof read
                                @else    
                                <button class="btn btn-primary" wire:click="markasproofread({{$item->id}})">Proof Read</button>
                                @endif
                                
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" style="text-align: center">No Record Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{$data->links()}}</div>
        </div>
    </div>
        @break
    @case(2)
    <div class="card">
        <div class="card-header">
            <div style="margin-top: 20px;" class="row">
                <div class="col-md-3">
                    {{-- <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                        data-target="#createcat" id="createbtn" wire:click="$emit('reset')">Create Content</button> --}}
                </div>
                <div class="col-md-6"></div>
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
                            {{-- <th>Content Explanation</th> --}}
                            <th>Content Name</th>
                            {{-- <th>Content Keyword</th> --}}
                            <th>Content File</th>
                            <th>Compaint By</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Mark As Read</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            {{-- <td>{{$item->contentexplaination ?? ''}}</td> --}}
                            <td>{{$item->contentRelation->name ?? 'Not Updated Yet'}}</td>
                            {{-- <td>{{$item->keyword ?? 'Not Updated Yet'}}</td> --}}
                            <td>{{$item->contentRelation->contentfile->first()->file ?? 'Not Updated Yet'}}</td>
                            <td>{{$item->complaintcreatorRelation->name ?? ''}}</td>
                            <td>
                                @if($item->assigned_to_junior)
                                    {{$item->complaintjuniorTrainer->name ?? ''}}
                                @else    
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Assigned To
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($juniorcontentwriters as $value)
                                        <button type="button" wire:click="assigncontent({{$item->id}},{{$value->id}})" class="dropdown-item" >{{$value->name ?? ''}}</button>
                                        @endforeach
                                    </div>
                                  </div>
                                @endif
                            </td>
                            <td>
                                @if ($item->junior_proofread)
                                <span class="badge badge-success" style="font-size: 14px;">Done</span>
                                @else
                                <span class="badge badge-danger blink" style="font-size: 14px;">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($item->senior_proofread)
                                Thanks for proof read
                                @else    
                                <button class="btn btn-primary" wire:click="markasproofreadcomplaint({{$item->id}})">Proof Read</button>
                                @endif
                                
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" style="text-align: center">No Record Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{$data->links()}}</div>
        </div>
    </div>
    @break    
    @default
        
@endswitch
       
        {{-- create modal --}}
        <div wire:ignore.self class="modal fade " id="createcat" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Content</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="store" method="POST">
                        @csrf
                        
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Content Number</label>
                                <div class="col-sm-10">
                                    <input type="number" wire:model="contentnumber"  class="form-control"/>
                                    @error('contentnumber') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select Junior</label>
                                <div class="col-sm-10">
                                    <select wire:model="selectedjunior" id="category" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($juniorcontentwriters as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedjunior') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select Content Category</label>
                                <div class="col-sm-10">
                                    <select wire:model="contentcategoryid" id="category" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($contentcategory as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('contentcategory') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Content Explaination</label>
                                <div class="col-sm-10">
                                    <textarea wire:model="contentexplaination" class="form-control" ></textarea>
                                    @error('contentexplaination') <span style="color:red;">{{ $message }}</span> @enderror
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
        <div wire:ignore.self class="modal fade " id="updatecat" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Content  </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="update" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Courses</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        Livewire.on('flashMessage', message => {
            $('#updatecat').modal('hide');
            $('#createcat').modal('hide');
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
<div class="row">
    <div class="col-xl-4 col-md-6" wire:click="statsswitchhandel(0)">
        <div class="card bg-c-yellow text-white" >
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Content Request</p>
                        <h4 class="m-b-0">{{$totalcontent ?? ''}}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-user f-50 text-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6" wire:click="statsswitchhandel(1)">
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
    <div class="col-xl-4 col-md-6">
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
        <div class="card">
            <div class="card-header">
                <div style="margin-top: 20px;" class="row">
                    {{-- <div class="col-md-3">
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                            data-target="#createcat" id="createbtn" wire:click="$emit('reset')">Create Content</button>
                    </div> --}}
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        {{-- <input type="text" placeholder="Search" wire:model.debounce.500ms="search" class="form-control"> --}}
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
                                <th>Content Keyword</th>
                                <th>Content File</th>
                                <th>Assign Date</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->contentexplaination ?? ''}}</td>
                                <td>{{$item->name ?? 'Not Updated Yet'}}</td>
                                <td>{{optional($item->contentCategory)->name ?? 'Not Updated Yet'}}</td>
                                @php $link=$item->contentfile->first();  @endphp
                                <td> 
                                @if($link)
                                <a href='{{openfileonline($link) }}' target="_blank">View Content</a></td>

                                @else
                                N/A
                                @endif 
                                </td>
                                <td>{{$item->created_at->isToday() ? 'Today' : dateformat($item->created_at) }}</td>
                                <td><button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                    data-target="#createcat" id="createbtn" wire:click="edit({{$item->id}})">Update Content</button></td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align: center">No Record Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="py-3" style="float: right;">{{$data->links()}}</div>
            </div>
        </div>
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
                                <label class="col-sm-2 col-form-label">Content Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name" id="name">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Content file</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="file" id="name">
                                    @error('file') <span style="color:red;">{{ $message }}</span> @enderror
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
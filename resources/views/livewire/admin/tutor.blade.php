<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div style="margin-top: 20px;" class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                            data-target="#createcat" id="createbtn" wire:click="$emit('reset')">Create
                            {{$componentName ?? ''}}</button>
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
                                <th>Video</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>
                                    <img class="user-img img-radius"
                                        src='{{ asset("storage/$item->video") }}'
                                        alt="user-img" height="100px" width="100px">
                                </td>
                                <td>{{ucwords($item->name ?? 'N/A')}}</td>
                                <td>{{$item->description ?? 'N/A'}}</td>
                               
                                <td>
                                    <label class="switch">
                                        <input type="checkbox"
                                            wire:click="changestatus({{$item->id}}, {{$item->is_active}})"
                                            {{$item->is_active ? 'checked' : ''}}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                        data-target="#updatecat" wire:click="edit({{$item->id}})">Update</button>
                                </td>
                            </tr>
                            @endforeach
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
                        <h4 class="modal-title">Create {{$componentName}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="store" method="POST">
                        @csrf
                        <div class="modal-body">
                            @if ($video)
                            <div class="row form-group">
                                Video Preview:
                                <img src="{{ $video->temporaryUrl() }}"
                                height="100px" width="100px">
                            </div>
                            @endif
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Video</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="video" id="video">
                                    @error('video') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name" id="name">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" wire:model="description" id="description">
                                    @error('description') <span style="color:red;">{{ $message }}</span> @enderror
                                    </textarea>
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
                        <h4 class="modal-title">Update {{$componentName}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="update" method="POST">
                        @csrf
                       <div class="modal-body">
                           @if ($video)
                            <div class="row form-group">
                                Video Preview:
                                <img src="{{ $video->temporaryUrl() }}"
                                height="100px" width="100px">
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Video</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="video" id="video">
                                    @error('video') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name" id="name">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" wire:model="description" id="description">
                                    @error('description') <span style="color:red;">{{ $message }}</span> @enderror
                                    </textarea>
                                </div>
                            </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="resetInputs()" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div style="margin-top: 20px;" class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                            data-target="#createsubdepartment" wire:click="$emit('reset')">Create Sub-Department</button>
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
                                <th>Sub-Department Name</th>
                                <th> Department </th>
                                <th>Status</th>
                                {{-- <th>Update</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{optional($item->departmentname)->name}}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox"
                                            wire:click="changestatus({{$item->id}}, {{$item->is_active}})"
                                            {{$item->is_active ? 'checked' : ''}}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                {{-- <td>
                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                        data-target="#updatesubdepartment" wire:click="edit({{$item->id}})">Update</button>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-3" style="float: right;">{{$data->links()}}</div>
            </div>
        </div>
        {{-- create modal --}}
        <div wire:ignore.self class="modal fade " id="createsubdepartment" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Sub-Department</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="store" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name"
                                        placeholder="Name of the sub-department">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <select wire:model="department" id="department" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($departments as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department') <span style="color:red;">{{ $message }}</span> @enderror
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
        <div wire:ignore.self class="modal fade " id="updatesubdepartment" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Department</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="update" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <select wire:model="department" id="department" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($departments as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department') <span style="color:red;">{{ $message }}</span> @enderror
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
    
        <script>
            Livewire.on('subdepAdded', postId => {
            $('#createsubdepartment').modal('hide');
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Sub-Department added successfully',
                showConfirmButton: false,
                timer: 1500
            });
        });
        Livewire.on('flashMessage', message => {
            $('#updatesubdepartment').modal('hide');
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
</div>
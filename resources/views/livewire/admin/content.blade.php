<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div style="margin-top: 20px;" class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                            data-target="#createcontent" wire:click="$emit('reset')">Create Content</button>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <select wire:model="catfilter" id="category" class="form-control">
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}">{{ $item->name }}</option> 
                            @endforeach
                        </select>
                    </div>
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
                                <th>Title</th>
                                <th style="min-width:200px;">Description</th>
                                <th>File</th>
                                <th>Category</th>
                                {{-- <th>Tags</th> --}}
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->title ?? ''}}</td>
                                <td>{{$item->description ?? ''}}</td>
                                <td><a href="{{\Storage::disk('public')->url($item->file)}}" target="_blank" style="color: #01a9ac;">{{$item->title ?? ''}}</a></td>
                                <td>{{optional($item->cat)->name ?? ''}}</td>
                                {{-- <td>{{$tags}}</td> --}}
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
                                        data-target="#updatecontent" wire:click="edit({{$item->id}})">Update</button>
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
        <div wire:ignore.self class="modal fade " id="createcontent" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Content</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="title">
                                    @error('title') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea wire:model="description" class="form-control"  rows="5"></textarea>
                                    @error('description') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="file" id="upload{{ $iteration }}">
                                    @error('file') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select wire:model="category" id="category" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option> 
                                        @endforeach
                                    </select>
                                    @error('category') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="tags" id="tags"
                                    wire:click="$emit('taginputevent')" data-role="tagsinput"
                                    onchange="this.dispatchEvent(new InputEvent('input'))"
                                    class="form-control">
                                    @error('tags') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div> --}}
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
        <div wire:ignore.self class="modal fade " id="updatecontent" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Content</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="title">
                                    @error('title') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea wire:model="description" class="form-control"  rows="5"></textarea>
                                    @error('description') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <a href="{{\Storage::disk('public')->url($prefile)}}" target="_blank" style="color: #01a9ac;">{{$title}}</a>
                                    <input type="file" class="form-control" wire:model="file">
                                    @error('file') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select wire:model="category" id="category" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.defer="tags" id="tagsedit"
                                    wire:click="$emit('taginputevent')" data-role="tagsinput"
                                    onchange="this.dispatchEvent(new InputEvent('input'))"
                                    class="form-control">
                                    @error('tags') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div> --}}
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
        Livewire.on('flashMessage', message => {
            $('#updatecontent').modal('hide');
            $('#createcontent').modal('hide');
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 1500
            });
        })
        Livewire.on('taginput', message => {
            $("#tags").tagsinput('destroy');
            $("#tags").tagsinput('items');
            $("#tagsedit").tagsinput('destroy');
            $("#tagsedit").tagsinput('items');
        })
        </script>
    </div>
</div>
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
                                <th>Carriculam Image</th>
                                <th>Course / Subscription Type</th>
                                <th>Description</th>
                                <th>Course Duration</th>
                                <th>Total Classes</th>
                                <th>Class Duration</th>
                                <th>Course Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                {{-- <th>Show On LandingPage</th> --}}
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>
                                    <img class="user-img img-radius"
                                    src='{{ asset("storage/$item->carriculam_file") }}'
                                    alt="user-img" height="100px" width="100px">
                                </td>
                                <td>{{$item->name ?? 'N/A'}} ( {{ucwords($item->Course->name ?? 'N/A')}} ) </td>
                                <td>{{$item->description ?? 'N/A'}}</td>
                                <td>{{$item->days ?? 'N/A'}}</td>
                                <td>{{$item->no_of_classes ?? 'N/A'}}</td>
                                <td>{{$item->class_duration ?? 'N/A'}}</td>
                                <td>{{$item->price ?? 'N/A'}}</td>
                                <td>{{$item->discount ?? '0'}}</td>
                                <td>
                                    
                                    <label class="switch">
                                        <input type="checkbox"
                                            wire:click="changestatus({{$item->id}}, {{$item->isactive}})"
                                            {{$item->isactive=='1' ? 'checked' : ''}}>
                                        <span class="slider round"></span>
                                    </label>
                                   
                                </td>
                                {{-- <td>
                                    <label class="switch">
                                        <input type="checkbox"
                                            wire:click="showOnLandingPage({{$item->id}}, {{$item->show_on_dashboard}})"
                                            {{$item->show_on_dashboard == '1' ? 'checked' : ''}}>
                                        <span class="slider round"></span>
                                    </label>
                                </td> --}}

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
                            @if ($carriculam_image)
                            <div class="row form-group">
                                Photo Preview:
                                <img src="{{ $carriculam_image->temporaryUrl() }}"
                                height="100px" width="100px">
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Carriculam Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="carriculam_image" id="carriculam_image">
                                    @error('carriculam_image') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Parent Course</label>
                                <div class="col-sm-10">
                                    <select wire:model="multipleCourse" id="multipleCourse" class="form-control" multiple>
                                        <option value="">--Select--</option>
                                        @foreach ($parentCourse as $key => $childCourse)
                                        <optgroup label="{{ $key ? 'Personal Classes' : 'Group Classes'}}">
                                            @foreach ($childCourse as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    @error('multipleCourse') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Course Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name" id="name">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Course description</label>
                                <div class="col-sm-10">
                                     <textarea class="form-control" wire:model="description" id="description" >
                                    </textarea>
                                    @error('description') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Course Price</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="price" id="name">
                                    @error('price') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Discount</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="discount" id="name">
                                    @error('discount') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Course Duration (in Days)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="days" id="name">
                                    @error('days') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No of Classes</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="no_of_classes" id="no_of_classes">
                                    @error('no_of_classes') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Class Duration(in minutes)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="class_duration" id="class_duration">
                                    @error('class_duration') <span style="color:red;">{{ $message }}</span> @enderror
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
                             @if ($carriculam_image)
                            <div class="row form-group">
                                Photo Preview:
                                <img src="{{ $carriculam_image->temporaryUrl() }}"
                                height="100px" width="100px">
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Carriculam Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" wire:model="carriculam_image" id="carriculam_image">
                                    @error('carriculam_image') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Courses Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="name">
                                    @error('name') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Course description</label>
                                <div class="col-sm-10">
                                     <textarea class="form-control" wire:model="description" id="description" required>
                                    </textarea>
                                    @error('description') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Parent Course</label>
                                <div class="col-sm-10">
                                    <select wire:model="course" id="course" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($parentCourse as $key => $childCourse)
                                        <optgroup label="{{ $key ? 'Personal Classes' : 'Group Classes'}}">
                                            @foreach ($childCourse as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    @error('course') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Course Price</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="price" id="name">
                                    @error('price') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Discount</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="discount" id="name">
                                    @error('discount') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Course Duration (in Days)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="days" id="name">
                                    @error('days') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No of Classes</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="no_of_classes" id="no_of_classes">
                                    @error('no_of_classes') <span style="color:red;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Class Duration  (in Mins.)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" wire:model="class_duration" id="class_duration">
                                    @error('class_duration') <span style="color:red;">{{ $message }}</span> @enderror
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
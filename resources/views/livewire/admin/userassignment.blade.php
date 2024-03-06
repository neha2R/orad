<div class="row">
    {{-- {{dd($departments)}} --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Assignment Process</h5>
                
                <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
            </div>
            <div class="card-block">
                <form wire:submit.prevent="store">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select
                            Department</label>
                        <div class="col-sm-10">
                            <select wire:model="selecteddepartment" class="form-control">
                                <option value="">Select One Value Only
                                </option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('selecteddepartment')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select
                            Senior</label>
                        <div class="col-sm-10">
                            <select wire:model="selectedsenior" class="form-control">
                                <option value="">Select One Value Only
                                </option>
                                @foreach ($seniors as $item)
                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('selectedsenior')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select Junior Trainer</label>
                        <div class="col-sm-10">
                            {{-- <select id='testSelect1' wire:model="selectedjunior" multiple>
                                @foreach ($juniors as $item)
                                <option value='{{$item->id}}'>{{$item->name??''}}</option> 
                                @endforeach
                            </select> --}}
                            <select wire:model="selectedjunior" class="form-control" multiple>
                                <option value="">Select Multiple
                                </option>
                                @foreach ($juniors as $item)
                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('selectedjunior')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>User Assignment</h4>
                {{-- <span>use class <code>table</code> inside table element</span> --}}

            </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Department</th>
                                <th>Assigned</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seniorstaff as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->email ?? '' }}</td>
                                    <td>{{ $item->mobilecode ?? '' }}{{ $item->mobile ?? '' }}</td>
                                    <td>{{ optional($item->departmentRelation)->name ?? '' }}</td>
                                    <td><button class="btn btn-primary" data-target="#userassignedmodal" data-toggle="modal"
                                            wire:click="$emit('showJuniors','{{ $item->id }}')">Assigned</button>
                                    </td>
                                </tr>
                            @endforeach

                            {{ $seniorstaff->links() }}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade " id="userassignedmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Showing result for assigned traniees to Senior</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h5>Showing Result For Assgined traniees to Senior</h5> --}}
                            {{-- <span>use class <code>table</code> inside table element</span> --}}

                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Unassign</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($showjuniorlist as $key=> $item)
                                            <tr>
                                                <th scope="row">{{$key + 1}}</th>
                                                <td>{{$item->name ?? ''}}</td>
                                                <td>{{$item->email ?? ''}}</td>
                                                <td>{{$item->mobilecode ?? ''}}{{$item->mobile ?? ''}}</td>
                                                <td><button wire:click="unAssignTrainee({{$item->id}})"  class="btn btn-danger">Unassign</button></td>
                                            </tr>
                                        @endforeach
                                       
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
</div>

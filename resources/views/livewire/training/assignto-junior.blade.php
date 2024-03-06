<div class="row">
    <div class="col-md-12">
        <form wire:submit.prevent="store" method="POST">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-1">
                            Date :
                        </div>
                        <div class="col-md-2">
                            <input type="date" wire:model.defer="date"
                                class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }} input-opacity"
                                disabled>
                        </div>
                        <div class="col-md-1">
                            Time Slot :
                        </div>
                        <div class="col-md-3">
                            <select wire:model.defer="slot" id="slot"
                                class="form-control {{ $errors->first('slot') ? ' form-control-danger' : '' }} input-opacity"
                                disabled>
                                <option value="">--Select--</option>
                                @foreach ($slots as $key => $item)
                                <option value="{{$item->id}}">{{$item->from}} - {{$item->to}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">Assign To :</div>
                        <div class="col-md-4">
                            <select wire:model.defer="assignto" id="growth"
                                class="form-control {{ $errors->first('assignto') ? ' form-control-danger' : '' }}">
                                <option value="">--Select--</option>
                                @foreach ($trainers as $item)
                                <option value="{{$item->id}}">{{$item->name}} (Assigned
                                    leads-{{$item->assignedusers_count}})</option>
                                @endforeach
                            </select>
                            @error('assignto') <span style="color:red">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div style="margin-top: 20px;" class="row">
                        <div class="col-md-3">
                            <select wire:model="catfilter" id="category" class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $item)
                                <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" placeholder="Search" wire:model.debounce.500ms="search"
                                class="form-control">
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <button type="submit" class="btn {{ $errors->first('contents') ? ' btn-danger' : 'btn-outline-primary' }} ">Assign Content and Trainer</button>
                            @error('contents') <span style="color:red">{{ $message }}</span> @enderror
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
                                    <th>Title</th>
                                    <th style="min-width:200px;">Description</th>
                                    <th>File</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                @php
                                $tags = json_decode($item->tags);
                                $tags = implode(",",$tags);
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:model="contents.{{$key}}"
                                            value="{{$item->id}}">
                                    </td>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$item->title ?? ''}}</td>
                                    <td>{{$item->description ?? ''}}</td>
                                    <td><a href="{{\Storage::disk('public')->url($item->file)}}" target="_blank"
                                            style="color: #01a9ac;">{{$item->title ?? ''}}</a></td>
                                    <td>{{optional($item->cat)->name ?? ''}}</td>
                                    <td>{{$tags}}</td>
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
                                            data-target="#updatecontent"
                                            wire:click="edit({{$item->id}})">Update</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="py-3" style="float: right;">{{$data->links()}}</div>
                </div>
            </div>
        </form>
    </div>
</div>
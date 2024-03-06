<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="margin-top: 20px;" class="row">
                        <div class="col-md-9"></div>
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
                                    <th>Total Assigned/Rescheduled Leads</th>
                                    <th>List of leads</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->assignedusers_count}}</td>
                                    <td>
                                        <a href="{{route('sales.juniorleadslist', ['id' => encrypt($item->id)])}}" class="btn btn-primary">Show List</a>
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
</div>

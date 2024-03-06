<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div style="margin-top: 20px;" class="row">
                <div class="col-md-3">
                   <h3>Lead Managment</h3>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">

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
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Lead Detail</th>
                            <th>Assigned to You On</th>
                            <th>Lead Track</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $item )
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    {{ optional($item->userRelation)->name ?? '' }}
                                </td>
                                <td>{{ optional($item->userRelation)->email ?? '' }}</td>
                                <td>{{ optional($item->userRelation)->mobilecode ?? '' }}{{ optional($item->userRelation)->mobile ?? '' }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary waves-effect"
                                        data-toggle="modal" data-target="#updatelead"
                                        wire:click="edit({{ optional($item->userRelation)->id }})">Update</button>
                                </td>
                                <td>
                                    {{ $item->created_at->diffForHumans() ?? '' }}
                                </td>
                                <td>
                                    <button type="button" class="{{demoHelperColor($item->id)}}" data-toggle="modal"
                                    data-target="#leadhistory"
                                    wire:click="getleadHistory({{$item->leadid}},{{$item->id}})">Lead History</button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align: center">No Data Found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="py-3" style="float: right;">{{ $data->links() }}</div>
            </div>
        </div>
    </div>
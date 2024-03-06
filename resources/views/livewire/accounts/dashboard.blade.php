<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Sr No.</th>
                            <th>Lead Name</th>
                            <th>Lead Email</th>
                            <th>Lead Mobile</th>
                            <th>Course Name</th>
                            <th>Original Price</th>
                            <th>Discounted Price</th>
                            <th>People</th>
                            
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->lead_id ?? 'N/A'}}</td>
                            <td>{{$item->email ?? 'N/A'}}</td>
                            <td>{{$item->mobile ?? 'N/A'}}</td>
                            <td>{{$item->course_id ?? 'N/A'}}</td>
                            <td>{{$item->price ?? 'N/A'}}</td>
                            <td>{{$item->discounted_price ?? 'N/A'}}</td>
                            <td>
                                @foreach ($item->user->stakeholders() as $value)    
                                <button class="btn btn-primary  btn-round m-1">{{App\Models\User::find($value)->name}}</button>
                                @endforeach
                                
                                
                            </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                {{-- <div class="py-3" style="float: right;">{{$data->links()}}</div> --}}
            </div>
        </div>
    </div>
</div>

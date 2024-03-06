<div>
    <div class="card">
        <div class="card-header">
            <h3>Classes</h3>
        
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
                            <th>View Class</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key=> $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name ?? ''}}</td>
                            <td>{{$item->email ?? ''}}</td>
                            <td>{{$item->mobilecode ?? ''}}{{$item->mobile ?? ''}}</td>
                            <td><a href="{{route('training.juniorclassreport',['id'=>$item->id])}}" target="_blank" >View Class</a></td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center">No Records Found</td>
                            </tr>
                        @endforelse
    
                        
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

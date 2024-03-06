<div class="card">
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Time in System</th>
                        <th>Update</th>
                        <th>Lead Track</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $data=[] as $key => $item )
    
                        <tr>
                           
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center">No Data Found</td>
                        </tr>
                    @endforelse
    
                </tbody>
            </table>
        </div>
        {{-- <div class="py-3" style="float: right;">{{ $data->links() }}</div> --}}
    </div>
</div>

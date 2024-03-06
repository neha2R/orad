<div>
    <div class="card">
        <div class="card-header"><h3>Create Leads</h3></div>
        @include('includes.leadform',['method'=>'update','createleads'=>0,'readonly'=>0,'activelang'=>1])
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if($errormessage)
                    <span style="color: red">{{$errormessage ?? ''}}</span>
                @endif
                <div class="card-header">
                    <h4>Import Bulk Leads</h4>
                    <div class="row" style="margin: 10px">
                        <div class="col-md-4"><a href="{{URL::asset('staticdata.xlsx')}}" target="_blank" class="btn btn-primary">Static Data Sheets</a></div>
                    </div>
                    <form method="post" wire:submit.prevent="save"  >
                        <div class="form-group">
                            <input type="file" wire:model="fileimport" class="form-control" id="{{$iteration}}" /> 
                            <div wire:loading wire:target="fileimport" style="color: red">Uploading...</div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                        
                    </form>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Assigned Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$item->userRelation->name ?? ''}}</td>
                                    <td>{{$item->userRelation->email ?? 'N/A'}}</td>
                                    <td>{{$item->userRelation->mobile ?? ''}}</td>
                                    <td>{{dateformat($item->created_at) ?? ''}}</td>
                                    {{-- <td>{{$item->leadStatus->where('assignedby',0)->first()->userAssignedTo->name ?? ''}}</td> --}}
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
    
    <script>
        Livewire.on('flashmessage', message => {
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

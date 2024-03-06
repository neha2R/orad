<style>

.sleadhistory {
    background-color: #f7f6f6;
    max-height: 505px;
    overflow-y: scroll;
}
.cardhistory {
    border: none;
    box-shadow: 5px 6px 6px 2px #e9ecef;
    border-radius: 4px
}

.dots {
    height: 4px;
    width: 4px;
    margin-bottom: 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block
}

.badge {
    padding: 7px;
    padding-right: 9px;
    padding-left: 16px;
    box-shadow: 5px 6px 6px 2px #e9ecef
}

.user-img {
    margin-top: 4px
}

.check-icon {
    font-size: 17px;
    color: #c3bfbf;
    top: 1px;
    position: relative;
    margin-left: 3px
}

.form-check-input {
    margin-top: 6px;
    margin-left: -24px !important;
    cursor: pointer
}

.form-check-input:focus {
    box-shadow: none
}

.icons i {
    margin-left: 8px
}

.reply {
    margin-left: 12px
}

.reply small {
    color: #b7b4b4
}

.reply small:hover {
    color: green;
    cursor: pointer
}
</style>
<div wire:ignore.self class="modal fade  bd-example-modal-lg" id="leadhistory" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLongTitle">Demo Status : {{demoHelperText($leadstatusfordemo)}} </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body sleadhistory">
              <div class="container mt-5">
                  <div class="row d-flex justify-content-center">
                      <div class="col-md-8">
                          <div class="headings d-flex justify-content-between align-items-center mb-3">
                              <h5>Lead History</h5>
                              {{-- <div class="buttons"> <span class="badge bg-white d-flex flex-row align-items-center"> <span class="text-primary">Comments "ON"</span>
                                      <div class="form-check form-switch"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
                                  </span> </div> --}}
                          </div>
                          @foreach ($leadhistorydata as $item)
                          <div class="card cardhistory p-3">

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center"> <img src="{{URL::asset('oradavtar.jpg')}}" width="30" class="user-img rounded-circle mr-2"> 
                                    <span>
                                        <small class="font-weight-bold text-primary">{{$item->title ?? ''}}</small> 

                                    <small class="font-weight-bold">{{$item->description ?? ''}}</small>
                                    </span> </div> 
                                    <small>{{dateformat($item->created_at) ?? ''}}</small>
                            </div>
                            <div class="action d-flex justify-content-between mt-2 align-items-center">
                                <div class="reply px-4"> <small>{{optional($item->user)->name ?? ''}}</small> <span class="dots"></span> <small>{{optional($item->user) ? optional($item->user)->departmentRelation ? optional($item->user)->departmentRelation->name  : '' : ''}}</small> <span class="dots"></span> <small>{{$item->user ? rolesHelper($item->user->role) : ''}}</small> </div>
                                {{-- <div class="icons align-items-center"> <i class="fa fa-star text-warning"></i> <i class="fa fa-check-circle-o check-icon"></i> </div> --}}
                            </div>
                        </div>
                          @endforeach
                        
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-9">

                <form style="width: 60%">
                    <div class="form-group" >
                        <label for="exampleFormControlTextarea1">Leave Comment As {{auth()->user()->name ?? ''}}</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model="leadhistorycomment"></textarea>
                        <button type="button" class="btn btn-primary" wire:click="leadhistorycommentstore">Submit</button>

                      </div>
                     
                </form>
              </div>
              <div class="col-md-2">
               
              </div>
           
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> --}}
          </div>
      </div>
    </div>
  </div>

{{-- <div class="modal fade" id="leadhistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="headings d-flex justify-content-between align-items-center mb-3">
                            <h5>Unread comments(6)</h5>
                            <div class="buttons"> <span class="badge bg-white d-flex flex-row align-items-center"> <span class="text-primary">Comments "ON"</span>
                                    <div class="form-check form-switch"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
                                </span> </div>
                        </div>
                        <div class="card cardhistory p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/hczKIze.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">james_olesenn</small> <small class="font-weight-bold">Hmm, This poster looks cool</small></span> </div> <small>2 days ago</small>
                            </div>
                            <div class="action d-flex justify-content-between mt-2 align-items-center">
                                <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                                <div class="icons align-items-center"> <i class="fa fa-star text-warning"></i> <i class="fa fa-check-circle-o check-icon"></i> </div>
                            </div>
                        </div>
                        <div class="card cardhistory p-3 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">olan_sams</small> <small class="font-weight-bold">Loving your work and profile! </small></span> </div> <small>3 days ago</small>
                            </div>
                            <div class="action d-flex justify-content-between mt-2 align-items-center">
                                <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                                <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                            </div>
                        </div>
                        <div class="card cardhistory p-3 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/0LKZQYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">rashida_jones</small> <small class="font-weight-bold">Really cool Which filter are you using? </small></span> </div> <small>3 days ago</small>
                            </div>
                            <div class="action d-flex justify-content-between mt-2 align-items-center">
                                <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                                <div class="icons align-items-center"> <i class="fa fa-user-plus text-muted"></i> <i class="fa fa-star-o text-muted"></i> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                            </div>
                        </div>
                        <div class="card cardhistory p-3 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/ZSkeqnd.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">simona_rnasi</small> <small class="font-weight-bold text-primary">@macky_lones</small> <small class="font-weight-bold text-primary">@rashida_jones</small> <small class="font-weight-bold">Thanks </small></span> </div> <small>3 days ago</small>
                            </div>
                            <div class="action d-flex justify-content-between mt-2 align-items-center">
                                <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                                <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
<div>
    @if(count($previousclasses))
    <div class="card">
        <div class="card-header">
            <h3>Classes Created</h3>
            {{-- <span>Add class of <code>.form-control</code> with
                <code>&lt;input&gt;</code> tag</span> --}}
            <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
        </div>
         </div>
        @else
        <div class="card">
            {{-- {{dd($content)}} --}}
            <div class="card-header">
                <h3>Create Classes</h3>
                {{-- <span>Add class of <code>.form-control</code> with
                    <code>&lt;input&gt;</code> tag</span> --}}
                <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
            </div>
            <div class="card-block">
                <form method="POST" wire:submit.prevent="submit">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-normal" placeholder="" value="{{optional($coursedetails->user)->name ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Course Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-bold" value="{{$coursedetails->course->Course->name ?? ''}} {{$coursedetails->course->name ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-capitalize" value="{{$coursedetails->discounted_price ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Days</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " value="{{$coursedetails->course->days ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Trainer</label>
                        <div class="col-sm-10">
                            <select wire:model="trainerid" class="form-control">
                                <option value="">Select One Value Only</option>
                                @foreach ($availabletrainers as $item)
                                <option value="{{$item->id}}">{{$item->name ??''}}</option> 
                                @endforeach
                                
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Slot</label>
                        <div class="col-sm-10">
                            <select wire:model="slot" class="form-control">
                                <option value="">Select One Value Only</option>
                                @foreach ($slots as $item)
                                <option value="{{$item->id}}">{{$item->from ??''}}-{{$item->to ??''}}</option> 
                                @endforeach
                                
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Assign Content</label>
                        <div class="col-sm-10">
                            <select wire:model="content" class="form-control">
                                <option value="">Select One Value Only</option>
                                @foreach ($contentcategory as $item)
                                <option value="{{$item->id}}">{{$item->name ??''}}</option> 
                                @endforeach
                                
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Starting Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control form-control-lowercase" wire:model="startdate"> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ending Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control form-control-lowercase" wire:model="enddate">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                
                </form>
            </div>
        </div>
    @endif
   
   
  @include('includes.classreporttable',['data'=>$previousclasses,'isjuniortrainer'=>0])
</div>

<form wire:submit.prevent={{ $method }} method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-2">Name :</div>
            <div class="col-md-4"> 
                <input type="text" wire:model="name" class="form-control">
                @error('name') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Email :</div>
            <div class="col-md-4"> 
                <input type="text" wire:model="email" class="form-control">
                @error('email') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">Contact :</div>
            <div class="col-md-2"> 
                <select wire:model="mobilecode" 
                        class="form-control {{ $errors->first('mobilecode') ? ' form-control-danger' : '' }}">
                        <option value="">--Select--</option>
                        @foreach (countryCodes() as $key => $item)
                            <option value="+{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                @error('mobilecode') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                 <input type="text" wire:model="mobile" class="form-control">
                 @error('mobile') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Whatsapp Number :</div>
            <div class="col-md-3">
                <input type="text" wire:model="whatsappnumber" class="form-control">
                @error('whatsappnumber') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">State :</div>
            <div class="col-md-4"> 
                <select wire:model="state" id="state"
                  class="form-control {{ $errors->first('state') ? ' form-control-danger' : '' }}">
                  <option value="">--Select--</option>
                  @foreach (indianStates() as $key => $item)
                  <option value="{{ $item }}">{{ $item }}</option>
                  @endforeach
                </select>
                @error('state') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Reference :</div>
            <div class="col-md-4">
                <select wire:model="reference" id="reference"
                    class="form-control {{ $errors->first('reference') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (referencearray() as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('reference') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            
        </div>
        <h5 class="text-info" style="margin-top: 20px">Update following info</h5>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Growth :</div>
            <div class="col-md-4">
                <select wire:model="growth" id="growth"
                    class="form-control {{ $errors->first('growth') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (growthOptions() as $key => $item)
                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('growth') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Edu Level :</div>
            <div class="col-md-4">
                <select wire:model="edulevel" id="edulevel"
                    class="form-control {{ $errors->first('edulevel') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (edulevelOptions() as $key => $item)
                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('edulevel') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">Gender :</div>
            <div class="col-md-4">
                <select wire:model="gender" id="gender"
                    class="form-control {{ $errors->first('gender') ? ' form-control-danger' : '' }}">
                    <option value="">--Select--</option>
                    @foreach (genderOptions() as $key => $item)
                        <option value="{{ $key + 1 }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('gender') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Lead Type :</div>
            <div class="col-md-4">
                <select wire:model="leadtype" id="leadtype"
                    class="form-control {{ $errors->first('leadtype') ? ' form-control-danger' : '' }}">
                    <option disabled>--Select--</option>
                    @foreach (leadtype() as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                <span style="color: red">{{$leadtypemessage ?? ''}}</span>
                @error('leadtype') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">Comments :</div>
            <div class="col-md-4">
                <textarea wire:model="comments" id="comments" rows="5" class="form-control"></textarea>
                @error('comments') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-2">Lead Keyword :</div>
            <div class="col-md-4">
                <input type="text" wire:model="leadkeyword" class="form-control">
                @error('leadkeyword') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        @if($activelang)
        <div class="row" style="margin-top: 20px" >
            <div class="col-md-2">Lead Langauge :</div>
        <div class="col-md-4">
            <select wire:model="lang" id="lang"
                class="form-control {{ $errors->first('lang') ? ' form-control-danger' : '' }}">
                <option disabled>--Select--</option>
                <option value="0">English</option>
                <option value="1">Hindi</option>
            </select>
            @error('lang') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        </div>
        @endif
        @if($createleads)
        <div class="row" style="margin-top: 20px" >
            <div class="col-md-1">SeniorSales :</div>
            <div class="col-md-3">
                <select wire:model="seniorsalesid" id="seniorsalesid"
                    class="form-control {{ $errors->first('seniorsalesid') ? ' form-control-danger' : '' }} input-opacity"
                    >
                    <option value="">--Select--</option>
                    @foreach ($seniorsalespeople as $key => $item)
                        <option value="{{$item->id ?? ''}}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('gender') <span style="color:red">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
        @if($readonly)
        @else
        <button type="submit" class="btn btn-primary waves-effect waves-light ">Update</button>
        @endif
        
    </div>
</form>

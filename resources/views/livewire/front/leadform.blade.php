<div>
  <div class="col-md-12"  style="padding:0;">
    <img src="https://orad.in/wp-content/themes/orad/images/ORADNEW.jpg" class="banner-img-pc" style="width:100%; border-bottom: 2px solid #4e58b2;">
    <div class="top-right">
       <h4 class="top-form-h-pc">Sign up for free 1-on-1 trial class
          <br>
          <span style="font-size: 15px;">
          (Limited seats only!)
          </span>
       </h4>
       <div id="erf_form_container_61" class="erf-container erf-contact erf-label-no-label erf-layout-one-column erf-style-rounded-corner">
          <div class="erf-content-above">
          </div>
          <form wire:submit.prevent="store" method="POST" class="form-pc " >
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->first('name') ? ' form-control-danger' : '' }}"
                  wire:model="name">
                @error('name') <span style="color:red">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Mobile</label>
              <div class="col-sm-4">
                <select wire:model="countrycode" id="department"
                  class="form-control {{ $errors->first('countrycode') ? ' form-control-danger' : '' }}">
                  <option value="">--Select--</option>
                  @foreach (countryCodes() as $key => $item)
                  <option value="+{{ $key }}">{{ $item }}</option>
                  @endforeach
                </select>
                @error('countrycode') <span style="color:red">{{ $message }}</span>
                @enderror
    
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control {{ $errors->first('mobile') ? ' form-control-danger' : '' }}"
                  wire:model="mobile">
                @error('mobile') <span style="color:red">{{ $message }}</span>
                @enderror
    
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control {{ $errors->first('email') ? ' form-control-danger' : '' }}"
                  wire:model="email">
                @error('email') <span style="color:red">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">State</label>
              <div class="col-sm-10">
                <select wire:model="state" id="state"
                  class="form-control {{ $errors->first('state') ? ' form-control-danger' : '' }}">
                  <option value="">--Select--</option>
                  @foreach (indianStates() as $key => $item)
                  <option value="{{ $item }}">{{ $item }}</option>
                  @endforeach
                </select>
                @error('state') <span style="color:red">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Reference</label>
              <div class="col-sm-10">
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
            <div class="row">
              <div class="col-md-12" style="text-align: right;">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
          {{-- <form wire:submit.prevent="store" method="POST" class="form-pc">
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Name</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control"
                     wire:model="name">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Mobile</label>
               <div class="col-sm-4">
                  <select wire:model="countrycode" id="department"
                     class="form-control">
                     <option value="">--Select--</option>
                  </select>
               </div>
               <div class="col-sm-6">
                  <input type="text" class="form-control "
                     wire:model="mobile">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Email</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control "
                     wire:model="email">
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">State</label>
               <div class="col-sm-10">
                  <select wire:model="state" id="state"
                     class="form-control ">
                     <option value="">--Select--</option>
                  </select>
               </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-2 col-form-label">Reference</label>
               <div class="col-sm-10">
                  <select wire:model="reference" id="reference"
                     class="form-control ">
                     <option value="">--Select--</option>
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12" style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </div>
         </form> --}}
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





{{-- <div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <h2>Sign up for free 1-on-1 trial class</h2>
      <h4 style="text-align: center;">(Limited seats only!)</h4>
      <form wire:submit.prevent="store" method="POST">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control {{ $errors->first('name') ? ' form-control-danger' : '' }}"
              wire:model="name">
            @error('name') <span style="color:red">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Mobile</label>
          <div class="col-sm-4">
            <select wire:model="countrycode" id="department"
              class="form-control {{ $errors->first('countrycode') ? ' form-control-danger' : '' }}">
              <option value="">--Select--</option>
              @foreach (countryCodes() as $key => $item)
              <option value="+{{ $key }}">{{ $item }}</option>
              @endforeach
            </select>
            @error('countrycode') <span style="color:red">{{ $message }}</span>
            @enderror

          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control {{ $errors->first('mobile') ? ' form-control-danger' : '' }}"
              wire:model="mobile">
            @error('mobile') <span style="color:red">{{ $message }}</span>
            @enderror

          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="text" class="form-control {{ $errors->first('email') ? ' form-control-danger' : '' }}"
              wire:model="email">
            @error('email') <span style="color:red">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">State</label>
          <div class="col-sm-10">
            <select wire:model="state" id="state"
              class="form-control {{ $errors->first('state') ? ' form-control-danger' : '' }}">
              <option value="">--Select--</option>
              @foreach (indianStates() as $key => $item)
              <option value="{{ $item }}">{{ $item }}</option>
              @endforeach
            </select>
            @error('state') <span style="color:red">{{ $message }}</span> @enderror
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Reference</label>
          <div class="col-sm-10">
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
        <div class="row">
          <div class="col-md-12" style="text-align: right;">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3"></div>
  </div>
</div> --}}
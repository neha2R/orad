
<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="lead.isOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': lead.isOpening(), 'opacity-100': lead.isOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': lead.isOpening(), 'mt-8': lead.isOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container"  id="importstaff" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            @if (!$readonly)
                            <span class="font-bold text-gray-700 text-lg edit-title">{{ $editId == null ? 'Create':'Update'}} Lead</span>
                            @else
                            <span class="font-bold text-gray-700 text-lg edit-title">Lead Details: </span>
                            @endif
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="lead.close()" wire:click="resetInputsLead()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    @if (!$readonly)
                    <form wire:submit.prevent="{{$method}}"  method="POST">
                    @else
                    <section>
                    @endif
                        <input type="hidden" class="edit-id" name="editId" wire:model="editID">
                        
                        <div class="px-10 py-5 text-gray-600">
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="">
                                    <label for="" class="block font-bold ">Name :</label>
                                    <input type="text" class="form-input" name="name" wire:model="name" {{$readonly ? 'readonly disabled' : 'required'}} >
                                    @error('name') <span class="text-danger">{{ $message }} @enderror
                                </div>
                                
                                <div class="">
                                    <label for="" class="block font-bold ">Email :</label>
                                    <input type="text" class="form-input" name="email" wire:model.defer="email" {{$readonly ? 'readonly disabled' : 'required'}} >
                                    @error('email') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Contact :</label>
                                    <div class="flex flex-row">
                                        <div class="w-2/5">
                                            <select wire:model="mobilecode" id="mobilecode"
                                                class="w-full pl-5 pr-10 appearance-none form-input {{ $errors->first('countrycode') ? ' form-control-danger' : '' }}">
                                                <option value="">--Select--</option>
                                                @foreach (countryCodes() as $key => $item)
                                                    <option value="+{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('mobilecode') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-3/5">
                                            <input type="text" class="form-input" name="mobile" wire:model="mobile" {{$readonly ? 'readonly disabled' : 'required'}} >
                                            @error('mobile') <span class="text-danger">{{ $message }} @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Whatsapp No. :</label>
                                    <input type="text" class="form-input" name="whatsappnumber" wire:model="whatsappnumber" {{$readonly ? 'readonly disabled' : 'required'}} >
                                    @error('whatsappnumber') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">State :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="state" onchange="this.dispatchEvent(new InputEvent('input'))" name="state">
                                            <option> Select State </option>
                                            @foreach (indianStates() as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('state') <span class="text-danger">{{ $message }} @enderror
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Reference :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="reference" onchange="this.dispatchEvent(new InputEvent('input'))" name="reference">
                                            <option> Select Reference </option>
                                            @foreach (referencearray() as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('reference') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Growth :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="growth" onchange="this.dispatchEvent(new InputEvent('input'))" name="growth">
                                            <option> Select Growth </option>
                                                @foreach (growthOptions() as $key => $item)
                                                <option value="{{ $key + 1 }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('growth') <span class="text-danger">{{ $message }} @enderror
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">EDU Level :</label>
                                        <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model.defer="edulevel" onchange="this.dispatchEvent(new InputEvent('input'))" name="edulevel">
                                            <option> Select EDU Level </option>
                                                @foreach (edulevelOptions() as $key => $item)
                                                <option value="{{ $key + 1 }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('edulevel') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Gender :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model.defer="gender" onchange="this.dispatchEvent(new InputEvent('input'))" name="course">
                                            <option> Select Gender </option>
                                            @foreach (genderOptions() as $key => $item)
                                                <option value="{{ $key + 1 }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="w-1/2">
                                    <label for="" class="block font-bold ">Lead Type :</label>
                                    <div class="flex flex-col w-full mb-4 relative">
                                        
                                        <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="leadtype" onchange="this.dispatchEvent(new InputEvent('input'))" name="leadtype">
                                            <option> Select Lead Type</option>
                                            <option value="1">Not Called Yet</option>
                                            <option value="2">Cold</option>
                                            <option value="3">Warm</option>
                                            <option value="4">Hot</option>
                                        </select>
                                    </div>
                                    @error('leadtype') <span class="text-danger">{{ $message }} @enderror
                                </div>
                            </div>
                            
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                
                                <div class="w-1/2"">
                                    <label for="" class="block font-bold ">Lead language :</label>
                                    <select class="w-full pl-5 pr-10 appearance-none form-input" wire:model="lang" onchange="this.dispatchEvent(new InputEvent('input'))" name="lang">
                                            <option> Select Language</option>
                                            <option value="1">English</option>
                                            <option value="2">Hindi</option>
                                        </select>
                                    @error('lang') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="w-1/2"">
                                    <label for="" class="block font-bold ">Lead Keyword :</label>
                                    <input type="text"  class="form-input" name="leadkeyword" wire:model.debounce.500ms='leadkeyword' {{$readonly ? 'readonly disabled' : 'required'}} >
                                    @error('leadkeyword') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                    <div class="w-full">
                                    <label for="" class="block font-bold ">Comment :</label>
                                    <textarea wire:model.defer="comments" class="form-input " name="comment" style="height: 85px"></textarea>
                                </div>
                                
                            </div>
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="lead.close()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInputsLead()">Close</button>
                            @if(!$readonly)
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >{{ $editId == null ? 'Create':'Update'}}</button>
                            @endif
                        </div>
                    @if (!$readonly)
                        
                    </form>
                    @else
                    </section>
                    @endif
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': lead.isOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
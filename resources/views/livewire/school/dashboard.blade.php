<div>
    <div class="card">
        <div class=""></div>
    </div>
    <div class="card">
        <style type="text/css">
            .uld {
                overflow-x: hidden;
                white-space: nowrap;
                height: 10em;
                width: 100%;
            }

            .lid {
                display: inline;
                font-size: 20px
            }

            .ssf {
                font-size: 20px
            }

        </style>
        <div class="card-header">
            <h3>Demo Details</h3>
            <h3 style="float: right">Demo In Order of date Descending</h3>
        </div>


        @foreach ($demos as $singledemo)
            <div class="card-block">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="{{ Storage::disk('public')->exists(optional($singledemo->trainerRelation)->profileimage) ? Storage::disk('public')->url(optional($singledemo->trainerRelation)->profileimage) : URL::asset('oradavtar.jpg') }}"
                                            class="img-radius" alt="User-Profile-Image">
                                    </div>
                                    <h6 class="f-w-800 ssf">
                                        {{ optional($singledemo->trainerRelation)->name ?? 'Not Assigned' }}</h6>
                                    <p class="ssf">Trainer</p>
                                    {{-- <i class="feather icon-edit m-t-10 f-16"></i> --}}
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h3 class="m-b-20 p-b-5 b-b-default f-w-800">Information</h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-800 ssf">Email</p>
                                            <h6 class="text-muted f-w-400"><a
                                                    href="..\..\..\cdn-cgi\l\email-protection.htm" class="__cf_email__"
                                                    data-cfemail="1e747b70675e79737f7772307d7173">info@orad.in</a>
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-800 ssf">Phone</p>
                                            <h6 class="text-muted f-w-400">
                                                +917023257320
                                            </h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-800">Demo Info</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-800 ssf">Date</p>
                                            <h6 class=" f-w-400">{{ $singledemo->date ?? 'Not Assigned' }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-800 ssf">Slot </p>
                                            <h6 class=" f-w-400">
                                                {{ optional($singledemo->slotRelation)->from ?? 'Not Assigned' }}
                                                -{{ optional($singledemo->slotRelation)->to ?? 'Not Assigned' }} </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                <li><a href="https://www.facebook.com/oradcosultancy/"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="facebook"><i
                                                            class="feather icon-facebook facebook" aria-hidden="true"
                                                            target="_blank"></i></a></li>
                                                <li><a href="https://www.linkedin.com/company/orad-consultancy"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="linkedin"><i class="fa fa-linkedin"
                                                            aria-hidden="true" target="_blank"></i></a></li>
                                                <li><a href="https://www.instagram.com/spoken_english_orad/"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="instagram"><i
                                                            class="feather icon-instagram instagram" aria-hidden="true"
                                                            target="_blank"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 social-link list-unstyled m-t-40 m-b-10"
                                            style="font-family:inherit">
                                            @if ($singledemo->certificate)
                                                @if($singledemo->student_feedback)
                                                  <a href="{{route('student.certificate',['id'=>encrypt(auth()->user()->id),'demoid'=>encrypt($singledemo->id)])}}" target="_blank">Click Here To Download Certificate</a>  
                                                @else
                                                <h5> Rate Trainer and get completion certificate</h5>
                                                <form class="form-control" style="margin: 20px" wire:submit.prevent="submit({{$singledemo->id}})">
                                                    {{-- <input type="hidden" wire:model="demoid"  /> --}}
                                                        <label>Rating</label>
                                                        <select wire:model="rating" id="department"
                                                            class="form-control {{ $errors->first('rating') ? ' form-control-danger' : '' }}">
                                                            <option value="">--Select--</option>
                                                            <option value="1">1 Star</option>
                                                            <option value="2">2 Star</option>
                                                            <option value="3">3 Star</option>
                                                            <option value="4">4 Star</option>
                                                            <option value="5">5 Star</option>
                                                        </select>
                                                        <label>Comment</label>
                                                        <input type="text" wire:model="comment" class="form-control" />
                                                        <button class="btn btn-primary" style="margin: 5px">Submit</button>
                                                    </form>
                                                @endif
                                            
                                            @else
                                                @if ($singledemo->demolink)
                                                    <li><a href="{{ $singledemo->demolink }}"
                                                            target="_blank">{{ $singledemo->demolink }}</a></li>
                                                @else
                                                    <label class="label label-warning" style="font-size: 15px">Demo Link
                                                        Will Be Available Here</label>
                                                @endif
                                            @endif



                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach




    </div>
</div>

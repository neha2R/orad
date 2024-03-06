<section class="login-block">

    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->

                <form class="md-float-material form-material" wire:submit.prevent="store">
                    <div class="text-center">
                        <img src="{{URL::asset('files\assets\images\logo.png')}}" alt="logo.png" style="max-width: 150px; max-height: 75px;">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            @if (session()->has('message'))
                            <div class="alert alert-danger icons-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                </button>
                                <p><strong>Invalid Credentials!</strong> </p>
                            </div>
                            @endif
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Sign In </h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" wire:model="mobile" class="form-control" required=""
                                    placeholder="Your Registered Mobile">
                                    
                                {{-- <span class="form-bar"></span> --}}
                                @error('email') <span class="form-ba">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group form-primary">
                                {{-- <input type="password" wire:model="password" class="form-control" required=""
                                    placeholder="Password"> --}}
                                   
                                    <div class="input-group">
                                        <input 
                                            @if($showpass)
                                            type="text"
                                            @else
                                            type="password"
                                            @endif
                                        wire:model="password" class="form-control" placeholder="Password">
                                        <span class="input-group-addon" id="basic-addon5"><i class="icofont icofont-eye" wire:click="showPassword"></i></span>
                                    </div>
                                    @error('password') <span class="form-ba">{{ $message }}</span> @enderror
                            </div>
                            <div class="text-left row m-t-25">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary d-">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="text-right forgot-phone f-right">
                                        {{-- <a href="auth-reset-password.htm" class="text-right f-w-600"> Forgot
                                            Password?</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="text-center btn btn-primary btn-md btn-block waves-effect waves-light m-b-20">Sign
                                        in</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="text-left text-inverse m-b-0">Thank you.</p>
                                    <p class="text-left text-inverse"><a href="index-1.htm"><b class="f-w-600">Back to
                                                website</b></a></p>
                                </div>
                                <div class="col-md-2">
                                    <img src="..\files\assets\images\auth\Logo-small-bottom.png" alt="small-logo.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->

</section>

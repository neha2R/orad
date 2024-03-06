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
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Forgot Password </h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" wire:model="email" class="form-control" required=""
                                    placeholder="Your Email Address">
                                @error('email') <span class="form-ba">{{ $message }}</span> @enderror
                            </div>  
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="text-center btn btn-primary btn-md btn-block waves-effect waves-light m-b-20">Sign
                                        in</button>
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

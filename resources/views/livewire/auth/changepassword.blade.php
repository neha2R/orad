<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="cover-profile">
                <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" src="..\files\assets\images\user-profile\bg-img1.jpg"
                        alt="bg-img">
                    <div class="card-block user-info">
                        <div class="col-md-12">
                            <div class="media-left">
                                <a href="#" class="profile-image">
                                    <img class="user-img img-radius"
                                        src="{{$imageurl ?? ''}}"
                                        alt="user-img" style="height: 150px;
                                        width: 201px;">
                                </a>
                            </div>
                            <div class="media-body row">
                                <div class="col-lg-12">
                                    <div class="user-title">
                                        <h2>{{ auth()->user()->name ?? '' }}</h2>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--profile cover end-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Personal Info</h5>
                    
                    </button>
                </div>
                <div class="card-block">

                    <div class="edit-info">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-info">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-user"></i></span>
                                                                    <input wire:model="name" type="text"
                                                                        class="form-control" placeholder="Full Name">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-mobile-phone"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Mobile Number" wire:model="mobile">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-mobile-phone"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Email" wire:model="email">
                                                                </div>
                                                            </td>
                                                        </tr>




                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                            <div class="col-lg-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-mobile-phone"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Department" wire:model="department"
                                                                        readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-mobile-phone"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Role" wire:model="role" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @if ($photo)
                                                                    Photo Preview:
                                                                    <img src="{{ $photo->temporaryUrl() }}"
                                                                        height="100px" width="100px">
                                                                @endif
                                                                <div class="input-group">

                                                                    <input type="file" wire:model="photo"
                                                                        class="form-control">

                                                                    @error('photo') <span
                                                                            class="error">{{ $message }}</span>
                                                                    @enderror

                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                        </div>
                                        <!-- end of row -->
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                            {{-- <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a> --}}
                                        </div>
                                    </div>
                                    <!-- end of edit info -->
                                </div>
                                <!-- end of col-lg-12 -->
                            </div>
                        </form>

                        <!-- end of row -->
                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Change Password</h5>

                </div>
                <div class="card-block">

                    <div class="edit-info">
                        <form wire:submit.prevent="changePassword">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-info">
                                        <div class="row">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-user"></i></span>
                                                                    <input wire:model="currentpassword" type="text"
                                                                        class="form-control" placeholder="Old Password">

                                                                </div>
                                                                @error('currentpassword')
                                                                    <span style="color:red">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-mobile-phone"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="New Password"
                                                                        wire:model="newpassword">
                                                                </div>
                                                                @error('newpassword')
                                                                    <span style="color:red">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i
                                                                            class="icofont icofont-mobile-phone"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Confirm New Password"
                                                                        wire:model="confirmnewpassword">
                                                                </div>
                                                                @error('confirmnewpassword')
                                                                    <span style="color:red">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>




                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                            <div class="col-lg-3"></div>
                                            <!-- end of table col-lg-6 -->
                                        </div>
                                        <!-- end of row -->
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                            {{-- <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a> --}}
                                        </div>
                                    </div>
                                    <!-- end of edit info -->
                                </div>
                                <!-- end of col-lg-12 -->
                            </div>
                        </form>

                        <!-- end of row -->
                    </div>

                </div>

            </div>

        </div>
    </div>
    <script>
        Livewire.on('flashMessage', message => {
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

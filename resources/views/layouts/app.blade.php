<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title ?? 'ORAD' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ URL::asset('files\assets\images\favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\bower_components\bootstrap\css\bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\assets\icon\themify-icons\themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('files\assets\icon\icofont\css\icofont.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('files\assets\icon\feather\css\feather.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\bower_components\bootstrap\css\bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\assets\icon\font-awesome\css\font-awesome.min.css') }}">

    <!-- Style.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('files\assets\css\style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('files\assets\css\jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\assets\pages\data-table\css\buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{URL::asset('files\assets\scss\partials\menu\_pcmenu.htm')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\bower_components\bootstrap-datepicker-1.9.0-dist\css\bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\bower_components\bootstrap-datepicker-1.9.0-dist\css\bootstrap-datepicker3.standalone.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('files\bower_components\bootstrap-tagsinput\css\bootstrap-tagsinput.css') }}" />
        <link rel="stylesheet" href="{{asset('files\bower_components\select2\css\select2.min.css')}}">
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="{{asset('files\bower_components\bootstrap-multiselect\css\bootstrap-multiselect.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('files\bower_components\multiselect\css\multi-select.css')}}">

    {{-- <link href="{{URL::asset('multiselect.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('progress-wizard.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('files\bower_components\jquery\js\jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('files\assets\js\sweetalert.js') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('files\bower_components\bootstrap-tagsinput\js\bootstrap-tagsinput.js') }}"></script>
        
    <style>
        .datepicker{
            padding: 10px !important;
        }
        .marquee {
            width: 300px;
            overflow: hidden;
            border: 1px solid #ccc;
            background: #ccc;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 42px;
            height: 25px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }


        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 15px;
            left: 0px;
            bottom: 5px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #01a9ac;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #01a9ac;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .input-opacity {
            opacity: 1 !important;
        }

        .active-border {
            border: 2px solid #007BFF;
            -webkit-box-shadow: 3px 3px 5px 3px #a59c9c;
            -moz-box-shadow: 3px 3px 5px 3px #a59c9c;
            box-shadow: 3px 3px 5px 3px #a59c9c;
            cursor: pointer;
        }

        .makepointer {

            cursor: pointer;
        }

        th,
        td {
            white-space: inherit !important;
        }

        @-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
	text-decoration: blink;
	-webkit-animation-name: blinker;
	-webkit-animation-duration: 0.6s;
	-webkit-animation-iteration-count:infinite;
	-webkit-animation-timing-function:ease-in-out;
	-webkit-animation-direction: alternate;
}

textarea{
    height: 200px !important;
}
    </style>

    @livewireStyles
    @livewireScripts
</head>

<body>

    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="">
                            <img class="img-fluid" src="{{ URL::asset('files\assets\images\logo.png') }}" alt="ORAD"
                                style="max-width: 100px; max-height: 60px;">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <span class="nav-left" style="padding: 10px">

                            @if (auth()->user()->user_type == 2)
                                <h4 class="animate__animated animate__headShake animate__infinite">Student Panel</h4>
                            @else
                                @switch(auth()->user()->role)
                                    @case(0)
                                        <h4 class="animate__animated animate__headShake animate__infinite">Ceo Panel</h4>

                                    @break
                                    @case(1)
                                        <h4 class="animate__animated animate__headShake animate__infinite">Admin Panel</h4>

                                    @break
                                    @case(2)
                                        @switch(auth()->user()->department)
                                            @case(3)
                                                <h4 class="animate__animated animate__headShake animate__infinite">Senior Sales
                                                    Panel</h4>
                                            @break
                                            @case(4)
                                                <h4 class="animate__animated animate__headShake animate__infinite">Senior Training
                                                    executive</h4>
                                            @break
                                            @default

                                        @endswitch
                                    @break
                                @case(3)
                                @switch(auth()->user()->department)
                                @case(3)
                                    <h4 class="animate__animated animate__headShake animate__infinite">Junior Sales
                                        Panel</h4>
                                @break
                                @case(4)
                                <h4 class="animate__animated animate__headShake animate__infinite">Trainer panel
                                </h4>
                                @break
                                @default

                            @endswitch
                                    
                                @break
                                @default

                            @endswitch
                        @endif

                    </span>
                    <ul class="nav-right">
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-bell"></i>
                                    <span class="badge bg-c-pink"
                                        id="noticount">{{ auth()->user()->unreadNotifications->count() }}</span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut"
                                    style="height: 300px;overflow:scroll ">
                                    <li id="notificationparent">
                                        <h6>Notifications</h6>
                                        <a href="/notifications" class="label label-danger">All notifications</a>
                                    </li>
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <li>
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="notification-user">{{  isset($notification->data['title']) ? $notification->data['title'] : 'Notification'}}</h5>
                                                    <p class="notification-msg">
                                                        {{ isset($notification->data['message'])? $notification->data['message'] : '' }}
                                                    </p>
                                                    <span
                                                        class="notification-time">{{ $notification->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </li>
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ auth()->user()->profileimage ? Storage::disk('public')->url(auth()->user()->profileimage) : URL::asset('oradavtar.jpg') }}"
                                        class="img-radius" alt="User-Profile-Image">
                                    <span>{{ auth()->user()->name ?? '' }}</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                    <li>
                                        <a href="{{ route('userprofile') }}">
                                            <i class="feather icon-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">


                @if (auth()->user()->user_type == 2)
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Student Managment</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="{{ route('student.dashboard') }}">
                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                            </ul>
                            @if (!auth()->user()->is_scholorship_user)
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="{{ route('student.studentclasses') }}">
                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                        <span class="pcoded-mtext">Student Classes</span>
                                    </a>
                                </li>
                            </ul>
                                
                            @endif

                        </div>
                    </nav>
                @else
                    @switch(auth()->user()->role)
                        @case(0)
                            <nav class="pcoded-navbar">
                                <div class="pcoded-inner-navbar main-menu">
                                    <div class="pcoded-navigatio-lavel">CEO Managment</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="{{ route('admin.dashboard') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </nav>
                        @break
                        @case(1)
                            <nav class="pcoded-navbar">
                                <div class="pcoded-inner-navbar main-menu">
                                    <div class="pcoded-navigatio-lavel">Managment</div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="">
                                            <a href="{{ route('admin.dashboard') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('admin.usermanagement') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">User Managment</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('admin.userassginment') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">User Assignment</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('admin.slot') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Slot Managment</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('admin.leadcreate') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Create Lead</span>
                                            </a>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                                <span class="pcoded-mtext">Department</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="{{ route('admin.departments') }}">
                                                        <span class="pcoded-mtext">Departments</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('admin.subdepartments') }}">
                                                        <span class="pcoded-mtext">Sub Department</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                                <span class="pcoded-mtext">Course Managment</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="{{ route('admin.course') }}">
                                                        <span class="pcoded-mtext">Parent Course</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('admin.coursetype') }}">
                                                        <span class="pcoded-mtext">Course Type</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('admin.discountmanager') }}">
                                                        <span class="pcoded-mtext">Discount Managment</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('admin.adminFaqs') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Create FAQs</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('admin.empOfMonth') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Emp. of month</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('admin.ourClients') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Our Clients</span>
                                            </a>
                                        </li>
                                        {{-- <li class="">
                                            <a href="{{ route('admin.meetOurTutor') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Meet Our Tutor</span>
                                            </a>
                                        </li> --}}

                                         <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                                <span class="pcoded-mtext">Exam Managment</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="{{ route('admin.instruction') }}">
                                                        <span class="pcoded-mtext">Instructions</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('admin.paper') }}">
                                                        <span class="pcoded-mtext">Exam Paper</span>
                                                    </a>
                                                </li>
                                               
                                            </ul>
                                        </li>

                                    </ul>

                                </div>
                            </nav>
                        @break
                        @case(2)
                            @switch(auth()->user()->department)
                                @case(3)
                                    <nav class="pcoded-navbar">
                                        <div class="pcoded-inner-navbar main-menu">
                                            <div class="pcoded-navigatio-lavel">Senior Sales Managment</div>
                                            <ul class="pcoded-item pcoded-left-item">
                                                <li class="">
                                                    <a href="{{ route('sales.dashboard') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Dashboard</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('sales.seniorsalesteam') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Team</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('sales.createleadsenior') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Create Lead</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('sales.seniorreport') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Report</span>
                                                   </a>
                                                    <!-- <a href="{{ route('sales.reports') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Reports</span>
                                                    </a> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                @break
                                @case(4)
                                    <nav class="pcoded-navbar">
                                        <div class="pcoded-inner-navbar main-menu">
                                            <div class="pcoded-navigatio-lavel">Senior Training Managment</div>
                                            <ul class="pcoded-item pcoded-left-item">
                                                <li class="">
                                                    <a href="{{ route('training.seniordashboard') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Dashboard</span>
                                                    </a>
                                                </li>
                                               <li class="">
                                                    <a href="{{ route('training.reports') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Reports</span>
                                                    </a>
                                                </li>
                                               
                                                <li class="">
                                          
                                        </li>
                                            </ul>
                                        </div>
                                    </nav>
                                @break
                                @case(5)
                                    <nav class="pcoded-navbar">
                                        <div class="pcoded-inner-navbar main-menu">
                                            <div class="pcoded-navigatio-lavel">Senior Content Managment</div>
                                            <ul class="pcoded-item pcoded-left-item">
                                                <li class="">
                                                    <a href="{{ route('content.seniordashboard') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Dashboard</span>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="{{ route('content.contentcategory') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Content Category</span>
                                                    </a>
                                                </li>
                                               
                                                {{-- <li class="">
                                            <a href="{{ route('sales.seniorsalesteam') }}">
                                                <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                <span class="pcoded-mtext">Team</span>
                                            </a>
                                        </li> --}}
                                            </ul>
                                        </div>
                                    </nav>
                                @break
                                @case(6)
                                    <nav class="pcoded-navbar">
                                        <div class="pcoded-inner-navbar main-menu">
                                            <div class="pcoded-navigatio-lavel">Accounts Department</div>
                                            <ul class="pcoded-item pcoded-left-item">
                                                <li class="">
                                                    <a href="{{ route('accounts.accountdashboard') }}">
                                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                                        <span class="pcoded-mtext">Dashboard</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                @break
                                @default

                            @endswitch
                        @break
                    @case(3)
                    
                    @switch(auth()->user()->department)
                                    
                        @case(3)
                        
                        <nav class="pcoded-navbar">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigatio-lavel">Junior Managment</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="{{ route('sales.juniordashboard') }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('sales.createleadjunior') }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">Create Lead</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('sales.juniorreport') }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">Report</span>
                                        </a>
                                    </li>



                                </ul>

                            </div>
                        </nav>
                            @break
                        @case(4)
                        
                        <nav class="pcoded-navbar">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigatio-lavel">Junior Training</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="{{ route('training.juniordashboard') }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">Dashboard</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="{{ route('training.juniorclasses') }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">Class Managment</span>
                                        </a>
                                    </li>
                                </ul>
                                

                            </div>
                        </nav>
                        @break
                        @case(5)
                        
                        <nav class="pcoded-navbar">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigatio-lavel">Junior Content</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="{{ route('content.juniordashboard') }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">Dashboard</span>
                                        </a>
                                    </li>
                                </ul>
                                

                            </div>
                        </nav>
                            @break
                        @default
                            
                    @endswitch
                        
                    @break
                    @default

                @endswitch
            @endif



            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- Main-body start -->
                    <div class="main-body">
                        <div class="{{ !auth()->user()->is_scholorship_user ? 'page-wrapper' : ''}}">
                            <!-- Page-header start -->
                            <div class="page-header">
                                <div class="row align-items-end">
                                    <div class="col-lg-8">
                                        <div class="page-header-title">
                                            <div class="d-inline">
                                                <p style="font-weight: bold; font-size:20px;">
                                                    {{ $pageheading ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        {{-- <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Widget</a> </li>
                                                </ul>
                                            </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Page-header end -->

                            <div class="page-body">
                                {{ $slot }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<div class="ie-warning">
<h1>Warning!!</h1>
<p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
to access this website.</p>
<div class="iew-container">
<ul class="iew-download">
<li>
<a href="http://www.google.com/chrome/">
    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
    <div>Chrome</div>
</a>
</li>
<li>
<a href="https://www.mozilla.org/en-US/firefox/new/">
    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
    <div>Firefox</div>
</a>
</li>
<li>
<a href="http://www.opera.com">
    <img src="../files/assets/images/browser/opera.png" alt="Opera">
    <div>Opera</div>
</a>
</li>
<li>
<a href="https://www.apple.com/safari/">
    <img src="../files/assets/images/browser/safari.png" alt="Safari">
    <div>Safari</div>
</a>
</li>
<li>
<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
    <img src="../files/assets/images/browser/ie.png" alt="">
    <div>IE (9 & above)</div>
</a>
</li>
</ul>
</div>
<p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->

<script type="text/javascript" src="{{ URL::asset('files\bower_components\jquery-ui\js\jquery-ui.min.js') }}">
</script>
{{-- <script type="text/javascript" src="{{ URL::asset('files\bower_components\popper.js\js\popper.min.js') }}"> </script> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('files\bower_components\bootstrap\js\bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript"
src="{{ URL::asset('files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->

<script type="text/javascript" src="{{ URL::asset('files\bower_components\modernizr\js\modernizr.js') }}">
</script>
<script type="text/javascript" src="{{ URL::asset('files\bower_components\modernizr\js\css-scrollbars.js') }}">
</script>

<!-- i18next.min.js -->
<script type="text/javascript" src="{{ URL::asset('files\bower_components\i18next\js\i18next.min.js') }}">
</script>
<script type="text/javascript"
src="{{ URL::asset('files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript"
src="{{ URL::asset('files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js') }}">
</script>
<script type="text/javascript" src="{{ URL::asset('files\assets\js\jquery.quicksearch.js') }}"></script>


<script type="text/javascript"
src="{{ URL::asset('files\bower_components\jquery-i18next\js\jquery-i18next.min.js') }}"></script>
<script src="{{ URL::asset('files\assets\js\pcoded.min.js') }}"></script>
<script src="{{ URL::asset('files\assets\js\vartical-layout.min.js') }}"></script>
<script src="{{ URL::asset('files\assets\js\jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ URL::asset('files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('files\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js') }}">
</script>
<script src="{{ URL::asset('files\assets\pages\data-table\js\jszip.min.js') }}"></script>
<script src="{{ URL::asset('files\assets\pages\data-table\js\pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('files\assets\pages\data-table\js\vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('files\bower_components\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('files\bower_components\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}">
</script>
<script
src="{{ URL::asset('files\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js') }}">
</script>
<script
src="{{ URL::asset('files\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}">
</script>
<script
src="{{ URL::asset('files\bower_components\bootstrap-datepicker-1.9.0-dist\js\bootstrap-datepicker.js') }}">
</script>

<script type="text/javascript" src="{{Url::asset('files\bower_components\select2\js\select2.full.min.js')}}"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="{{Url::asset('files\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js')}}">


</script>
<script type="text/javascript" src="{{Url::asset('files\bower_components\multiselect\js\jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{Url::asset('files\assets\js\jquery.quicksearch.js')}}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{Url::asset('files\assets\pages\advance-elements\select2-custom.js')}}"></script>

<!-- Custom js -->
<script type="text/javascript" src="{{ URL::asset('files\assets\js\script.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> --}}
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}

<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;
var pusher = new Pusher('376e5739a7cde0a14c72', {
    wsHost: window.location.hostname,
    // cluster:'ap2',
    wssPort: 6001,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
    // disableStats: true,
    enabledTransports: ['ws','wss']

});
var userid = {{ auth()->user()->id }}
var channelName = 'userid-' + userid
console.log(channelName);
// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('status-liked');
// Bind a function to a Event (the full Laravel class)
channel.bind(channelName, function(data) {
    // console.log(data.message)
    var currentcount = parseInt($('#noticount').html()) + 1
    $('#noticount').html('')
    $('#noticount').html(currentcount)
    $("#noticount").effect("shake");
    var notificationsingle =
        '<li><div class="media"><div class="media-body"><h5 class="notification-user">Notification</h5><p class="notification-msg">' +
        data.message + '</p><span class="notification-time">now</span></div></div></li>';
    $('#notificationparent').after(notificationsingle)
});

$('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true
});
</script>

</body>

</html>

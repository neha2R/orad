@php
    $department = auth()->user()->department;
    $sub_department = auth()->user()->sub_department;
    $role = auth()->user()->role;
    $usertype=auth()->user()->user_type;
    
@endphp
<aside class="flex-shrink-0 hidden w-64 bg-white shadow-lg md:block">
  <div class="flex flex-col h-full">
    <!-- Sidebar links -->
    <img src="{{ asset('img/logo/dashboard-logo.png') }}" alt="ORAD" class="mx-3 my-3 w-28">
    @if($usertype == 2 && !auth()->user()->is_scholorship_user)
      @include('layouts.navigations.desktop.student')
    @endif

    @switch($department)
      @case(1)
        @include('layouts.navigations.desktop.ceo')
      @break;
      @case(2)
        @include('layouts.navigations.desktop.admin')
      @break;
      @case(3)
        @switch($role)
          @case(3)
            @if ($sub_department == 2)
              @include('layouts.navigations.desktop.bde-intern')
              @break;
            @else
              @include('layouts.navigations.desktop.bde-junior')
              @break;
            @endif
          @default
            @if ($sub_department == 2)
              @include('layouts.navigations.desktop.bde-team-lead')
              @break;
            @else
              @include('layouts.navigations.desktop.bdm-team-lead')
              @break;
            @endif
        @endswitch
      @break
      @case (4)
        @switch ($role)
            @case (3)
                @if ($sub_department == 3)
                  @include('layouts.navigations.desktop.demo_trainer')
                  @break;
                @else
                  @include('layouts.navigations.desktop.class_trainer')
                  @break;
                @endif
            @break;
            
            @default
                @if ($sub_department == 3)
                  @include('layouts.navigations.desktop.demo_manager')
                  @break;
                @else
                  @include('layouts.navigations.desktop.qa_manager')
                  @break;
                @endif
            @break;
            
        @endswitch
      @break;
      @default
      @break;    
    @endswitch
    <div class="flex hidden md:block">
      {{-- <img src="{{ asset('img/background/Img2.png') }}" alt="Img2" class="w-full"> --}}
    </div>
  </div>
</aside>

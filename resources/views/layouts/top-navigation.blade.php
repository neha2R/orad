<header class="relative bg-white shadow-lg">
    <div class="flex items-center justify-between p-2 border-b ">
    <!-- Mobile menu button -->
    <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
        class="p-1 text-gray-400 transition-colors duration-200 rounded-md bg-gray-50 hover:text-gray-600 hover:bg-blue-100 md:hidden focus:outline-none focus:ring">
        <span class="sr-only">Open main manu</span>
        <span aria-hidden="true">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        </span>
    </button>

    <!-- Search -->
    <div class="flex flex-wrap items-stretch lg:w-1/3 w-1/2 mb-4 relative">
        <div class="flex -mr-px mt-2">
        <span
            class="flex items-center bg-grey-lighter leading-normal text-xl pl-3 whitespace-no-wrap text-gray-dark">
            {{userPost()}}
        </span>
        </div>
    </div>

    <!-- Desktop Right buttons -->
    <nav aria-label="Secondary" class=" space-x-2  flex items-center justify-between px-3">
        <!-- notificationsPanel -->
        <div class="">
          <div class="flex justify-center">
              <div x-data="{ dropdownOpen: false }" class="relative">
                  <button id="bellicone" @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                    <span  id="noticount" class="bg-primary px-2 py-1 rounded-full relative  text-white text-xs ml-2">{{ auth()->user()->unreadNotifications->count() }}</span>
                      <img class="w-5 h-7 mr-3 -mt-4" src="{{ asset('img/icons/black/Notification.svg') }}"" alt="img">
                  </button>

                  <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                  <div x-show="dropdownOpen" id="importnotification" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:20rem;display:none;">
                      <div class="py-2 h-72 overflow-x-hidden overflow-y-auto" id="notificationparent">
                        @forelse (auth()->user()->unreadNotifications as $notification)
                          <div  class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                            <p class="text-gray-600 text-sm mx-2">
                                <span class="font-normal text-sm notification-msg">{{ isset($notification->data['message'])? $notification->data['message'] : '' }}</span> 
                                <span class="notification-time text-primary">{{ $notification->created_at->diffForHumans() }}</span>
                            </p>
                          </div>
                        @empty 
                         <div  class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2" id="emptynotification">
                            <p class="text-gray-600 text-sm mx-2">
                              no record found...
                            </p>
                         </div>
                        @endforelse

                      </div>
                      <a href="{{route('notificationpage')}}" class="block bg-gray-800 text-white text-center font-bold py-2">See all notifications</a>
                  </div>
              </div>
          </div>
          
        </div>
        <!-- notificationsPanel -->

        <!-- User avatar button -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })" type="button"
                aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                class="transition-opacity duration-200 rounded-full focus:outline-none ">
                <span class="sr-only">User menu</span>
                <div class="flex justify-between items-center">

                <img src="{{ userPhoto(auth()->user()->id) }}" alt="avatar" class="rounded-full w-10 h-10 ">

                <span class="font-normal mx-2 hidden md:block">{{ucwords(auth()->user()->name)}}</span>
                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>

                </div>

            </button>

            <!-- User dropdown menu -->
            <div x-show="open" x-ref="userMenu" x-transition:enter="transition-all transform ease-out"
                x-transition:enter-start="translate-y-1/2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition-all transform ease-in"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                @keydown.escape="open = false"
                class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 focus:outline-none"
                tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                <a href="{{route('profile')}}" role="menuitem"
                class="block px-4 py-2 text-lg inactive transition-colors hover:bg-gray-100  flex justify-start items-center">
                <img src="{{ asset('img/icons/blue/Profile.svg') }}"" alt="" class="w-4">
                <span class="ml-3">Profile</span>
                </a>
                <a href="{{ route('change-password')}}" role="menuitem"
                class="block px-4 py-2 text-lg inactive transition-colors hover:bg-gray-100  flex justify-start items-center">
                <img src="{{ asset('img/icons/blue/Lock.svg') }}"" alt="" class="w-4">
                <span class="ml-3">Password</span>

                </a>
                <form >
                <a href="{{route('logout')}}" role="menuitem" 
                    class="block px-4 py-2 text-lg inactive transition-colors hover:bg-gray-100  flex justify-start items-center">
                    <img src="{{ asset('img/icons/blue/SignOut.svg') }}"" alt="" class="w-5">
                    <span class="ml-2">Sign Out</span>
                </a>

                </form>
            </div>
        </div>
    </nav>

    </div>
    <!-- Mobile main manu -->
    <div class="border-b md:hidden " x-show="isMobileMainMenuOpen" @click.away="isMobileMainMenuOpen = false">
    @php
        $department = auth()->user()->department;
        $sub_department = auth()->user()->sub_department;
        $role = auth()->user()->role;
        $usertype=auth()->user()->user_type;
        
    @endphp
    @if($usertype == 2 && !auth()->user()->is_scholorship_user)
      @include('layouts.navigations.mobile.student')
    @endif

    @switch($department)
      @case(1)
        @include('layouts.navigations.mobile.ceo')
      @break;
      @case(2)
        @include('layouts.navigations.mobile.admin')
      @break;
      @case(3)
        @switch($role)
          @case(3):
            @if ($sub_department == 2)
              @include('layouts.navigations.mobile.bde-intern')
              @break;
            @else
              @include('layouts.navigations.mobile.bde-junior')
              @break;
            @endif
          @default:
            @if ($sub_department == 2)
              @include('layouts.navigations.mobile.bdm-team-lead')
              @break;
            @else
              @include('layouts.navigations.mobile.bde-team-lead')
              @break;
            @endif
        @endswitch
      @break;
      @case (4)
        @switch ($role)
            @case (3)
                @if ($sub_department == 3)
                  @include('layouts.navigations.mobile.demo_trainer')
                  @break;
                @else
                  @include('layouts.navigations.mobile.class_trainer')
                  @break;
                @endif
            @break;
            
            @default
                @if ($sub_department == 3)
                  @include('layouts.navigations.mobile.demo_manager')
                  @break;
                @else
                  @include('layouts.navigations.mobile.qa_manager')
                  @break;
                @endif
            @break;
            
        @endswitch
      @break;
      @default
      @break;   
    @endswitch
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script>
        $(document).ready(function() {
    $("#bellicone").click(function(){
      document.getElementById("importnotification").style.display = "block";
    }); 
});
       </script> 
</header>
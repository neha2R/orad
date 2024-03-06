<nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
  <!-- Dashboards links -->
  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-blue-100 ' -->
    <a href="{{route('student.dashboard')}}" class="{{activeTab('dashboard')}} nav-tab">
      <span aria-hidden="true">
        <img src='{{ asset("img/icons/blue/Dashboard.svg") }}' alt="Dashboard" class="w-5 h-5">

      </span>
      <span class="ml-3 text-md"> Dashboards </span>
    </a>

  </div>


  <!-- User links -->

  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-blue-100 ' -->
    <a href="{{ route('classSchedule') }}" class="inactive nav-tab">
      <span aria-hidden="true">
        <img src="{{ asset('img/icons/black/User.svg') }}" alt="User" class="w-5 h-5">

      </span>
      <span class="ml-3 text-md"> Class Schedule </span>
    </a>

  </div>

  <!-- Events links -->
  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-blue-100 ' -->
    <a href="{{ route('student.reports')}}" class="inactive nav-tab">
      <span aria-hidden="true">
        <img src="{{ asset('img/icons/black/Events.svg') }}" alt="Events" class="w-5 h-5">

      </span>
      <span class="ml-3 text-md"> Reports </span>
    </a>

  </div>

  <!-- Profile links -->
  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-blue-100 ' -->
    <a href="{{ route('profile') }}" class=" inactive nav-tab">
      <span aria-hidden="true">
        <img src="{{ asset('img/icons/black/Profile.svg') }}" alt="Profile" class="w-5 h-5">

      </span>
      <span class="ml-3 text-md"> Profile </span>
    </a>

  </div>

  <!-- Sign Out links -->
  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-blue-100 ' -->
      <a href="{{ route('logout') }}" class="inactive nav-tab">
        <span aria-hidden="true">
          <img src="{{ asset('img/icons/black/SignOut.svg') }}" alt="Profile" class="w-5 h-5">

        </span>
        <span class="ml-3 text-md"> Sign Out </span>
      </a>
  </div>


</nav>
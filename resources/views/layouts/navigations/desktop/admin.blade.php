<nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-scroll hover:overflow-y-auto">
  <!-- Dashboards links -->
  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-blue-100 ' -->
    <a href="{{route('admin.dashboard')}}" class="{{activeTab('dashboard')}} nav-tab">
      <span aria-hidden="true">
        <img src='{{ asset("img/icons/blue/Dashboard.svg") }}' alt="Dashboard" class="w-5 h-5">

      </span>
      <span class="ml-3 text-md"> Dashboards </span>
    </a>

  </div>

  {{-- employee Management  --}}
  <div x-data="{ open: false }">
      <button @click="open = !open" class="sub-nav-tab">
          <span class="flex items-center">
              <span aria-hidden="true">
                <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Employee Management" class="w-5 h-5">
              </span>

              <span class="ml-3 text-md">Emp. Management</span>
          </span>

          <span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                  <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
          </span>
      </button>

      <div x-show="open" class="bg-gray-100 pl-5">
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.usermanagement') }}">
              <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Employee" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Employee</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.slotmanagement') }}">
              <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Employee" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Trainer Slots</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('createmeeting') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Dashboard" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">PR Meeting</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('leave') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Leave" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Your Leaves</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('leave-approve') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Leave Approve" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Staff Leaves</span>
          </a>
      </div>
  </div>

  {{-- leads  --}}
  <div x-data="{ isActive: false, open: false}">
    <!-- active & hover classes 'bg-blue-100 ' -->
    <a href="{{route('admin.leadcreate')}}" class="{{activeTab('leadcreate')}} nav-tab">
      <span aria-hidden="true">
        <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Dashboard" class="w-5 h-5">
      </span>
      <span class="ml-3 text-md">Leads</span>
    </a>
  </div>


  {{-- Web Management  --}}
  <div x-data="{ open: false }">
      <button @click="open = !open" class="sub-nav-tab">
          <span class="flex items-center">
              <span aria-hidden="true">
                <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Web Settings" class="w-5 h-5">
              </span>

              <span class="ml-3 text-md">Web Settings</span>
          </span>

          <span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                  <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
          </span>
      </button>

      <div x-show="open" class="bg-gray-100 pl-5">
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.course') }}">
              <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="courses" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Courses</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.discountmanager') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="discountmanager" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Discount Management</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.empOfMonth') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="empOfMonth" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Emp. of Month</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.adminFaqs') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="adminFaqs" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">FAQs</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.ourClients') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="ourClients" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md">Our clients</span>
          </a>
      </div>
  </div>

  {{-- examination  --}}
  <div x-data="{ open: false }">
      <button @click="open = !open" class="sub-nav-tab">
          <span class="flex items-center">
              <span aria-hidden="true">
                <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="Examination" class="w-5 h-5">
              </span>

              <span class="ml-3 text-md">Examination</span>
          </span>

          <span>
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                  <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
          </span>
      </button>

      <div x-show="open" class="bg-gray-100 pl-5">
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.instruction') }}">
              <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="instuction" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md"> Instructions</span>
          </a>
          <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.paper') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="paper" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md"> Exam Paper</span>
          </a>
          {{-- <a class="py-2 px-16 block text-sm text-mute nav-tab" href="{{ route('admin.discountmanager') }}">
            <span aria-hidden="true">
              <img src='{{ asset("img/icons/black/Dashboard.svg") }}' alt="result" class="w-5 h-5">

            </span>
            <span class="ml-3 text-md"> Result</span>
          </a> --}}
      </div>
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


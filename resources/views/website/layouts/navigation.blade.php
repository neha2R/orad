<nav class="flex items-center bg-warning text-gray-900 p-3 flex-wrap lg:px-16">
      <a href="{{ route('home') }}" class="p-2 mr-4 inline-flex items-center lg:-mt-6">
        <img loading="lazy"  src="{{asset('images/png/Logo.png')}}" alt="orad" class="w-28">
      </a>
      <button
        class="text-white inline-flex p-3 lg:hidden ml-auto hover:text-white outline-none nav-toggler"
        data-target="#navigation"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-8 h-8"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </button>
      <div
        class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto"
        id="navigation"
      >
        <div
          class=" flex flex-col lg:flex-row lg:flex-wrap lg:justify-between lg:w-full lg:items-center lg:pt-4 px-2 pt-12 pb-3"
        >
          <div class="flex lg:justify-start flex-col lg:gap-10 lg:flex-row lg:itmes-cetner">
          
            {{-- <div x-data="{ dropdownOpen: false }" class="relative cursor-pointer px-2 pb-3 "  @click="dropdownOpen = ! dropdownOpen">
              <button   class="relative z-10 block focus:outline-none " >
              Our Courses
              </button>

              <div x-show="dropdownOpen" class="fixed inset-0 h-full w-full z-10"></div>

              <div x-show="dropdownOpen" class="absolute mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                @foreach (personalCourses() as $item)
                  <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">{{$item->name}} </a>
                @endforeach
                
              </div>
            </div> --}}
            <a href="{{ route('home') }}/#our_courses" class="px-2 pb-3 {{ activeClass('organization')}}" >
              <span>Our Courses</span>
            </a>
            <a href="{{ route('organization') }}" class="px-2 pb-3 {{ activeClass('organization')}}" >
              <span>For Organization</span>
            </a>
            <a href="{{ route('faq') }}" class="px-2 pb-2 {{ activeClass('faq')}}" >
              <span>FAQ</span>
            </a>
          </div>

          <div class="flex lg:justify-start flex-col lg:flex-row lg:itmes-cetner">
            <div class="-ml-1 w-full md:w-24 relative bg-warning px-2 pb-2 lg:mt-3">
                <select class="bg-warning h-10 w-full text-gray-900 font-medium lg:w-28 lg:-ml-8 focus:outline-none">
                    <option>English</option>
                    <option>Hindi</option>
                </select>
            </div>
            <a href="{{ route('login') }}"
            class="border border-gray-900 bg-warning rounded px-6 py-2 m-2"
            >
              <span>Sign In</span>
            </a>
            <a
              href="{{ route('register') }}"
              class="border border-red-500 bg-danger rounded px-6 py-2 m-2"
            >
              <span>Sign Up</span>
            </a>
          </div>
        </div>
      </div>
    </nav>

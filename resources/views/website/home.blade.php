<div>
    <section class="home-background">
        <div class="container mx-auto px-8 md:px-16 py-8 md:py-0">
            <div class="grid md:grid-cols-2 grid-rows-2 md:grid-rows-1 md:pb-4 pb-7">
                <div class="row-start-2 md:row-start-1 -mb-16">
                    <img loading="lazy"   src="{{ asset('images/png/BannerImage.png') }}" alt="courses" class="mx-auto md:block">
                </div>
                <div class="my-auto ml-auto md:grid-row-1 grid-row-start-1">
                    <a href="{{ route('register') }}" class="shine-button text-white border bg-danger rounded-full py-1 px-2  font-normal text-center flex flex-row h-14"><span class="my-auto ml-2">Sign up for free trial Class </span><img loading="lazy"   src="{{ asset('images/icons/SignUpArrow.svg') }}" alt="signup" class="w-11 md:ml-5 ml-2"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="personal-goal mt-28 mf:mt-36 md:mb-{{$courses->count() > 3 ? "46":'18'}} " id="our_courses">
        <div class="container mx-auto px-8 pt-8">
            <h3 class="text-2xl md:text-3xl font-semibold text-primary pb-4 text-center">Our Specialised English Courses</h3>
            <div class="flex flex-row justify-center items-start align-center mt-5">
                @foreach ($parentCourse as $item)
                    <div class="cursor-pointer flex flex-col px-1 md:px-8 py-2 items-center text-center relative {{ $item['id'] == $parentId ? 'active-course' : ''}} shadow-lg" wire:click="changeCourseParent({{ $item['id'] }})"><span class="text-normal md:text-xl font-bold tracking-normal md:tracking-wider pb-2 " >{{ $item['name'] }} Class</span><span class="text-sm font-normal child">({{$item['detail']}})</span>
                        @if ($item['id'] == '0')
                            <div class="ribbon-container">
                                <div class="ribbon shine-button">Save Extra 50%</div>
                            </div>
                        @endif
                    </div>
                @endforeach
                
            </div>
            <h3 class="text-2xl md:text-3xl  font-semibold text-primary py-4 text-center" >Our Curriculum</h3>
            {{-- <div class="owl-carousel carriculum owl-theme mt-5"> --}}
            <div class="flex flex-row flex-wrap justify-center items-start align-center mt-5">
                @foreach ($courses as $item)
                {{-- <div class="item"> --}}
                    <p class="cursor-pointer  flex flex-col px-2 md:px-8 py-4 items-center text-center {{ $item->id == $courseid ? 'active-course' : ''}} shadow-lg"  wire:click="changeCourseChild({{ $item->id }})">
                        <span class=" text-normal md:text-xl font-bold tracking-wider child"> {{$item->name}}</span>
                        <span class=" text-sm font-normal"> ({{$item->title}})</span>
                    </p>
                {{-- </div> --}}
                    
                @endforeach
            </div>
            
            <div class="card-container" >
                <div class="relative flex md:flex-row flex-col cards justify-{{$coursesType->count() ? 'between' : 'center'}} items-end mb-8 md:mb-2" id="card-container">

                    @forelse ($coursesType as $key => $item)     
                        @php
                            $title = $item->Course->title ?? '';
                        @endphp
                        @if ($coursesType->count() >0 && $coursesType->count() < 2)
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="md:relative absolute card group group-class item1 flex-grow mx-5 my-3 md:my-12 {{ $key == 0 ? 'active' : '' }}  w-3/4 md:w-auto">
                                    <div class="md:flex flex-col items-center justify-center bg-white shadow-lg-xy rounded-xl transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 group-child">
                                        <div class="bg-light w-full card-cover">
                                            <div class="flex flex-col px-2">
                                                <h5 class="mt-4 text-2xl group-hover:text-white text-dark font-bold ">{{ $item->name }}</h5>
                                                {{-- <h6 class="text-sm text-mute group-hover:text-white font-normal ">{{$item->Course->title != null ? "( $title )" : '' }}</h6> --}}
                                                <div class="flex justify-between text-mute text-sm group-hover:text-white font-bold mt-8 pb-2">
                                                    <span>{{ $item->no_of_classes }} Classes</span> 
                                                    <span class="text-white save-flag bg-danger group-hover:bg-white px-2 py-1">SAVE {{$item->discount}}%</span> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col mt-5 px-2 py-4 w-full">
                                            <p class="font-normal text-sm text-mute">{{$item->description}}
                                                <a href="#" download="{{ $item->carriculam_file }}" class="mt-4 font-normal text-sm text-primary underline">know More</a>

                                            </p>
                                            
                                            <div class="mb-4 flex flex-row mt-12 gap-2 justify-between items-center">
                                                <div class="flex flex-row gap-2">
                                                    <div class="w-auto md:w-7">
                                                        <img src="{{asset('images/icons/Rupee.svg')}}" alt="Rs" class="md:w-8 md:h-8 w-6 h-6">
                                                    </div>
                                                    <h6 class="text-md md:text-xl text-primary font-bold ">{{ ceil($item->discounted_price != 0 ? $item->discounted_price : $item->price) }}/-</h6>
                                                </div>
                                                <div class="flex flex-row md:gap-2">
                                                    {{-- <div class="text-md md:text-xl text-primary font-bold md:block hidden"> <span> MRP:- </span></div> --}}
                                                    <div class="text-md md:text-xl text-primary font-bold md:flex md:flex-rows"> <span class="line-through ">{{ ceil($item->price) }}</span> <span class="md:block hidden">/-</span></div>
                                                </div>
                                            </div>

                                            <div class="flex flex-col md:flex-row text-sm justify-between w-full">
                                                {{-- <a href="{{ route('demoClass') }}" class="text-center btn-primary px-4 py-2 mb-4">Book your free trial</a> --}}
                                                <a href="{{ route('payment',encrypt(['parent_id'=>$item->course_id,'course'=>$item->id, 'payment_id'=>null])) }}" class="text-center btn-primary px-4 py-2 mb-4 w-full">Buy Now</a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endfor
                        @else
                        @php
                            $incrementedkey = $key+1;
                        @endphp
                        <div data-card="{{ $incrementedkey }}" class="card md:relative absolute group group-class item1 flex-grow mx-5 my-3 md:my-12 {{ $key == 0 ? 'active' : '' }} w-3/4 md:w-auto">
                            <div class="md:flex flex-col items-center justify-center bg-white shadow-lg-xy rounded-xl transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 group-child">
                                <div class="bg-light w-full card-cover">
                                    <div class="flex flex-col px-2">
                                        <h5 class="mt-4 text-2xl group-hover:text-white text-dark font-bold ">{{ $item->name }}</h5>
                                        {{-- <h6 class="text-sm text-mute group-hover:text-white font-normal ">{{$item->Course->title != null ? "( $title )" : '' }}</h6> --}}
                                        <div class="flex justify-between text-mute text-sm group-hover:text-white font-bold mt-8 pb-2">
                                            <span>{{ $item->no_of_classes }} Classes</span> 
                                            <span class="text-white save-flag bg-danger group-hover:bg-white px-2 py-1">SAVE {{$item->discount}}%</span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col mt-5 px-2 py-4 w-full">
                                    <p class="font-normal text-sm text-mute">{{$item->description}}
                                        <a href="#" download="{{ $item->carriculam_file }}" class="mt-4 font-normal text-sm text-primary underline">know More</a>

                                    </p>
                                    
                                    <div class="mb-4 flex flex-row mt-12 gap-2 justify-between items-center">
                                        <div class="flex flex-row gap-2">
                                            <div class="w-auto md:w-7">
                                                <img src="{{asset('images/icons/Rupee.svg')}}" alt="Rs" class="md:w-8 md:h-8 w-6 h-6">
                                            </div>
                                            <h6 class="text-md md:text-xl text-primary font-bold ">{{ ceil($item->discounted_price != 0 ? $item->discounted_price : $item->price) }}/-</h6>
                                        </div>
                                        <div class="flex flex-row md:gap-2">
                                            {{-- <div class="text-md md:text-xl text-primary font-bold md:block hidden"> <span> MRP:- </span></div> --}}
                                            <div class="text-md md:text-xl text-primary font-bold md:flex md:flex-rows"> <span class="line-through ">{{ ceil($item->price) }}</span> <span class="md:block hidden">/-</span></div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col md:flex-row text-sm justify-between w-full">
                                        {{-- <a href="{{ route('demoClass') }}" class="text-center btn-primary px-4 py-2 mb-4">Book your free trial</a> --}}
                                        <a href="{{ route('payment',encrypt(['parent_id'=>$item->course_id,'course'=>$item->id,'payment_id'=>null])) }}" class="text-center btn-primary px-4 py-2 mb-4 w-full">Buy Now</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        @endif            
                    @empty
                    <h5 class="mt-4 text-xl text-center text-dark font-normal ">Comming soon...</h5>    
                    @endforelse
                </div>
            </div>
            <h3 class="text-2xl md:text-3xl  font-semibold text-primary py-4 text-center mt-152 md:mt-1">Personal Vs Group Learning</h3>

            <div class="  md:px-16 px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-gray-200 bg-light text-center text-sm  tracking-wider">
                                    
                                </th>
                                <th class="px-5 py-3 border-gray-200 bg-light text-center text-sm  tracking-wider">
                                    
                                </th>
                                <th
                                    class="px-5 py-3 border-gray-200 bg-light text-center text-sm text-danger tracking-wider">
                                    Personal
                                </th>
                                <th
                                    class="px-5 py-3 border-gray-200 bg-light text-center text-sm text-danger tracking-wider">
                                    Group
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-5 py-2 bg-white text-md items-start" >
                                    <p class="text-dark whitespace-no-wrap "> Core Curriculum</p>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Core Curriculum </li>
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"></li>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                            </tr>
                            <tr>
                               <td class="px-5 py-2 bg-white text-md items-start" >
                                    
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Epic Journey Milestones </li>
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                    
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                            </tr>
                            <tr>
                               <td class="px-5 py-2 bg-white text-md items-start" >
                                    
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Report Card Feedback </li>
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                            </tr>
                            <tr>
                               <td class="px-5 py-2 bg-white text-md items-start" >
                                    
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Post Class Projects and Quizzes </li>
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                            </tr>
                            <tr>
                               <td class="px-5 py-2 bg-white text-md items-start" >
                                    
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Capstones Projects </li>
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                            </tr>
                            <tr>
                               <td class="px-5 py-2 bg-white text-md items-start" >
                                    
                                </td>
                                <td class="px-5  pt-2 pb-8 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Weekly Parents Teacher Meeting </li>
                                    </ol>
                                </td>
                                <td class="px-5  pt-2 pb-8 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                                <td class="px-5  pt-2 pb-8 bg-white text-sm">
                                </td>
                            </tr>
                                
                            <tr>
                               
                                <td class="px-5 py-2 bg-white text-md items-start" >
                                    <p class="text-dark whitespace-no-wrap "> In Class Experience</p>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Number of Student</li>
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    1
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    4
                                </td>
                                
                            </tr>
                            <tr >
                               <td class="px-5 py-2 bg-white text-md items-start" >
                                    
                                </td>
                                <td class="px-5 pt-2 pb-8 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Choice of teacher</li>
                                    </ol>
                                </td>
                                <td class="px-5 pt-2 pb-8 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4"> </li>
                                </td>
                                <td class="px-5 pt-2 pb-8 bg-white text-sm">
                                    
                                </td>
                                
                            </tr>
                            
                            <tr>
                               
                                <td class="px-5 py-2 bg-white text-md items-start" >
                                    <p class="text-dark whitespace-no-wrap "> Scheduling</p>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Class Scheduling Flexiblity</li>
                                        
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm"  align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4">
                                </td>
                                <td class="px-5 py-2 bg-white text-sm">
                                    
                                </td>
                                
                            </tr>
                            
                            <tr>
                                <td class="px-5 py-2 bg-white text-md items-start" >
                                    
                                </td>
                                <td class="px-5 py-2 bg-white text-sm w-2/5">
                                    <ol class="list-disc text-mute">
                                        <li>Revision Class </li>
                                        
                                    </ol>
                                </td>
                                <td class="px-5 py-2 bg-white text-sm" align="center">
                                    <img src="{{ asset('images/icons/Tick.svg') }}" alt="✓" class="w-4 h-4">
                                </td>
                                <td class="px-5 py-2 bg-white text-sm">
                                    
                                </td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="notOnlySection">

        <div class="container mx-auto px-8 mt-4">
            <h3 class="text-2xl md:text-3xl font-semibold text-primary pb-4 mt-12 text-center"> Our Vision: <q class="italic">
                To not only speak English but to think in English</q></h3>
            <div class="w-full grid grid-rows-1 md:grid-rows-2 md:grid-cols-2 grid-flow-rows-dense md:grid-flow-col-dense md:px-4">
                <div class="ml-auto md:row-start-1 md:col-start-2 row-start-4">
                    <img loading="lazy"   src="{{asset('images/png/CourseStructure.png')}}" class="w-11/12" alt="">
                </div>
                <div class="mr-auto my-auto md:row-start-1 md:col-start-1 row-start-3">
                    <h3 class="font-bold p-2 pt-6"> COURSE STRUCTURE</h1>
                    
                    <ul class="list-disc text-gray-400 p-2 text-md font-medium leading-loose ml-4">
                        <li>Basic introductory sessions</li>
                        <li>Grammar & vocabulary</li>
                        <li>One-to-One conversation on common topics(as per specialized courses)</li>
                        <li>Discussions with personal trainer</li>
                        <li>Personality development skills</li>
                        <li>Public speaking sessions</li>
                    </ul>
                </div>
                
                <div class="my-auto ml-auto md:row-start-2 row-start-1 md:col-start-2">
                    <h3 class="font-bold p-2 pt-6"> OUR SERVICES</h1>
                    <ul class="list-disc text-gray-400 p-2 text-md font-medium leading-loose ml-4">
                        <li>Easily Accessible</li>
                        <li>Specialized courses and one-on-one practice sessions</li>
                        <li>24-hour online customer support via call, email and live chat</li>
                        <li>Promising progress in your speaking skills</li>
                        <li>Learn through free flowing conversation with open room to make mistakes</li>
                    </ul>
                </div>

                <div class="mr-auto row-start-2 md:row-start-2 md:col-start-1">
                    <img loading="lazy"   src="{{asset('images/png/OradServices.png')}}" class="w-11/12" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="join-us">
        <div class="container px-8 flex flex-col text-center mx-auto">
            <h3 class="font-bold">WHO CAN JOIN THE COURSE? </h3>
            <p class="text-mute text-sm font-normal pt-4">
               
                Orad Spoken English courses and personalized services are designed to cater to everyone’s English speaking needs. You may be a student, school teacher, housewife, job seeker, working professional, entrepreneur, or anyone who wants to learn Spoken English.
            </p>
        </div>
        <div class="owl-carousel courses owl-theme mt-8">
            @for ($i = 1; $i < 12; $i++)
            <div class="item"><img loading="lazy"   src='{{ asset("images/testimonials/Image$i.jpg") }}' alt="images" class="w-46"></div>
                
            @endfor
        </div>
    </section>
    <section class="our-clients mt-12 mb-72">
        <div class="container mx-auto px-8 ">
            <h3 class="text-2xl md:text-3xl  font-semibold text-primary pb-4 text-center">Meet our Clients</h3>
            <div class="owl-carousel clients owl-theme mx-auto">
                @forelse ($clients as $item)
                    <div class="item m-auto my-5 md:mx-3">
                        
                        <div class=" bg-white p-4 shadow-lg-xy rounded-lg flex flex-col items-center">
                            <div class="inline-flex shadow-lg border border-gray-200 rounded-xl overflow-hidden h-40 w-40">
                                <img loading="lazy"  src='{{ asset("/storage/$item->photo") }}'
                                    alt="images"
                                    class=" w-45">
                            </div>
        
                            <h2 class="mt-4 font-bold text-xl">{{ucwords($item->name)}}</h2>
                            {{-- <h6 class="mt-2 text-sm font-medium">Content writer</h6> --}}
        
                            <p class="text-xs text-mute text-center mt-3"
                            x-data="{ isCollapsed: false, maxLength: 40, originalContent: '', content: '' }"
                            x-init="originalContent = $el.firstElementChild.textContent.trim(); content = originalContent.slice(0, maxLength)"
                            >
                                <span x-text="isCollapsed ? originalContent : content" class="flex items-center justify-center text-justify">
                                    {{$item->description}}
                                </span>
                                <button class="text-primary underline focus:outline-none"
                                @click="isCollapsed = !isCollapsed"
                                x-show="originalContent.length > maxLength"
                                x-text="isCollapsed ? 'Show less' : 'Show more'"
                                ></button>
                            </p>
        
                        </div>
                    </div>
                @empty
                @for($i=1; $i<=3; $i++)
                @for ($j = 1; $j <= 7; $j++)
                @php
                    $user = ['1'=>'Ved Agnihotri','2'=>'Pragya Panwar', '3'=> 'Rishab Pant', '4'=>'Sanjay Soni', '5'=>'Zaid Islam', '6'=>'Sharwan Kumar','7'=>'Vidhi Saini']
                @endphp
                    <div class="item m-auto my-5 md:mx-3">
                        
                        <div class=" bg-white p-4 shadow-lg-xy rounded-lg flex flex-col items-center">
                            <div class="inline-flex shadow-lg border border-gray-200 rounded-xl overflow-hidden h-40 w-40">
                                <img loading="lazy"  src='{{ asset("images/testimonials/Img$j.jpg") }}'
                                    alt="images"
                                    class=" w-45">
                            </div>
        
                            <h2 class="mt-4 font-bold text-xl">{{$user[$j]}}</h2>
                            {{-- <h6 class="mt-2 text-sm font-medium">Content writer</h6> --}}
        
                            {{-- <p class="text-xs text-mute text-center mt-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab enim molestiae nulla.
                            </p> --}}
        
                        </div>
                    </div>
                    
                @endfor
                @endfor
                    
                @endforelse
            </div>
        </div>
    </section>
    
    <section id="growth-rate">
        <div class="my-10">
          
            <div class="flex md:flex-row flex-col justify-around items-center text-center counterSection">
                <div class="w-56 text-center grid items-center">
                    <div class="circular">
                        <div class="inner"></div>
                        <div class="number"><span class="liveHours counter" data-count="1.25">1.25 </span><span> Lakh +</span></div>
                        <div class="circle">
                            <div class="bar left">
                                <div class="progress blue_circle"></div>
                            </div>
                            <div class="bar right blueCircle">
                                <div class="progress blue_circle"></div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-mute font-normal text-lg mt-3">No. of live hours</h3>
                </div>
                <div class="w-56 text-center grid items-center">
                    <div class="circular">
                        <div class="inner"></div>
                        <div class="number"><span class="retention counter" data-count="96">96 </span><span> %</span></div>
                        <div class="circle">
                            <div class="bar left">
                                <div class="progress red_circle"></div>
                            </div>
                            <div class="bar right redCircle">
                                <div class="progress red_circle_right"></div>
                            </div>
                        </div>
                    </div>
                     <h3 class="text-mute font-normal text-lg mt-3">Retention Rate</h3>
                </div>
                <div class="w-56 text-center grid items-center">
                    <div class="circular">
                        <div class="inner"></div>
                        <div class="number"><span class="referral counter" data-count="91">91</span><span> %</span></div>
                        <div class="circle">
                            <div class="bar left">
                                <div class="progress yellow_circle"></div>
                            </div>
                            <div class="bar right yellowCircle">
                                <div class="progress yellow_circle_right"></div>
                            </div>
                        </div>
                    </div>
                     <h3 class="text-mute font-normal text-lg mt-3">Referral Rate</h3>
                </div>
            </div>
        </div>
    </section>

      
    <section class="tutor-section mt-20 ">
        <div class="container mx-auto mt-5 mb-48">
            <h3 class="text-2xl md:text-3xl font-semibold text-primary pb-4 mt-12 text-center"> Meet our Tutor</h3>
            <div class="owl-carousel tutor owl-theme mt-8">
                @php
                    $color = ['blue','yellow','red','blue','yellow','red','yellow','blue','yellow'];
                @endphp
      
                @for ($i = 1; $i <= 6; $i++)
                @php
                    
                    $employees= ['1'=>'Soumya Bhargava','2'=>'Khushi Mehta','3'=>'Lana Swarna','4'=>'Soumya Bhargava','5'=>'Khushi Mehta','6'=>'Lana Swarna','7'=>'Soumya Bhargava'];
                    $video = "images/video/WebsiteVideo$i.mp4";
                @endphp
                    <div class="item col-span-1 col-start-1 p-4 " >
                        <div class="w-full rounded-xl space-y-2 p-6 hover:shadow-lg transition delay-75 duration-75 ease-in-out" >
                            <div class="space-y-4" x-data={show:false} @mouseleave = "show=false" >
                                <div class="group mx-auto w-36 border-2 border-{{$color[$i]}}-500  rounded-xl transform rotate-12  ansition delay-200 duration-100 ease-in-out" @mouseover="show=true" >
                                    <img loading="lazy"  x-show="!show"  src='{{asset("images/employees/emp$i.jpg")}}' class="rounded-xl h-36 transform -rotate-12 cursor-pointer" alt="">
                                    <a @click="$dispatch('img-modal', {  imgModalSrc: '{{asset($video)}}', imgModalDesc: '{{$employees[$i]}}' })" class="cursor-pointer">
                                        <img src="{{asset('images/icons/playbutton.svg')}}" x-show="show"  class="rounded-xl h-36 border-solid border-2 transform -rotate-12 transition delay-400 duration-300 ease-in-out cursor-pointer" alt="">
                                    </a>
                                        
                                </div>
                            </div>
                            <div class="p-5">
                            <div class=" text-center">
                                <h2 class="font-medium text-lg ">{{$employees[$i]}}</h2>
                                {{-- <h3 class="text-xs text-mute text-center ">Delhi, India</h3> --}}
                                <div class="flex md:px-20 mt-2">
                                    @for ($j = 1; $j <= 5; $j++)
                                        <img loading="lazy"   src="{{asset('images/icons/starRating.svg')}}" class="w-4 h-4" />
                                    @endfor

                                </div>
                            </div>
                            {{-- <div class="text-xs text-mute text-center mt-3">
                                <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia rerum facilis quam impedit fugiat expedita tenetur, 
                                </p>
                            </div> --}}
                            </div> 
                        </div>
                    </div>
                    
                @endfor
            </div>
        </div>
    </section> 
    <section class="journey-section mt-20">
        <div class="container mx-auto ">
            <div class="px-12 w-full  grid gird-rows-5 md:gird-rows-1 md:gird-cols-5 justify-items-center">
                <div class="group row-start-1 md:col-start-1">
                <a href="tel:7023257319">
                    <img loading="lazy"   src="{{asset('images/png/Contract-Us.png')}}" class=" 
                    transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 mx-auto w-1/2 md:w-full" alt="">
                    {{-- <p class="my-auto  py-1 font-extrabold text-lg  group-hover:text-blue-600 text-center">Contact Us</p> --}}
                </a>
                </div>
                <div class="row-start-2 md:row-start-1 md:col-start-2 my-auto">
                    <div class="flex flex-col md:flex-row container md:h-auto h-32 w-10/12 mx-auto">
                        <div class="border-8 rounded-full border-gray-900 bg-gray-900 mx-auto md:mx-0 my-auto"></div>
                        <div class="border-2 md:w-72 md:h-0 border-dashed border-gray-900 flex  my-auto h-28 md:h-1 mx-auto"></div>
                        <div class="border-8 rounded-full border-gray-900 bg-gray-900 mx-auto md:mx-0 my-auto"></div>
                    </div>
                </div>
    
    
                <div class="group row-start-3 md:row-start-1 md:col-start-3">
                    <a href="{{ route('demoClass') }}" >
                        <img loading="lazy"   src="{{asset('images/png/Demo-Class.png')}}" class=" 
                        transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 mx-auto w-1/2 md:w-full" alt="">
                        {{-- <p class="-mx-2 py-1 font-extrabold text-lg my-auto group-hover:text-blue-600 text-center">Take a demo class</p> --}}
                    </a>
                </div>
                
                <div class="row-start-4 md:row-start-1 md:col-start-4 my-auto">
                    <div class="flex flex-col md:flex-row container md:h-auto h-32 w-10/12 mx-auto">
                        <div class="border-8 rounded-full border-gray-900 bg-gray-900 mx-auto md:mx-0 my-auto"></div>
                        <div class="border-2 md:w-72 md:h-0 border-dashed border-gray-900 flex md:my-auto h-28 md:h-1 mx-auto"></div>
                        <div class="border-8 rounded-full border-gray-900 bg-gray-900 mx-auto md:mx-0 my-auto"></div>
                    </div>
                </div>
    
                <div class="group row-start-5 md:row-start-1 md:col-start-5">
                    <a href="{{ route('payment',encrypt(['parent_id'=>$item->course_id,'course'=>$item->id,'payment_id'=>null]))}}">
                        <img loading="lazy"   src="{{asset('images/png/Start-Journey.png')}}" class=" 
                        transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 mx-auto w-1/2 md:w-full" alt="">
                        {{-- <p class=" py-1 font-extrabold text-lg my-auto  group-hover:text-blue-600 text-center" >Start Your Journey</p> --}}
                    </a>
                </div>
    
    
            </div>

        </div>
    </section>


    {{-- video model start here  --}}
    <div x-data="{ imgModal : false, imgModalSrc : '', imgModalDesc : '' }">
        <template @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc; imgModalDesc = $event.detail.imgModalDesc;" x-if="imgModal">
          <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrc = ''" class="p-2 fixed w-full h-full inset-0 z-50 flex justify-center items-center bg-black bg-opacity-75">
            <div @click.away="imgModal = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
              <div class="z-50">
                <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                  <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                  </svg>
                </button>
              </div>
              <div class="p-2 overflow-hidden">
                <iframe class="h-96 w-full" :src="imgModalSrc" :title="imgModalDesc" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                {{-- <img :alt="imgModalSrc" class="object-contain h-1/2-screen" :src="imgModalSrc"> --}}
                <p x-text="imgModalDesc" class="text-center text-white"></p>
              </div>
            </div>
          </div>
        </template>
    </div>
    {{-- video model end here  --}}

    {{-- model start here --}}
    <input type="hidden" name="" id="isRegisterd" value="{{ $isRegistered }}">
    @if(!$isRegistered)
    <div class="scholarshipModal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
		<div class="border border-blue-500 shadow-lg modal-container bg-white w-4/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
			<div class="modal-content py-4 text-left px-2">
				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<div class="modal-close cursor-pointer z-50" onclick="modalClose()">
						<svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
							viewBox="0 0 18 18">
							<path
								d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
							</path>
						</svg>
					</div>
				</div>
				<!--Body-->
				<div class="my-2 mr-5 ml-5 flex flex-col items-center gap-2 justify-center">
                    <p class="text-lg text-dark">Register for ORAD Little champ competition and get a chance to win Tablet</p>
                    <a href="{{ route('scholarship') }}" class="bg-primary text-white px-2 py-2 font-normal">Register now</a>
				</div>
				
			</div>
		</div>
	</div>
    @endif
    {{-- model end here --}}
</div>
<script>
function cardswipe() {
    const cardContainer = document.querySelector(".card-container");
    const cards = document.querySelectorAll(".card");
    const allCards = cards.length;
    let index = 0;
    cards.forEach(value => {
        // console.log(value);
        index++;
        const top = index * 3;
        const right = index * 3;
        value.className += `top-${top} `;
        value.className += `right-${right}`;

        const hammertime = new Hammer(value);
        const actions = "pan" //hammertime.get('pan').set({ direction: Hammer.DIRECTION_ALL });

        
        hammertime.on(actions, function (ev) {
            // console.log(ev, value);
            value.style.transform = `scale(.9) translate(${ev.deltaX}px, ${ev.deltaY}px) rotate(${(ev.deltaX * ev.deltaY) / (value.offsetWidth * value.offsetHeight) * 90}deg)`
            value.classList.add('moving');

            value.classList.toggle('ok', ev.deltaY > 0);
            value.classList.toggle('ko', ev.deltaY < 0);
            
            // check if all cards z index value is -1 then update it to 0 
            /**
             * allCardsZindexValue 0 = false
             * allCardsZindexValue 1 = true
             */
            let allCardsZindexValue = 0;
            if (!allCardsZindexValue) {
                cards.forEach(singleCard => {
                    if (singleCard.style.zIndex == '-1') {
                        allCardsZindexValue = 1;
                    }
                });
            }

            // if allCardsZindexValue == 1 then update all value 
            if (allCardsZindexValue) {
                cards.forEach(singleCard => {
                    singleCard.style.zIndex = '0';
                });
            }


            if (ev.isFinal) {
                // console.log("if part",ev.isFinal);
                if (Math.abs(ev.deltaX) > (value.offsetWidth * 0.9 / 3)) {
                    // value.style.display = 'none'
                    value.style.transform = '';
                    value.style.zIndex = '-1';
                    value.classList.remove('moving')
                }else {
                    value.style.transform = '';
                    // value.style.zIndex = '0';
                    value.classList.remove('moving')
                }
            }
        })


    })

}

function cardswipe2() {
    var bioImg = document.getElementsByClassName("card"),
        bioImgLen = bioImg.length,
        counter = bioImgLen,
        tl = new TimelineLite();
    console.log(bioImgLen);
    // Set image positons
    for (var i = 0; i < bioImgLen; i++) {
        bioImg[i].style.transform = "rotate(" + Math.random() * (2 - 0) + 0 + "deg)";
    }

    // Get a reference to an element
    var wrap = document.getElementById("card-container"),
    // Create a manager to manager the element
    HamMangr = new Hammer.Manager(wrap),
    // Create a recognizer
    Swipe = new Hammer.Swipe();
    // Add the recognizer to the manager
    HamMangr.add(Swipe, { direction: Hammer.DIRECTION_HORIZONTAL });

    HamMangr.on("swipeup swiperight swipedown swipeleft", function (e) {
        
        counter--;
        if (counter <= 0) {
           console.log(bioImgLen);
           // bioImgLen=8;
            for (var i = 0; i < bioImgLen; i++) {
                console.log("call");
                tl.to(wrap.children[i], 0.25, { y: 0, x: 0, rotation: 0, ease: Expo.easeOut });
            }
            // Reset counter
            counter = bioImgLen;
        } else {
                           // console.log("call2");

            tl.add(slideOutAnim(HamMangr.input.element.children[counter], e.type, 1));
        }

    });

    // Greensock animation
    function slideOutAnim(element, swipeDir, timeDuration) {
        console.log(element);
        var xDistance = element.clientWidth * 1.5;
        var yDistance = element.clientHeight * 1.5;
        var soa = new TimelineLite(),
            vars = {
                rotation: 180,
                ease: Expo.easeOut
            };

        switch (swipeDir) {
            case "swiperight":
                vars.x = xDistance;
                break;
            case "swipeleft":
                vars.x = -xDistance;
                break;
            case "swipeup":
                vars.y = -yDistance;
                break;
            case "swipedown":
                vars.y = yDistance;
                break;
            default:
                console.log("swipe direction error");
        }
        soa.to(element, timeDuration, vars);

        return soa;
    }
}

window.onload = function () {
    let windowSmallScreen = window.matchMedia("(max-width: 700px)");
    Livewire.on('contentChanged', () => {
        //swipe card Initialize
        if (windowSmallScreen.matches) {

            cardswipe();

        }
    });
}

function modalClose() {
    const modalToClose = document.querySelector('.scholarshipModal');
    modalToClose.classList.remove('fadeIn');
    modalToClose.classList.add('fadeOut');
    setTimeout(() => {
        modalToClose.style.display = 'none';
    }, 500);
}
</script>
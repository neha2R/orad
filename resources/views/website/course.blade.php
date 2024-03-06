<div>
    <section class="courses-background">
        <div class="container mx-auto px-16 py-8 md:py-0">
            <div class="grid md:grid-cols-2 grid-rows-2 md:grid-rows-1 md:pb-4 pb-7">
                <div class="row-start-2 md:row-start-1">
                    <img loading="lazy"  src="{{ asset('images/png/OurCoursesBanner.png') }}" alt="courses" class="mx-auto h-96 hidden md:block">
                    <img loading="lazy"  src="{{ asset('images/png/OurCoursesBannerMobile.png') }}" alt="courses" class="block md:hidden mx-auto h-96">
                </div>
                <div class="m-auto md:grid-row-1 grid-row-start-1">
                    <h3 class="text-white text-2xl font-semibold text-center">Choose your course</h3>
                    <p class="text-center text-gray-600">
                        To proceed click the book now button showing below course details
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="course-details container mx-auto p-8">
        <h3 class="text-2xl md:text-3xl font-semibold text-primary pb-4 pt-2 text-center">SPECIALISED ENGLISH COURSES DESIGNED TO MEET YOUR PERSONAL GOALS</h3>

        <div class=" w-full grid grid-rows-1 md:grid-rows-{{ $data->count() ?? '1'}} md:grid-cols-2 grid-flow-rows-dense md:grid-flow-col-dense mt-8 md:gap-12">
            @forelse ($data as $index => $item)
        
            
                <div class="md:row-start-{{ $index+1 ?? '1'}} md:col-start-{{ $index % 2 == '0' ? '1' : '2' }}  md:my-auto mt-5">
                    <div class="flex flex-col md:flex-row md:flex-start items-baseline">
                        <h3 class="text-dark font-bold text-2xl">{{$item->title}}</h3>
                        <span class="font-light text-sm text-gray-900 md:ml-2 pt-2 md:pt-0">( {{ucwords($item->name)}} )</span>
                    </div>
                    <p class="text-mute font-light pt-5 md:text-left text-justify">
                        {{$item->description}}
                    </p>
                </div>
                
                <div class="md:row-start-{{ $index+1 ?? '1'}}  md:col-start-{{ $index % 2 == '1' ? '1' : '2' }} mt-8 md:mt-0">
                    <section class="blog text-gray-700 body-font">
                        <div class="flex flex-wrap flex-col md:flex-row sm:-m-4 -mx-4 -mb-10 -mt-4">
                            @forelse ($item->activeCourses as $key => $value)
                                <div class="transation-effect w-full p-4 {{ $item->activeCourses->count() > 1 ? "md:w-1/2 md:max-w-sm" : "md-w-full md:max-w-lg" }} md:mb-0 mb-6 flex flex-col justify-center items-center  mx-auto">
                                    <div class="h-auto w-full rounded-sm shadow-lg bg-white">
                                        <div class="pt-8 pb-9 px-2 text-center bg-{{ $item->activeCourses->count() > 1 ? ( $key==0 ?'red': 'yellow' ) : 'primary' }} text-white">
                                            <h3 class="text-xl font-bold">{{ucwords($value->name)}}</h3>
                                            
                                        </div>
                                        <div class="text-left p-8 font-normal text-dark">
                                        <p class="pt-3">Duration: {{ $value->days / 30}} Months</p>
                                        <p class="pt-3">No of classes: {{ $value->no_of_classes }}</p>
                                        <p class="pt-3">Class time/day: {{$value->class_duration}} Mins</p>
                                        <p class="pt-3">MRP: {{ceil($value->price)}} /-</p>
                                        @if ($value->discount) 
                                            <p class="pt-3">Discount:  {{"$value->discount %" }}</p> 
                                            @else
                                            <p class="pt-9"></p> 
                                        @endif
                                        <h4 class="text-{{ $item->activeCourses->count() > 1 ? ( $key==0 ?'red': 'yellow' ) : 'primary' }} text-xl font-bold py-4">RS. {{ceil($value->discounted_price)}}/-</h4>
                                        </div>
                                    </div>


                                    <a href="{{ route('payment',['course'=>$value->id]) }}" class="tracking-px bg-{{ $item->activeCourses->count() > 1 ? ( $key==0 ?'danger': 'warning' ) : 'primary' }} text-white -mt-6 shadow-lg rounded-md px-20 py-3  text-sm">
                                        BUY NOW
                                    </a>
                                </div>
                                
                            @empty

                            <div class="transation-effect w-full md:w-auto p-4 md:w-1/2 md:mb-0 mb-6 flex flex-col justify-center items-center md:max-w-sm mx-auto">
                                <div class="h-auto w-full rounded-sm shadow-lg bg-white  ">
                                    <div class="pt-8 pb-9 px-2 text-center bg-warning text-white">
                                        <h3 class="text-xl font-bold">Pay Monthly</h3>
                                        
                                    </div>
                                    <div class="text-left px-8 pb-8 pt-2 font-normal text-dark">
                                        <p class="pt-3">Duration: 1 Months</p>
                                        <p class="pt-3">No of classes: 25</p>
                                        <p class="pt-3">Class hours: 45 Mins</p>
                                        <p class="pt-3">MRP: 6000/-</p>
                                        <p class="pt-3">Discount: 30%</p>
                                        <h4 class="text-warning text-xl font-bold py-4 tracking-px">RS. 4200/-</h4>
                                    </div>
                                </div>


                                <button class="bg-warning text-white -mt-6 shadow-lg rounded-md px-20 py-3  text-sm">
                                    BUY NOW
                                </button>
                            </div>
                            
                                
                            @endforelse
                        </div>
                    </section>
                </div>
            @empty
            <div class="grid md:grid-cols-2 md:grid-rows-1 mt-8 md:gap-12 gird-auto">
                <div class="md:row-start-1 md:grid-col-start-1 md:my-auto ">
                    <div class="flex flex-col md:flex-row md:flex-start items-baseline">
                        <h3 class="text-dark font-bold text-2xl">General English</h3>
                        <span class="font-light text-sm text-gray-900 md:ml-2 pt-2 md:pt-0">(Beginner level)</span>
                    </div>
                    <p class="text-mute font-light pt-5 md:text-left text-justify">
                        General course is specialized for those who need to learn basics of English language such as grammar, sentence formation, common words, simple idioms, etc. We will also provide personal grooming sessions for personality development.
                    </p>
                </div>
                <div class="md:row-start-1 grid-col-start-2 mt-8 md:mt-0">
                    <section class="blog text-gray-700 body-font">
                        <div class="flex flex-wrap flex-col md:flex-row sm:-m-4 -mx-4 -mb-10 -mt-4">

                            <div class="transation-effect w-full md:w-auto p-4 md:w-1/2 md:mb-0 mb-6 flex flex-col justify-center items-center md:max-w-sm mx-auto">
                                <div class="h-auto w-full rounded-sm shadow-lg bg-white">
                                    <div class="pt-8 pb-9 px-2 text-center bg-red text-white">
                                        <h3 class="text-xl font-bold">Pay One Time</h3>
                                        
                                    </div>
                                    <div class="text-left p-8 font-normal text-dark">
                                    <p class="pt-3">Duration: 3 Months</p>
                                    <p class="pt-3">No of classes: 75</p>
                                    <p class="pt-3">Class time/day: 45 Mins</p>
                                    <p class="pt-3">MRP: 17299/-</p>
                                    <p class="pt-3">Discount: 30%</p>
                                    <h4 class="text-danger text-xl font-bold py-4">RS. 12,109/-</h4>
                                    </div>
                                </div>


                                <button class="bg-danger -mt-6 shadow-lg rounded-md px-20 py-3  text-sm">
                                    BUY NOW
                                </button>
                            </div>

                            <div class="transation-effect w-full md:w-auto p-4 md:w-1/2 md:mb-0 mb-6 flex flex-col justify-center items-center md:max-w-sm mx-auto">
                                <div class="h-auto w-full rounded-sm shadow-lg bg-white  ">
                                    <div class="pt-8 pb-9 px-2 text-center bg-warning text-white">
                                        <h3 class="text-xl font-bold">Pay Monthly</h3>
                                        
                                    </div>
                                    <div class="text-left px-8 pb-8 pt-2 font-normal text-dark">
                                    <p class="pt-3">Duration: 1 Months</p>
                                    <p class="pt-3">No of classes: 25</p>
                                    <p class="pt-3">Class time/day: 45 Mins</p>
                                    <p class="pt-3">MRP: 6000/-</p>
                                    <p class="pt-3">Discount: 30%</p>
                                    <h4 class="text-warning text-xl font-bold py-4">RS. 4200/-</h4>
                                    </div>
                                </div>


                                <button class="bg-warning text-white -mt-6 shadow-lg rounded-md px-20 py-3  text-sm">
                                    BUY NOW
                                </button>
                            </div>
                            
                        </div>
                    </section>
                </div>
            </div> 
            @endforelse
        </div>
    </section>
    <section class="py-12">
        <div class="flex flex-col w-72 mx-auto my-auto">
            <h3 class="text-dark text-xl text-center">Want to book a course?</h3>
            <a href="{{ route('payment') }}" class="transation-effect bg-warning text-dark shadow-lg rounded-full px-20 py-4  mt-4 text-center"> Click here</a>
        </div>
    </section>
</div>


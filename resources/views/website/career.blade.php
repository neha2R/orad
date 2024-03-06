<div class="container mt-12 px-8 md:px-20 mx-auto">
    <section class="">
        @for ($i = 0; $i < 3; $i++)
        <div x-data={show:false}>
            <div class="grid">
                <div class="justify-self-start">
                    <h3 @click="show=!show" type="button" :class="show ? 'text-primary' : 'text-gray-500'" class="hover:text-primary cursor-pointer">
                    Business Development
                    </h3>
                </div>
                
                <div x-show.transition.origin.top.left="show" class=" w-full text-gray-500 pt-8">
                    <div class="rid grid-rows-3 grid-flow-row">
                        <p class="text-gray-500 mb-3 text-sm">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi officia, at sapiente exercitationem obcaecati possimus iure, minus reprehenderit eaque tempora voluptatum quaerat veniam quia autem nesciunt similique atque neque ullam quae molestiae?
                        </p>
                        <button class="text-white btn-primary rounded-xl py-2 px-6">Apply Now</button>
                    </div>
                </div>
            </div>
        </div>  
        <hr class="my-5 text-gray-600 border-1">
        @endfor
    </section>
    <section class="form mt-16">
        <div class="mt-6 rounded-lg shadow-lg-xy bg-white p-5">
            <form>
                <h3 class="text-3xl font-semibold text-primary pb-4 pt-2 text-center"> Let's connect</h3>
                <div class="lg:flex lg:justify-between mt-3">
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                        
                        <input type="text" class="form-input " placeholder="First Name*">
                        
                    </div>	
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pl-2">
                        <input type="text" class="form-input" placeholder="Last Name*">
                    </div>	
                </div>
                <div class="lg:flex lg:justify-between mt-3">
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                        <input type="text" class="form-input" placeholder="Email*">
                    </div>	
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pl-2">
                        
                        <input type="text" class="form-input" placeholder="Mobile*">
                        
                    </div>	
                </div>
                <div class="lg:flex lg:justify-between mt-3">
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                        <input type="text" class="form-input" placeholder="Highest Education">
                    </div>	
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pl-2">
                        
                        <input type="text" class="form-input" placeholder="Choice of branch">
                        
                    </div>	
                </div>	
                <div class="lg:flex lg:justify-between mt-3">
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                        <input type="text" class="form-input" placeholder="Experience level">
                    </div>	
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pl-2">
                        <input type="text" class="form-input" placeholder="Primary skill">
                    </div>	
                </div>	
                <div class="lg:flex lg:justify-between mt-3">

                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                        <input type="text" class="form-input" placeholder="Areas of interest">
                    </div>	
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pl-2">
                        
                        <input type="text" class="form-input " placeholder="Primary country">
                        
                    </div>	
                </div>	
                <div class="lg:flex lg:justify-between mt-3">
                    <div class="flex flex-col items-stretch w-full lg:w-1/2 mb-2 lg:pr-2">
                        <label for="resume" class="text-gray-400 text-xs pb-2 ">Resume</label>
                        <input type="file" class="form-input" placeholder="resume">
                    </div>
                    <div class="flex flex-wrap items-stretch w-full lg:w-1/2 mb-2 lg:pl-2 mt-6">
                        <input type="text" class="form-input" placeholder="Work sample">
                    </div>	
                </div>
                    

                <div class="mt-2 flex justify-end">
                    <button class="btn-primary px-4 py-2 md:w-1/5 text-center rounded-xl
                    font-normal ">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </section>
    <section class="mt-16 mb-{{$employeeOfMonth->count() > '3' ? "48":"12"}}">
        <div class="container mx-auto px-8 ">
            <h3 class="text-3xl font-semibold text-primary pb-4 text-center">Employee of the month</h3>
            <div class="owl-carousel employe-of-the-month owl-theme mx-auto">
                @forelse ($employeeOfMonth as $item)
                    <div class="item m-auto my-5 md:mx-3 mb-{{$employeeOfMonth->count() > 3 ? "48":'18'}}">
                        
                        <div class=" bg-white p-4 shadow-lg-xy rounded-xl flex flex-col items-center">
                            <div class="inline-flex shadow-lg border border-gray-200 rounded-full overflow-hidden h-40 w-40">
                                <img loading="lazy"  src='{{ asset("storage/$item->photo") }}'
                                    alt="images"
                                    class=" w-45">
                            </div>
        
                            <h2 class="mt-4 font-bold text-xl">{{$item->name}}</h2>
                            <h6 class="mt-2 text-sm font-medium">{{$item->post}}</h6>
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
                @for ($j = 1; $j <= 5; $j++)
                    <div class="item m-auto my-5 md:mx-3 mb-48">
                        
                        <div class=" bg-white p-4 shadow-lg-xy rounded-xl flex flex-col items-center">
                            <div class="inline-flex shadow-lg border border-gray-200 rounded-full overflow-hidden h-40 w-40">
                                <img loading="lazy"  src='https://material-ui.com/static/images/avatar/{{$j}}.jpg'
                                    alt="images"
                                    class=" w-45">
                            </div>
        
                            <h2 class="mt-4 font-bold text-xl">Sebastian Bennett</h2>
                            <h6 class="mt-2 text-sm font-medium">Content writer</h6>
        
                            <p class="text-xs text-mute text-center mt-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab enim molestiae nulla.
                            </p>
        
                        </div>
                    </div>
                    
                @endfor
                @endfor
                @endforelse
            </div>
        </div>
    </section>
</div>
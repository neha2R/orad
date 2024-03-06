@if ($message = Session::get('success'))
<div  x-data={show:true} class="-mb-20 alertParent relative">
    <section class="flex items-center justify-center mt-2 mx-3 alert"  x-show="show" id="close">
        <div class="flex items-center bg-white shadow  rounded mt-6 px-2 mx-8" style="width: 24rem;">

            <div class="mr-3 bg-green-500 rounded px-4 py-2 text-center -ml-3">

                <svg fill="none" viewBox="0 0 24 24" class="w-8 h-8 text-white" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="flex items-center rounded-lg rounded-l-none">
                <p class="text-green-600 text-sm font-bold mr-2">{{$message}}</p>


            </div>
            <div class="flex justify-end flex-1 cursor-pointer">
                <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 text-red-600" stroke="currentColor" @click="show = !show">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
        </div>
    </section>
</div>
@endif


<!-- Warning Modal -->
@if ($message = Session::get('warning'))
    <div  x-data={show:true} class="-mb-20 alertParent relative">
        <section class="flex items-center justify-center mt-2 mx-3 alert"  x-show="show" id="close">
            <div class="flex items-center bg-white shadow  rounded mt-6 px-2 mx-8" style="width: 24rem;">
                <div class="mr-3 bg-yellow-500 rounded px-4 py-2 text-center -ml-3">

                   <svg viewBox="0 0 24 24" class="text-white-600 w-5 h-5 sm:w-5 sm:h-5">
                        <path fill="white" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z"></path>
                    </svg>
                </div>
                <div class="flex items-center rounded-lg rounded-l-none">
                    <p class="text-yellow-600 text-sm font-bold mr-2">{{$message}}</p>
                </div>
                <div class="flex justify-end flex-1 cursor-pointer">
                    
                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 text-red-600" stroke="currentColor" @click="show = !show">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
        </section>
    </div>
@endif

<!-- Error Modal -->
@if ($message = Session::get('error'))
    <div x-data={show:true}  class="-mb-20 alertParent relative">
        <section class="flex items-center justify-center mt-2 mx-3 alert"  x-show="show" >
            <div class="flex items-center bg-white shadow  rounded mt-6 px-2 mx-8"
            style="width: 24rem;">
                <div class="mr-3 bg-red-500 rounded px-4 py-2 text-center -ml-3" id="close" >

                    <svg fill="none" viewBox="0 0 24 24" class="w-8 h-8 text-white" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                
                <div class="flex items-center rounded-lg rounded-l-none">
                    <p class="text-red-600 text-sm font-bold mr-2"> {{$message}} </p>
                </div>
                <div class="flex justify-end flex-1 cursor-pointer" >
                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 text-red-600" 
                    stroke="currentColor" @click="show = !show">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
        </section>
    </div>
@endif

<script>
    //hide alert after 5 sec.
    setTimeout(function() {
        $(".alertParent").slideUp();
    }, 5000);
    
    // document.getElementById('close').addEventListener('click',document.getElementsByName('alertParent').remove())

</script>
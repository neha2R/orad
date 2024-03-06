<section>
    
    <div class="table-section " x-data="{apply:leaveModal()}">
        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Course Details:</h3>
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="th" align="left"> Sr. No. </th>
                        <th class="th" align="left"> Course Name </th>
                        <th class="th" align="left"> Course Type </th>
                        <th class="th" align="left"> Student Name </th>
                        <th class="th" align="left"> Completion Date</th>
                        <th class="th" align="left"> Course Details </th>
                    </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        @forelse ($data as $key => $item)
                            @php 
                                $i =  $data->perPage() * ($data->currentPage() - 1); $key++;
                                $date = $item->classesRelation ? $item->classesRelation->class_date : $item->created_at->format('Y-m-d');
                                $duration = $item->course->duration ?? null;
                            @endphp
                            <tr>
                                <td class="td">
                                    <p class="p">{{ $i+=$key }} </p>
                                </td>
                                <td class="td">
                                    <p class="p">{{ $item->course->name ?? '' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{  $item->course ? $item->course->Course->course_type ? 'Personale' : 'Group' : '' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">{{ $item->student->name ?? '' }}</p>
                                </td>
                                <td class="td">
                                    <p class="p">
                                        {{ courseLastDate($date, $duration) }}
                                    </p>
                                </td>
                                
                                <td class="td">
                                    <button class="btn-primary" wire:click="show({{$item->id}})" x-on:click="apply.leaveOpen()">
                                        View
                                    </button>
                                </td>
                                
                            </tr>
                                
                            
                        @empty
                        <tr>
                            <td class="td" colspan="6" align="center">
                                <p class="p">No record found...</p>
                            </td>
                        </tr>
                        @endforelse
    
                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{ $data->links() }}</div>
        </div>
    
        <!-- Leave MODAL CONTAINER WITH BACKDROP -->
        <div x-show="apply.isLeaveOpening()">
    
            <!-- MODAL -->
            <div :class="{ 'opacity-0': apply.isLeaveOpening(), 'opacity-100': apply.isLeaveOpen() }"
                class="model-head"
                tabindex="-1" role="dialog">
    
                <!-- MODAL DIALOG -->
                <div :class="{ 'mt-4': apply.isLeaveOpening(), 'mt-8': apply.isLeaveOpen() }"
                    class="model-dialog max-w-2xl">
    
                    <!-- MODAL CONTAINER -->
                    <div class="model-container">
    
                        <div class="flex justify-between px-5 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-700 text-lg edit-title">Course Info</span>
                              
                            </div>
                            <div>
                                <button type="button" class="close" wire:click="resetInputs()" x-on:click="apply.leaveClose()">
                                    <i class="fa fa-times-circle btn-close"></i>
                                </button>
                            </div>
                        </div>
    
                        <!-- form section start here -->
                        <section wire:submit.prevent="storeLeave"  method="POST">
                            <div class="px-10 py-5 text-gray-600">
                                
                                <div class="w-full py-1">
                                    <label for="" class="block font-bold ">Coruse Name :</label>
                                    <input type="text" wire:model="courseName" class="form-input cursor-not-allowed" disabled readonly>
                                </div>
                                <div class="w-full py-1">
                                    <label for="" class="block font-bold ">Coruse Type :</label>
                                    <input type="text" wire:model="courseType" class="form-input cursor-not-allowed" disabled readonly>
                                </div>
                                <div class="w-full py-1">
                                    <label for="" class="block font-bold ">Student Name :</label>
                                    <input type="text" wire:model="studentName" class="form-input cursor-not-allowed" disabled readonly>
                                </div>
                                <div class="w-full py-1">
                                    <label for="" class="block font-bold ">Time Slot:</label>
                                    <input type="text" wire:model="timeslot" class="form-input cursor-not-allowed" disabled readonly>
                                </div>
                                <div class="w-full py-1">
                                    <label for="" class="block font-bold ">Start Date :</label>
                                    <input type="text" wire:model="startDate" class="form-input cursor-not-allowed" disabled readonly>
                                </div>
                                <div class="w-full py-1">
                                    <label for="" class="block font-bold ">Coruse Duration :</label>
                                    <input type="text" wire:model="courseDuration" class="form-input cursor-not-allowed" disabled readonly>
                                </div>
                            </div>
                                
                        </section>
                        <!-- form section end here -->
                    </div>
                </div>
            </div>
    
            <!-- BACKDROP -->
            <div :class="{ 'opacity-25': apply.isLeaveOpen() }"
                class="model-backdrop">
            </div>
        </div>
    <!-- Edit user model end here  -->
    </div>
    
    <script>
        // pop model open & close for lead create
        function leaveModal() {
    
            return {
                state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
                leaveOpen() {
                    this.state = 'TRANSITION'
                    setTimeout(() => { this.state = 'OPEN' }, 50)
                },
                leaveClose() {
                    this.state = 'TRANSITION';
                    setTimeout(() => { this.state = 'CLOSED' }, 300)
                },
                isLeaveOpen() { return this.state === 'OPEN' },
                isLeaveOpening() { return this.state !== 'CLOSED' },
            }
        }
        // pop model open & close for lead create
        function reasonModal() {
    
            return {
                reasonState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
                reasonOpen() {
                    this.reasonState = 'TRANSITION'
                    setTimeout(() => { this.reasonState = 'OPEN' }, 50)
                },
                reasonClose() {
                    this.reasonState = 'TRANSITION';
                    setTimeout(() => { this.reasonState = 'CLOSED' }, 300)
                },
                isReasonOpen() { return this.reasonState === 'OPEN' },
                isReasonOpening() { return this.reasonState !== 'CLOSED' },
            }
        }
    </script>
</section>
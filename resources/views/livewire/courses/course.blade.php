<section x-data="{child:childModal(), parent:parentModal(), }">
    {{-- <h3 class="font-normal text-gray-500 my-3 text-xl"> Employees </h3> --}}
    
    @include('includes.childCourse')
    @include('includes.parentCourse')
    

    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-rows-1 lg:grid-cols-2 grid-col-1 ">

        <div class="card-header {{ $activeCourse == 0 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="changeActiveCourse(0)">
            <span class="card-title"> {{ $parentCourseCount ?? '' }}</span>
            <p class="card-subtitle">Parent Course</p>
        </div>
  
        <div class=" card-header {{ $activeCourse == 1 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="changeActiveCourse(1)">
            <span class="card-title">{{ $childCourseCount ?? '' }} </span>
            <p class="card-subtitle">Child Course</p>
        </div>
    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">{{ $activeCourseName }} Course Lists:</h3>
                    <div class="">
                        <button class="btn-primary" x-on:click="parent.parentOpen()">
                            Add Parent Course
                        </button>
                        <button class="btn-primary" x-on:click="child.childOpen()">
                            Add Child Course
                        </button>
                        
                    </div>
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="th" align="left">#</th>
                            <th class="th" align="left">Name</th>
                            <th class="th" align="left">Course Type</th>
                            @if($activeCourse)
                            <th class="th" align="left">Parent Course</th>
                            <th class="th" align="left">Description</th>
                            @endif
                            <th class="th" align="left">Status</th>
                            <th class="th" align="left">Update</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->name ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->course_type ? 'Personal' : 'Group' }} </p></td>
                                @if($activeCourse)
                                <td class="td"><p class="text-mute">{{ $item->Course->name ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->description ?? '' }} </p></td>

                                @endif
                                <td class="td">
                                                   
                                    <div class="toggle-div">
                                        <input type="checkbox" name="toggle" id="toggle" class="toggle-input" wire:click="changestatus({{ $item->id }}, {{ $item->isactive }})" {{ $item->isactive ? 'checked' : '' }}/>
                                        <label for="toggle" class="toggle-label-tag"></label>
                                    </div>
                                    
                                </td>
                                <td class="td">
                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                        data-target="#createuser"
                                        wire:click="edit({{ $item->id }})" x-on:click="{{$activeCourse ? 'child.childOpen()': 'parent.parentOpen()'}}">Update</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="td" colspan="{{ $activeCourse ? '7':'5'}}">
                                    <p class="text-gray-500 text-center">No record found...</p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-2" style="float: right">{{ $data->links() }}</div>
        </div>
    </div>

</section>

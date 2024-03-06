<section x-data="{staff:staffModal(), assign:assignModal(),excel:excelImportModal(),}">
    {{-- <h3 class="font-normal text-gray-500 my-3 text-xl"> Employees </h3> --}}
    @include('includes.staffCreate')
    @include('includes.assignStaff')

    {{-- Staff excel import model  --}}
    @include('includes.leadImport',['usertype'=>'Staff'])

    <!-- cards start here -->
    <div class="card-section grid gap-4 lg:grid-rows-1 lg:grid-cols-5 grid-col-1 ">

        <div class="card-header {{ $activeDepartment == 3 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="changeActiveDepartment(3)">
            <span class="card-title"> {{ $total_sales ?? '' }}</span>
            <p class="card-subtitle">Sales & Marketing</p>
        </div>
  
        <div class=" card-header {{ $activeDepartment == 4 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="changeActiveDepartment(4)">
            <span class="card-title">{{ $total_trainings ?? '' }} </span>
            <p class="card-subtitle">Training</p>
        </div>

        <div class="card-header {{ $activeDepartment == 5 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="changeActiveDepartment(5)">
            <span class="card-title"> {{ $total_content ?? '' }}</span>
            <p class="card-subtitle">Content</p>
        </div>
  
        <div class=" card-header {{ $activeDepartment == 7 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="changeActiveDepartment(7)">
            <span class="card-title">{{ $total_hr ?? '' }} </span>
            <p class="card-subtitle">HR</p>
        </div>
  
        <div class=" card-header {{ $activeDepartment == 6 ? 'shadow-2xl' : 'shadow-md'}}" wire:click="changeActiveDepartment(6)">
            <span class="card-title">{{ $total_finance ?? '' }} </span>
            <p class="card-subtitle">Finance </p>
        </div>

    </div>
    <!-- cards end here  -->

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Employee Lists:</h3>
                    <div class="">
                        <button class="btn-primary" x-on:click="staff.open()">
                            Add Staff
                        </button>
                        <button class="btn-primary" x-on:click="excel.excelOpen()">
                            Import Staff
                        </button>
                        <button class="btn-primary" x-on:click="assign.assignOpen()">
                            Assign
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
                            <th class="th" align="left">Mobile</th>
                            <th class="th" align="left">Email</th>
                            <th class="th" align="left">Role</th>
                            <th class="th" align="left">Assign to</th>
                            <th class="th" align="left">Status</th>
                            <th class="th" align="left">Edit</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($users as $key => $item)
                        @php $i =  $users->perPage() * ($users->currentPage() - 1); $key++;@endphp
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->name ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->mobile ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->email ?? '' }} </p></td>
                                <td class="td"><p class="text-mute">{{ rolesHelper($item->role) ?? '' }}</p></td>
                                <td class="td"><p class="text-mute">{{ userName($item->parent_id) }}</p></td>
                                
                                <td class="td">
                                                   
                                    <div class="toggle-div">
                                        <input type="checkbox" name="toggle" id="toggle" class="toggle-input" wire:click="changestatus({{ $item->id }}, {{ $item->is_active }})" {{ $item->is_active ? 'checked' : '' }}/>
                                        <label for="toggle" class="toggle-label-tag"></label>
                                    </div>
                                    
                                </td>
                                <td class="td">
                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal"
                                        data-target="#createuser"
                                        wire:click="$emit('editon','{{ $item->id }}')" x-on:click="staff.open()">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="td" colspan="7">
                                    <p class="text-gray-500 text-center">No record found...</p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-2" style="float: right">{{ $users->links() }}</div>
        </div>
    </div>
   
    <script>
        // pop model open & close for lead create
        function staffModal() {

            return {
                staffState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
                open() {
                    document.getElementById("importstaffcreate").style.display = "block";

                    this.staffState = 'TRANSITION'
                    setTimeout(() => { this.staffState = 'OPEN' }, 50)
                },
                close() {
                    this.staffState = 'TRANSITION';
                    setTimeout(() => { this.staffState = 'CLOSED' }, 300)
                },
                isOpen() { document.getElementById("importstaffcreate").style.display = "block";
 return this.staffState === 'OPEN' },
                isOpening() { document.getElementById("importstaffcreate").style.display = "block";
 return this.staffState !== 'CLOSED' },
            }
        }
        // pop model open & close for lead create
        function assignModal() {

            return {
                assignState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
                assignOpen() {
                    document.getElementById("importstaffassign").style.display = "block";

                    this.assignState = 'TRANSITION'
                    setTimeout(() => { this.assignState = 'OPEN' }, 50)
                },
                assignClose() {
                    this.assignState = 'TRANSITION';
                    setTimeout(() => { this.assignState = 'CLOSED' }, 300)
                },
                isAssignOpen() { return this.assignState === 'OPEN' },
                isAssignOpening() { return this.assignState !== 'CLOSED' },
            }
        }
    </script>
</section>

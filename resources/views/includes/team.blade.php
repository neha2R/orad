<div>
     <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="font-normal text-gray-500 my-3 text-xl">Team Members</h3>
                    
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th
                        class="p-3 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-800 tracking-wider"
                        align="left">
                        Sr. No.
                        </th>
                        <th
                        class="p-3 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-800 tracking-wider"
                        align="left">
                        Name
                        </th>
                        <th
                        class="p-3 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-800 tracking-wider"
                        align="left">
                        Email
                        </th>
                        <th
                        class="p-3 border-b-2 border-gray-200 bg-gray-100 font-medium text-gray-800 tracking-wider"
                        align="left">
                        Contact
                        </th>
                        
                    </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        @forelse ($data as $key => $item)
                            @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                            <tr>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-500">{{ $i+=$key }} </p>
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-500">{{ $item->name ?? 'N/A' }}</p>
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-500">{{ $item->email ?? 'N/A' }}</p>
                                </td>
                                <td class="p-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-500">{{ $item->mobile }}</p>
                                </td>
                               
                                </td>
                                
                            </tr>
                                
                            
                        @empty
                        <tr>
                            <td class="p-3 border-b border-gray-200 bg-white text-sm" colspan="4">
                                <p class="text-gray-500 text-center">No record found...</p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-3" style="float: right;">{{ $data->links() }}</div>
        </div>
    </div>
    <!-- tables section end here  -->
</div>

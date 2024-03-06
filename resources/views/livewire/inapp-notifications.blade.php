
<section>
    <div class="py-8" >
        <div>
            <div class="flex justify-between items-center">
                
                <h3 class="font-normal text-gray-500 my-3 text-xl">All Notifications</h3>
                <div class="">
                    
                    <button class="btn-primary" wire:click="markallnotificationasread">
                        Mark all as read
                    </button>
                </div>
            </div>
            {{-- @include('includes.table-header') --}}
        </div>
        <div class=" min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="th" align="left">#</th>
                    <th class="th" align="left">Notification</th>
                    <th class="th" align="left">Time</th>
                    <th class="th" align="left">Mark as Read</th>
                </tr>
                </thead>
                <tbody class="transition duration-700 ease-in-out">
                    @forelse ($notifications as $key => $item)
                     @php $i =  $notifications->perPage() * ($notifications->currentPage() - 1); $key++;@endphp
                        <tr>
                            <td class="td">{{$i+=$key}}</td>
                            <td class="td">{{count($item->data) ? $item->data['message'] : ''}}
                                
                                @if ($item->read_at)
                                <span class="badge bg-danger">Read</span>
                                @else
                                <span class="badge bg-success">New</span>
                                @endif
                                                
                            </td>
                            <td class="td">{{$item->created_at ?? ''}}</td>
                            <td class="td"><span wire:click="marknotificationread('{{$item->id}}')" class=" btn-primary cursor-pointer">✓</span></td>
                        </tr>
                        
                   
                    @empty
                    <tr>
                        <td class="td" colspan="4" align="center">
                            <p class="p">No record found...</p>
                        </td>
                    </tr>
                    @endforelse
    
                </tbody>
            </table>
        </div>
        <div class="py-3" style="float: right;">{{ $notifications->links() }}</div>
    </div>
</section>
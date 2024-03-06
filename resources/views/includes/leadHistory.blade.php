<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="history.isHistoryOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': history.isHistoryOpening(), 'opacity-100': history.isHistoryOpen() }"
            class="fixed z-50 top-0 left-0 w-full h-full outline-none transition-opacity duration-200 linear overflow-y-auto"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': history.isHistoryOpening(), 'mt-8': history.isHistoryOpen() }"
                class="relative w-auto pointer-events-none max-w-2xl mt-8 mx-auto transition-all duration-200 ease-out">

                <!-- MODAL CONTAINER -->
                <div
                    class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl" id="importstaff" style="display:none;">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            
                            <span class="font-bold text-gray-700 text-lg edit-title">Demo Status : {{demoHelperText($leadidfordemo)}} </span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="history.historyClose()" wire:click="clearLeadHistory()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form>
                        <div class="px-5 mt-5">
                            <div class="flex justify-center">
                                <div class="w-full">
                                    <div class="headings flex justify-between items-center mb-3">
                                        <h5 class="font-bold text-gray-700 text-lg edit-title"">Lead History</h5>
                                    </div>
                                    @foreach ($leadhistorydata as $item)
                                    <div class="shadow-md cardhistory p-3">
                                    <div class="flex justify-between items-center">
                                        <div class="user flex flex-row items-center"> <img src="{{URL::asset('oradavtar.jpg')}}" width="30" class="user-img rounded-circle mr-2"> 
                                            <span>
                                                <small class="font-weight-bold text-primary">{{$item->title ?? ''}}</small> 
                                                <small class="font-weight-bold">{{$item->description ?? ''}}</small>
                                            </span> 
                                        </div> 
                                        <small>{{$item->created_at->format('d/m/Y') ?? ''}} <br /> {{$item->created_at->format('H:i:s') ?? ''}}</small>
                                    </div>
                                    <div class="action flex justify-between mt-2 items-center">
                                        <div class="reply px-4"> <small>{{optional($item->user)->name ?? ''}}</small> <span class="dots"></span> <small>{{userDepartment($item->user->id)}}</small> <span class="dots"></span> <small>{{$item->user && $item->user->user_type != '2' ? rolesHelper($item->user->role) : 'Student'}}</small> </div>
                                    </div>
                                </div>
                                    @endforeach
                                
                                </div>
                            </div>
                        </div>
                       
                        <div class="flex items-center justify-start p-4 ">
                            <div class="form-group" >
                                <label for="exampleFormControlTextarea1" class="font-bold text-gray-700 text-lg">Leave Comment As {{auth()->user()->name ?? ''}}</label>
                                <textarea class="form-input" id="exampleFormControlTextarea1" rows="3" wire:model="leadhistorycomment" style="height: 64px"></textarea>
                                
                            </div>
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="history.historyClose()" type="button" class="inline-block btn-mute mr-2" wire:click="clearLeadHistory()">Close</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button" wire:click="leadhistorycommentstore">Create</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': history.isHistoryOpen() }"
            class="z-40 fixed top-0 left-0 bottom-0 right-0 bg-black opacity-0 transition-opacity duration-200 linear">
        </div>
    </div>
<!-- Edit user model end here  -->
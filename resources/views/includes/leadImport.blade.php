<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="excel.isExcelOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': excel.isExcelOpening(), 'opacity-100': excel.isExcelOpen() }"
            class="fixed z-50 top-0 left-0 w-full h-full outline-none transition-opacity duration-200 linear overflow-y-auto"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': excel.isExcelOpening(), 'mt-8': excel.isExcelOpen() }"
                class="relative w-auto pointer-events-none max-w-2xl mt-8 mx-auto transition-all duration-200 ease-out">

                <!-- MODAL CONTAINER -->
                <div id="importstafflead" style="display:none;"
                    class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Add Bulk {{$usertype ?? 'Leads'}}</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="excel.excelClose()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-start flex-col gap-y-2 px-5 py-4">
                        <span class="text-danger font-bold text-lg">Rules For {{$usertype ?? 'Leads'}} Excel File:-</span>
                        @if(isset($usertype))
                        <p >
                            <span class="text-mute font-normal text-md">Role : </span>
                            <span>0=Senior</span>
                            <span>1=Senior</span>
                        </p>
                        <p >
                            <span class="text-mute font-normal text-md">Department : </span>
                            <span>3=Marketing</span>
                            <span>4=Training</span>
                            <span>5=Content</span>
                            <span>6=Accounts</span>
                            <span>7=HR</span>
                        </p>
                        <p >
                            <span class="text-mute font-normal text-md">Sub Department : </span>
                            <span>1=BDM</span>
                            <span>2=BDE</span>
                            <span>3=Demo Manager</span>
                            <span>4=Q.A.</span>
                            <span>5=Talent Hunt</span>
                            <span>6=Training & Development</span>
                            <span>7=Performance</span>
                        </p>
                        @else
                        <p >
                            <span class="text-mute font-normal text-md">Reference : </span>
                            <span>0=Webinar</span>
                            <span>1=Instagram</span>
                            <span>2=Google</span>
                            <span>3=Facebook</span>
                            <span>4=Twitter</span>
                            <span>5=Other</span>
                        </p>
                        <p >
                            <span class="text-mute font-normal text-md">Growth : </span>
                            <span>0=A (Can speak well)</span>
                            <span>1=B (Can speak but is not fluent)</span>
                            <span>2=C (Can understand but is not able to speak)</span>
                            <span>3=D (Can not understand at all)</span>
                        </p>
                        <p >
                            <span class="text-mute font-normal text-md">Edu Level : </span>
                            <span>0=School</span>
                            <span>1=UG</span>
                            <span>2=PG</span>
                            <span>3=Job Seeker</span>
                            <span>4=Working</span>
                            <span>5=Housewife</span>
                            <span>6=Other</span>
                            <span>7=self</span>
                        </p>
                         <p >
                            <span class="text-mute font-normal text-md">Gender : </span>
                            <span>0=Male</span>
                            <span>1=Female</span>
                            <span>2=Prefer not to say</span>
                        </p>
                        <p >
                            <span class="text-mute font-normal text-md">Lead Type : </span>
                            <span>1=Not Called Yet</span>
                            <span>2=Cold</span>
                            <span>3=Warm</span>
                            <span>3=Hot</span>
                        </p>
                        @endif
                    </div>
                    
                    <div class="flex justify-center px-5 py-4">
                        @php $excelfile = (isset($usertype)) ? 'staff.xlsx' : 'staticdata.xlsx'                     @endphp
                        <a href='{{URL::asset($excelfile)}}' target="_blank" class="px-12 py-2 btn-primary">Download Sample File</a>
                    </div>

                    <!-- form section start here -->
                    <form method="post"  wire:submit.prevent="importSheet" class="px-5 mt-5">
                        <div class="flex justify-center">
                            <div class="file_upload p-5 relative border-4 border-dotted border-gray-300 rounded-lg w-full">
                            <svg class="text-primary w-24 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                            <div class="input_field flex flex-col w-max mx-auto text-center">
                                <label>
                                    <input class="text-sm cursor-pointer w-36 hidden" type="file" wire:model="fileimport" id="upload{{ $iteration }}">
                                    <div class="text bg-primary text-white border border-gray-300 rounded font-semibold cursor-pointer p-1 px-3 hover:bg-indigo-500">Browse File</div>
                                </label>
                                <span wire:loading wire:target="fileimport" class="text-primary">Uploading...</span>
                                <span x-data="{ isUploading: false}" x-on:livewire-upload-finish="isUploading = true" class="text-primary">{{$fileimport != null ? $fileimport->getClientOriginalName() : ''}}</span>
                            </div>   
                            @if(count($errormessages))
                            <div style="text-align: center">
                                @foreach ($errormessages as $item)
                                <span style="color: red">{!!$item ?? '' !!}</span><br />
                                @endforeach
                            </div>
                            
                            @endif  
                        </div>     
                           
                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="excel.excelClose()" type="button" class="inline-block btn-mute mr-2" wire:click="resetInputsLead()">Close</button>
                            
                            <button type="submit" class="inline-block btn-primary edit-button">Upload</button>
                            
                        </div>
                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': excel.isExcelOpen() }"
            class="z-40 fixed top-0 left-0 bottom-0 right-0 bg-black opacity-0 transition-opacity duration-200 linear">
        </div>
    </div>
<!-- Edit user model end here  -->
<section x-data="{feedback:feedbackModal()}">

    <!-- tables section  start here  -->
    <div class="table-section ">

        <!-- recent registration section start here  -->
        <div class="py-8" >
            <div>
                <div class="flex justify-between items-center">
                    
                    <h3 class="font-normal text-gray-500 my-3 text-xl">PR Meetings:</h3>
                    
                </div>
                @include('includes.table-header')
            </div>
            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="th" align="left">#</th>
                            <th class="th" align="left">Date</th>
                            <th class="th" align="left">Agenda</th>
                            <th class="th" align="left">Created By</th>
                            <th class="th" align="left">Join Meeting</th>
                            <th class="th" align="left">Feedback</th>
                        </tr>
                    </thead>
                    <tbody class="transition duration-700 ease-in-out">
                        
                        
                        @forelse ($data as $key => $item)
                        @php $i =  $data->perPage() * ($data->currentPage() - 1); $key++;@endphp
                        
                            <tr>
                                <td class="td"><p class="text-mute">{{ $i+=$key }} </p></td>
                               
                                <td class="td"><p class="text-mute">{{ date('M d, Y',strtotime($item->prmeeting->date)) }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->prmeeting->agenda }} </p></td>
                                <td class="td"><p class="text-mute">{{ $item->prmeeting->admin->name ?? 'N/A' }} </p></td>
                                <td class="td">
                                    <a target="_blank" class="btn-success" href="{{ $item->join_link ?? 'N/A' }}">
                                        Join
                                    </a>
                                </td>
                                <td class="td">
                                    @if ($item->comments)
                                        <p class="text-mute">Feedback submitted </p>
                                    @else
                                        <button class="btn-warning" x-on:click="feedback.feedbackOpen()" wire:click="show({{ $item->id }})">
                                            Feedback
                                        </button>
                                    @endif
                                </td>
                               
                            </tr>
                        @empty
                            <tr>
                                <td class="td" colspan="6">
                                    <p class="p text-center">No record found...</p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="py-2" style="float: right">{{ $data->links() }}</div>
        </div>
    </div>

<!-- FeedBack user model end here  -->
    <div x-show="feedback.isFeedbackOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': feedback.isFeedbackOpening(), 'opacity-100': feedback.isFeedbackOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': feedback.isFeedbackOpening(), 'mt-8': feedback.isFeedbackOpen() }"
                class="model-dialog max-w-2xl">

                <!-- MODAL CONTAINER -->
                <div  class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Feedback: </span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="feedback.feedbackClose()" wire:click="resetInputs()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- form section start here -->
                    <form wire:submit.prevent="store"  method="POST">
                        <div class="px-10 py-5 text-gray-600">

                            {{-- Rating  --}}
                            <div class="w-full py-1">
                                <label for="rating" class="block font-bold ">Select Rating :</label>
                                <select name="rating" id="rating" wire:model='rating' class="form-input" >
                                  @for ($i = 1; $i < 6; $i++)
                                      <option value="{{$i}}">{{$i}} Rate</option>
                                  @endfor
                                </select>
                                @error('rating') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>

                            {{-- Comments  --}}
                            <div class="w-full py-1">
                                <label for="comments" class="block font-bold ">Enter Feedback :</label>
                                <textarea name="comments" id="comments" style="height: 85px" class="form-input" wire:model="comments"></textarea>
                                @error('department') <span class="text-danger">{{ $message }}</span> @enderror                        
                            </div>


                        </div>
                        <div class="flex items-center justify-end p-4 ">

                            <button x-on:click="discount.discountClose()" type="button"
                                class="inline-block btn-mute mr-2" wire:click="resetInputs()">Close</button>
                            
                            <button type="submit"
                                class="inline-block btn-primary edit-button" >Submit</button>
                            
                        </div>

                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': feedback.isFeedbackOpen() }"
            class="model-backdrop">
        </div>
    </div>

   
<script>

    // pop model open & close for lead create
    function feedbackModal() {
        
        return {
            feedbackState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            feedbackOpen() {
                this.feedbackState = 'TRANSITION'
                setTimeout(() => { this.feedbackState = 'OPEN' }, 50)
            },
            feedbackClose() {
                this.feedbackState = 'TRANSITION';
                setTimeout(() => { this.feedbackState = 'CLOSED' }, 300)
            },
            isFeedbackOpen() { return this.feedbackState === 'OPEN' },
            isFeedbackOpening() { return this.feedbackState !== 'CLOSED' },
        }
    }
</script>
</section>

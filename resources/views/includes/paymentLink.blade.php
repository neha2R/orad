<!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="payment.isPaymentOpening()">

        <!-- MODAL -->
        <div :class="{ 'opacity-0': payment.isPaymentOpening(), 'opacity-100': payment.isPaymentOpen() }"
            class="model-head"
            tabindex="-1" role="dialog">

            <!-- MODAL DIALOG -->
            <div :class="{ 'mt-4': payment.isPaymentOpening(), 'mt-8': payment.isPaymentOpen() }"
                class="model-dialog max-w-3xl">

                <!-- MODAL CONTAINER -->
                <div class="model-container">

                    <div class="flex justify-between px-5 py-4">
                        <div>
                            <span class="font-bold text-gray-700 text-lg edit-title">Send payment links to lead</span>
                        </div>
                        <div>
                            <button type="button" class="close" x-on:click="payment.paymentClose()" wire:click="resetInput()">
                                <i class="fa fa-times-circle btn-close"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- form section start here -->
                    <section class="px-5 mt-5">
                        <div class="w-full py-1">
                            <label for="" class="block font-normal ">Select Lead :</label>
                            <select wire:model="leadid" id="lead"
                                class="w-full pl-5 pr-10 appearance-none form-input">
                                <option value="">--Select Lead--</option>
                                @foreach ($unconvertedLead as $key => $item)
                                    <option value="{{ $item->leadid }}"> {{ucwords($item->userRelation->name ?? '')}} </option>
                                @endforeach
                            </select>
                            @error('leadid') <span class="text-danger">{{ $message }} @enderror
                        </div>
                        <div class="w-full py-1">
                            <label for="" class="block font-normal ">Select Course :</label>
                            <select wire:model="course" id="course"
                                class="w-full pl-5 pr-10 appearance-none form-input">
                                <option value="">--Select Course--</option>
                                @foreach ($courses as $key => $item)
                                    <option value="{{ $item->id }}"> {{ucwords($item->name)}} ({{ $item->Course->name ?? '' }})</option>
                                @endforeach
                            </select>
                            @error('course') <span class="text-danger">{{ $message }} @enderror
                        </div>

                        {{-- price, mobile and email section  --}}
                        <div class="py-2">
                            <h3>Send Payment Link</h3>
                            <div class="flex flex-row gap-x-2 py-1 justify-between">
                                
                                <div class="w-1/3 ">
                                    <label for="price" class="block font-bold ">Price :</label>
                                    <input type="text" class="form-input" wire:model="price"  style="{{ $discountedPrice ? 'color:#3b65df !important' : '' }}" readonly>
                                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror                        
                                </div>
                                <div class="w-1/3 ">
                                    <label for="mobile" class="block font-bold ">Mobile :</label>
                                    <input type="text" class="form-input" wire:model="mobile" id="mobile">
                                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror                        
                                </div>
                                <div class="w-1/3 ">
                                    <label for="email" class="block font-bold ">Email :</label>
                                    <input type="text" class="form-input" wire:model="email" id="email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror                        
                                </div>
                               
                            </div>
                        </div>

                        {{-- discount section  --}}
                        <div class="py-2 flex justify-end">
                            <button class="btn-success px-4 py-1" wire:click="addDiscount()">Add Discount</button>
                        </div>
                        
                        {{-- payments details of sepcific user --}}
                        <div class="py-2">
                            <h3>Payment Details</h3>
                            <div class=" min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                    <tr>
                                        <th class="th" align="left">#</th>
                                        <th class="th" align="left">Date</th>
                                        <th class="th" align="left">Link</th>
                                        <th class="th" align="left">Course</th>
                                        {{-- <th class="th" align="left">Mobile </th> --}}
                                        {{-- <th class="th" align="left">Discount</th> --}}
                                        <th class="th" align="left">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody class="transition duration-700 ease-in-out">
                                        @forelse ($paymentHistory as $key => $item)
                                          
                                            <tr>
                                                <td class="td">
                                                    <p class="p">{{ ++$key }} </p>
                                                </td>
                                                <td class="td">
                                                    <p class="p">{{ date('M d, Y',strtotime($item->created_at)) }}</p>
                                                </td>
                                                <td class="td">
                                                    <p class="p">{{url("/short-url/$item->linkId ")}}</p>
                                                </td>
                                                <td class="td">
                                                    <p class="p">{{ $item->course->name ?? 'N/A' }}</p>
                                                </td>
                                                {{-- <td class="td">
                                                    <p class="p">{{ $item->mobile ?? '' }}</p>
                                                </td> --}}
                                                <td class="td">
                                                    <p class="p">{{$item->discounted_price}}</p>
                                                </td>
                                                {{-- <td class="td">
                                                    <p class="p">{{$item->price}}</p>
                                                </td>
                                                 --}}
                                            </tr>
                                                
                                            
                                        @empty
                                        <tr>
                                            <td class="td" colspan="5">
                                                <p class="p text-center">No record found...</p>
                                            </td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                          
                        </div>
                        <div class="flex items-center justify-between p-4 ">

                            <div>

                                <button type="button" class="inline-block btn-primary" wire:click="sendwhatsapplink()">Send Link on whatsapp</button>
                                <button type="button" class="inline-block btn-primary">Send Link on sms</button>
                            </div>
                            <button wire:click="resetInput()" x-on:click="payment.paymentClose()" type="button" class="inline-block btn-mute mr-2" >Close</button>
                            
                        </div>
                    </form>
                    <!-- form section end here -->
                </div>
            </div>
        </div>

        <!-- BACKDROP -->
        <div :class="{ 'opacity-25': payment.isPaymentOpen() }"
            class="model-backdrop">
        </div>
    </div>
<!-- Edit user model end here  -->
<script>
    // pop model open & close for lead create
    function paymentModal() {
        
        return {
            paymentState: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
            paymentOpen() {
                this.paymentState = 'TRANSITION'
                setTimeout(() => { this.paymentState = 'OPEN' }, 50)
            },
            paymentClose() {
                this.paymentState = 'TRANSITION';
                setTimeout(() => { this.paymentState = 'CLOSED' }, 300)
            },
            isPaymentOpen() { return this.paymentState === 'OPEN' },
            isPaymentOpening() { return this.paymentState !== 'CLOSED' },
        }
    }
</script>
<div class="row">
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Feedback</label>
                            <textarea wire:model="currentfeedback" class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="contentcomplaint" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentcomplaint">Content Complaint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" wire:submit.prevent="storecontaintcomplain">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
                        <textarea wire:model="complaintinfo" class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reschedule Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit.prevent="rescheduleStore">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                Date :
                            </div>
                            <div class="col-md-4">
                                <input type="date" wire:model="date" min="{{ date('Y-m-d') }}"
                                    class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }} input-opacity">
                            </div>
                            <div class="col-md-2">
                                Time Slot :
                            </div>
                            <div class="col-md-4">
                                <select wire:model="slot" id="slot"
                                    class="form-control {{ $errors->first('slot') ? ' form-control-danger' : '' }} input-opacity">
                                    <option value="">--Select--</option>
                                    @foreach ($slots as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->from }} -
                                            {{ $item->to }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->user_type ==2)
    <div class="col-md-12">
        @else
        <div class="col-md-8">
         @endif
    
        <div class="card">
            <div class="card-header">
                <h3>Class Report</h3>
                @if ($isjuniortrainer)
                <input type="text" wire:model="classlink.{{$key}}"  class="form form-control"  /> 
                <button class="btn btn-primary" wire:click="submitClasslink({{$item->id}})" style="margin:3px" >Update Class Link</button>
                @endif
                <ul class="list-unstyled card-option" style="float: right">
                </ul>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Classid</th>
                                <th>Trainer Name</th>
                                <th>Date</th>
                                <th>Slot</th>
                                <th>Class Link</th>
                                <th>Reschedule Class</th>
                                <th>Class Recording</th>
                                @if (!$isjuniortrainer)
                                    <th>Feedback/Complaint</th>

                                @endif

                            </tr>
                        </thead>

                        <tbody>
                          

                            @foreach($data as $key => $item)
                            @if ($loop->last)
                            <tr style="background:#D63E36" >
                            @else
                            @php
                                $ss=$key+1;
                            @endphp
                                @if ($ss % 10 == 0)
                                <tr style="background:#F68F8C" >
                                @else
                                <tr>
                                @endif
                            
                            @endif
                           

                                <td>{{ $key + 1 }}</td>
                                <td>Class#{{ $item->id }}</td>
                                <td>{{ optional($item->trainerRelation)->name ?? '' }}</td>
                                <td>{{ dateformater($item->class_date) ?? '' }}</td>
                                <td>{{ optional($item->slotRelation)->from ?? '' }}</td>
                                <td>
                                    <a class="btn btn-primary" wire:model="classlink.{{$key}}" href="{{ $item->classlink ?? '' }}"
                                        target="_blank" class="blink">Join</a>
                                </td>
                                <td>
                                    @if (Carbon\Carbon::parse($item->class_date)->isToday())
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenter"
                                    wire:click="classreschdule({{ $item->id }})">
                                    Reschedule
                                </button>
                                    @elseif(Carbon\Carbon::parse($item->class_date)->gt(today()))
                                    <a class="btn btn-primary" 
                                    target="_blank">Can Not Reschedule</a>
                                        
                                    @else
                                        <a class="btn btn-disabled" 
                                            target="_blank">Can Not Reschedule</a>
                                    @endif

                                </td>
                                
                                    <td>
                                    @if($item->recording)
                                        <a href="{{$item->recording ?? ''}}" target="_blank">View Recording</a>
                                        @else
                                        @if ($isjuniortrainer)
                                        
                                            <input type="text" wire:model="recording.{{$key}}"  class="form form-control"  /> 
                                            <button class="btn btn-primary" wire:click="submitrecording({{$item->id}})" style="margin:3px" >Submit Link</button>
                                        @else
                                             Recording Not Available Yet
                                        @endif 
                                    @endif
                                </td>
                            
                                @if (!$isjuniortrainer)
                                    <td>
                                        @switch(auth()->user()->user_type)
                                            @case(1)
                                                @if ($item->feedbackRelation)
                                                    {{ $item->feedbackRelation->feedback ?? '' }}
                                                @else
                                                    Not Given
                                                @endif

                                            @break
                                            @case(2)
                                                @if ($item->feedbackRelation)
                                                    {{ $item->feedbackRelation->feedback ?? '' }}
                                                @else
                                                    <button type="button" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        wire:click="recordfeedback({{ $item->id }},1)">Give
                                                        Feedback</button>
                                                @endif

                                            @break
                                            @default
                                        @endswitch
                                    </td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Classid</th>
                                <th>Trainer Name</th>
                                <th>Date</th>
                                <th>Slot</th>
                                <th>Class Link</th>
                                <th>Reschedule Class</th>
                                <th>Class Recordings</th>
                                @if (!$isjuniortrainer)
                                    <th>Feedback/Complaint</th>

                                @endif
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>








        </div>
    </div>
    @if(auth()->user()->user_type != 2)
    <div class="col-md-4">
        <div class="card table-card">
            <div class="card-header">
                <h3>Class Content</h3>
                <div class="card-header">

                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Content Name</th>
                                <th>View</th>
                                <th>Complaint</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todaycontent as $item)
                                <tr>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td><a href="{{openfileonline($item->contentfile->first()) ?? ''}}" target="_blank">View Content</a></td>
                                    <td><button wire:click="registercomplaint({{ $item->id }})"
                                            class="btn btn-danger" data-toggle="modal" data-target="#contentcomplaint" >Complaint</button></td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endif
   
    <script>
        Livewire.on('modalcallback', postId => {
            // alert('A post was added with the id of: ' + postId);
            $('#exampleModal').modal('hide');
            $('#exampleModalCenter').modal('hide');
            $('#contentcomplaint').modal('hide');
        })

    </script>
</div>

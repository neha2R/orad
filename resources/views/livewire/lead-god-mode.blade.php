<div>
    <div class="card">
        <div class="card-header">
            <h3>Lead God Mode</h3>
            {{-- <span>use class <code>table table-styling</code> inside table element</span> --}}

        </div>
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Whatsapp Mobile</th>
                            <th>Email</th>
                            <th>Entry In System</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name ??''}}</td>
                            <td>{{$item->mobile ?? ''}}</td>
                            <td>{{$item->whatsappnumber ?? ''}}</td>
                            <td>{{$item->email ?? ''}}</td>
                            <td>{{$item->created_at ?? ''}}</td>
                            <td>
                                <ul class="progress-indicator">
                                <li 
                                @if ($item->seniorMarketingRelation)
                                 
                                class="completed"
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="{{messageforgodmodelead($item->seniorMarketingRelation)}}"
                                @else
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="No Action Taken Yet"
                                @endif
                                 > <span class="bubble"></span> Senior Marketing. </li>
                                <li @if ($item->juniorMarketingRelation)
                                    class="completed"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="{{messageforgodmodelead($item->juniorMarketingRelation)}}"
                                    @else
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="No Action Taken Yet"
                                    @endif> <span class="bubble"></span> Junior Marketing. </li>
                                <li  @if ($item->seniorTrainerRelation)
                                    class="completed"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="{{messageforgodmodelead($item->seniorTrainerRelation)}}"
                                    @else
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="No Action Taken Yet"
                                    @endif> <span class="bubble"></span> Senior Trainer. </li>
                                <li @if ($item->juniorTrainerRelation)
                                    class="completed"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="{{messageforgodmodelead($item->juniorTrainerRelation)}}"
                                    @else
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="No Action Taken Yet"
                                    @endif> <span class="bubble"></span> Junior Trainer. </li>
                                <li 
                                @if ($item->demo)
                                @if($item->demo->is_demodone)
                                class="completed"
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="Demo is done by trainer on date {{$item->demo->date}}"
                                    @else
                                    class="completed"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="Demo is schedule by trainer for date {{$item->demo->date}}"
                                @endif
                                
                                @else
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="No Action Taken Yet"
                                @endif   
                                > 
                                    <span class="bubble"></span> Demo Status
                                
                                </li>
                                <li> 
                                    {{-- @if($condition)
                                        @else
                                    @endif --}}
                                    <span class="bubble"></span> Payment Status
                                 </li>
                                </ul>
                            </td>
                        </tr> 
                        @endforeach
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

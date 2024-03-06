<div wire:ignore.self class="modal fade " id="reassignlead" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Slot time</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="reassign" method="POST">
                @csrf
                <div class="modal-body">
                    <h5 class="text-info" style="margin-top: 20px">Preferred Demo Date and Slot of the Lead</h5>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-2">Date :</div>
                        <div class="col-md-4">
                            <input type="date" wire:model.defer="date" min="{{ date('Y-m-d') }}"
                                class="form-control {{ $errors->first('date') ? ' form-control-danger' : '' }}" readonly>
                            @error('date') <span style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2">Time Slot :</div>
                        <div class="col-md-4">
                            <select wire:model.defer="slot" id="slot"
                                class="form-control {{ $errors->first('slot') ? ' form-control-danger' : '' }}">
                                <option value="">--Select--</option>
                                @foreach ($slots as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->from }} - {{ $item->to }}
                                    </option>
                                @endforeach
                            </select>
                            @error('slot') <span style="color:red">{{ $message }}</span> @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Reassign</button>
                </div>
            </form>
        </div>
    </div>
    </div>
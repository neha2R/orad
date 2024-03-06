<div wire:ignore.self class="modal fade" id="contentcomplaint" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="contentcomplaint">Containt Complain</h5>
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
        </form>
    </div>
</div>
</div>
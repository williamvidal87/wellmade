<div>
    <div class="modal-content">
        <form wire:submit.prevent="Stop_worker" enctype="multipart/form-data">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" style="margin-top: -10px;" wire:click='closeStopWorkerForm'><i class="pci-cross pci-circle"></i></button>
                <div class="bootbox-body"><h4>Reason to Stop</h4>
                    <textarea wire:model.defer="reason_stop" name="reason_stop" class="form-control" id="reason_stop" rows="4" required></textarea>
                </div>
        </div>
        <div class="modal-footer">
                    <button wire:click='closeStopWorkerForm' data-bb-handler="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" data-bb-handler="confirm" class="btn btn-primary" value="OK">
        </div>
        </form>
    </div>
</div>

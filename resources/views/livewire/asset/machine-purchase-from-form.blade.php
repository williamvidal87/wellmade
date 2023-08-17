<div>
    <div wire:ignore.self class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Machine Purchase From</h4>
            <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
        </div>

        <form class="horizontal" wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="modal-body d-flex justify-content-between">
                <div class="panel">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="machine_purchase_from_name">Machine Purchase From Name</label>
                                    <input type="text" wire:model="machine_purchase_from_name" name="machine_purchase_from_name" id="machine_purchase_from_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal body -->
            <div class="modal-footer">
                <div class="form-group btn-group mr-4">
                    <!-- <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button> -->
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
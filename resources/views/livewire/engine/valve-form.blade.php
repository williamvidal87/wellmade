<div>
    <div wire:ignore.self class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Valve</h4>
            <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            {{-- <a type="button" class="close" data-dismiss="modal" wire:click="closemodal">&times;</a> --}}
        </div>
        <form class="horizontal" wire:submit.prevent="store" enctype="multipart/form-data">

            <!-- Modal body -->
            <div class=" modal-body d-flex justify-content-between">
                <div class="panel">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="form-group">
                                <label for="valve">Valve</label>
                                <input type="text" wire:model="valve" class="form-control" id="valve" required>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal body -->
            <div class="modal-footer">
                <div class="form-group btn-group mr-4">
                    <!-- <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
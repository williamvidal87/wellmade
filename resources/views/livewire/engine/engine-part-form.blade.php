<div>
    <div>
        <div>
            <div class="modal-content">
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Engine Parts List</h4>
                        <a type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>

                    <!-- Modal body -->
                    <div class=" modal-body">
                        <div class="form-group">
                            <label>Engine Part Name</label>
                            <input type="text" wire:model="engine_part_name" name="engine_part_name"
                                class="form-control" required>
                            @if ($errors->has('engine_part_name'))
                                <p style="color:red">{{ $errors->first('engine_part_name') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary  pull-right">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

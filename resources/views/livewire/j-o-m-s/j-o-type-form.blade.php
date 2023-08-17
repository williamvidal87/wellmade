<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Job Type</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <!-- Abbriv Code -->
                    <label>Abbriv Code</label>
                    <input type="text" wire:model="abbriv_code" name="abbriv_code" class="form-control" required>
                    @if ($errors->has('abbriv_code'))
                        <p style="color:red">{{ $errors->first('abbriv_code') }}</p>
                    @endif
                    <!-- End Abbriv Code -->
                    <br>
                    <!-- Description -->
                    <label for="fordescription">Description</label>
                    <input type="text" wire:model="description" name="description" class="form-control" required>
                    @if ($errors->has('description'))
                        <p style="color:red">{{ $errors->first('description') }}</p>
                    @endif
                    <!-- End Description -->
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

<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Generate </h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="filterFrom_id"> From :</label>
                    <input type="date" id="filterForm_id" wire:model.defer="start_date" name="start_date" class="p-5 form-control">
                    <label for="filterTo_id"> To :</label>
                    <input type="date" id="filterTo_id" wire:model.defer="end_date" name="end_date" class="p-5 form-control">
                </div>
            </div>
            <br><br>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="filter" class="btn btn-primary btn-sm pull-right"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

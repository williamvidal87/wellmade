<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Summary of Consume for The Day</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="filterFrom_id"> Date of Report from :</label>
                    <input type="date" id="filterForm_id" wire:model.defer="start_date" name="start_date"
                        value="{{ isset($start_d) ? $start_d : null }}" class="p-5 form-control">
                        <br>
                    <label for="filterTo_id">Date of Report to :</label>
                    <input type="date" id="filterTo_id" wire:model.defer="end_date" name="end_date"
                        value="{{ isset($end_d) ? $end_d : null }}" class="p-5 form-control">
                </div>
                <br>
            </div>
           
            <!-- Modal footer -->
            <div class="modal-footer bg-trans-dark">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')"
                        class="btn btn-primary btn-sm pull-right"><i class="fa fa-filter"></i> Generate</button>
                </div>
            </div>
        </form>
    </div>
</div>

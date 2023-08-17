<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Daily Reconciliation Report</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="filterFrom_id"> Report Date:</label><br>
                    <input type="date" id="filterFrom_id" wire:model.defer="start_date" name="start_date"                   
                        value="{{ isset($start_d) ? $start_d : date('Y-m-d') }}" class="p-5 form-control">
                        <br>
                    {{-- <label for="filterTo_id"> to :</label>
                    <input type="date" id="filterTo_id" wire:model.defer="end_date" name="end_date"
                        value="{{ isset($end_d) ? $end_d : date('Y-m-d') }}" class="p-5 form-control">    --}}
                </div>
                <br>
            </div>
           
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')"
                        class="btn btn-primary btn-sm pull-right"><i class="fa fa-filter"></i> Generate</button>
                </div>
            </div>
        </form>
    </div>
</div>

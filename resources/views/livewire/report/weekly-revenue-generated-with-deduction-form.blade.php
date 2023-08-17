<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Weekly Revenue Generated with Deduction</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group col-md-12 mt-5">
                    <label class="col-md-4" for="month_ids">Start Date:</label>
                    <input class="col-md-8 p-3" type="date" wire:model.defer="start_date" id="month_ids"  value="{{ isset($start_d) ? $start_d : date('Y-m-d') }}">
                </div>
                <div class="form-group col-md-12 mt-5">
                    <label class="col-md-4" for="month_id">End Date:</label>
                    <input class="col-md-8 p-3" type="date" wire:model.defer="end_date" id="month_id"  value="{{ isset($end_d) ? $end_d : date('Y-m-d') }}">
                </div>            
               
            </div>
            <br>
                <br><br>
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

<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Monthly New Customer Performance and Report</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                    <div class="form-group">
                        <label>1st Month</label>
                        <input type="month" id="filterFrom_id" wire:model="option_one" name="option_one"
                        class="p-5 form-control">

                        <label>2nd Month</label>
                        <input type="month" id="filterFrom_id" wire:model="option_two" name="option_two"
                        class="p-5 form-control">
                    </div>
                <br>
            </div>
           
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="filter"
                        class="btn btn-primary btn-sm pull-right"><i class="fa fa-filter"></i> Generate</button>
                </div>
            </div>
        </form>
    </div>
</div>

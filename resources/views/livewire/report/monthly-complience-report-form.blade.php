<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Month -to- Month Report</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="filterFrom_id"> Report Year Date:</label><br>
                     <input  type="number" min="2000" max="2099" step="1" value="2022" id="filterFrom_id" wire:model.defer="date_year" name="start_date"                   
                        value="{{ isset($year) ? $year : '' }}" class="form-control" style="padding: 20px">
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

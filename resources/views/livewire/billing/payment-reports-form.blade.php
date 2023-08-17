<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Generate</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label for="filterFrom_id"> Month :</label>
                    <input type="month" id="filterForm_id" wire:model.defer="month" name="start_date" class="p-5 form-control">
                </div>
                <div class="form-group">
                    <label for="filterFrom_id"> Inv Type :</label>
                    <select wire:model="invoice_type" name="invoice_type" class="form-control">
                        <option value="">-- Select a invoice type --</option>
                        @foreach ($inv_types as $data)
                            <option value="{{ $data->id }}">
                                {{ $data->invoice_type ?? '' }}
                            </option>
                        @endforeach
                        <option value="3"> WV & SB </option>
                    </select>
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

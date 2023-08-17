<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Delayed</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group col-md-12 mt-3">
                    <label for="month_ids">Date Finished:</label>
                    <input class="col-md-12 p-3"type="date" wire:model.defer="date_finished_id" id="month_ids"  value="{{ isset($start_d) ? $start_d : date('Y-m-d') }}" required>
                    @if($errors->has('date_finished_id'))
                    <p style="color:red">{{$errors->first('date_finished_id')}}</p>
                @endif
                </div>
                <div class="form-group col-md-12 mt-5">
                    <label for="month_id">Delay Reason (if delayed):</label>
                    {{-- <input type="date" wire:model.defer="end_date" id="month_id"  value="{{ isset($end_d) ? $end_d : date('Y-m-d') }}"> --}}
                    <select class="col-md-12"name="" id="" wire:model.defer='delayed_reason_id' required>
                        <option value="">Select Reason</option>
                        <option value="1">MAN</option>
                        <option value="2">MACHINE</option>
                        <option value="3">METHOD</option>
                        <option value="4">MATERIAL</option>
                    </select>
                </div>            
               
            </div>
            <br><br><br>
                <br><br>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')"
                        class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

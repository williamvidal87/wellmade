<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Daily Efficiency Report</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Work Type:</label>
                    <select wire:model.defer="work_type_id" name="work_type_id" class="form-control">
                        <option value="">Select a work type</option>
                        @foreach ($job_types as $job_type)
                            <option value="{{$job_type->id}}"> {{ $job_type->abbriv_code ?? '' }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Report Date:</label>
                    <input type="date" id="filterFrom_id" wire:model.defer="start_date" name="start_date"
                    value="{{ isset($start_d) ? $start_d : date('Y-m-d') }}" class="p-5 form-control">
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

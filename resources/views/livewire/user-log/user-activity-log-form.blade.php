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
                    <label for="filterFrom_id"> from :</label>
                    <input type="date" id="filterForm_id" wire:model.defer="start_date" name="start_date"
                        value="{{ isset($start_d) ? $start_d : date('Y-m-d') }}" class="p-5 form-control">
                    <label for="filterTo_id"> to :</label>
                    <input type="date" id="filterTo_id" wire:model.defer="end_date" name="end_date"
                        value="{{ isset($end_d) ? $end_d : date('Y-m-d') }}" class="p-5 form-control">
                    <select name="subject_id" wire:model.defer="subject_id" class="form-control mt-8 col-md-12">
                        <option value="">Select User</option>
                        @foreach ($user as $data)
                            <option value="{{ $data->id }}">
                                {{ $data->name, isset($current_user) ? $current_user : null }}</option>
                        @endforeach
                    </select>
                  
                </div>
            </div>
            <br><br>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')"
                        class="btn btn-primary btn-sm pull-right"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

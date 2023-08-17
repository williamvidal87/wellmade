<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Worker</h4>
            <button type="button" class="close" data-dismiss="modal" wire:click='closeAddFormWorker'><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="assigned_worker_id">Worker:</label>
                    <div class="col-sm-8">
                        <select name="assigned_worker_id" wire:model="assigned_worker_id"class="form-control select_design" id="mf_work_group_select" required>
                            <option value=''>Choose Worker</option>
                            @foreach($worker as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('assigned_worker_id'))
                    <p style="color:red">{{$errors->first('assigned_worker_id')}}</p>
                    @endif
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="percent_id">Percent:</label>
                    <div class="col-sm-4">
                        <select name="percent_id" wire:model="percent_id" class="form-control select_design" id="percent_id"
                            required>
                            <option value=''>Choose Percent</option>
                            @foreach($percent as $data)
                            <option value="{{ $data->id }}">{{ $data->percent_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('percent_id'))
                    <p style="color:red">{{$errors->first('percent_id')}}</p>
                    @endif
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="parts_percent_id">Part Percent:</label>
                    <div class="col-sm-4">
                        <select name="parts_percent_id" wire:model="parts_percent_id" class="form-control select_design" id="parts_percent_id"
                            required>
                            <option value=''>Choose Part Percent</option>
                            @foreach($part_percent as $data)
                            <option value="{{ $data->id }}">{{ $data->percent_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('parts_percent_id'))
                    <p style="color:red">{{$errors->first('parts_percent_id')}}</p>
                    @endif
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right"
                        for="scope_input">Alloted Hr(s)</label>
                    <div class="col-sm-4">
                        <input type="number" step="any" wire:model.defer="allot_hours" name="allot_hours" class="form-control" id="scope_input" required>
                    </div>
                    @if($errors->has('allot_hours'))
                    <p style="color:red">{{$errors->first('allot_hours')}}</p>
                    @endif
                </div>  
                <br><br>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

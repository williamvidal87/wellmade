
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Operator Monthly Effeciency Report</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group col-md-12 mt-5">
                    <label class="col-md-4" for="work_ids">Worker:</label>
                    <select name="worker_id" wire:model.defer="worker_id" id="work_ids" class="col-md-8">
                        <option value="">Select Worker</option>
                            @foreach($worker as $data)
                            <option value="{{$data->id ?? ''}}">{{$data->name, isset($current_workers) ? $current_workers : null}}</option>
                            @endforeach 
                    </select>  
                </div>
                <div class="form-group col-md-12 mt-5">
                    <label class="col-md-4" for="month_ids">Start Date:</label>
                    <input class="col-md-8 p-3" type="date" wire:model.defer="start_date" id="month_ids"  value="{{ isset($start_d) ? $start_d : date('Y-m-d') }}">
                </div>
                <div class="form-group col-md-12 mt-5">
                    <label class="col-md-4" for="month_id">End Date:</label>
                    <input class="col-md-8 p-3" type="date" wire:model.defer="end_date" id="month_id"  value="{{ isset($end_d) ? $end_d : date('Y-m-d') }}">
                </div>               
                <div class="form-group col-md-12 mt-5">
                    <label class="col-md-4" for="work_type_ids">Work Type:</label>
                    <select name="work_type_id" wire:model.defer="work_type_id" id="work_type_ids" class="col-md-8">
                        <option value="">Select Work Type</option>
                            @foreach($work_type as $data)
                            <option value="{{$data->id}}">{{$data->abbriv_code, isset($current_work_type) ? $current_work_type : null }}</option>
                            @endforeach 
                    </select>        
                </div>                
            </div>
            <br><br>       
            <br><br>       
            <br><br>       
            <br><br>       
            <br><br> 
            <!-- Modal footer -->
            <div class="modal-footer" style="">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')"
                        class="btn btn-primary btn-sm pull-right"><i class="fa fa-filter"></i> Generate</button>
                </div>
            </div>
        </form>
    </div>



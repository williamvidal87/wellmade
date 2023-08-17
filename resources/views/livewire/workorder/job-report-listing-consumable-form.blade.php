<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">SUMMARY OF CONSUME FOR THE DAY</h4>
            <button type="button" class="close" data-dismiss="modal" wire:click='closeModalConsumable'><i class="pci-cross pci-circle"></i></button>
            </div>
            <br>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="assigned_worker_id">Parts/Stocks List:</label>
                    <div class="col-sm-9">
                        <select name="stock_management_id" wire:model.defer="stock_management_id"class="form-control select_design" id="assigned_worker_id" required>
                            <option value=''>-- Choose Parts/Stocks List--</option>
                            @foreach($stocks as $data)                           
                            <option value="{{ $data->id }}">{{$data->item_code}} - {{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('stock_management_id'))
                    <p style="color:red">{{$errors->first('stock_management_id')}}</p>
                    @endif
                </div>
                <br><br>
                {{-- <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="assigned_worker_id">Auth to Withdraw:</label>
                    <div class="col-sm-9">
                        <select name="user_id" wire:model="user_id"class="form-control select_design" id="mf_work_group_select" required>
                            <option value=''>-- Choose an Employee --</option>
                            @foreach($user_auth as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('user_id'))
                    <p style="color:red">{{$errors->first('user_id')}}</p>
                    @endif
                </div>
                <br><br> --}}
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="work_area_id">Work Area:</label>
                    <div class="col-sm-9">
                        {{-- <input type="text" name="on_site" wire:model.defer="on_site" class="form-control"> --}}
                        <select name="work_area_id" wire:model="work_area_id" class="form-control select_design" id="work_area_id"
                            required>
                            <option value=''>--Choose Work Area--</option>
                            @foreach($workArea as $data)
                            <option value="{{ $data->id }}">{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('work_area_id'))
                    <p style="color:red">{{$errors->first('work_area_id')}}</p>
                    @endif
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="department_id">Department:</label>
                    <div class="col-sm-9">
                        <select name="department_id" wire:model="department_id" class="form-control select_design" id="department_id"
                            required>
                            <option value=''>--Choose Department--</option>
                            @foreach($departments as $data)
                            <option value="{{ $data->id }}">{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('department_id'))
                    <p style="color:red">{{$errors->first('department_id')}}</p>
                    @endif
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="user_id">User:</label>
                    <div class="col-sm-9">
                        <select name="user_id" wire:model="user_id" class="form-control select_design" id="user_id"
                            required>
                            <option value=''>--Choose Operator--</option>
                            @foreach($operator as $data)
                            <option value="{{ $data->id }}">{{ $data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('user_id'))
                    <p style="color:red">{{$errors->first('user_id')}}</p>
                    @endif
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right"
                        for="scope_input">Date of Use:</label>
                    <div class="col-sm-9">
                        <input type="date" wire:model.defer="date_of_use" name="date_of_use" class="form-control" id="scope_input" required>
                    </div>
                    @if($errors->has('date_of_use'))
                    <p style="color:red">{{$errors->first('date_of_use')}}</p>
                    @endif
                </div>  
                <br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right"
                        for="sty_input">Qty:</label>
                    <div class="col-sm-9">
                        <input type="number" wire:model.defer="quantity" name="quantity" class="form-control" id="sty_input" required>
                    </div>
                    @if($errors->has('quantity'))
                    <p style="color:red">{{$errors->first('quantity')}}</p>
                    @endif
                </div>  
                <br><br>  
            </div>

            <!-- Modal footer -->
            <div class="modal-footer bg-trans-dark">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

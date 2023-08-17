<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Scope Description</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Sub Type</label>
                    <select name="sub_type_id" wire:model="sub_type_id" class="form-control">
                        <option value=''>--Choose Sub Type--</option>
                        @foreach($subtypes as $data)
                            <option value="{{ $data->id }}">{{ $data->sub_group }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('sub_type_id'))
                    <p style="color:red">{{$errors->first('sub_type_id')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>General Procedure</label>
                    <select name="general_procedure_id" wire:model="general_procedure_id" class="form-control">
                        <option value=''>--Choose General Procedure--</option>
                        @foreach($general_procedure as $data)
                        @if($data->work_sub_type_id==$this->sub_type_id)
                            <option value="{{ $data->id }}">{{ $data->general_procedure_name }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('general_procedure_id'))
                    <p style="color:red">{{$errors->first('general_procedure_id')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Scope Description</label>
                    <input  type="text" wire:model="scope_description_name" name="scope_description_name" class="form-control" required>
                    @if($errors->has('scope_description_name'))
                    <p style="color:red">{{$errors->first('scope_description_name')}}</p>
                    @endif
                </div>       
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

<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">General Procedure </h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Work Groups</label>
                    <select name="groups_id" wire:model="groups_id" 
                        class="form-control">
                        <option value=''>--Choose Work Groups--</option>
                        @foreach($groups as $data)
                            <option value="{{ $data->id }}">{{ $data->group_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('groups_id'))
                    <p style="color:red">{{$errors->first('groups_id')}}</p>
                    @endif
                </div><div class="form-group">
                    <label>Sub Type</label>
                    <select name="work_sub_type_id" wire:model="work_sub_type_id" 
                        class="form-control">
                        <option value=''>--Choose Sub Type--</option>
                        @foreach($worksubtype as $data)
                        @if($data->group_id==$groups_id)
                            <option value="{{ $data->id }}">{{ $data->sub_group }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('work_sub_type_id'))
                    <p style="color:red">{{$errors->first('work_sub_type_id')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>General Procedure Name</label>
                    <input type="text" wire:model="general_procedure_name" name="general_procedure_name"
                        class="form-control" required>
                    @if ($errors->has('general_procedure_name'))
                        <p style="color:red">{{ $errors->first('general_procedure_name') }}</p>
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

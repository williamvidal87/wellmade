<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Process Sub Group</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Group</label>
                    <select name="process_group_id" wire:model="process_group_id" 
                        class="form-control">
                        <option value=''>--Choose Group--</option>
                        @foreach($groups as $data)
                            <option value="{{ $data->id }}">{{ $data->process_group_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('process_group_id'))
                    <p style="color:red">{{$errors->first('process_group_id')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Process Sub Group Name</label>
                    <input  type="text" wire:model="process_sub_group_name" name="process_sub_group_name" class="form-control" required>
                    @if($errors->has('process_sub_group_name'))
                    <p style="color:red">{{$errors->first('process_sub_group_name')}}</p>
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

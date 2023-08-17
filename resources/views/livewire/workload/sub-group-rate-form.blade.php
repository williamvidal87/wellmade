<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Sub-Group and Rates</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                
                    <label>Group</label>
                    <select name="group_id" wire:model="group_id" class="form-control">
                            <option value=''>--Select a Mf Group--</option>
                            @foreach($SubGroup as $data)
                                <option value="{{ $data->id }}">{{ $data->group_name }}</option>
                            @endforeach
                        </select>
                    @if($errors->has('group_id'))
                    <p style="color:red">{{$errors->first('group_id')}}</p>
                    @endif
                    <label>Sub Group</label>
                    <input  type="text" wire:model="sub_group" name="sub_group" class="form-control" required>
                    @if($errors->has('sub_group'))
                    <p style="color:red">{{$errors->first('sub_group')}}</p>
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

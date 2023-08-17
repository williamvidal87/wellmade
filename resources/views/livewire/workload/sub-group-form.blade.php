<div>
    <div class="modal-content">
        <form wire:submit.prevent="store()" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Group</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                
                    <label>Job Type</label>
                    <select name="job_type_id" wire:model="job_type_id" class="form-control">
                            <option value=''>--Select a Job Type--</option>
                            @foreach($jobtype as $data)
                                <option value="{{ $data->id }}">{{ $data->description }}</option>
                            @endforeach
                        </select>
                    @if($errors->has('job_type_id'))
                    <p style="color:red">{{$errors->first('job_type_id')}}</p>
                    @endif
                    
                    <label>Group Name</label>
                    <input type="text" wire:model="group_name" name="group_name" class="form-control" required>
                    @if ($errors->has('group_name'))
                        <p style="color:red">{{ $errors->first('group_name') }}</p>
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

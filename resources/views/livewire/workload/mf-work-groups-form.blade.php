<div>
    <div>
        <div class="modal-content"> 
            <form wire:submit.prevent="store()" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Mf Work Group</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" wire:model="mf_work_group_name" name="mf_work_group_name" class="form-control"
                        required>
                    @if ($errors->has('mf-work_group_name'))
                        <p style="color:red">{{ $errors->first('mf_work_group_name') }}</p>
                    @endif
                </div>               
            </div>
             <!-- Modal footer -->
             <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right">Save</button>
                </div>
            </form>
        </div>
    </div>
    
</div>

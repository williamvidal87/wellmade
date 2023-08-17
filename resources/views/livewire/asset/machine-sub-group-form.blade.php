<div>
    <div>
        <div>
            <div class="modal-content"> 
                <form wire:submit.prevent="store()" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Machine Sub Group</h4>
                    <a type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    
                    <!-- Modal body -->
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="machine_sub_group_name_ids">Machine Sub Group:</label>
                            <input type="text" wire:model.defer="machine_sub_group_name" name="machine_sub_group_name" class="form-control" id="machine_sub_group_names_ids" required>   
                            @if($errors->has('machine_sub_group_name'))
                            <p style="color:red">{{$errors->first('machine_sub_group_name')}}</p>
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
        
    </div>
    
</div>

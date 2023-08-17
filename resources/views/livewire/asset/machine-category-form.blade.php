<div>
    <div>
        <div>
            <div class="modal-content"> 
                <form wire:submit.prevent="store()" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Machine Category</h4>
                    <a type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    
                    <!-- Modal body -->
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="machine_category_name_ids">Machine Category:</label>
                            <input  type="text" wire:model.defer="machine_category_name" name="machine_category_name" class="form-control" id="machine_category_name_ids" required>                               
                            @if($errors->has('machine_category_name'))
                            <p style="color:red">{{$errors->first('machine_category_name')}}</p>
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

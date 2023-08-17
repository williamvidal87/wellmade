<div>
    <div>
        <div>
            <div class="modal-content"> 
                <form wire:submit.prevent="store()" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Machine Number</h4>
                    <a type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    
                    <!-- Modal body -->
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="machine_id_numbers_ids">Machine Number:</label>
                            <input type="number" wire:model.defer="machine_id_number" name="machine_id_number" class="form-control" id="machine_id_numbers_ids" required>   
                            @if($errors->has('machine_id_number'))
                            <p style="color:red">{{$errors->first('machine_id_number')}}</p>
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

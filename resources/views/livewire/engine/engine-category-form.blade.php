<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Engine Category</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Engine Category</label>
                    <input  type="text" wire:model="engine_category" name="engine_category" class="form-control" required>
                    @if($errors->has('engine_category'))
                    <p style="color:red">{{$errors->first('engine_category')}}</p>
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
<<<<<<< HEAD
<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Engine Category</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Engine Category</label>
                    <input  type="text" wire:model="engine_category" name="engine_category" class="form-control" required>
                    @if($errors->has('engine_category'))
                    <p style="color:red">{{$errors->first('engine_category')}}</p>
                    @endif
                </div>       
            </div>
=======
>>>>>>> feature/workload


<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Update Price</h4>
            <a type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="price">Price</label>
                    <div class="col-sm-8">
                        <input type="number" wire:model="selling_price" name="selling_price" class="form-control" id="selling_price" required>
                    </div>
                    @if($errors->has('selling_price'))
                        <p style="color:red">{{$errors->first('selling_price')}}</p>
                    @endif
                </div>  
                <br><br>
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

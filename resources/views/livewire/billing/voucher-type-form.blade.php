<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Voucher Type</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div>
                    <div class="form-group">
                        <label>Type</label>
                        <input  type="text" wire:model="type" name="type" class="form-control" required>
                        @if($errors->has('type'))
                        <p style="color:red">{{$errors->first('type')}}</p>
                        @endif
                    </div>
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

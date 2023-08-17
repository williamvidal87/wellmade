<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Supplier Record</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input  type="text" wire:model.defer="name" name="name" class="form-control" required>
                    @if($errors->has('name'))
                    <p style="color:red">{{$errors->first('name')}}</p>
                    @endif
                </div>    
                <div class="form-group">
                    <label>Email</label>
                    <input  type="text" wire:model.defer="email" name="email" class="form-control">
                    @if($errors->has('email'))
                    <p style="color:red">{{$errors->first('email')}}</p>
                    @endif
                </div>   
                <div class="form-group">
                    <label>Address</label>
                    <input  type="text" wire:model.defer="address" name="address" class="form-control" required>
                    @if($errors->has('address'))
                    <p style="color:red">{{$errors->first('address')}}</p>
                    @endif
                </div>     
                <div class="form-group">
                    <label>Contact Number</label>
                    <input  type="tel" wire:model.defer="contact_no" name="contact_no" class="form-control">
                    @if($errors->has('contact_no'))
                    <p style="color:red">{{$errors->first('contact_no')}}</p>
                    @endif
                </div>   
                <div class="form-group">
                    <label>Contact Person</label>
                    <input  type="text" wire:model.defer="contact_person" name="contact_person" class="form-control">
                    @if($errors->has('contact_person'))
                    <p style="color:red">{{$errors->first('contact_person')}}</p>
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

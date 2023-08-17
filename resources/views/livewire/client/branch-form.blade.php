<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Branch</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Company Name</label>
                    <input  type="text" wire:model="company_name" name="company_name" class="form-control" required>
                    @if($errors->has('company_name'))
                    <p style="color:red">{{$errors->first('company_name')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Branch Name</label>
                    <input  type="text" wire:model="branch_name" name="branch_name" class="form-control" required>
                    @if($errors->has('branch_name'))
                    <p style="color:red">{{$errors->first('branch_name')}}</p>
                    @endif
                </div> 
                <div class="form-group">
                    <label>Address</label>
                    <input  type="text" wire:model="address" name="address" class="form-control" required>
                    @if($errors->has('address'))
                    <p style="color:red">{{$errors->first('address')}}</p>
                    @endif
                </div> 
                <div class="form-group">
                    <label>Contact No.</label>
                    <input  type="text" wire:model="contact_no" name="contact_no" class="form-control" required>
                    @if($errors->has('contact_no'))
                    <p style="color:red">{{$errors->first('contact_no')}}</p>
                    @endif
                </div> 
                <div class="form-group">
                    <label>Owner Name</label>
                    <input  type="text" wire:model="owner_name" name="owner_name" class="form-control" required>
                    @if($errors->has('owner_name'))
                    <p style="color:red">{{$errors->first('owner_name')}}</p>
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

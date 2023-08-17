<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User Report Listing</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">                        
                    <select name="roles_id" wire:model.defer="roles_id" class="form-control mt-5 col-md-12 select_design">
                    <option value="">-- Select Roles --</option>
                    @foreach($user_role as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                    </select>   
                </div>
            </div>
            <br>    
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')" class="btn btn-primary btn-sm pull-right" ><i class="fa fa-filter"></i> Generate</button>
                </div>
            </div>
        </form>        
    </div>
</div>

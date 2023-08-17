<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Set Role with Permission</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" style="height: 150px; overflow-y: scroll;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input  type="text" wire:model="name" name="name" class="form-control" required readonly>
                        @if($errors->has('name'))
                        <p style="color:red">{{$errors->first('name')}}</p>
                        @endif
                    </div>
                        {{-- <div>
                            <h5>PAGES</h5>
                            <div>
                            <input type="checkbox"  wire:model="selection_pages" class="form-check-input"  value="ClientContact" id="ClientContact">
                            <label class="form-check-label" for="ClientContact">ClientContact</label>
                            </div>
                            
                            <div>
                            <input type="checkbox"  wire:model="selection_pages" class="form-check-input"  value="UserManagement" id="UserManagement">
                            <label class="form-check-label" for="UserManagement">UserManagement</label>
                            </div>
                            
                            <div>
                            <input type="checkbox"  wire:model="selection_pages" class="form-check-input"  value="Inventory" id="Inventory">
                            <label class="form-check-label" for="Inventory">Inventory</label>
                            </div>
                            
                            <div>
                            <input type="checkbox"  wire:model="selection_pages" class="form-check-input"  value="JobOrderManagement" id="JobOrderManagement">
                            <label class="form-check-label" for="JobOrderManagement">JobOrderManagement</label>
                            </div>
                            
                            <div>
                            <input type="checkbox"  wire:model="selection_pages" class="form-check-input"  value="WorkLoadManagement" id="WorkLoadManagement">
                            <label class="form-check-label" for="WorkLoadManagement">WorkLoadManagement</label>
                            </div>
                            
                            <div>
                            <input type="checkbox"  wire:model="selection_pages" class="form-check-input"  value="Billing" id="Billing">
                            <label class="form-check-label" for="Billing">Billing</label>
                            </div>
                            
                            <div>
                            <input type="checkbox"  wire:model="selection_pages" class="form-check-input"  value="Miscellaneous" id="Miscellaneous">
                            <label class="form-check-label" for="Miscellaneous">Miscellaneous</label>
                            </div>
                            
                                    
                        </div>    --}}
                </div>
                <div class="col-md-6">
                    <h5>Set Permissions</h5>
                    @if (empty($selectedRoles))
                        @foreach($perms as $perm)
                            <div class="form-check mb-2">
                                <input type="checkbox"  wire:model="permissions" class="form-check-input"  value="{{$perm->id}}" id="{{ $perm->id }}">
                                <label class="form-check-label" for="{{ $perm->id }}">{{ $perm->name }}</label>
                                @if($errors->has('name'))
                                <p style="color:red">{{$errors->first('name')}}</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        @foreach($perms as $key => $value)
                            <div class="form-check mb-2">
                                <input class="form-check-input" wire:model="selectedRoles" value="{{ $value->id }}" type="checkbox" id="{{ $value->name }}" {{ in_array($value->id, $selectedRoles) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $value->name }}">{{ $value->name }}</label>
                            </div>
                        @endforeach
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

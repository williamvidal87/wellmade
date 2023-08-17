<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">User Profile</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-7 border-right">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input  type="text" wire:model.defer="name" name="name" class="form-control" required>
                            @if($errors->has('name'))
                            <p style="color:red">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea type="text" wire:model.defer="address" name="address" class="form-control"></textarea>
                            @if($errors->has('address'))
                            <p style="color:red">{{$errors->first('address')}}</p>
                            @endif
                        </div> 
                        <div class="form-group">
                            <label>Contact No</label>
                            <input  type="tel" wire:model.defer="contact_no" name="contact_no" class="form-control">
                            @if($errors->has('contact_no'))
                            <p style="color:red">{{$errors->first('contact_no')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input  type="text" wire:model.defer="email" name="email" class="form-control">
                            @if($errors->has('email'))
                            <p style="color:red">{{$errors->first('email')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Person</label>
                            <input  type="text" wire:model.defer="emergency_contact_person" name="emergency_contact_person" class="form-control">
                            @if($errors->has('emergency_contact_person'))
                            <p style="color:red">{{$errors->first('emergency_contact_person')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Address</label>
                            <textarea type="text" wire:model.defer="emergency_contact_address" name="emergency_contact_address" class="form-control"></textarea>
                            @if($errors->has('emergency_contact_address'))
                            <p style="color:red">{{$errors->first('emergency_contact_address')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact No</label>
                            <input  type="tel" wire:model.defer="emergency_contact_no" name="emergency_contact_no" class="form-control">
                            @if($errors->has('emergency_contact_no'))
                            <p style="color:red">{{$errors->first('emergency_contact_no')}}</p>
                            @endif
                        </div> 
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Username</label>
                            <input  type="text" wire:model.defer="username" name="username" class="form-control" required>
                            @if($errors->has('username'))
                            <p style="color:red">{{$errors->first('username')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input  type="password" wire:model.defer="password" name="password" class="form-control" >
                            @if($errors->has('password'))
                            <p style="color:red">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input  type="password" wire:model.defer="password_confirmation" name="password_confirmation" class="form-control" >
                            @if($errors->has('password_confirmation'))
                            <p style="color:red">{{$errors->first('password_confirmation')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-bold">Role(s)</label>
                            <div style="height: 150px; overflow-y: scroll;">
                                @if (empty($selectedRoles))
                                    @forelse ($roles as $role)
                                        <div class="form-check mb-2">
                                            <input wire:model.defer="roleCheck" type="checkbox" class="form-check-input"  value="{{ $role->name }}" id="{{ $role->name }}">
                                            <label class="form-check-label" for="{{ $role->name }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>No roles found</p>
                                    @endforelse
                                @else
                                    @forelse ($roles as $role)
                                        <div class="form-check mb-2">
                                            <input wire:model.defer="selectedRoles" type="checkbox" class="form-check-input"  value="{{ $role->name }}" id="{{ $role->name }}" {{ in_array($role->name, $selectedRoles) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $role->name }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>No roles found</p>
                                    @endforelse
                                @endif
                            </div>
                        </div>
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

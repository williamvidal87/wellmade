<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Add New Stock</h4>
            <a type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-6 border-right">  
                        <div class="form-group">
                            <label>Item Code</label>
                            <input  type="text" wire:model.defer="item_code" name="item_code" class="form-control" required>
                            @if($errors->has('item_code'))
                            <p style="color:red">{{$errors->first('item_code')}}</p>
                            @endif
                        </div>   
                        <div class="form-group">
                            <label>Supplier</label>
                            <select wire:model.defer="supplier" name="supplier" class="form-control" required>
                                <option value="">-- Select a supplier --</option>
                                @forelse ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('supplier'))
                            <p style="color:red">{{$errors->first('supplier')}}</p>
                            @endif
                        </div>     
                        <div class="form-group">
                            <label>Item Name</label>
                            <input  type="text" wire:model.defer="name" name="name" class="form-control" required>
                            @if($errors->has('name'))
                            <p style="color:red">{{$errors->first('name')}}</p>
                            @endif
                        </div>   
                        <div class="form-group">
                            <label>Description</label>
                            <textarea  wire:model.defer="description" name="description" class="form-control" required></textarea>
                            @if($errors->has('description'))
                            <p style="color:red">{{$errors->first('description')}}</p>
                            @endif
                        </div>  
                        <div class="form-group">
                            <label>Serial Number</label>
                            <input type="text"  wire:model.defer="serial" name="serial" class="form-control" required>
                            @if($errors->has('serial'))
                            <p style="color:red">{{$errors->first('serial')}}</p>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="text" wire:model.lazy="unit_price" name="unit_price" class="form-control" style="text-align:right;" required>
                                    @if($errors->has('unit_price'))
                                    <p style="color:red">{{$errors->first('unit_price')}}</p>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Conversion Rate</label>
                                    <input type="number" step="1" wire:model.defer="conversion_rate" name="conversion_rate" class="form-control" style="text-align:right;" step="any" required>
                                    @if($errors->has('conversion_rate'))
                                    <p style="color:red">{{$errors->first('conversion_rate')}}</p>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="number"  wire:model.defer="qty" name="qty" class="form-control" min="0" required>
                                    @if($errors->has('qty'))
                                    <p style="color:red">{{$errors->first('qty')}}</p>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Unit Type</label>
                                    <select wire:model.defer="unit_type_id" name="unit_type_id" class="form-control" required>
                                        <option value="">-- Select a Unit Type --</option>
                                        @forelse ($unit_types as $unit_type)
                                            <option value="{{ $unit_type->id }}">{{ $unit_type->longdescription }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if($errors->has('unit_type_id'))
                                    <p style="color:red">{{$errors->first('unit_type_id')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Department</label>
                            <select wire:model.defer="department_id" name="department_id" class="form-control" required>
                                <option value="">-- Select a department --</option>
                                @forelse ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('department_id'))
                            <p style="color:red">{{$errors->first('department_id')}}</p>
                            @endif
                        </div>  
                        <div class="form-group">
                            <label>Brand</label>
                            <input type="text"  wire:model.defer="brand" name="brand" class="form-control" required>
                            @if($errors->has('brand'))
                            <p style="color:red">{{$errors->first('brand')}}</p>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label>Loan-Consume Status</label>
                            <select wire:model.defer="loan_consume_status_id" name="loan_consume_status_id" class="form-control" required>
                                <option value="">-- Select a loan consume status --</option>
                                @forelse ($loan_consume_status as $loan_consume)
                                    <option value="{{ $loan_consume->id }}">{{ $loan_consume->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('loan_consume_status_id'))
                            <p style="color:red">{{$errors->first('loan_consume_status_id')}}</p>
                            @endif
                        </div> --}}
                        <div class="form-group">
                            <label class="text-bold">Loan-Consume Status</label>
                            <div style="height: 150px; overflow-y: scroll;">
                                {{-- @if (empty($selectedRoles)) --}}
                                    @foreach ($loan_consume_status as $loan_consume)
                                        <div class="form-check mb-2">
                                            <input wire:model.defer="loan_consume_ids" type="checkbox" class="form-check-input"  value="{{ $loan_consume->id }}" id="{{ $loan_consume->name }}">
                                            <label class="form-check-label" for="{{ $loan_consume->name }}">
                                                {{ $loan_consume->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                {{-- @else
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
                                @endif --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Item Image</label>
                            <input type="file"  wire:model.defer="item_image" name="item_image" class="form-control" accept="image/*">
                            @if($errors->has('item_image'))
                            <p style="color:red">{{$errors->first('item_image')}}</p>
                            @endif
                            @if ($item_image)
                                <div class="d-flex">
                                    <span class="text-success">Photo Preview:</span>
                                    <img src="{{ $isUploaded ? $item_image->temporaryUrl() : url('storage/images/'. $item_image) }}" width="200" height="250">
                                </div>
                            @endif
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

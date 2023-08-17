<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="storeContact" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Contact Person</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Industry</label>
                    <select wire:model="client_types_id" name="client_types_id" class="form-control" required>
                        <option value="">-- Select a industry --</option>
                        @forelse ($client_types as $data)
                            <option value="{{ $data->id }}">{{ $data->getIndustry->name ?? ""}} - {{ $data->client_type ?? ""}}</option>
                        @empty
                        @endforelse
                    </select>
                    @if($errors->has('client_types_id'))
                    <p style="color:red">{{$errors->first('client_types_id')}}</p>
                    @endif
                </div> 
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input  type="text" wire:model="name" name="name" class="form-control" required>
                            @if($errors->has('name'))
                            <p style="color:red">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input  type="text" wire:model="address" name="address" class="form-control">
                            @if($errors->has('address'))
                            <p style="color:red">{{$errors->first('address')}}</p>
                            @endif
                        </div>  
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Contact No.</label>
                            <input  type="text" wire:model="contact_no" name="contact_no" class="form-control">
                            @if($errors->has('contact_no'))
                            <p style="color:red">{{$errors->first('contact_no')}}</p>
                            @endif
                        </div>  
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>CSA Type</label>
                            <select wire:model="csa_type_id" name="csa_type_id" class="form-control" required>
                                <option value="">-- Select a csa type --</option>
                                @forelse ($csa_types as $data)
                                    <option value="{{ $data->id }}">{{ $data->csa_type }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('csa_type_id'))
                            <p style="color:red">{{$errors->first('csa_type_id')}}</p>
                            @endif
                        </div> 
                    </div>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input  type="file" wire:model="image" name="image" class="form-control">
                    @if($errors->has('image'))
                        <p style="color:red">{{$errors->first('image')}}</p>
                    @endif
                    @if ($image)
                        @if (!$isUploaded)
                            <div class="mt-2">
                                <button wire:click.prevent="removeImage({{ $contactId }})" class="btn btn-danger" title="Remove Image"><i class="fa fa-trash"></i></button>
                            </div>
                        @endif
                        <div class="d-flex">
                            <span class="text-success">Photo Preview:</span>
                            <img src="{{ $isUploaded ? $image->temporaryUrl() : url('storage/images/'. $image) }}" width="200" height="250">
                        </div>
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

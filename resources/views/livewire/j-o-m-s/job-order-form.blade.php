<div>
    <div wire:ignore.self class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Job Order Form</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
        </div>

        <form class="horizontal" wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="modal-body d-flex justify-content-between">
                <div class="panel">
                    <div class="row">
                        <div class="col-md-12">
                            <livewire:flash-message.job-order-form-flash-message-modal />
                        </div>
                    </div>
                    <div class="row">
                        {{-- Left Side --}}
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="reference_no">REFERENCE No.</label>
                                    <input type="text" wire:model="reference_no" name="reference_no" id="reference_no" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jo_no">JO No.</label>
                                    <input type="text" wire:model="jo_no" name="jo_no" id="jo_no" class="form-control" required readonly>
                                </div>
                            </div>
                            <?php 

                                if(is_null($this->date) && is_null($this->po_date) && is_null($this->date_commited) && is_null($this->date_receive)){
                                    $this->date = date("Y-m-d");
                                    $this->po_date = date("Y-m-d");
                                    $this->date_commited = date("Y-m-d");
                                    $this->date_receive = date("Y-m-d");
                                }
                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="date">DATE</label>
                                    <input type="date" class="form-control" value="{{ $date }}" id="date" wire:model="date" name="date" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="serial_no">SERIAL No.</label>
                                <input type="text" wire:model="serial_no" id="serial_no" class="form-control" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6" wire:ignore>
                                    <label class="control-label" for="customer_id">CUSTOMER</label>
                                    <select wire.ignore.self id="customerID" name="customer_id" class="form-control" wire:model="customer_id" style="width:100%" required>
                                        <option value='' style="font-family:Courier New;text-align:center">-- CUSTOMER NAME --</option> 
                                        @foreach ($client_profile as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="csa_foreign_name">CSA</label>
                                    <input type="text" class="form-control" id="csa_foreign_name" value="{{ $csa_foreign_name }}" wire:model="csa_foreign_name" name="csa_foreign_name"  required readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="po_no">PO No.</label>
                                    <input type="integer" class="form-control" id="po_no" wire:model="po_no" name="po_no">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="po_date">PO Date</label>
                                    <input type="date" class="form-control" value={{ $po_date }} id="po_date" wire:model="po_date" name="po_date" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="contact_person">ASSIGNED MECHANIC</label>
                                    {{-- <input type="text" class="form-control" id="contact_person_form" value="{{ $contact_person_form }}" wire:model="contact_person_form" name="contact_person_form"  required readonly> --}}
                                    <select wire.ignore.self name="contact_person" class="form-control" wire:model="contact_person" id="contact_person">
                                        <option value='' style="font-family:Courier New;text-align:center">-- MECHANIC --</option>
                                        @foreach ($contacts as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}
                                            </option>
                                        @endforeach
                                        <option value="0">None</option>
                                        @if ($errors->has('contact_person'))
                                            <p style="color:red">{{ $errors->first('contact_person') }}</p>
                                        @endif
                                    </select><br><br>
                                    <button class="btn btn-dark btn-labeled btn-sm"  wire:click.prevent="addContact" type="submit"><i class="btn-label fa fa-user-o icon-fw"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        {{-- End Left Side --}}
                        {{-- Right Side --}}
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="engineModel">ENGINE MODEL</label>
                                    <select wire.ignore.self name="engine_model" class="form-control" wire:model="engine_model" id="engineModel" style="width:100%">
                                        <option value='' style="font-family:Courier New;text-align:center">-- SELECT ENGINE MODEL --</option>
                                        @foreach ($engine_models as $data)
                                            {{-- @dd($data->model); --}}
                                            <option value="{{ $data->id }}">{{ $data->model ?? "" }}
                                            </option>
                                        @endforeach
                                        <option value="0" style="background-color: #000000;">None</option>
                                        @if ($errors->has('engine_model'))
                                            <p style="color:red">{{ $errors->first('engine_model') }}</p>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-xs-5">
                                    <label class="control-label" for="category">Make</label>
                                    <input type="text" class="form-control" id="makelist_foreign_name" value="{{ $makelist_foreign_name ?? "" }}" wire:model="makelist_foreign_name" name="makelist_foreign_name"  readonly>
                                </div>
                                <div class="form-group mb-4 col-xs-3">
                                    <label class="control-label" for="category">Category</label>
                                    <input type="text" class="form-control" id="category_foreign_name" value="{{ $category_foreign_name ?? "" }}" wire:model="category_foreign_name" name="category_foreign_name"  readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="date_receive">DATE RECEIVED</label>
                                    <input type="date" id="date_receive" value="{{ $date_receive }}" class="form-control mx-sm-3" wire:model="date_receive" name="date_receive" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_commited">DATE COMMITED</label>
                                    <input type="date" id="date_commited" value="{{ $date_commited }}" class="form-control mx-sm-3" wire:model="date_commited" name="date_commited" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="terms_of_payment">TERMS OF PAYMENT</label>
                                    <select wire.ignore.self name="terms_of_payment" class="form-control" wire:model="terms_of_payment" id="terms_of_payment">
                                        <option value='' style="font-family:Courier New;text-align:center">-- SELECT TYPE OF PAYMENT --</option>
                                        @foreach ($types_of_payments as $data)
                                            <option value="{{ $data->id }}">{{ $data->payment_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="edit_reason">REASON FOR EDIT</label>
                                    <input type="text" id="edit_reason" class="form-control mx-sm-3" wire:model="edit_reason" name="edit_reason">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="remarks">REMARKS</label>
                                    <textarea class="form-control" id="remarks" rows="3"  wire:model="remarks" name="remarks"></textarea>
                                </div>
                            </div>
                            <!-- Image Upload -->
                            <div class="form-row">
                                <div class="col-md-12">
                                    <input type="file" class="form-control-file" wire:model="item_image" multiple>
                                    <div wire:loading wire:target="item_image" class="text-dark">Uploading...</div>
                                    @error('item_image.*') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- End Image Upload -->
                            @if($item_image)
                                <br>
                                Photo Preview:
                                @if($change_images)
                                    <ul style="list-style-type: none;margin: 0;padding: 0;overflow: hidden;padding: 16px;">
                                        @foreach($item_image as $image)
                                            
                                            <li style="float: left;display: block;text-decoration: none;"><img src="{{$image->temporaryUrl()}} " class="img-thumbnail" style="border: 1px solid rgb(5, 0, 0);border-radius: 4px;padding: 5px;width: 100px;"></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul style="list-style-type: none;margin: 0;padding: 0;overflow: hidden;padding: 16px;">
                                        @foreach($item_image as $image)
                                            
                                            <li style="float: left;display: block;text-decoration: none;"><img src="{{ $isUploaded ? $image->temporaryUrl() : url('storage/images/'.$image)}} " class="img-thumbnail" style="border: 1px solid rgb(5, 0, 0);border-radius: 4px;padding: 5px;width: 100px;"></li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        </div>
                        {{-- End Right Side --}}
                    </div>
                </div>
            </div>
            <!-- End Modal body -->
            <div class="modal-footer">
                <div class="form-group btn-group mr-4">
                    <!-- <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
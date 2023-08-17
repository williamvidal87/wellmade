<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Approved Job Order</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
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

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="date">DATE</label>
                                <input type="date" class="form-control" value={{ $date }} id="date" wire:model="date" name="date" required>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="serial_no">SERIAL No.</label>
                            <input type="text" wire:model="serial_no" id="serial_no" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="customer_id">CUSTOMER</label>
                                <select wire.ignore.self id="customer_id" name="customer_id" class="form-control" wire:model="customer_id" required>
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
                                <label class="control-label" for="contact_person_form">ASSIGNED MECHANIC</label>
                                <input type="text" class="form-control" id="contact_person_form" value="{{ $contact_person_form }}" wire:model="contact_person_form" name="contact_person_form"  required readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label" for="engine_model">ENGINE MODEL</label>
                                <select wire.ignore.self name="engine_model" class="form-control" wire:model="engine_model" id="engine_model" required>
                                    <option value='' style="font-family:Courier New;text-align:center">-- SELECT ENGINE MODEL --</option>
                                    @foreach ($engine_models as $data)
                                        <option value="{{ $data->id }}">{{ $data->model }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            {{-- <label class="col-sm-4 control-label" for="category">Make and Category</label> --}}
                            <div class="form-group col-xs-5">
                                <label class="control-label" for="category">Make</label>
                                <input type="text" class="form-control" id="makelist_foreign_name" value="{{ $makelist_foreign_name }}" wire:model="makelist_foreign_name" name="makelist_foreign_name"  required readonly>
                            </div>
                            <div class="form-group mb-4 col-xs-3">
                                <label class="control-label" for="category">Category</label>
                                <input type="text" class="form-control" id="category_foreign_name" value="{{ $category_foreign_name }}" wire:model="category_foreign_name" name="category_foreign_name"  required readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_receive">DATE RECEIVED</label>
                                <input type="date" id="date_receive" value={{ $date_receive }} class="form-control mx-sm-3" wire:model="date_receive" name="date_receive" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_commited">DATE COMMITED</label>
                                <input type="date" id="date_commited" value={{ $date_commited }} class="form-control mx-sm-3" wire:model="date_commited" name="date_commited" required>
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
                                <div wire:loading wire:target="item_image">Uploading...</div>
                                @error('item_image.*') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- End Image Upload -->
                        @if($item_image)
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
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group btn-group mr-4">
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                    <button type="submit" class="btn btn-primary" pull-right>Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

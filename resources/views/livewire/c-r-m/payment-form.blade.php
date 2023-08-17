<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Payment Information</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">

                <div class="row">
                    <div class="col-lg-6 pull">
                        <div class="form-group">
                            <label>Invoice Issued:</label>
                            <select wire:model="invoice_issued_id" name="invoice_issued_id" class="form-control" required>
                                <option value="">-- Select a Invoice Issued --</option>
                                @foreach ($invoice_issueds as $data)
                                    <option value="{{ $data->id }}">{{ $data->type}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('invoice_issued_id'))
                            <p style="color:red">{{$errors->first('invoice_issued_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Discount ER:</label>
                            <select wire:model="discount_er" name="discount_er" class="form-control" required>
                                <option value="">-- Select a Discount ER --</option>
                                @foreach ($discount_percentages as $data)
                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                @endforeach
                            </select>
                            @if($errors->has('discount_er'))
                            <p style="color:red">{{$errors->first('discount_er')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Discount MF/SP/GM:</label>
                            <select wire:model="discount_mf" name="discount_mf" class="form-control" required>
                                <option value="">-- Select a MF/SP/GM: --</option>
                                @foreach ($discount_percentages as $data)
                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                @endforeach
                            </select>
                            @if($errors->has('discount_mf'))
                            <p style="color:red">{{$errors->first('discount_mf')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Discount Spareparts:</label>
                            <select wire:model="discount_spareparts" name="discount_spareparts" class="form-control" required>
                                <option value="">-- Select a Spareparts: --</option>
                                @foreach ($discount_percentages as $data)
                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                @endforeach
                            </select>
                            @if($errors->has('discount_spareparts'))
                            <p style="color:red">{{$errors->first('discount_spareparts')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Discount Calibration:</label>
                            <select wire:model="discount_calib" name="discount_calib" class="form-control" required>
                                <option value="">-- Select a Calibration: --</option>
                                @foreach ($discount_percentages as $data)
                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                @endforeach
                            </select>
                            @if($errors->has('discount_calib'))
                            <p style="color:red">{{$errors->first('discount_calib')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Payment Type:</label>
                            <select wire:model="payment_type_id" name="payment_type_id" class="form-control" required>
                                <option value="">-- Select a payment type: --</option>
                                @foreach ($payment_types as $data)
                                    <option value="{{ $data->id }}">{{ $data->type }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_type_id'))
                            <p style="color:red">{{$errors->first('payment_type_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
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

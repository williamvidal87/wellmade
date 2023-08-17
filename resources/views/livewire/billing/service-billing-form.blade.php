<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Service Billing</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Date</label>
                            <input  type="date" wire:model="date" name="date" class="form-control" required>
                            @if($errors->has('date'))
                            <p style="color:red">{{$errors->first('date')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Reference No</label>
                            <input  type="text" wire:model="reference_no" name="reference_no" class="form-control" required>
                            @if($errors->has('reference_no'))
                            <p style="color:red">{{$errors->first('reference_no')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>JO No</label>
                            <select wire:model.defer="jo_no" name="jo_no" class="form-control" required>
                                <option value="">-- Select a job order --</option>
                                @forelse ($job_order as $jo)
                                    <option value="{{ $jo->id }}">{{ $jo->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('jo_no'))
                            <p style="color:red">{{$errors->first('jo_no')}}</p>
                            @endif
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <label>Customer Name</label>
                    <input  type="text" wire:model="customer_name" name="customer_name" class="form-control" required readonly>
                    @if($errors->has('customer_name'))
                    <p style="color:red">{{$errors->first('customer_name')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input  type="text" wire:model="address" name="address" class="form-control" required readonly>
                    @if($errors->has('address'))
                    <p style="color:red">{{$errors->first('address')}}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Contact No</label>
                            <input  type="text" wire:model="contact_no" name="contact_no" class="form-control" required readonly>
                            @if($errors->has('contact_no'))
                            <p style="color:red">{{$errors->first('contact_no')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Work Type</label>
                            <input  type="text" wire:model="job_type" name="job_type" class="form-control" required readonly>
                            @if($errors->has('job_type'))
                            <p style="color:red">{{$errors->first('job_type')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea wire:model="description" name="description" class="form-control" required></textarea>
                    @if($errors->has('description'))
                    <p style="color:red">{{$errors->first('description')}}</p>
                    @endif
                </div>
                {{-- <div class="form-group">
                    <label>Term of Payments</label>
                    <select wire:model.defer="term_of_payment" name="term_of_payment" class="form-control" required>
                        <option value="">-- Select option --</option>
                        @forelse ($term_of_payments as $term_payments)
                            <option value="{{ $term_payments->id }}">{{ $term_payments->payment_type }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if($errors->has('term_of_payment'))
                    <p style="color:red">{{$errors->first('term_of_payment')}}</p>
                    @endif
                </div>  --}}
                <div class="form-group">
                    <label>Cash/Charge</label>
                    <select wire:model.defer="cash_charge" name="cash_charge" class="form-control" required>
                        <option value="">-- Select option --</option>
                        @forelse ($cash_charges as $cash_charge)
                            <option value="{{ $cash_charge->id }}">{{ $cash_charge->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if($errors->has('cash_charge'))
                    <p style="color:red">{{$errors->first('cash_charge')}}</p>
                    @endif
                </div> 
                <div class="form-group">
                    <label>Total Bill</label>
                    <input type="text" wire:model="total_bill" name="total_bill" class="form-control" required>
                    @if($errors->has('total_bill'))
                    <p style="color:red">{{$errors->first('total_bill')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Term of Payments</label>
                    <select wire:model.defer="payment_type" name="payment_type" class="form-control" required>
                        <option value="">-- Select a payment type --</option>
                        @forelse ($term_of_payments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->payment_type }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if($errors->has('payment_type'))
                    <p style="color:red">{{$errors->first('payment_type')}}</p>
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

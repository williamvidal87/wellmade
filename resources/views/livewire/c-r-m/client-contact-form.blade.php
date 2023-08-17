<div>
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Client Contact</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i> </button>
        </div>
        <!--Panel heading-->
        <div class="panel-heading">
            <div class="panel-control">
                <ul class="nav nav-tabs">
                    <li class="active" wire:ignore><a href="#clientInfo" data-toggle="tab" aria-expanded="false">Client Info</a></li>
                    <li class="" wire:ignore><a href="#paymentInfo" data-toggle="tab" aria-expanded="true">Payment Info</a></li>
                </ul>
            </div>
        </div>

        <!--Panel body-->
        <div class="panel-body">
            <div class="tab-content">
                <div wire:ignore.self class="tab-pane fade active in" id="clientInfo">
                    <div class="row">
                        <form wire:submit.prevent="store" enctype="multipart/form-data">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Client Information</h4>
                                {{-- <a type="button" class="close" data-dismiss="modal">&times;</a> --}}
                            </div>
                
                            <!-- Modal body -->
                            <div class=" modal-body">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input <?php
                                                if(!empty($this->jobOrderclientContactId))
                                                {
                                                    echo "readonly";
                                                }
                                            ?> type="text" wire:model.defer="name" name="name" class="form-control" required>
                                            @if ($errors->has('name'))
                                                <p style="color:red">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input <?php
                                            if(!empty($this->jobOrderclientContactId))
                                            {
                                                echo "readonly";
                                            }
                                            ?> type="text" wire:model.defer="email" name="email" class="form-control">
                                            @if ($errors->has('email'))
                                                <p style="color:red">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Client Type</label>
                                            <select wire.ignore.self 
                                            <?php
                                            if(!empty($this->jobOrderclientContactId))
                                            {
                                                echo "disabled";
                                            }
                                            ?> wire:model="client_type" id="clientTypeId" name="client_type" class="form-control" required>
                                                <option value="">-- Select a type --</option>
                                                @forelse ($client_types as $types)
                                                    <option value="{{ $types->id }}">{{ $types->getIndustry->name ?? ""}} - {{ $types->client_type ?? ""}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('client_type'))
                                                <p style="color:red">{{ $errors->first('client_type') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Csa Type</label>
                                            <select wire.ignore.self <?php
                                                if(!empty($this->jobOrderclientContactId))
                                                {
                                                    echo "disabled";
                                                }
                                                ?> wire:model="csa_id" id="csaId" name="csa_id" class="form-control" required>
                                                <option value="">-- Select a type --</option>
                                                @forelse ($csa_types as $types)
                                                    <option value="{{ $types->id }}">{{ $types->csa_type }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('csa_id'))
                                                <p style="color:red">{{ $errors->first('csa_id') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select wire.ignore.self <?php
                                                if(!empty($this->jobOrderclientContactId))
                                                {
                                                    echo "disabled";
                                                }
                                                ?> wire:model="branch_id" id="branchId" name="branch_id" class="form-control" required>
                                                <option value="">-- Select a branch --</option>
                                                @forelse ($branches as $types)
                                                    <option value="{{ $types->id }}">{{ $types->branch_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('branch_id'))
                                                <p style="color:red">{{ $errors->first('branch_id') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input <?php
                                                if(!empty($this->jobOrderclientContactId))
                                                {
                                                    echo "readonly";
                                                }
                                                ?> type="text" wire:model.defer="address" name="address" class="form-control" required>
                                            @if ($errors->has('address'))
                                                <p style="color:red">{{ $errors->first('address') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tin No.</label>
                                            <input <?php
                                                if(!empty($this->jobOrderclientContactId))
                                                {
                                                    echo "readonly";
                                                }
                                                ?> type="text" wire:model.defer="tin_no" name="tin_no" class="form-control">
                                            @if ($errors->has('tin_no'))
                                                <p style="color:red">{{ $errors->first('tin_no') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input <?php
                                                if(!empty($this->jobOrderclientContactId))
                                                {
                                                    echo "readonly";
                                                }
                                                ?> type="tel" wire:model.defer="contact_no" name="contact_no" class="form-control">
                                            @if ($errors->has('contact_no'))
                                                <p style="color:red">{{ $errors->first('contact_no') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group ">
                                    <label>Contact Person</label>
                                    <div class="form-inline">
                                        <div class="row">
                                            <div class="col-lg-11">
                                                <select id="contactPersonId" <?php
                                                    if(!empty($this->jobOrderclientContactId))
                                                    {
                                                        echo "disabled";
                                                    }
                                                    ?> wire:model="contact_person" id="contactId" name="contact_person"
                                                    class="form-control" style="width: 487px">
                                                    <option value="">-- Select a Contacts --</option>
                                                    @foreach ($contacts as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('contact_person'))
                                                    <p style="color:red">{{ $errors->first('contact_person') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="pull-right ">
                                                    <button <?php
                                                        if(!empty($this->jobOrderclientContactId))
                                                        {
                                                            echo "disabled";
                                                        }
                                                        ?> type="button" class="btn btn-purple" wire:click.prevent="addContact"><i
                                                            class="fa fa-plus-circle"></i> Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button <?php
                                        if(!empty($this->jobOrderclientContactId))
                                        {
                                            echo "disabled";
                                        }
                                        ?> type="submit" class="btn btn-primary  pull-right">Save</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                
                <div wire:ignore.self class="tab-pane fade" id="paymentInfo">
                    <div class="row">
                        <form wire:submit.prevent="store" enctype="multipart/form-data">
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Payment Information</h4>
                            {{-- <a type="button" class="close" data-dismiss="modal">&times;</a> --}}
                            </div>
                            
                            <!-- Modal body -->
                            <div class=" modal-body">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Invoice Issued:</label>
                                            <select <?php 
                                                    if(!empty($this->jobOrderclientContactId))
                                                    {
                                                        echo "disabled";
                                                    }
                                                ?> wire:model="invoice_issued_id" name="invoice_issued_id" class="form-control" required>
                                                <option value="">-- Select a Invoice Issued --</option>
                                                @foreach ($invoice_issueds as $data)
                                                    <option value="{{ $data->id }}">{{ $data->type}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('invoice_issued_id'))
                                            <p style="color:red">{{$errors->first('invoice_issued_id')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Discount ER:</label>
                                            <select <?php 
                                                    if(!empty($this->jobOrderclientContactId))
                                                    {
                                                        echo "disabled";
                                                    }
                                                ?> wire:model="discount_er" name="discount_er" class="form-control" required>
                                                <option value="">-- Select a Discount ER --</option>
                                                @foreach ($discount_percentages as $data)
                                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('discount_er'))
                                            <p style="color:red">{{$errors->first('discount_er')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Discount MF/SP/GM:</label>
                                            <select <?php 
                                                    if(!empty($this->jobOrderclientContactId))
                                                    {
                                                        echo "disabled";
                                                    }
                                                ?> wire:model="discount_mf" name="discount_mf" class="form-control" required>
                                                <option value="">-- Select a MF/SP/GM: --</option>
                                                @foreach ($discount_percentages as $data)
                                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('discount_mf'))
                                            <p style="color:red">{{$errors->first('discount_mf')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Discount Spareparts:</label>
                                            <select <?php 
                                                    if(!empty($this->jobOrderclientContactId))
                                                    {
                                                        echo "disabled";
                                                    }
                                                ?> wire:model="discount_spareparts" name="discount_spareparts" class="form-control" required>
                                                <option value="">-- Select a Spareparts: --</option>
                                                @foreach ($discount_percentages as $data)
                                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('discount_spareparts'))
                                            <p style="color:red">{{$errors->first('discount_spareparts')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Discount Calibration:</label>
                                            <select <?php 
                                                    if(!empty($this->jobOrderclientContactId))
                                                    {
                                                        echo "disabled";
                                                    }
                                                ?> wire:model="discount_calib" name="discount_calib" class="form-control" required>
                                                <option value="">-- Select a Calibration: --</option>
                                                @foreach ($discount_percentages as $data)
                                                    <option value="{{ $data->id }}">{{ (int) $data->percentage}}%</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('discount_calib'))
                                            <p style="color:red">{{$errors->first('discount_calib')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Payment Type:</label>
                                            <select <?php 
                                                    if(!empty($this->jobOrderclientContactId))
                                                    {
                                                        echo "disabled";
                                                    }
                                                ?> wire:model="payment_type_id" name="payment_type_id" class="form-control" required>
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
                                </div>
                
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button <?php 
                                        if(!empty($this->jobOrderclientContactId))
                                        {
                                            echo "disabled";
                                        }
                                    ?> type="submit" class="btn btn-primary  pull-right">Save</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                
            </div>
        </div>
    </div>
    {{-- end sample --}}

    </div>

</div>

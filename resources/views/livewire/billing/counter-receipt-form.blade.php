<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Counter Receipt</h4>
            <a type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input  type="date" wire:model="date" name="date" class="form-control" required {{ $viewPayCrId != null ? "disabled='disabled'" : '' }}>
                                @if($errors->has('date'))
                                <p style="color:red">{{$errors->first('date')}}</p>
                                @endif
                            </div>
                        </div>
                        @if ($viewPayCrId == null || ($transaction_status_id == 1 || $transaction_status_id == 2))
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-8 control-label text-right">Total</label>
                                <div class="col-lg-4">
                                    <input  type="text" wire:model="total" name="total" class="form-control text-right" required readonly>
                                    @if($errors->has('total'))
                                    <p style="color:red">{{$errors->first('total')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-8 control-label text-right">Paid</label>
                                <div class="col-lg-4">
                                    <input  type="text" wire:model="paid" name="paid" class="form-control text-right" required readonly>
                                    @if($errors->has('paid'))
                                    <p style="color:red">{{$errors->first('paid')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-8 control-label text-right">Balance</label>
                                <div class="col-lg-4">
                                    <input  type="text" wire:model="balance" name="balance" class="form-control text-right" required readonly>
                                    @if($errors->has('balance'))
                                    <p style="color:red">{{$errors->first('balance')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group" wire:ignore>
                                <label>Client Name</label>
                                <select wire.ignore.self id="clientId" name="client_id" style="width: 100%;" wire:model="client_id" 
                                    class="form-control" {{ ($counterReceiptId || $payCrId || $viewPayCrId) ? 'disabled' : '' }} >
                                    <option value=''>Select a client</option>
                                    @foreach($clients as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('client_id'))
                                <p style="color:red">{{$errors->first('client_id')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Entry</label>
                                <input  type="text" wire:model="entries" name="entries" class="form-control" required readonly>
                                @if($errors->has('entries'))
                                <p style="color:red">{{$errors->first('entries')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-info pull-right" wire:click.prevent="addItem" {{ ($payCrId != null) ? 'disabled' : '' }}><i class="fa fa-plus fa-sm" style="font-size:10px;"></i>&nbsp;&nbsp;Add</button>
                            <br><br>
                            <table id="counterReceiptDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"></th>
                                        <th style="width: 240px;">INVOICE NO</th>
                                        <th style="width: 130px;">REF. DATE</th>
                                        <th style="width: 130px;">CSA</th>
                                        <th style="width: 130px;">NET AMOUNT</th>
                                        <th style="width: 180px;">PAYMENTS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listItems as $index => $item)
                                    {{-- @dd($payCrId, $listItems) --}}
                                    <tr>
                                        <td style="width: 50px;">
                                            <button wire:click.prevent="deleteItem({{ $index }})" class="btn btn-info delete-header btn-sm"  title="Delete Item" {{ ($payCrId != null) ? 'disabled' : '' }}><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </td>
                                        <td style="width: 240px;">
                                            <div>
                                                <select wire:model="listItems.{{ $index }}.invoice_no" name="listItems[{{ $index }}][invoice_no]" class="form-control" required {{ ((empty($client_id) || $payCrId ) || ($counterReceiptId && $item['payments'])) ? 'disabled' : '' }} {{ $viewPayCrId != null ? "disabled='disabled'" : '' }}>
                                                    <option value="">-- Select a transaction --</option>
                                                    @foreach ($transac as $data)
                                                        <option value="{{ $data->id }}"
                                                        @foreach ($listItems as $list)
                                                            @if ($list['invoice_no'] == $data->id)
                                                                {{ 'disabled' }}
                                                            @endif
                                                        @endforeach  
                                                        @foreach ($listUsedInvoices as $key => $value)
                                                            @if ($data->id == $value)
                                                                {{ 'disabled' }}
                                                            @endif
                                                        @endforeach  
                                                        >
                                                        @if ($data->invoice_type_id == 1)
                                                            {{ $data->sb_invoice_no ?? '' }}
                                                        @else
                                                            {{ $data->wv_invoice_no ?? '' }}
                                                        @endif
                                                        
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td style="width: 130px;">
                                            <div>
                                                <input type="text" wire:model="listItems.{{ $index }}.ref_date" name="listItems[{{ $index }}][ref_date]" class="form-control" readonly>
                                            </div>
                                        </td>
                                        <td style="width: 130px;">
                                            <div>
                                                <input type="text" wire:model.lazy="listItems.{{ $index }}.csa" name="listItems[{{ $index }}][csa]" min="0" class="form-control" style="text-align: right;" readonly>
                                            </div>
                                        </td>
                                        <td style="width: 130px;">
                                            <div>
                                                <input type="text" wire:model.lazy="listItems.{{ $index }}.net_amount" name="listItems[{{ $index }}][net_amount]" min="0" class="form-control" style="text-align: right;" readonly>
                                            </div>
                                        </td>
                                        <td style="width: 180px;">
                                            <div>
                                                <select wire:model="listItems.{{ $index }}.payments" name="listItems[{{ $index }}][payments]" class="form-control" disabled='disabled'>
                                                    <option value="">-- Select a payment --</option>
                                                    @foreach ($payment as $data)
                                                        @foreach ($transac as $trans)
                                                            @if ($trans->id == $item['invoice_no'])
                                                                @if ($trans->invoice_type_id == 2 && $data->receipt_type_id == 1)
                                                                    <option value="{{ $data->id }}" {{ $data->all_total_debits >= $trans->all_total_debits ? 'disabled' : '' }}>{{ $data->ar_transaction. ' = ' .number_format($data->all_total_debits, 2) }} </option>
                                                                @elseif ($trans->invoice_type_id == 1 && $data->receipt_type_id == 2)
                                                                    <option value="{{ $data->id }}" {{ $trans->all_total_debits >= $data->all_total_debits  ? 'disabled' : '' }}>{{ $data->or_transaction. ' = ' .number_format($data->all_total_debits, 2) }} </option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tr>
                                    <td style="text-align:center" colspan="3"></td>
                                    <td style="text-align:right"><b>Total:</b></td>
                                    <td>
                                        <input  type="text" wire:model="total" name="total" class="form-control" readonly style="text-align: right;">
                                        @if($errors->has('total'))
                                        <p style="color:red">{{$errors->first('total')}}</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>  
                    </div>

                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group pull-left">
                    {{-- @dd($transaction_status_id, $payCrId, $status_id) --}}
                    @if ($transaction_status_id == 1 && $counterReceiptId != null)
                        <button wire:click.prevent="postConfirmCounterReceipt({{ $counterReceiptId }})" class="btn btn-success delete-header m-1 btn-sm pull-left"  title="Post"><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Post</button> 
                        <button wire:click.prevent="printCounterReceipt({{ $counterReceiptId }})" class="btn btn-purple delete-header m-1 btn-sm pull-left"  title="Print" {{ $balance <= 0 ? "disabled='disabled'" : '' }}><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</button> 
                    @elseif ($transaction_status_id == 2 && $viewPayCrId != null)
                        <button wire:click.prevent="reverseConfirmCounterReceipt({{ $viewPayCrId }})" class="btn btn-danger delete-header m-1 btn-sm pull-left"  title="Reverse" {{$transaction_status_id == 3 ? 'disabled' : ''}}><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Reverse</button>
                    @elseif ($transaction_status_id == 2 && $payCrId != null)
                        <button wire:click.prevent="reverseConfirmCounterReceipt({{ $payCrId }})" class="btn btn-danger delete-header m-1 btn-sm pull-left"  title="Reverse" {{$transaction_status_id == 3 ? 'disabled' : ''}}><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Reverse</button>
                        <button wire:click.prevent="printCounterReceipt({{ $payCrId }})" class="btn btn-purple delete-header m-1 btn-sm pull-left"  title="Print" {{ $balance <= 0 ? "disabled='disabled'" : '' }}><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</button>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right" {{ ($viewPayCrId != null || $payCrId != null) ? "disabled='disabled'" : '' }}>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

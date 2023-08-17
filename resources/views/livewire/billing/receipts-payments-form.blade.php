<div>
    <div class="modal-content">
    @if (($transaction_status == 2 && $serviceInvoiceId != null) || ($transaction_status == 3 && $serviceInvoiceId != null)) 
        @foreach ($report_data as $data)
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Receipts Payment</h4>
                <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
                </div>
                
            <!-- Modal body -->
            <div class=" modal-body">

                <div class="row">
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" value="{{ date('Y-m-d', strtotime($data->date)) }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <div class="form-group">
                            <label>Check Date</label>
                            <input  type="text" value="{{ $data->sb_date }}" name="sb_date" class="form-control" required readonly>
                            @if($errors->has('sb_date'))
                            <p style="color:red">{{$errors->first('sb_date')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                </div>
                <div class="row">
                </div>
                <div class="row">
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Receipt Type</label>
                            <input type="text" value="{{ $data->receiptType->receipt_type }}" name="receipt_type_id" class="form-control" required readonly>
                            @if($errors->has('receipt_type_id'))
                            <p style="color:red">{{$errors->first('receipt_type_id')}}</p>
                            @endif
                        </div> 
                    </div>
                </div>

                @if ($receipt_type_id  == 1)
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Receipt ID</label>
                            <div class="form-inline">
                                <input type="text" wire:model.lazy="ar_transaction" name="ar_transaction" class="form-control" required {{ Auth::user()->hasRole(['Admin', 'Super Admin']) ? '' : 'readonly' }}>
                            </div>
                            @if($errors->has('ar_transaction'))
                            <p style="color:red">{{$errors->first('ar_transaction')}}</p>
                            @endif
                        </div>
                    </div>
                @elseif ($receipt_type_id  == 2)
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Receipt ID</label>
                            <div class="form-inline">
                                <input type="text" wire:model.lazy="or_transaction" name="or_transaction" class="form-control" required {{ Auth::user()->hasRole(['Admin', 'Super Admin']) ? '' : 'readonly' }}>
                            </div>
                            @if($errors->has('or_transaction'))
                            <p style="color:red">{{$errors->first('or_transaction')}}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="row">
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Receipt For</label>
                            <input type="text" value="{{ $data->receiptFor->type }}" name="receipt_for" class="form-control" required readonly>
                            @if($errors->has('receipt_for'))
                            <p style="color:red">{{$errors->first('receipt_for')}}</p>
                            @endif
                        </div> 
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>For</label>
                            <input type="text" value="{{ $data->fors->type }}" name="for" class="form-control" required readonly>
                            @if($errors->has('for'))
                            <p style="color:red">{{$errors->first('for')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Bank</label>
                            <input type="text" value="{{ $data->bankType->bank_name }}" name="bank" class="form-control" required readonly>
                            @if($errors->has('bank'))
                            <p style="color:red">{{$errors->first('bank')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>GL Account for Bank</label>
                            <input  type="text" value="{{ $data->gl_account_bank }}" name="gl_account_bank" class="form-control" required readonly>
                            @if($errors->has('gl_account_bank'))
                            <p style="color:red">{{$errors->first('gl_account_bank')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Collected By</label>
                            <input type="text" value="{{ $data->getCollect->type ?? '' }}" name="bank" class="form-control" required readonly>
                            @if($errors->has('collected_by_id'))
                            <p style="color:red">{{$errors->first('collected_by_id')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>Payment Type</label>
                            <input type="text" value="{{ $data->getPaymentType->type ?? '' }}" name="bank" class="form-control" required readonly>
                            @if($errors->has('payment_type_id'))
                            <p style="color:red">{{$errors->first('payment_type_id')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($payment_type_id == 3)
                    <div class="p-3 bg-gray" style="width: 50%; height: auto; margin: auto; border:1px dashed #444;">
                        <div class="form-group">
                            <label>Dated</label>
                            <input  type="text" value="{{ $data->dated ?? '' }}" name="dated" class="form-control" required readonly>
                            @if($errors->has('dated'))
                            <p style="color:red">{{$errors->first('dated')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Cheque No</label>
                            <input  type="text" value="{{ $data->cheque_no ?? '' }}" name="cheque_no" class="form-control" required readonly>
                            @if($errors->has('cheque_no'))
                            <p style="color:red">{{$errors->first('cheque_no')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Customer Bank</label>
                            <input  type="text" value="{{ $data->getCustomerBank->bank_name ?? '' }}" name="cheque_no" class="form-control" required readonly>

                            @if($errors->has('customer_bank'))
                            <p style="color:red">{{$errors->first('customer_bank')}}</p>
                            @endif
                        </div>
                    </div>
                @endif


                {{-- start sample --}}
                <div class="panel">

                    <!--Panel heading-->
                    <div class="panel-heading">
                        <div class="panel-control">
                            <ul class="nav nav-tabs">
                                <li class="active" wire:ignore><a href="#particulars" data-toggle="tab" aria-expanded="false">Particulars</a></li>
                                <li class="" wire:ignore><a href="#journalize" data-toggle="tab" aria-expanded="true">Journalize</a></li>
                            </ul>
                        </div>
                    </div>

                    <!--Panel body-->
                    <div class="panel-body">
                        <div class="tab-content">
                            <div wire:ignore.self class="tab-pane fade active in" id="particulars">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <label>Summary of Explanation</label>
                                        <br><br> --}}
                                        <br><br>
                                        <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                            <thead>
                                                <tr>
                                                    <th style="width: 160px;">WV NO</th>
                                                    <th style="width: 160px;">SB NO</th>
                                                    <th style="width: 240px;">REF. DATE</th>
                                                    <th style="width: 150px;">TERMS</th>
                                                    <th style="width: 150px;">INV. AMOUNT</th>
                                                    <th style="width: 150px;">TOTAL PAID</th>
                                                    <th style="width: 150px;">THIS PAYMENT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prtclrs as $index => $item)
                                                    @if (floatval(preg_replace('/[^\d.]/', '', $item->total_paid)) > 0)
                                                        <tr>
                                                            <td style="width: 160px;">
                                                                <div>
                                                                    <input type="text" value="{{ $item->transactionSummaryInvoice->wv_invoice_no ?? ''  }}"  class="form-control" readonly>
                                                                </div>
                                                            </td>
                                                            <td style="width: 160px;">
                                                                <div>
                                                                    <input type="text" value="{{ $item->transactionSummaryInvoice->sb_invoice_no ?? ''  }}"  class="form-control" readonly>
                                                                </div>
                                                            </td>
                                                            <td style="width: 240px;">
                                                                <div>
                                                                    <input type="text" value="{{ date('Y-m-d', strtotime($item->transactionSummaryInvoice->jobOrder->date)) }}"  class="form-control" readonly>
                                                                </div>
                                                            </td>
                                                            <td style="width: 150px;">
                                                                <div>
                                                                    <input type="text" value="{{ $item->transactionSummaryInvoice->jobOrder->term }}"  class="form-control" style="text-align: right;" readonly>
                                                                </div>
                                                            </td>
                                                            <td style="width: 150px;">
                                                                <div>
                                                                    <input type="text" value="{{ number_format($item->transactionSummaryInvoice->jobOrder->overall_total, 2) }}"  class="form-control" style="text-align: right;" readonly>
                                                                </div>
                                                            </td>
                                                            <td style="width: 150px;">
                                                                <div>
                                                                    <input type="text" value="{{ number_format($item->total_paid, 2) }}" class="form-control" style="text-align: right;" readonly>
                                                                </div>
                                                            </td>
                                                            <td style="width: 150px;">
                                                                <div>
                                                                    <input type="text" value="{{ number_format($item->this_payment, 2) }}"  class="form-control" style="text-align: right;" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td style="text-align:center" colspan="4"></td>
                                                    <td style="text-align:right"><b>Total:</b></td>
                                                    <td>
                                                        <input  type="text" wire:model="all_total_paid" name="all_total_paid" class="form-control" readonly style="text-align: right;">
                                                        @if($errors->has('all_total_paid'))
                                                        <p style="color:red">{{$errors->first('all_total_paid')}}</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input  type="text" wire:model="all_this_payment" name="all_this_payment" class="form-control" readonly style="text-align: right;">
                                                        @if($errors->has('all_this_payment'))
                                                        <p style="color:red">{{$errors->first('all_this_payment')}}</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>  
                                </div> 
                            </div>
                            
                            <div wire:ignore.self class="tab-pane fade" id="journalize">
                                <div class="row">
                                    <div class="col-md-12">
            
                                        <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                            <thead>
                                                <tr>
                                                    <th style="width: 160px;">ACCOUNT NUMBER</th>
                                                    <th style="width: 240px;">ACCOUNT TITLE</th>
                                                    <th style="width: 150px;">DEBITS</th>
                                                    <th style="width: 150px;">CREDITS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                <tr>
                                                    <td style="width: 160px;">
                                                        <input type="text" value="{{ $item->chartOfAccounts->account_code }}" class="form-control" required readonly>
                                                    </td>
                                                    <td style="width: 240px;">
                                                        <input type="text" value="{{ $item->account_title }}" class="form-control" readonly readonly>
                                                    </td>
                                                    <td style="width: 150px;">
                                                        <input type="text" value="{{ number_format($item->debits, 2) }}" min="0" class="form-control" style="text-align: right;" readonly>
                                                    </td>
                                                    <td style="width: 150px;">
                                                        <input type="text" value="{{ number_format($item->credits, 2) }}" min="0" class="form-control" style="text-align: right;" readonly>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td style="text-align:center" colspan="1"></td>
                                                    <td style="text-align:right"><b>Total:</b></td>
                                                    <td>
                                                        <input  type="text" value="{{ number_format($data->all_total_debits, 2) }}" name="all_total_debits" class="form-control" readonly style="text-align: right;">
                                                        @if($errors->has('all_total_debits'))
                                                        <p style="color:red">{{$errors->first('all_total_debits')}}</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input  type="text" value="{{ number_format($data->all_total_credits, 2) }}" name="all_total_credits" class="form-control" readonly style="text-align: right;">
                                                        @if($errors->has('all_total_credits'))
                                                        <p style="color:red">{{$errors->first('all_total_credits')}}</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>  
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    @if ($transaction_status == 1 && $serviceInvoiceId != null)
                        <button wire:click.prevent="transactionConfirmServiceInvoice({{ $serviceInvoiceId }}, 'posted')" class="btn btn-success delete-header m-1 btn-sm pull-left"  title="Post"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Post</button>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary  pull-right">Save</button>
                    </div>
                </div>

            </form>
        @endforeach

    @else 

        <form wire:submit.prevent="store" enctype="multipart/form-data">
            @if (session('receiptPaymentsError'))
                <div id="alertRefill" class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ session('receiptPaymentsError') }}</strong>
                </div>
            @endif
            @if (session('receiptPaymentsErrorNotMatch'))
                <div id="alertRefill" class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ session('receiptPaymentsErrorNotMatch') }}</strong>
                </div>
            @endif
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Receipts/Payments</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input  type="date" wire:model="date" name="date" class="form-control" required>
                            @if($errors->has('date'))
                            <p style="color:red">{{$errors->first('date')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>Check Date</label>
                            <input  type="date" wire:model="sb_date" name="sb_date" class="form-control" required>
                            @if($errors->has('sb_date'))
                            <p style="color:red">{{$errors->first('sb_date')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Receipt Type <span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span></label>
                            <select wire:model="receipt_type_id" name="receipt_type_id" class="form-control" required>
                                <option value="">-- Select a receipt type --</option>
                                @forelse ($receipt_types as $receipt)
                                    <option value="{{ $receipt->id }}">{{ $receipt->receipt_type }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('receipt_type_id'))
                            <p style="color:red">{{$errors->first('receipt_type_id')}}</p>
                            @endif
                        </div> 
                    </div>
                        <div class="col-lg-4 pull-right">
                            <div class="form-group" wire:ignore>
                                <label>Client <span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span></label>
                                <select wire.ignore.self id='clientId' name="client_id" class="form-control" wire:model="client_id" style="width: 100%; {{ $transaction_status_id != 2 ? "display: none;" : '' }}" required>
                                    <option value="" style="text-align: center;">-- Select a client --</option>
                                    @foreach ($clients as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('client_id'))
                                <p style="color:red">{{$errors->first('client_id')}}</p>
                                @endif
                            </div>
                        </div>
                </div>

                @if ($receipt_type_id  == 1)
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Receipt ID</label>
                            <div class="form-inline">
                                <input type="text" wire:model.lazy="ar_transaction" name="ar_transaction" class="form-control" required>
                            </div>
                            @if($errors->has('ar_transaction'))
                            <p style="color:red">{{$errors->first('ar_transaction')}}</p>
                            @endif
                        </div>
                    </div>
                @elseif ($receipt_type_id  == 2)
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Receipt ID</label>
                            <div class="form-inline">
                                <input type="text" wire:model.lazy="or_transaction" name="or_transaction" class="form-control" required>
                            </div>
                            @if($errors->has('or_transaction'))
                            <p style="color:red">{{$errors->first('or_transaction')}}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Receipt For</label>
                            <select wire:model.defer="receipt_for" name="receipt_for" class="form-control" required>
                                <option value="">-- Select a receipt for --</option>
                                @forelse ($receipt_fors as $receipt_f)
                                    <option value="{{ $receipt_f->id }}">{{ $receipt_f->type }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('receipt_for'))
                            <p style="color:red">{{$errors->first('receipt_for')}}</p>
                            @endif
                        </div> 
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>For</label>
                            <select wire:model="for" name="for" class="form-control" required>
                                <option value="">-- Select a for --</option>
                                @forelse ($fors as $for)
                                    <option value="{{ $for->id }}">{{ $for->type }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('for'))
                            <p style="color:red">{{$errors->first('for')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Bank</label>
                            <select wire:model="bank" name="bank" class="form-control" required>
                                <option value="">-- Select a bank --</option>
                                @forelse ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->bank_name ?? '' }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('bank'))
                            <p style="color:red">{{$errors->first('bank')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>GL Account for Bank</label>
                            <input  type="text" wire:model="gl_account_bank" name="gl_account_bank" class="form-control" required readonly>
                            @if($errors->has('gl_account_bank'))
                            <p style="color:red">{{$errors->first('gl_account_bank')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div>
                                <label>Collected By <span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span></label>
                                <select wire:model="collected_by_id" name="collected_by_id" class="form-control" required>
                                    <option value="">-- Select Collected --</option>
                                    @foreach ($collects as $collect)
                                        <option value="{{ $collect->id }}">{{ $collect->type }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('collected_by_id'))
                                <p style="color:red">{{$errors->first('collected_by_id')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <div>
                                <label>Payment Type <span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span></label>
                                <select wire:model="payment_type_id" name="payment_type_id" class="form-control" required>
                                    <option value="">-- Select Payment --</option>
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}">{{ $payment->type }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('payment_type_id'))
                                <p style="color:red">{{$errors->first('payment_type_id')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if ($payment_type_id == 3)
                        <div class="p-3 bg-gray" style="width: 50%; height: auto; margin: auto; border:1px dashed #444;">
                            <div class="form-group">
                                <label>Dated</label>
                                <input  type="date" wire:model="dated" name="dated" class="form-control" required>
                                @if($errors->has('dated'))
                                <p style="color:red">{{$errors->first('dated')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Cheque No</label>
                                <input  type="text" wire:model="cheque_no" name="cheque_no" class="form-control" required>
                                @if($errors->has('cheque_no'))
                                <p style="color:red">{{$errors->first('cheque_no')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Customer Bank</label>
                                <select wire:model="customer_bank_id" name="customer_bank_id" class="form-control" required>
                                    <option value="">-- Select Bank --</option>
                                    @foreach ($client_banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-3">
                                    <div>
                                        <button type="button" class="btn btn-purple" wire:click.prevent="addBank"><i class="fa fa-university" aria-hidden="true"></i> | Add</button>
                                    </div>
                                </div>

                                @if($errors->has('customer_bank'))
                                <p style="color:red">{{$errors->first('customer_bank')}}</p>
                                @endif
                            </div>
                        </div>
                @endif


                @if ($client_id != null)
                    {{-- start sample --}}
                    <div class="panel">

                        <!--Panel heading-->
                        <div class="panel-heading">
                            <div class="panel-control">
                                <ul class="nav nav-tabs">
                                    <li class="active" wire:ignore><a href="#particulars" data-toggle="tab" aria-expanded="false">Particulars</a></li>
                                    <li class="" wire:ignore><a href="#journalize" data-toggle="tab" aria-expanded="true">Journalize</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--Panel body-->
                        <div class="panel-body">
                            <div class="tab-content">
                                <div wire:ignore.self class="tab-pane fade active in" id="particulars">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <label>Summary of Explanation</label>
                                            <br><br> --}}
                                            <br><br>
                                            <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                                <thead>
                                                    <tr>
                                                        <th style="width: 160px;">WV NO</th>
                                                        <th style="width: 160px;">SB NO</th>
                                                        <th style="width: 240px;">REF. DATE</th>
                                                        <th style="width: 150px;">TERMS</th>
                                                        <th style="width: 150px;">INV. AMOUNT</th>
                                                        <th style="width: 150px;">TOTAL PAID</th>
                                                        <th style="width: 150px;">THIS PAYMENT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($particulars as $index => $item)
                                                    <tr>
                                                        <td style="width: 160px;">
                                                            <div>
                                                                <input type="text" wire:model="particulars.{{ $index }}.wv_invoice_no" name="particulars[{{ $index }}][wv_invoice_no]" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td style="width: 160px;">
                                                            <div>
                                                                <input type="text" wire:model="particulars.{{ $index }}.sb_invoice_no" name="particulars[{{ $index }}][sb_invoice_no]" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td style="width: 240px;">
                                                            <div>
                                                                <input type="text" wire:model="particulars.{{ $index }}.ref_date" name="particulars[{{ $index }}][ref_date]" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model="particulars.{{ $index }}.terms" name="particulars[{{ $index }}][terms]" min="0" class="form-control" style="text-align: right;" readonly>
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model="particulars.{{ $index }}.inv_amount" name="particulars[{{ $index }}][inv_amount]" min="0" class="form-control" style="text-align: right;" readonly>
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model.lazy="particulars.{{ $index }}.total_paid" name="particulars[{{ $index }}][total_paid]" min="0" class="form-control" style="text-align: right;">
                                                            </div>
                                                            @if($errors->has('particulars.*.total_paid'))
                                                            <div class="text-danger">{{ $errors->first('particulars.'. $index .'.total_paid') }}</div>
                                                            @endif
                                                            {{-- @error('particulars.*.total_paid')
                                                                <div class="text-danger">{{ $errors->first('particulars.'. $index .'.total_paid') }}</div>
                                                            @enderror --}}
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model.lazy="particulars.{{ $index }}.this_payment" name="particulars[{{ $index }}][this_payment]" min="0" class="form-control" style="text-align: right;">
                                                            </div>
                                                            @if($errors->has('particulars.*.this_payment'))
                                                            <div class="text-danger">{{ $errors->first('particulars.'. $index .'.this_payment') }}</div>
                                                            @endif
                                                            {{-- @error('particulars.*.this_payment')
                                                                <div class="text-danger">{{ $errors->first('particulars.'. $index .'.this_payment') }}</div>
                                                            @enderror --}}
                                                        </td>
                                                        {{-- @if ($errors->any())
                                                            @foreach ($errors->all() as $error)
                                                                <div style="color: red;">{{$error}}</div>
                                                            @endforeach
                                                        @endif --}}
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td style="text-align:center" colspan="4"></td>
                                                        <td style="text-align:right"><b>Total:</b></td>
                                                        <td>
                                                            <input  type="text" wire:model="all_total_paid" name="all_total_paid" class="form-control" readonly style="text-align: right;">
                                                            @if($errors->has('all_total_paid'))
                                                            <p style="color:red">{{$errors->first('all_total_paid')}}</p>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input  type="text" wire:model="all_this_payment" name="all_this_payment" class="form-control" readonly style="text-align: right;">
                                                            @if($errors->has('all_this_payment'))
                                                            <p style="color:red">{{$errors->first('all_this_payment')}}</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>  
                                    </div> 
                                </div>
                                
                                <div wire:ignore.self class="tab-pane fade" id="journalize">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <label>Summary of Explanation</label>
                                            <br><br> --}}
                                            <button class="btn btn-info pull-right" wire:click.prevent="addItem"><i class="fa fa-plus fa-sm" style="font-size:10px;"></i>&nbsp;&nbsp;Add</button>
                                            <br><br>
                                            <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px;"></th>
                                                        <th style="width: 160px;">ACCOUNT NUMBER</th>
                                                        <th style="width: 240px;">ACCOUNT TITLE</th>
                                                        <th style="width: 150px;">DEBITS</th>
                                                        <th style="width: 150px;">CREDITS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listItems as $index => $item)
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <a wire:click="deleteItem({{ $index }})" class="btn btn-info delete-header btn-sm"  title="Delete Item"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        </td>
                                                        <td style="width: 160px;">
                                                            <div>
                                                                <select wire:model="listItems.{{ $index }}.accnt_no" name="listItems[{{ $index }}][accnt_no]" class="form-control" required>
                                                                    <option value="">-- Choose a Accnt. No. --</option>
                                                                    @foreach ($accout_numbers as $account_number)
                                                                        <option
                                                                        <?php
                                                                        for ($i=0; $i < sizeof($listItems); $i++) {
                                                                            if(!empty($listItems[$i]['accnt_no'])){
                                                                                if($account_number->id == $listItems[$i]['accnt_no']){
                                                                                    if($listItems[$index]['accnt_no']==$listItems[$i]['accnt_no']){
                                                                                    // echo "";
                                                                                    }else{
                                                                                    echo "disabled";
                                                                                    }   
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        value="{{ $account_number->id }}">
                                                                            {{ $account_number->account_code . ' = ' . $account_number->account_desc }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td style="width: 240px;" wire:model="listItems.{{ $index }}.account_title" name="listItems[{{ $index }}][account_title]">
                                                            <div>
                                                                <input type="text" wire:model="listItems.{{ $index }}.account_title" name="listItems[{{ $index }}][account_title]" class="form-control" readonly>
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model.lazy="listItems.{{ $index }}.debits" name="listItems[{{ $index }}][debits]" min="0" class="form-control" style="text-align: right;">
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model.lazy="listItems.{{ $index }}.credits" name="listItems[{{ $index }}][credits]" min="0" class="form-control" style="text-align: right;">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td style="text-align:center" colspan="2"></td>
                                                        <td style="text-align:right"><b>Total:</b></td>
                                                        <td>
                                                            <input  type="text" wire:model="all_total_debits" name="all_total_debits" class="form-control" readonly style="text-align: right;">
                                                            @if($errors->has('all_total_debits'))
                                                            <p style="color:red">{{$errors->first('all_total_debits')}}</p>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input  type="text" wire:model="all_total_credits" name="all_total_credits" class="form-control" readonly style="text-align: right;">
                                                            @if($errors->has('all_total_credits'))
                                                            <p style="color:red">{{$errors->first('all_total_credits')}}</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>  
                                    </div> 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    {{-- end sample --}}
                @endif


            </div>
            @if (session('receiptPaymentsErrorSaveNoParticulars'))
                <div id="alertRefill" class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ session('receiptPaymentsErrorSaveNoParticulars') }}</strong>
                </div>
            @endif


            <!-- Modal footer -->
            <div class="modal-footer">
                @if ($transaction_status == 1 && $serviceInvoiceId != null)
                    <button wire:click.prevent="transactionConfirmServiceInvoice({{ $serviceInvoiceId }}, 'posted')" class="btn btn-success delete-header m-1 btn-sm pull-left"  title="Post" {{ $old_receipt_type_id != $receipt_type_id ? "disabled='disabled'" : '' }}><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Post</button>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right">Save</button>
                </div>
            </div>
        </form>

    @endif
    </div>
</div>

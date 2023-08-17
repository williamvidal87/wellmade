<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            @if (session('receiptPaymentsErrorNotMatch'))
                <div id="alertRefill" class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ session('receiptPaymentsErrorNotMatch') }}</strong>
                </div>
            @endif
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Service Invoice</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label>Date</label>
                                <input  type="date" wire:model="date" name="date" class="form-control" required {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                @if($errors->has('date'))
                                <p style="color:red">{{$errors->first('date')}}</p>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label>Time</label>
                                <input  type="time" wire:model="time" name="time" class="form-control" required {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                @if($errors->has('time'))
                                <p style="color:red">{{$errors->first('time')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 pull-right">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>WV Invoice No</label>
                                    @if (Auth::user()->hasRole(['Admin', 'Super Admin']))
                                        <input type="text" wire:model.lazy="wv_invoice_no" name="wv_invoice_no" class="form-control">
                                    @else
                                        <input type="text" wire:model.lazy="wv_invoice_no" name="wv_invoice_no" class="form-control" {{ ($invoice_type_id == 1 || $invoice_type_id == null) ? "disabled='disabled'" : '' }} {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                    @endif
                                    @if($errors->has('wv_invoice_no'))
                                    <p style="color:red">{{$errors->first('wv_invoice_no')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>WV Date</label>
                                    @if (Auth::user()->hasRole(['Admin', 'Super Admin']))
                                        <input type="date" wire:model="wv_date" name="wv_date" class="form-control">
                                    @else
                                        <input type="date" wire:model="wv_date" name="wv_date" class="form-control" {{ ($invoice_type_id == 1 || $invoice_type_id == null) == 1 ? "disabled='disabled'" : '' }} {{ $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                    @endif
                                    @if($errors->has('wv_date'))
                                    <p style="color:red">{{$errors->first('wv_date')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Receipt For</label>
                            <select wire:model.defer="receipt_for" name="receipt_for" class="form-control" required {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}>
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
                    <div class="col-lg-5 pull-right">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>SB Invoice No</label>
                                    <input type="text" wire:model.lazy="sb_invoice_no" name="sb_invoice_no" class="form-control" {{ ($invoice_type_id == 2 || $invoice_type_id == null) ? "disabled='disabled'" : '' }} {{ $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                    @if($errors->has('sb_invoice_no'))
                                    <p style="color:red">{{$errors->first('sb_invoice_no')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>SB Date</label>
                                    <input type="date" wire:model="sb_date" name="sb_date" class="form-control" {{ ($invoice_type_id == 2 || $invoice_type_id == null) == 1 ? "disabled='disabled'" : '' }} {{ $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                    @if($errors->has('sb_date'))
                                    <p style="color:red">{{$errors->first('sb_date')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>JO No <span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span></label>
                            @if ($transaction_status == 2 || $transaction_status == 3)
                                <input type="text" wire:model="post_jo_no" name="post_jo_no" class="form-control" disabled='disabled'>
                            @else
                                <select wire:model="jo_no" name="jo_no" class="form-control" required {{ $transaction_status == 2 ? "disabled='disabled'" : '' }}>
                                    <option value="">-- Select a job order --</option>
                                    @foreach ($job_orders as $job_order)
                                            <option value="{{ $job_order->id }}" 
                                            @foreach ($listInvoices as $key => $value)
                                                @if ($job_order->id == $value)
                                                    {{ 'disabled' }}
                                                @endif
                                            @endforeach
                                            >{{ $job_order->jo_no }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('jo_no'))
                                <p style="color:red">{{$errors->first('jo_no')}}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5 pull-right">
                        <div class="form-group">
                            <label>For</label>
                            <select wire:model.defer="for" name="for" class="form-control" required {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}>
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
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Remarks Payment <span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span></label>
                            <select wire:model.defer="remark_id" name="remark_id" class="form-control" {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                <option value="">-- Select a remark --</option>
                                @forelse ($remarks as $data)
                                    <option value="{{ $data->id }}">{{ $data->type }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('receipt_for'))
                            <p style="color:red">{{$errors->first('receipt_for')}}</p>
                            @endif
                        </div> 
                    </div>
                    <div class="col-lg-5 pull-right">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input  type="text" wire:model="customer_name" name="customer_name" class="form-control" required readonly>
                            @if($errors->has('customer_name'))
                            <p style="color:red">{{$errors->first('customer_name')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Choose a invoice type <span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span></label>
                            <select wire:model="invoice_type_id" name="invoice_type_id" class="form-control" {{ $this->wv_invoice_no != null && $this->sb_invoice_no != null ? "disabled='disabled'" : '' }} {{ $transaction_status == 3 ? "disabled='disabled'" : '' }}>
                                <option value="">-- Select a invoice type --</option>
                                @foreach ($invoice_types as $invoice)
                                    <option value="{{ $invoice->id }}">{{ $invoice->invoice_type }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('invoice_type_id'))
                            <p style="color:red">{{$errors->first('invoice_type_id')}}</p>
                            @endif
                        </div> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{-- <label>Summary of Explanation</label>
                        <br><br> --}}
                        <button class="btn btn-info pull-right" wire:click.prevent="addItem" {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}><i class="fa fa-plus fa-sm" style="font-size:10px;"></i>&nbsp;&nbsp;Add</button>
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
                                        <button wire:click="deleteItem({{ $index }})" class="btn btn-info delete-header btn-sm"  title="Delete Item" {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td>
                                    <td style="width: 160px;">
                                        <div>
                                            <select wire:model="listItems.{{ $index }}.accnt_no" name="listItems[{{ $index }}][accnt_no]" class="form-control" required {{ $transaction_status == 2 || $transaction_status == 3 ? "disabled='disabled'" : '' }}>
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
                                                        {{ $account_number->account_code . ' = ' . $account_number->account_desc}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 240px;">
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



            <!-- Modal footer -->
            <div class="modal-footer">
                @if ($transaction_status == 1 && $serviceInvoiceId != null)
                    <button wire:click.prevent="transactionConfirmServiceInvoice({{ $serviceInvoiceId }})" class="btn btn-success delete-header m-1 btn-sm pull-left"  title="Post"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Post</button>
                @elseif ($transaction_status == 2)
                    @if (Auth::user()->hasRole(['Admin', 'Super Admin']))
                        <button wire:click.prevent="cancelConfirmServiceInvoice({{ $serviceInvoiceId }})" class="btn btn-danger delete-header m-1 btn-sm pull-left"  title="Cancel"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</button>
                    @endif
                @endif
                <div class="form-group">
                    {{-- <button type="submit" class="btn btn-primary  pull-right" {{ $transaction_status == 3 || $isWvSb == true ? "disabled='disabled'" : '' }}>Save</button> --}}
                    <button type="submit" class="btn btn-primary  pull-right" {{ $transaction_status == 3 ? "disabled='disabled'" : '' }}>Save</button>
                </div>
            </div>
        </form>
    </div>

</div>

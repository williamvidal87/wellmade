<div>
    <div class="modal-content"> 
        @foreach ($report_data as $data)
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Receipts Payment</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
                </div>
                
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input  type="text" value="{{ $data->date }}" name="date" class="form-control" required readonly>
                            @if($errors->has('date'))
                            <p style="color:red">{{$errors->first('date')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
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
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Receipt Type</label>
                            <input type="text" value="{{ $data->receiptType->receipt_type }}" name="receipt_type_id" class="form-control" required readonly>
                            @if($errors->has('receipt_type_id'))
                            <p style="color:red">{{$errors->first('receipt_type_id')}}</p>
                            @endif
                        </div> 
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>Invoice No</label>
                            <input  type="text" value="{{ $data->receipt_no }}" name="receipt_no" id="receipt_no" class="form-control" required readonly>
                            @if($errors->has('receipt_no'))
                            <p style="color:red">{{$errors->first('receipt_no')}}</p>
                            @endif
                        </div>
                    </div>
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
                            <label>JO No</label>
                            <input type="text" value="{{ $data->jobOrder->jo_no }}" name="jo_no" class="form-control" required readonly>
                            @if($errors->has('jo_no'))
                            <p style="color:red">{{$errors->first('jo_no')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input  type="text" value="{{ $data->customer_name }}" name="customer_name" class="form-control" required readonly>
                            @if($errors->has('customer_name'))
                            <p style="color:red">{{$errors->first('customer_name')}}</p>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Bank</label>
                            <input type="text" value="{{ $data->bankType->abbrv_bank }}" name="bank" class="form-control" required readonly>
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



                <!-- Modal footer -->
                <div class="modal-footer">
                    @if ($serviceInvoiceId != null)
                    <a wire:click="printReports({{$serviceInvoiceId}})" class="btn btn-purple  m-1 btn-sm pull-left"><i class="fa fa-print"></i>&nbsp;Print Reports</a>
                    @endif
                </div>
            </form>
        @endforeach
        
    </div>
</div>

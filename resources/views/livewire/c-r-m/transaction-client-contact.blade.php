<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Client Transaction</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Subsidiaries</label>
                            <select wire:model="subsidiaries" name="subsidiaries" class="form-control" required>
                                <option value="">-- Select a subsidiaries --</option>
                                @foreach ($subsidiary as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subsidiaries'))
                            <p style="color:red">{{$errors->first('subsidiaries')}}</p>
                            @endif
                        </div>
                        @if (($subsidiaries != 1 && $subsidiaries != null) && ($subsidiaries != 4 && $subsidiaries != null))
                            <div class="col-lg-4">
                                <label>For</label>
                                <select wire:model="fors" name="fors" class="form-control" required>
                                    <option value="">-- Select a for --</option>
                                    @foreach ($forsTransaction as $data)
                                        <option value="{{ $data->id }}">{{ $data->type }}</option>
                                    @endforeach
                                    <option value="all">ALL</option>
                                </select>
                                @if($errors->has('fors'))
                                <p style="color:red">{{$errors->first('fors')}}</p>
                                @endif
                            </div>
                        @endif
                        <div class="col-lg-4 pull-right" style="background-color: #e5e5e5;">
                            <p style="text-align:center;">Balance</p>
                            <div class="row">
                                <div class="col-lg-4 bold">
                                    BSN:
                                </div>
                                <div class="col-lg-4 pull-right" style="text-align: right !important;">
                                    {{ $total_bsn }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 bold">
                                    SPQ:
                                </div>
                                <div class="col-lg-4 pull-right" style="text-align: right !important;">
                                    {{ $total_spq }} 
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4 bold">
                                    TOTAL
                                </div>
                                <div class="col-lg-4 pull-right" style="text-align: right !important;">
                                    {{ $overall_total }} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($subsidiaries == 4)
                    <div class="form-group">
                        <button wire:click.prevent="viewConfirmCounterReceipt({{ $clientId }})" class="btn btn-info delete-header m-1 btn-sm pull-left"  title="View"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; Counter Receipt</button>
                    </div> 
                @endif
            </div>

            <!--Data Table-->
            <!--===================================================-->
            <div class="panel-body">
                <div class="pad-btm form-inline">
                    <div class="row">
                        <div class="col-sm-6 table-toolbar-left">
                            {{-- <button class="btn btn-purple" wire:click="createClientContact"><i class="demo-pli-add icon-fw"></i>Add</button> --}}
                            <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>

                        <table id="transactionClientContactTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            @if($subsidiaries != 4)
                                <thead>
                                    <tr>
                                        <th>FOR</th>
                                        <th>REF. DATE</th>
                                        <th>REFERENCE</th>
                                        <th>TERM</th>
                                        <th>DEBIT</th>
                                        <th>CREDIT</th>
                                        <th>BALANCE</th>
                                    </tr>
                                </thead>
                            {{-- @else
                                <thead>
                                    <tr>
                                        <th>INVOICE NO</th>
                                        <th>REF. DATE</th>
                                        <th>CSA</th>
                                        <th>NET AMOUNT</th>
                                        <th>PAYMENT</th>
                                    </tr>
                                </thead> --}}
                            @endif
                            <tbody>
                                @foreach ($transactionClientContact as $data)
                                @if($subsidiaries != 4)
                                    <tr>
                                        <td>{{ $data->fors->type }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>
                                            @if ($data->invoice_type_id == 1)
                                                {{ $data->sb_invoice_no ?? '' }}
                                            @else
                                                {{ $data->wv_invoice_no ?? '' }}
                                            @endif
                                        </td>
                                        <td>{{ $data->jobOrder->term }}</td>
                                        <td>{{ number_format($data->all_total_debits, 2) }}</td>
                                        @if ($subsidiaries == 3 || $subsidiaries == 1)
                                            <td> {{ number_format($data->all_total_debits, 2) }} </td>
                                        @else
                                            <td>{{ ($data->all_total_debits) ? number_format(0, 2) : number_format($data->all_total_credits, 2) }}</td>
                                        @endif                                    
                                        <td>
                                            @if ($data->status_id == 13 || $subsidiaries == 2)
                                                {{ number_format($data->all_total_debits, 2) }}
                                            @else
                                                {{ number_format(0, 2) }}
                                            @endif
                                        </td>
                                    </tr>
                                {{-- @else
                                    <tr>
                                        <td>
                                            @foreach ($data->getCounterReceiptData as $transac)
                                                {{ $transac->getTransactionSummary->receipt_no ?? '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($data->getCounterReceiptData as $transac)
                                                {{ date('Y-m-d', strtotime($transac->getTransactionSummary->date)) ?? '' }}
                                            @endforeach
                                        </td>
                                        <td>{{ $data->getClient->forCSA->csa_type ?? '' }}</td>
                                        <td>{{ number_format($data->total, 2) ?? '' }}</td>
                                        <td>
                                            @foreach ($data->getCounterReceiptData as $transac)
                                                {{ $transac->getTransactionPayment->receipt ?? '' }}
                                            @endforeach
                                        </td>
                                    </tr> --}}
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </form>
    </div>
</div>
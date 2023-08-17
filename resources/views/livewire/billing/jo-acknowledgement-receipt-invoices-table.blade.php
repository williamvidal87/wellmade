<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">JO Acknowledgement Receipt</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
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
                        <table id="joAcknowledgementReceiptInvoicesTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th class="col-lg-2">INV. DATE</th>
                                    <th class="col-lg-2">TYPE</th>
                                    <th class="col-lg-2">INV. NO</th>
                                    <th class="col-lg-4">REMARKS</th>
                                    <th >GROSS AMT.</th>
                                    <th >DISCOUNT</th>
                                    <th >NET AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jo_acknowledgement_receipt_invoices as $data)
                                <tr>
                                    <td class="col-lg-2">{{ $data->date }}</td>
                                    <td class="col-lg-2">
                                        @if ($data->invoice_type_id == 1)
                                            {{ $data->getInvoiceType->invoice_type ?? '' }}
                                        @else
                                            {{ $data->getInvoiceType->invoice_type ?? '' }}
                                        @endif
                                    </td>
                                    <td class="col-lg-2">
                                        @if ($data->invoice_type_id == 1)
                                            {{ substr(strstr($data->sb_invoice_no, "-"), 1) ?? '' }}
                                        @else
                                            {{ substr(strstr($data->wv_invoice_no, "-"), 1) ?? '' }}
                                        @endif
                                    </td>
                                    <td class="col-lg-4">{{ $data->remarks }}</td>
                                    <td>
                                        @if (empty($data->remarks))
                                            {{ number_format($data->all_total_debits, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($data->remarks))
                                            {{ number_format($data->jobOrder->discount, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($data->remarks))
                                            {{ number_format($data->all_total_debits, 2) }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--===================================================-->
            <!--End Data Table-->

        </form>
    </div>
</div>
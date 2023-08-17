<div>
    <div class="row">
        <div class="col-xs-12">
        <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Counter Receipt</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createCounterReceipt"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="counterReceiptTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>COUNTER RECEIPT ID</th>
                                    <th>DATE</th>
                                    <th>CUSTOMER NAME</th>
                                    <th>BALANCE</th>
                                    <th>TRANSACTION STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($counter_receipts as $data)
                                <tr>
                                    <td>{{ 'CR-'. str_pad($data->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ date('Y-m-d', strtotime($data->date)) }}</td>
                                    <td>{{ $data->getClient->name ?? '' }}</td>
                                    <td>
                                        @php
                                            $total = 0;
                                            foreach ($data->getCounterReceiptData as $key => $value) {
                                                if($value->transaction_summary_cr_id != null && $value->transaction_payment_cr_id != null){
                                                    $total += 0;
                                                }elseif ($value->transaction_summary_cr_id != null) {
                                                    // foreach ($value->getTransactionSummary as $key => $val) {
                                                        $total += $value->getTransactionSummary->all_total_debits;
                                                    // }
                                                }
                                            }
                                        @endphp
                                        {{ number_format(($total), 2) }}
                                    </td>
                                    <td>
                                        @if ($data->getTransactionStatus->id == 1)
                                            <span class="badge badge-success">{{ $data->getTransactionStatus->name }}</span>
                                        @elseif ($data->getTransactionStatus->id == 2)
                                            <span class="badge badge-info">{{ $data->getTransactionStatus->name }}</span>
                                        @elseif ($data->getTransactionStatus->id == 3)
                                            <span class="badge badge-danger">{{ $data->getTransactionStatus->name }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            @if ($data->transaction_status_id == 1)
                                                <button wire:click="editCounterReceipt({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            @elseif ($data->transaction_status_id == 2)
                                                <button wire:click="payCounterReceipt({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm"  title="Pay"><i class="fa fa-money" aria-hidden="true"></i></button>
                                            @elseif ($data->transaction_status_id == 2)
                                                <button wire:click="viewCounterReceipt({{ $data->id }})" class="btn btn-dark delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            @elseif ($data->transaction_status_id == 3)
                                                <button wire:click="viewCounterReceipt({{ $data->id }})" class="btn btn-dark delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            @endif
                                        </div>                
                                    </td>
                                </tr>
                            
                                @endforeach   
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="counterReceiptModal" tabindex="-1" role="dialog" aria-labelledby="counterReceiptModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.counter-receipt-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.counter-receipts-scripts'); 
@endsection
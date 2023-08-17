<div>
    <div class="row">
        <div class="col-xs-12">
        <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Receipts/Payments</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createServiceInvoice"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>From</label>
                                    <input wire:model="dateFrom" type="date" class="form-control">
                                    @if($errors->has('dateFrom'))
                                    <p style="color:red">{{$errors->first('dateFrom')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>To</label>
                                    <input wire:model="dateTo" type="date" class="form-control">
                                    @if($errors->has('dateTo'))
                                    <p style="color:red">{{$errors->first('dateTo')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="serviceInvoiceTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>RECEIPT NO</th>
                                    {{-- <th>DATE</th> --}}
                                    <th>CUSTOMER NAME</th>
                                    <th>RECEIPT TYPE</th>
                                    <th>TRANSACTION STATUS</th>
                                    <th>DEBITS</th>
                                    <th>CREDITS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceInvoice as $data)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($data->created_at)) }}</td>
                                    <td>
                                        @if ($data->receipt_type_id == 1)
                                            {{ $data->ar_transaction ?? '' }}
                                        @else
                                            {{ $data->or_transaction ?? '' }}
                                        @endif
                                    </td>
                                    {{-- <td>{{date('Y-m-d', strtotime($data->date)) ?? ''}}</td> --}}
                                    <td>{{$data->clientProfile->name ?? ''}}</td>
                                    <td>{{$data->receiptType->receipt_type}}</td>
                                    <td>
                                        @if ($data->transactionStatus->id == 1)
                                            <span class="badge badge-success">{{$data->transactionStatus->name}}</span>
                                        @elseif ($data->transactionStatus->id == 2)
                                            <span class="badge badge-info">{{$data->transactionStatus->name}}</span>
                                        @elseif ($data->transactionStatus->id == 3)
                                            <span class="badge badge-danger">{{$data->transactionStatus->name}}</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($data->all_total_debits, 2) }}</td>
                                    <td>{{ number_format($data->all_total_credits, 2) }}</td>
                                    <td class="text-center align-middle">

                                        @if ($data->transaction_status_id == 2 || $data->transaction_status_id == 3)

                                            @if (Auth::user()->hasRole(['Admin', 'Super Admin']))
                                                <button wire:click="editServiceInvoice({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            @else
                                                <button wire:click="editServiceInvoice({{ $data->id }}, 'posted')" class="btn btn-primary delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            @endif
                                        @else
                                            <button wire:click="editServiceInvoice({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        @endif

                                        {{-- <div class="btn-group">
                                            @if ($data->transaction_status_id == 1)
                                                <button wire:click="transactionConfirmServiceInvoice({{ $data->id }}, 'posted')" class="btn btn-success delete-header m-1 btn-sm"  title="Post"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Post</button>
                                            @elseif ($data->transaction_status_id == 2)
                                                <button wire:click="transactionConfirmServiceInvoice({{ $data->id }}, 'reversed')" class="btn btn-info delete-header m-1 btn-sm"  title="Reverse"><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Reverse</button> 
                                            @elseif ($data->transaction_status_id == 3)
                                                <button wire:click="transactionConfirmServiceInvoice({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Reversed" {{$data->transaction_status_id == 3 ? 'disabled' : ''}}><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Reversed</button>
                                            @endif
                                        </div>                 --}}
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
            <div wire.ignore.self class="modal fade" id="serviceInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="serviceInvoiceModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.receipts-payments-form />
                </div>
            </div>

            <!-- Bank Modal -->
            <div wire.ignore.self class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="bankModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document" style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)">
                    <livewire:billing.bank-form />
                </div>
            </div>

            {{-- <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="serviceInvoiceViewModal" tabindex="-1" role="dialog" aria-labelledby="serviceInvoiceModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.receipt-payment-view />
                </div>
            </div> --}}

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.receipts-payments-script'); 
@endsection
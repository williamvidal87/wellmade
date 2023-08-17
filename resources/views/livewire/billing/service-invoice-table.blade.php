<div>
    <div class="row">
        <div class="col-xs-12">
        <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Service Invoice</h3>
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
                                    <th>WV INVOICE NO</th>
                                    <th>SB INVOICE NO</th>
                                    <th>JO NO:</th>
                                    <th>CUSTOMER NAME</th>
                                    <th>TRANSACTION STATUS</th>
                                    <th>PAYMENT STATUS</th>
                                    <th>DEBITS</th>
                                    <th>CREDITS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceInvoice as $data)
                                <tr>
                                    <td>{{ $data->wv_invoice_no ?? ''}}</td>
                                    <td>{{ $data->sb_invoice_no ?? ''}}</td>
                                    <td>{{$data->jobOrder->jo_no ?? ''}}</td>
                                    <td>{{$data->customer_name ?? ''}}</td>
                                    <td>
                                        @if ($data->transactionStatus->id == 1)
                                            <span class="badge badge-success">{{$data->transactionStatus->name ?? ''}}</span>
                                        @elseif ($data->transactionStatus->id == 2)
                                            <span class="badge badge-info">{{$data->transactionStatus->name ?? ''}}</span>
                                        @elseif ($data->transactionStatus->id == 3)
                                            <span class="badge badge-danger">{{$data->transactionStatus->name ?? ''}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->paymentStatus->id == 13)
                                            <span class="badge badge-danger">{{$data->paymentStatus->status ?? ''}}</span>
                                        @elseif ($data->paymentStatus->id == 12)
                                            <span class="badge badge-success">{{$data->paymentStatus->status ?? ''}}</span>
                                        @elseif ($data->paymentStatus->id == 3)
                                            <span class="badge badge-warning">{{$data->paymentStatus->status ?? ''}}</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($data->all_total_debits, 2) }}</td>
                                    <td>{{ number_format($data->all_total_credits, 2) }}</td>
                                    <td class="text-center align-middle">

                                        @if ($data->transaction_status_id == 2 || $data->transaction_status_id == 3)
                                            <button wire:click="editServiceInvoice({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            {{-- <button wire:click="editServiceInvoice({{ $data->id }}, 'posted')" class="btn btn-primary delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> --}}
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
                                        </div>              --}}
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
            <div wire.ignore.self class="modal fade" id="serviceInvoiceModal" role="dialog" aria-labelledby="serviceInvoiceModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.service-invoice-form />
                </div>
            </div>

            <!-- The Modal -->
            {{-- <div wire.ignore.self class="modal fade" id="serviceInvoiceViewModal" role="dialog" aria-labelledby="serviceInvoiceModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.service-invoice-view />
                </div>
            </div> --}}
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.service-invoice-scripts'); 
@endsection
<div>
    <div class="row">
        <div class="col-xs-12">
        <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">JO Acknowledgement Receipt</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- <button class="btn btn-purple" wire:click="createJoAcknowledgementReceipt"><i class="demo-pli-add icon-fw"></i>Add</button> --}}
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                {{-- <select name="" id="" class="form-control">
                                    <option value="">Select a status</option>
                                </select> --}}
                                <select id="status_filter" class="form-control select_design" wire:model="status_filter" name="status_filter" class="form-control" style="width:25%" required>
                                    <option value="">Select a status</option> 
                                    @foreach ($status_filter_id as $data)
                                        <option value="{{ $data->id }}">{{ $data->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="joAcknowledgementReceiptTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>JO NO</th>
                                    <th>CUSTOMER NAME</th>
                                    <th>ENGINE MODEL</th>
                                    <th>SERIAL NO.</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_orders as $data)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($data->date)) }}</td>
                                    <td>{{$data->jo_no ?? ''}}</td>
                                    <td>{{$data->clientProfile->name ?? ''}}</td>
                                    <td>{{$data->engineModel->model ?? ''}}</td>
                                    <td>{{$data->serial_no ?? ''}}</td>
                                    @if ($data->getStatus->status == "Pending")
                                        <td>
                                            <span class="text-warning">{{$data->getStatus->status ?? ''}}</span>
                                        </td>
                                    @elseif ($data->getStatus->status == "Done")
                                        <td>
                                            <span class="text-success">{{$data->getStatus->status ?? ''}}</span>
                                        </td>
                                    @elseif ($data->getStatus->status == "Approved")
                                        <td>
                                            <span class="text-primary">{{$data->getStatus->status ?? ''}}</span>
                                        </td>
                                    @elseif ($data->getStatus->status == "Cancelled")
                                        <td>
                                            <span class="text-danger">{{$data->getStatus->status ?? ''}}</span>
                                        </td>
                                    @elseif ($data->getStatus->status == "Processing")
                                        <td>
                                            <span class="text-primary">{{$data->getStatus->status ?? ''}}</span>
                                        </td>
                                    @endif
                                    <td class="text-center align-middle">
                                        <div class="btn-group">

                                            <button wire:click="invoicesJoAcknowledgementReceipt({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm"  title="Invoices"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Invoices</button>
                                            @if ($data->overall_total != null)

                                                {{-- <button wire:click="editJoAcknowledgementReceipt({{ $data->id }})" class="btn btn-warning delete-header m-1 btn-sm"  title="Edit" 
                                                    @foreach ($listInvoices as $key => $value)
                                                        @if ($data->id == $value)
                                                            {{ 'disabled' }}
                                                        @endif
                                                    @endforeach
                                                ><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit Receipt</button> --}}
                                                <button wire:click="addJoAcknowledgementReceipt({{ $data->id }})" class="btn btn-warning delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit Receipt</button>
                                            @else
                                                <button wire:click="addJoAcknowledgementReceipt({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Add" {{ ((count($data->WorkOrders) < 1 ) && ($this->checkContainsPart($data->id) < 1)) ? "disabled='disabled'" : '' }}><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Receipt</button>
                                            @endif

                                            {{-- <button wire:click="deleteConfirmJoAcknowledgementReceipt({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button> --}}

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
            <div wire.ignore.self class="modal fade" id="joAcknowledgementReceiptModal" tabindex="-1" role="dialog" aria-labelledby="joAcknowledgementReceiptModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.jo-acknowledgement-receipt-form />
                </div>
            </div>

            <!-- The Invoices Modal -->
            <div wire.ignore.self class="modal fade" id="joAcknowledgementReceiptInvoicesModal" tabindex="-1" role="dialog" aria-labelledby="joAcknowledgementReceiptInvoicesModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.jo-acknowledgement-receipt-invoices-table />
                </div>
            </div>

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.jo-acknowledgement-receipt-scripts'); 
@endsection
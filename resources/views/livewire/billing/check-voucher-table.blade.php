<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Check Voucher</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createCheckVoucher"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="checkVoucherTable" class="table table-striped table-bordered table-hover " cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>CV NO</th>
                                    <th>DATE</th>
                                    <th>SUPPLIER</th>
                                    <th>TRANSACTION STATUS</th>
                                    <th>AMOUNT</th>
                                    <th>ACTONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkVoucher as $data)
                                <tr>
                                    <td>{{'CV-'. str_pad($data->id, 5, '0', STR_PAD_LEFT)}}</td>
                                    <td>{{ date('Y-m-d', strtotime($data->date)) }}</td>
                                    <td>
                                        {{$data->getSupplierId->name ?? ''}}
                                    </td>
                                    <td>
                                        @if ($data->getTransactionStatus->id == 1)
                                            <span class="badge badge-success">{{ $data->getTransactionStatus->name ?? '' }}</span>
                                        @elseif ($data->getTransactionStatus->id == 2)
                                            <span class="badge badge-info">{{ $data->getTransactionStatus->name ?? '' }}</span>
                                        @elseif ($data->getTransactionStatus->id == 3)
                                            <span class="badge badge-danger">{{ $data->getTransactionStatus->name ?? '' }}</span>
                                        @endif
                                        
                                    </td>
                                    <td>{{ number_format($data->amount, 2) }}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            @if ($data->getTransactionStatus->id == 1)
                                                <button wire:click.prevent="editCheckVoucher({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            @elseif ($data->getTransactionStatus->id == 2 || $data->getTransactionStatus->id == 3)
                                                <button wire:click.prevent="viewCheckVoucher({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="checkVoucherModal" tabindex="-1" role="dialog" aria-labelledby="checkVoucherModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.check-voucher-form />
                </div>
            </div>

            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document" style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)">
                    <livewire:billing.supplier-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.check-voucher-scripts'); 
@endsection
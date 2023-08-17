<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Transaction Types</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createTransactionTypes"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="TransactionTypesTable" class="table table-striped table-bordered table-hover " cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>Transaction Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactiontypes as $data)
                                <tr>
                                    <td>{{$data->transaction_type}}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            
                                            <button wire:click="editTransactionTypes({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                            <button wire:click="deleteConfirmTransaction({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

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
            <div wire.ignore.self class="modal fade" id="transactiontypesModal" tabindex="-1" role="dialog" aria-labelledby="transactiontypesModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:billing.transaction-types-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.transaction-types-scripts'); 
@endsection
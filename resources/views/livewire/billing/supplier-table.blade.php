<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Supplier</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createSupplier"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="supplierTable" class="table table-striped table-bordered table-hover " cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>ADDRESS</th>
                                    <th>CONTACT NUMBER</th>
                                    <th>STATUS</th>
                                    <th>ACTONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$data->contact_number}}</td>
                                    <td>
                                        @if ($data->getStatus->id == 14)
                                            <span class="badge badge-success">{{ $data->getStatus->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $data->getStatus->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">

                                            <button wire:click="editSupplier({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                            @if ($data->status_id == 14)
                                                <button wire:click="inactiveStatusConfirmSupplier({{ $data->id }})" class="btn btn-success delete-header m-1 btn-sm"  title="Change to Inactive"><i class="fa fa-circle" aria-hidden="true"></i></button>
                                            @elseif ($data->status_id == 15)
                                                <button wire:click="activeStatusConfirmSupplier({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Change to Active"><i class="fa fa-circle" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.supplier-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.billing-supplier-scripts'); 
@endsection
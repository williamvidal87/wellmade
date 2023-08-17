<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Supplier Record</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- @can('createSupplierRecord') --}}
                                <button class="btn btn-purple" wire:click="createSupplierRecord"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="supplierRecordTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    {{-- <th>EMAIL</th> --}}
                                    <th>ADDRESS</th>
                                    {{-- <th>CONTACT PERSON</th> --}}
                                    <th>CONTACT NO.</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierRecord as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    {{-- <td>{{$data->email}}</td> --}}
                                    <td>{{$data->address}}</td>
                                    {{-- <td>{{$data->contact_person}}</td> --}}
                                    <td>{{$data->contact_no}}</td>
                                    <td>
                                        @if ($data->getStatus->id == 14)
                                            <span class="badge badge-success">{{$data->getStatus->status ?? ''}}</span>
                                        @elseif ($data->getStatus->id == 15)
                                            <span class="badge badge-danger">{{$data->getStatus->status ?? ''}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            {{-- @can('editSupplierRecord','deleteConfirmSupplierRecord') --}}
                                            <button wire:click="editSupplierRecord({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                            @if ($data->status_id == 14)
                                                <button wire:click="changeToInactive({{ $data->id }})" class="btn btn-success delete-header m-1 btn-sm"  title="Change to Inactive"><i class="fa fa-circle" aria-hidden="true"></i></button>
                                            @elseif ($data->status_id == 15)
                                                <button wire:click="changeToActive({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Change to Active"><i class="fa fa-circle" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="supplierRecordModal" tabindex="-1" role="dialog" aria-labelledby="supplierRecordModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:inventory.supplier-record-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.supplier-record-scripts'); 
@endsection

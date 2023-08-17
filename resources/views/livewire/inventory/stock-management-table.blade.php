<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Stock Management</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- @can('createStockManagement') --}}
                                <button class="btn btn-purple" wire:click="createStockManagement"><i
                                        class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="stockManagementTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>BRAND</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>SUPPLIER</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stockManagement as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->brand }}</td>
                                    <td>{{$data->description}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td>{{$data->suppliers->name}}</td>
                                    <td>
                                        @if ($data->qty > 10)
                                            <span class="text-success">On Stock</span>
                                        @elseif ($data->qty <= 10 && $data->qty > 0)
                                            <span class="text-warning">Refill the Stock</span>
                                        @elseif ($data->qty <=0 )
                                            <span class="text-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                                {{-- @can('editStockManagement','deleteConfirmStockManagement') --}}
                                                <button wire:click="editStockManagement({{ $data->id }})"
                                                    class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></button>

                                                <button wire:click="deleteConfirmStockManagement({{ $data->id }})"
                                                    class="btn btn-danger delete-header m-1 btn-sm" title="Delete" {{ $data->qty > 0 ? "disabled='disabled'" : '' }}><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                {{-- @endcan --}}
                                            </div>
                                        </td>
                                    </tr>

                    </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="stockManagementModal" tabindex="-1" role="dialog" aria-labelledby="stockManagementModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:inventory.stock-management-form />
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@section('custom_script')
    @include('layouts.scripts.stock-management-scripts');
@endsection

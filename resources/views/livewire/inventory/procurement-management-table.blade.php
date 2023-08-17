<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Procurement Management</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- @can('createProcurementManagement') --}}
                                <button class="btn btn-purple" wire:click="createProcurementManagement"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="procurementManagementTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>PR</th>
                                    <th>AMOUNT</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($procurementManagements as $procurementManagement)
                                <tr>
                                    <td>{{$procurementManagement->pr_no}}</td>
                                    <td>{{number_format($procurementManagement->all_total_price, 2)}}</td>
                                    <td>
                                        @if ($procurementManagement->statuses->id == 1)
                                            <span class="badge badge-info">{{$procurementManagement->statuses->status}}</span>
                                        @elseif ($procurementManagement->statuses->id == 2)
                                            <span class="badge badge-primary">{{$procurementManagement->statuses->status}}</span>
                                        @elseif ($procurementManagement->statuses->id == 3)
                                            <span class="badge badge-danger">{{$procurementManagement->statuses->status}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">

                                            @if ($procurementManagement->status_id == 3)
                                                <button wire:click="viewProcurementManagement({{ $procurementManagement->id }})" class="btn btn-dark delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            @elseif ($procurementManagement->status_id == 2)
                                                <button wire:click="viewProcurementManagement({{ $procurementManagement->id }})" class="btn btn-dark delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <button wire:click="deleteConfirmProcurementManagement({{ $procurementManagement->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            @elseif ($procurementManagement->status_id == 1)
                                                @if ($procurementManagement->all_total_price > 500)
                                                    <button wire:click="approveConfirmProcurementManagement({{ $procurementManagement->id }})" class="btn btn-primary  m-1 btn-sm"  title="Approve Procurement"  {{$procurementManagement->status_id == 2 ? 'disabled' : ''}} ><i class="fa fa-check" aria-hidden="true"></i></button>
                                                @endif
                                                <button wire:click="editProcurementManagement({{ $procurementManagement->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                <button wire:click="deleteConfirmProcurementManagement({{ $procurementManagement->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></button>    
                                            @endif
                                            {{-- @endcan --}}
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
            <div wire.ignore.self class="modal fade" id="procurementManagementModal" tabindex="-1" role="dialog" aria-labelledby="procurementManagementModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog  modal-lg" style="width:1200px" role="document">
                    <livewire:inventory.procurement-management-form />
                </div>
            </div>

            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)" role="document">
                    <livewire:inventory.stock-form />
                </div>
            </div>

            <!-- The Stock Management Modal -->
            <div wire.ignore.self class="modal fade" id="stockManagementModal" tabindex="-1" role="dialog" aria-labelledby="stockManagementModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)" role="document">
                    <livewire:inventory.stock-management-form />
                </div>
            </div>

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.procurement-management-scripts'); 
@endsection

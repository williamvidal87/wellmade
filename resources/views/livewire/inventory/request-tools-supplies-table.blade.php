<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Request Tools/Supplies</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createRequestToolsSupplies"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="requestToolsSuppliesTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>REQUEST BY</th>
                                    <th>ITEMS</th>
                                    <th>JO NO</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($request_tools as $data)
                                <tr>
                                    <td>{{$data->date ?? ''}}</td>
                                    <td>{{$data->getRequestBy->name ?? ''}}</td>
                                    <td>
                                        @foreach ($data->requestToolsData as $tool)
                                            <span class="badge badge-success">{{$tool->getStockManagment->name ?? ''}} - {{ $tool->qty. ' PC(s)' ?? '' }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$data->getJobOrder->jo_no ?? ''}}</td>
                                    <td>
                                        @if ($data->status_id == 1)
                                            <span class="badge badge-info">{{$data->getStatus->status ?? '' }}</span>
                                        @elseif ($data->status_id == 2)
                                            <span class="badge badge-primary">{{$data->getStatus->status ?? '' }}</span>
                                        @elseif ($data->status_id == 3)
                                            <span class="badge badge-danger">{{$data->getStatus->status ?? '' }}</span>
                                        @endif
                                        
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            {{-- If status is approved --}}
                                            @if ($data->status_id == 3)
                                                <button wire:click="viewRequestTools({{ $data->id }})" class="btn btn-dark delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            @elseif ($data->status_id == 2)
                                                <button wire:click="viewRequestTools({{ $data->id }})" class="btn btn-dark delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                                <button wire:click="deleteConfirmRequestTools({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            @elseif ($data->status_id == 1)
                                                {{-- Only for Encoder, Admin, Super Admin --}}
                                                @if (Auth::user()->hasRole(['Encoder', 'Admin', 'Super Admin']))
                                                    <button wire:click="approveRequestTools({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm"  title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                @endif
                                                <button wire:click="editRequestTools({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                <button wire:click="deleteConfirmRequestTools({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="requestToolsSuppliesModal" tabindex="-1" role="dialog" aria-labelledby="requestToolsSuppliesModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" style="width:1200px" role="document">
                    <livewire:inventory.request-tools-supplies-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.request-tools-supplies-scripts');
@endsection
<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Asset</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                              
                                <button class="btn btn-purple btn-labeled" wire:click="createAsset"><i class="btn-label demo-pli-add icon-fw"></i> Add</button>
                            
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="assetTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>Dept/Location</th>
                                    <th>Description</th>
                                    <th>Group</th>
                                    <th>Sub Group</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($machines as $data)
                                <tr>
                                    <td>{{$data->getDeptLocation->machine_dept_location_name ?? 'none'}}</td>
                                    <td>{{$data->getDescription->description ?? 'none'}}</td>
                                    <td>{{$data->getGroups->machine_group_name ?? 'none'}}</td>
                                    <td>{{$data->getAssignSubGroup->getMachineSubGroup->machine_sub_group_name ?? 'none'}}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">

                                            <button wire:click="editAsset({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                            <button wire:click="deleteConfirmAsset({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

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
            <div wire.ignore.self class="modal fade" id="assetModal" tabindex="-1" role="dialog" aria-labelledby="assetModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog " style="width: 700px"  role="document">
                    <livewire:asset.asset-form />
                </div>
            </div>         

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.asset-scripts'); 
@endsection

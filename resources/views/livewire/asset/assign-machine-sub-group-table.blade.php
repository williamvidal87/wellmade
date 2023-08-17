<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Assign Machine Sub Groups</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                              
                                <button class="btn btn-purple btn-labeled" wire:click="createAssignMachineSubGroup"><i class="btn-label demo-pli-add icon-fw"></i> Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="assignMachineSubGroupTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>MACHINE NUMBER</th>         
                                    <th>MACHINE GROUP</th>   
                                    <th>MACHINE SUB GROUP</th>                                         
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignmachinesubgroup as $data)
                                <tr>
                                    <td>{{$data->getMachineNumber->machine_id_number ?? 'none'}}</td>
                                    <td>{{$data->getMachineGroup->machine_group_name ?? 'none'}}</td>
                                    <td>{{$data->getMachineSubGroup->machine_sub_group_name ?? 'none'}}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            {{-- @can('editClientContact','deleteConfirmClientContact')                                           --}}
                                            <button wire:click="editAssignMachineSubGroup({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>                                          
                                           
                                            <button wire:click="deleteConfirmAssignMachineSubGroup({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="assignMachineSubGroupModal" tabindex="-1" role="dialog" aria-labelledby="assignMachineSubGroupModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog " style="width: 450px"  role="document">
                    <livewire:asset.assign-machine-sub-group-form />
                </div>
            </div>         

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.assign-machine-sub-group-scripts'); 
@endsection

<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Machine Group</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                              
                                <button class="btn btn-purple btn-labeled" wire:click="createMachineGroup"><i class="btn-label demo-pli-add icon-fw"></i> Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="machineGroupTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>MACHINE GROUP</th>    
                                    <th>MACHINE GROUP CATEGORY</th>              
                                    <th>MACHINE GROUP NUMBER</th>                      
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($machine_group as $data)   
                                <tr>
                                    <td>{{$data->machine_group_name}}</td>
                                    <td>{{$data->getMachineGroupCategory->machine_category_name}}</td>                                  
                                    <td>{{$data->getMachineGroupIdNumber->machine_id_number ?? ''}}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            {{-- @can('editClientContact','deleteConfirmClientContact')                                           --}}
                                            <button wire:click="editMachineGroup({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>                                          
                                           
                                            <button wire:click="deleteConfirmMachineGroup({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="machineGroupModal" tabindex="-1" role="dialog" aria-labelledby="machineGroupModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog " style="width: 450px" role="document">
                    <livewire:asset.machine-group-form />
                </div>
            </div>         

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.machine-group-scripts'); 
@endsection
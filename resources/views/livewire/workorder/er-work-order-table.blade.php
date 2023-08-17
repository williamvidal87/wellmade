<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            
                            <div class="panel-heading">
                                <h3 class="panel-title">Er Work Order</h3>
                            </div>
            
                            <!--Data Table-->
                            <!--===================================================-->
                            <div class="panel-body">
                                <div class="pad-btm form-inline">
                                    <div class="row">
                                        <div class="col-sm-6 table-toolbar-left">
                                            <button class="btn btn-purple" wire:click="create"><i class="demo-pli-add icon-fw"></i>Add</button>
                                            <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="mfWorkOrderTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                        <thead>
                                            <tr>
                                                <th>Er Work Group</th>
                                                <th>Work Sub Type</th>
                                                <th>General Procedure</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($work as $data)
                                                <tr>
                                                    <td>{{$data->getWorkGroup->mf_work_group_name ?? ''}}</td>                                                   
                                                    <td>{{$data->work_sub_type_id}}</td>
                                                    <td>{{$data->general_procedure_id}}</td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group">
                
                                                            <button wire:click="edit({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                
                                                            <button wire:click="deleteConfirm({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                
                                                        </div>                
                                                    </td>
                                                </tr>                                     
                                          
                                            @endforeach   --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--===================================================-->
                            <!--End Data Table-->
            
                        </div>
                        <!-- The Modal -->
                        <div wire.ignore.self class="modal fade" id="mfWorkOrderModal" tabindex="-1" role="dialog" 
                        aria-labelledby="mfWorkOrderModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg" role="document">
                                <livewire:workorder.er-work-order-form/>
                            </div>
                        </div>                           
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.er-work-order-scripts');
                @endsection
        </div>
        
    </div>
    
</div>
<div>
    <div class="row">
        <livewire:flash-message.flash-messages />
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Branch</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- @can('createBranch') --}}
                                <button class="btn btn-purple btn-labeled" wire:click="createBranch"><i class="btn-label demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="branchTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th class="text-left">Company Name</th>
                                    <th class="text-center">Branch</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Contact Number</th>
                                    <th class="text-center">Manager</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $data)
                                    <tr>
                                        <td class="text-left">{{$data->company_name}}</td>
                                        <td class="text-center">{{$data->branch_name}}</td>
                                        <td class="text-center">{{$data->address}}</td>
                                        <td class="text-center">{{$data->contact_no}}</td>
                                        <td class="text-center">{{$data->owner_name}}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                {{-- @can('editBranch','deleteConfirmBranch') --}}
                                                <button wire:click="editBranch({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                                <button wire:click="deleteConfirmBranch({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="branchModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:client.branch-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.branch-scripts'); 
@endsection
<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Machine and Fabrication List</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createMachineandFabricationList"><i
                                        class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <!-- start table -->
                    <div class="table-responsive">
                        <table id="machineANDfabricationTable" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>Machine and Fabrication</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($machineandFabricationList as $data)
                                    <tr>
                                        <td>{{ $data->mf_name }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">

                                                <button wire:click="editMachineandFabricationList({{ $data->id }})"
                                                    class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></button>

                                                <button
                                                    wire:click="deleteConfirmMachineandFabricationList({{ $data->id }})"
                                                    class="btn btn-danger delete-header m-1 btn-sm" title="Delete"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table -->
                </div>

            </div>
            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="mfListModal" tabindex="-1" role="dialog"
                aria-labelledby="mfListModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:machine.machineand-fabrication-list-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.machine-and-fabrication-list-scripts');
@endsection

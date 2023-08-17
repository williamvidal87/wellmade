<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Sub Type</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createSubtype"><i
                                        class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="subTypeTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Sub Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sub_types as $data)
                                    <tr>
                                        <td>{{ $data->sub_type_name }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">

                                                <button wire:click="editSubtype({{ $data->id }})"
                                                    class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></button>

                                                <button wire:click="deleteConfirmSubtype({{ $data->id }})"
                                                    class="btn btn-danger delete-header m-1 btn-sm" title="Delete"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></button>

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
            <div wire.ignore.self class="modal fade" id="subTypeModal" tabindex="-1" role="dialog"
                aria-labelledby="subTypeModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:workload.sub-type-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.sub-type-scripts');
@endsection

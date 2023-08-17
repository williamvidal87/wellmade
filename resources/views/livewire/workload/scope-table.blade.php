<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">ER Scope</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createScopeList"><i
                                        class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="scopeTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Work Group</th>
                                    <th>Scope</th>
                                    <th>A</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                    <th>F</th>
                                    <th>G</th>
                                    <th>H</th>
                                    <th>I</th>
                                    <th>J</th>
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($scopes as $data)
                                    <tr>
                                        <td>{{ $data->getERWorkGroup->group_name ?? " "}}</td>
                                        <td>{{ $data->scope_name }}</td>
                                        <td>{{ $data->price_a ?? "0" }}</td>
                                        <td>{{ $data->price_b ?? "0" }}</td>
                                        <td>{{ $data->price_c ?? "0" }}</td>
                                        <td>{{ $data->price_d ?? "0" }}</td>
                                        <td>{{ $data->price_e ?? "0" }}</td>
                                        <td>{{ $data->price_f ?? "0" }}</td>
                                        <td>{{ $data->price_g ?? "0" }}</td>
                                        <td>{{ $data->price_h ?? "0" }}</td>
                                        <td>{{ $data->price_i ?? "0" }}</td>
                                        <td>{{ $data->price_j ?? "0" }}</td>
                                        <td>{{ $data->getUnit->unit ?? " "}}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button wire:click="editScopeList({{ $data->id }})"
                                                    class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></button>
                                                <button wire:click="deleteConfirmScopeList({{ $data->id }})"
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
            <div wire.ignore.self class="modal fade" id="scopeListModal" tabindex="-1" role="dialog"
                aria-labelledby="scopeListModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:workload.scope-table-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.scope-list-scripts');
@endsection

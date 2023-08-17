<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">

            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Machine Unit</h3>
                </div>

                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple btn-labeled" wire:click="create">
                                    <i class="btn-label demo-pli-add icon-fw"></i>
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="machine-units" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">

                            <thead>
                                <tr>
                                    <th class="text-left">Machine Units</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $data)
                                    <tr>
                                        <td class="text-left">
                                            {{ $data->machine_unit_name }}
                                        </td>

                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button wire:click="edit({{ $data->id }})"
                                                    class="btn btn-info delete-header m-1 btn-sm"
                                                    title="Edit"><i class="fa fa-edit"
                                                        aria-hidden="true"></i></button>
                                                <button wire:click="delete({{ $data->id }})"
                                                    class="btn btn-danger delete-header m-1 btn-sm"
                                                    title="Delete"><i class="fa fa-trash-o"
                                                        aria-hidden="true"></i></button>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- MACHINE FORM --}}
            <div wire.ignore.self class="modal fade" id="machine-units-modal" tabindex="-1" role="dialog"
                aria-labelledby="machine-units-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:asset.machine-units-form />
                </div>

            </div>

        </div>

    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.machine-units-scripts');
@endsection
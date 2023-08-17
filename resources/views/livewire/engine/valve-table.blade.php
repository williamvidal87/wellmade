<div>
    <div class="row">

        <livewire:flash-message.flash-messages/>

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Valve</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple btn-labeled" wire:click="createvalve"><i
                                    class="btn-label demo-pli-add icon-fw"></i>Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="valveTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Valve</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($valve as $data)
                                    <tr>
                                        <td>
                                            {{ $data->valve }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button wire:click="editValve({{ $data->id }})"
                                                class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                class="fa fa-pencil" aria-hidden="true"></i></button>

                                                <button wire:click="deletetheValve({{ $data->id }})"
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
            
            <div  wire.ignore.self class="modal fade" id="valveformModal" tabindex="-1" role="dialog"
                aria-labelledby="valveformModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:engine.valve-form />
                </div>
            </div>
            
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.valve-scripts');
@endsection
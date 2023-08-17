<div>
    <div class="row">
        <livewire:flash-message.flash-messages />
        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Engine Parts List</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- @can('createEnginePartList') --}}
                                <button class="btn btn-purple" wire:click="createEnginePartList"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="enginepartTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Engine Part Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($engine_parts as $data)
                                    <tr>
                                        <td>{{ $data->engine_part_name }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                {{-- @can('editEnginePartList','deleteConfirmEnginePartList') --}}
                                                <button wire:click="editEnginePartList({{ $data->id }})"
                                                    class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></button>

                                                <button wire:click="deleteConfirmEnginePartList({{ $data->id }})"
                                                    class="btn btn-danger delete-header m-1 btn-sm" title="Delete"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="enginepartListModal" tabindex="-1" role="dialog" aria-labelledby="enginepartListModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:engine.engine-part-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.engine-part-scripts');
@endsection

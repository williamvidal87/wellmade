<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Engine Model</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- @can('createEngineModel') --}}
                                <button class="btn btn-purple" wire:click="createEngineModel"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <div wire:key="enginemodel" class="table-responsive">
                        <table id="enginemodelTable" class="table table-striped table-bordered table-hover " cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>Model</th>
                                    <th>Year Made</th>
                                    <th>Make</th>
                                    <th>Category</th>
                                    <th>Cylinder</th>
                                    <th>Valve</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enginemodel as $data)
                                <tr>
                                    <td>{{$data->model}}</td>
                                    <td>{{$data->getYearMade->year_made ?? "0"}}</td>
                                    <td>{{$data->getMake->make_name ?? " "}}</td>
                                    <td>{{$data->getCategory->category ?? " "}}</td>
                                    <td>{{$data->getCylinder->cylinder ?? " "}}</td>
                                    <td>{{$data->getValve->valve ?? " "}}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            {{-- @can('editEngineModel','deleteConfirmEngineModel') --}}
                                            <button wire:click="editEngineModel({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                            <button wire:click="deleteConfirmEngineModel({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
            <div wire.ignore.self class="modal fade" id="enginemodelModal" tabindex="-1" role="dialog" aria-labelledby="enginemodelModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:engine.engine-model-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.engine-model-scripts'); 
@endsection
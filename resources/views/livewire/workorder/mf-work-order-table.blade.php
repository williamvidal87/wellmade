<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            
                            <div class="panel-heading">
                                <h3 class="panel-title">Work Order</h3>
                            </div>
            
                            <!--Data Table-->
                            <!--===================================================-->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="mfWorkOrderTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                        <thead>
                                            <tr style="background-color: #2C3539">
                                                <th style="color: white">Job Order No.</th>
                                                <th class="text-center" style="color: white">Work Type(s)</th>
                                                <th class="text-center" style="color: white">Operator(s)</th>
                                                <th class="text-center" style="color: white">Start</th>
                                                <th class="text-center" style="color: white">End</th>
                                                <th class="text-center" style="color: white">Status</th>
                                                <th class="text-center" style="color: white">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($work as $data)
                                                @foreach ($data->workers as $workers)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $data->getJobOrder->reference_no ?? "" }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $data->getJobType->description ?? "" }}<br>
                                                            <small class="text-dark">
                                                                @if ($data->getJobType->abbriv_code == "MF")
                                                                    ( {{ $data->scope_description ?? "" }} )
                                                                @elseif ($data->getJobType->abbriv_code == "Calib")
                                                                    ( {{ $data->getScopeDescription->scope_description_name ?? "" }} )
                                                                @else
                                                                    ( {{ $data->general_procedure ?? "" }} )
                                                                @endif
                                                            </small>
                                                        </td>
                                                        <td class="text-center text-primary">
                                                            {{ $workers->getWorker->name }}
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($workers->Status->status == "Done")
                                                                {{ $workers->start->format('Y-m-d h:i A') }}
                                                            @elseif ($workers->Status->status == "Inactive")
                                                                {{ $workers->start->format('Y-m-d h:i A') }}
                                                            @else
                                                                ---
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($workers->Status->status == "Done")
                                                                {{ $workers->end->format('Y-m-d h:i A') }}
                                                            @else
                                                                ---
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($workers->status == 9)
                                                                <span class="fa fa-check-circle text-success">
                                                                    {{$workers->Status->status}}
                                                                </span>
                                                            @elseif ($workers->status == 6)
                                                                <span class="text-warning">
                                                                    Waiting to start
                                                                </span>
                                                            @elseif ($workers->status == 5)
                                                                <span class="text-primary">Currently Working</span>
                                                            @elseif($workers->status == 15)
                                                                <span class="text-warning fw-bold">PAUSED</span>
                                                            @else
                                                                <div class="text-primary">{{$workers->Status->status}}</div>
                                                            @endif
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group">
                    
                                                                <button wire:click="edit({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit">
                                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                </button>
                    
                                                            </div>                
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--===================================================-->
                            <!--End Data Table-->
            
                        </div>
                        
                        
                                            <!-- MF Modal -->
                        <div wire.ignore.self class="modal fade" id="mfModal" tabindex="-1" role="dialog"
                             aria-labelledby="mfModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg" role="document">
                                <livewire:workorder.mf-work-order-form />
                            </div>
                        </div>

                        {{-- <!-- PRINT -->
                        <div wire.ignore.self class="modal fade" id="printModal" tabindex="-1" role="dialog"
                            aria-labelledby="printModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg" role="document">
                                <livewire:workorder.print-work-order />
                            </div>
                        </div> --}}
                
                        <!-- ER Modal -->
                        <div wire.ignore.self class="modal fade" id="erModal" tabindex="-1" role="dialog"
                             aria-labelledby="erModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg" role="document">
                                <livewire:workorder.er-work-order-form />
                            </div>
                        </div>
                
                        <!-- Calib Modal -->
                        <div wire.ignore.self class="modal fade" id="calibModal" tabindex="-1" role="dialog"
                            aria-labelledby="calibModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg" role="document">
                                <livewire:workorder.calibration-work-order-form/>
                            </div>
                        </div>

                        {{-- <div wire.ignore.self class="modal fade" id="printModal" tabindex="-1" role="dialog"
                            aria-labelledby="printModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg" role="document">
                                <livewire:workorder.print-work-order/>
                            </div>
                        </div> --}}
                       
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.mf-work-order-scripts');
                @endsection
        </div>
        
    </div>
    
</div>
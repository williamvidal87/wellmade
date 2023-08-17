<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">

            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Job Order</h3>
                </div>

                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple btn-labeled" wire:click="create">
                                    <i class="btn-label demo-pli-add icon-fw"></i>
                                    Add
                                </button>

                                <select id="status_filter" class="form-control select_design"
                                    wire:change="changeshowtablestatus" name="status_filter" class="form-control"
                                    wire:model="status_filter" style="width:25%" required>
                                    <option value='1'>Select Status</option>
                                    @foreach ($status_filter_id as $data)
                                        <option value="{{ $data->id }}">{{ $data->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="job-order-table" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">

                            <thead>
                                <tr>
                                    <th class="text-left">DATE</th>
                                    <th class="text-left">JO NO</th>
                                    <th class="text-left">CUSTOMER NAME</th>
                                    <th class="text-center">ENGINE MODEL</th>
                                    <th class="text-center">SERIAL NO.</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_orders as $key => $data)
                                    <tr>
                                        <td>{{ $data->date->format("Y-m-d") }}</td>
                                        <td><u><a href="javascript:void(0)"
                                                    wire:click="AddMF({{ $data->id }})">{{ $data->jo_no ?? '' }}</a></u>
                                        </td>
                                        <td class="text-left">
                                            <i class="fa fa-user-circle"></i>&nbsp;&nbsp;
                                            <u><a href="javascript:void(0)"
                                                    wire:click="viewClientContact({{ $data->customer_id }})">{{ $data->clientProfile->name ?? '' }}</a></u>
                                        </td>
                                        <td class="text-center">{{ $data->engineModel->model ?? '' }}</td>
                                        <td class="text-center">{{ $data->serial_no }}</td>
                                        <td class="text-center">
                                            @if ($data->status == 1)
                                                <span class="badge badge-warning">
                                                    {{ $data->statusess->status ?? '' }}
                                                </span>
                                            @elseif($data->status == 9)
                                                <span class="badge badge-success">
                                                    {{ $data->statusess->status ?? '' }}
                                                </span>
                                            @elseif($data->status == 3)
                                                <span class="badge badge-danger">
                                                    {{ $data->statusess->status ?? '' }}
                                                </span>
                                            @else
                                                <span class="badge badge-primary">
                                                    {{ $data->statusess->status ?? '' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($data->status == 1 || $data->status == 2 || $data->status == 4 || $data->status == 9)
                                                <div class="btn-group">

                                                    <button wire:click="edit({{ $data->id }})"
                                                        class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                            class="fa fa-pencil" aria-hidden="true"></i></button>

                                                    <button wire:click="cancelJobOrder({{ $data->id }})"
                                                        class="btn btn-danger delete-header m-1 btn-sm"
                                                        title="Cancel Job Order"><i class="fa fa-remove"
                                                            aria-hidden="true"></i></button>

                                                    <button wire:click="AddMF({{ $data->id }})"
                                                        class="btn btn-primary delete-header m-1 btn-sm"
                                                        title="Work Order Group"><i class="fa fa-file-o"
                                                            aria-hidden="true"></i></button>

                                                </div>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- JO FORM --}}
            <div wire.ignore.self class="modal fade" id="JOFormModal" tabindex="-1" role="dialog"
                aria-labelledby="JOFormModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:j-o-m-s.job-order-form />
                </div>

            </div>

            <div wire.ignore.self class="modal fade" id="addworkordertable" tabindex="-1" role="dialog"
                aria-labelledby="addworkordertable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document" style="width: 90%">
                    <livewire:workorder.add-work-order-table />
                </div>
            </div>

            <!-- MF Modal -->
            <div wire.ignore.self class="modal fade" id="mfModal" tabindex="-1" role="dialog"
                aria-labelledby="mfModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document"
                    style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)">
                    <livewire:workorder.mf-work-order-form />
                </div>
            </div>

            <!-- ER Modal -->
            <div wire.ignore.self class="modal fade" id="erModal" tabindex="-1" role="dialog"
                aria-labelledby="erModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document"
                    style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)">
                    <livewire:workorder.er-work-order-form />
                </div>
            </div>

            <!-- Calib Modal -->
            <div wire.ignore.self class="modal fade" id="calibModal" tabindex="-1" role="dialog"
                aria-labelledby="calibModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document"
                    style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)">
                    <livewire:workorder.calibration-work-order-form />
                </div>
            </div>

            <div wire.ignore.self class="modal fade" id="addworkertable" tabindex="-1" role="dialog"
                aria-labelledby="addworkertable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)" class="modal-dialog modal-lg"
                    role="document">
                    <livewire:workorder.add-worker-table />
                </div>
            </div>

            <div wire.ignore.self class="modal fade" id="workerForm" tabindex="-1" role="dialog"
                aria-labelledby="workerForm" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div style="box-shadow: 0 0 300px 200px rgb(14, 13, 13, 0.185)" class="modal-dialog modal-md"
                    role="document">
                    <livewire:workorder.worker-form />
                </div>
            </div>

            <!-- Work Sub Type Modal -->
            <div wire.ignore.self class=" modal fade" id="workSubtypeModal" tabindex="-1" role="dialog"
                aria-labelledby="workSubtypeModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" style="box-shadow: 0 0 300px 200px rgb(14, 13, 13, 0.185)" role="document">
                    <livewire:workload.scope-table-form />
                </div>
            </div>

            <!-- View Details Modal -->
            <div wire.ignore.self class=" modal fade" id="viewDetails" tabindex="-1" role="dialog"
                aria-labelledby="viewDetails" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="shadow-lg modal-dialog modal-lg" role="document">
                    <livewire:j-o-m-s.view-details />
                </div>
            </div>

            <div wire.ignore.self class="modal fade" id="clientContactModal" tabindex="-1" role="dialog"
                aria-labelledby="clientContactModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" style="overflow-y: initial" role="document">
                    <livewire:c-r-m.client-contact-form />
                </div>
            </div>

            <!-- The Contact Modal -->
            <div wire.ignore.self class="modal fade" id="contactModal" tabindex="-1" role="dialog"
                aria-labelledby="contactModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog " style="width: 500px; border:black 6px solid" role="document">
                    <livewire:c-r-m.contact-form />
                </div>
            </div>

            {{-- cancel work order modal --}}
            <div wire.ignore.self class="modal fade" id="cancelworkordermodal" tabindex="-1" role="dialog"
                aria-labelledby="cancelworkordermodal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog " style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)" role="document">
                    <livewire:workorder.cancel-work-order-form />
                </div>
            </div>

            {{-- Stop Worker modal --}}
            <div wire.ignore.self class="modal fade" id="stopworkordermodal" tabindex="-1" role="dialog"
                aria-labelledby="stopworkordermodal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div style="box-shadow: 0 0 300px 200px rgb(14, 13, 13, 0.185)" class="modal-dialog modal-md"
                    role="document">
                    <livewire:workorder.stop-worker-reason-form />
                </div>
            </div>

            <div wire.ignore.self class="modal fade" id="workerStartForm" tabindex="-1" role="dialog"
                aria-labelledby="workerStartForm" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div style="box-shadow: 0 0 300px 200px rgb(14, 13, 13, 0.185)" class="modal-dialog modal-md"
                    role="document">
                    <livewire:workorder.worker-start-form />
                </div>
            </div>

            <div wire.ignore.self class="modal fade" id="workerEndForm" tabindex="-1" role="dialog"
                aria-labelledby="workerEndForm" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div style="box-shadow: 0 0 300px 200px rgb(14, 13, 13, 0.185)" class="modal-dialog modal-md"
                    role="document">
                    <livewire:workorder.worker-end-form />
                </div>
            </div>

            <div wire.ignore.self class="modal fade" id="jobOrderPrice" tabindex="-1" role="dialog"
                aria-labelledby="jobOrderPrice" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div style="box-shadow: 0 0 300px 200px rgb(14, 13, 13, 0.185)" class="modal-dialog modal-md"
                    role="document">
                    <livewire:workorder.price-form />
                </div>
            </div>

        </div>

    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.job-order-scripts');
@endsection

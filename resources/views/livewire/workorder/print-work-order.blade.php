<div>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">PRINT WORK ORDER</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
        </div>

        <div class=" modal-body d-flex justify-content-between">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel">
                        {{-- <div class="panel-head">
                            <h3 class="panel-title text-center">
                                Print Work Order
                            </h3>
                        </div> --}}
                        <div class="panel-body">
                            {{-- <div class="col-sm-6 table-toolbar-left">
                                <div class="col-sm">
                                    <label for="barcode_generator" class="form-label">Scan Now</label>
                                    <input type="number" class="form-control" wire:model="scannedID" id="forscanned" id="barcode_generator" autofocus>
                                </div>
                            </div>
                            <br> --}}
                            <div class="pad-btm form-inline">
                                <div class="row">
                                    <div class="col-sm-6 table-toolbar-left">
                                        <label for="barcode_generator" class="form-label" style="font-size: 15px;">Scan here: </label>
                                        <input type="number" class="form-control" wire:model="scannedID" id="forscanned" id="barcode_generator" autofocus>
                                        {{-- <button class="btn btn-purple" wire:click="create()"><i
                                                class="demo-pli-add icon-fw"></i>Add</button> --}}
                                        <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                                    </div>
                                    <div class="col-sm-6 table-toolbar-right">
                                        @if($scannedID)
                                            @if($data)
                                                <button class="btn btn-danger btn-rounded" wire:click="export2PDF()"><i class="fa fa-download" aria-hidden="true"></i><span class="ml-2">Export to PDF</span></button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if($scannedID)
                                @if($data)
                                    {{-- Start Table --}}
                                    <div class="table-responsive">
                                        <table class="table table-vcenter mar-top table table-bordered" cellspacing="0" width="100%">
                                            <div class="text-center">
                                                <h4 class="card-title">WM Global Holdings Dumaguete</h4>
                                                @if ($work_type == "MF")
                                                    <p><u><b>MACHINE FABRICATION WORK REPORT</b></u></p>
                                                    <p style="text-transform:uppercase;">{{ $data->getMFWorkGroup->group_name }}</p>
                                                @elseif ($work_type == "ER")
                                                    <p><u><b>ENGINE RECONDITIONING WORK REPORT</b></u></p>
                                                    <p style="text-transform:uppercase;">{{ $data->getERWorkGroup->group_name }}</p>
                                                @elseif ($work_type == "CALIB")
                                                    <p><u><b>CALIBRATION WORK REPORT</b></u></p>
                                                    <p style="text-transform:uppercase;">{{ $data->getCalibWorkGroup->group_name }}</p>
                                                @endif
                                                {{-- <p><u><b>ENGINE RECONDITIONING WORK & CALIBRATION REPORT</b></u></p> --}}
                                                {{-- <p>{{ $data->getMFWorkGroup->group_name }}</p> --}}
                                                <small>Printed on {{ date("Y-m-d h:i a") }}</small>
                                            </div>
                                            {{-- <p class="text-left">Printed on 2021-12-13</p> --}}
                                            {{-- <ul class="list-inline">
                                                <li class="list-inline-item" style="margin-right:165px;">Printed on {{ date("Y-m-d h:i a") }}</li>
                                                <li class="list-inline-item">
                                                    {!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}
                                                </li>
                                            </ul> --}}
                                            <caption>
                                                <div class="center" style="justify-content:center;display:flex">
                                                    {!! DNS1D::getBarcodeHTML($scannedID, 'CODABAR') !!}
                                                </div>
                                            </caption>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">JO No.</th>
                                                    <th class="text-center">
                                                        REFERENCE No.
                                                    </th>
                                                    <th class="text-center" colspan="2">ENGINE REFERENCE No.</th>
                                                    {{-- <th class="text-center">GENERAL PROCEDURE</th> --}}
                                                    <th class="text-center">MACHINE</th>
                                                    <th class="text-center">STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">{{ $data->getJobOrder->jo_no }}</td>
                                                    <td class="text-center">{{ $data->reference_no_id }}</td>
                                                    <td class="text-center">
                                                        <b>Make/Model</b><br>
                                                        {{ $jo_data->getMakeList->make_name }}/{{ $jo_data->engineModel->model }}
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <b>Serial No.</b><br>
                                                            {{ $jo_data->serial_no }}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $data->getMachine->machine_name }}
                                                    </td>
                                                    <td class="text-center">{{ $jo_data->statusess->status }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <div style="font-weight: bold;text-align: center;margin-top: -3px;">
                                                            GENERAL PROCEDURE
                                                        </div><br>
                                                        {{ $data->general_procedure }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div style="font-weight: bold;text-align: center;margin-top: -3px;">
                                                            PARTS REQUIRED
                                                        </div><br>
                                                        {{ $data->getPartsRequired->status }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div style="font-weight: bold;text-align: center;margin-top: -3px;">
                                                            PROCESS COST
                                                        </div><br>
                                                        {{ $data->process_cost }}
        
                                                    </td>
                                                    <td colspan="3">
                                                        {{-- <b>CALIB WORK SUBTYPE:</b><br> --}}
                                                        <div style="font-weight: bold;text-align: center;margin-top: -3px;">
                                                            PROCESSING DETAILS
                                                        </div><br>
                                                        {{-- <b>DATE:</b> DFS8 <b>TIME:</b> DFS8 <b>ENCODER:</b> DFS8 --}}
                                                        <b>DATE:</b> {{ $jo_data->work_date_start->isoFormat('MMMM D Y') }}<br>
                                                        <b>TIME:</b> {{ date("h:i a"); }}
                                                        {{-- {{ $data->getCalibWorkSubType->work_sub_type_name }} --}}
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        <div style="font-weight: bold;text-align: center;margin-top: -3px;">
                                                        MAX DISCOUNT
                                                        </div><br>
                                                        {{ $data->max_discount }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div style="font-weight: bold;text-align: center;margin-top: -3px;">
                                                            JO NO
                                                        </div><br>
                                                        {{ $data->getJobOrder->jo_no }}
                                                    </td> --}}
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <span class="sit-in-the-corner" style="float:left;margin-left: 5px;margin-top: -40px;"><b><u>WORK ONLY ON JOB(s) STATED BELOW</u></b></span>
                                                        {{-- {{ $data->getERWorkSubType->sub_group }} --}}
                                                        @if($work_type == "ER")
                                                            {{ $data->getERWorkSubType->scope_name }}
                                                        @elseif ($work_type == "MF")
                                                            {{ $data->getMFWorkSubType->sub_group }}
                                                        @elseif($work_type == "CALIB")
                                                            {{ $data->getCalibWorkSubType->sub_group }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div  id="qrcode" class="center" style="justify-content:center;display:flex">
                                                                    {!! DNS2D::getBarcodeHTML('{{ $user_id }}', 'QRCODE',3,3) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <b>HRS:</b> {{ $data->hours }}<br><br>
                                                        <b>QTY:</b> {{ $data->qty }}<br><br>
                                                    </td>
                                                    <td colspan="2">
                                                        <div style="font-weight: bold;text-align: left;margin-top: -6px;">
                                                            <u>CREDITABLE INCENTIVE, ON-GOING QC</u>
                                                        </div><br>
                                                        {{-- - {{ $data->getProcessGroup->sub_group }}<br>
                                                        - {{ $data->getProcessSubGroup->sub_group}} --}}
                                                        <b>INCENTIVE: </b>{{ $data->incentive }}<br><br>
                                                        <b>DISCOUNT: </b> {{ $data->getDiscount->discount }}
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        <div style="font-weight: bold;text-align: center;margin-top: -60px;">JO NO.</div><br>
                                                        {{ $data->getJobOrder->jo_no }}
                                                        
                                                    </td> --}}
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr style="width:50%; margin:auto;">
                                    </div>
                                    {{-- End Table --}}
                                @else
                                    <h1 class="text-center">No Records Found!</h1>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @section('custom_script')
    @include('layouts.scripts.barcode-scan-scripts');
@endsection --}}

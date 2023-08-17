<div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-head" style="text-align: center;line-height: 20%;font-size: 15px;">
                    <h3 class="panel-title">
                        WM Global Holdings Dumaguete
                    </h3>
                    @if ($viewdata['records']->mf_work_group_id)
                        <p><u><b>MACHINE FABRICATION WORK REPORT</b></u></p>
                        <p style="text-transform:uppercase;">{{ $viewdata['records']->getMFWorkGroup->group_name }}</p>
                    @elseif ($viewdata['records']->er_work_group_id)
                        <p><u><b>ENGINE RECONDITIONING WORK REPORT</b></u></p>
                        <p style="text-transform:uppercase;">{{ $viewdata['records']->getERWorkGroup->group_name }}</p>
                    @elseif ($viewdata['records']->calib_work_group_id)
                        <p><u><b>CALIBRATION WORK REPORT</b></u></p>
                        <p style="text-transform:uppercase;">{{ $viewdata['records']->getCalibWorkGroup->group_name }}</p>
                    @endif
                    <small>Printed on {{ $viewdata['current_date_printed'] }}</small>
                    <br><br>
                </div>
                <div class="panel_body">
                    @if($viewdata['scannedID'])

                        {{-- Start Table --}}
                        <div class="table-responsive">
                            <table border="1" style="border-collapse: collapse;" width="100%">
                                <caption>
                                    {{-- <div class="center" style="width: 70px;margin: auto;">
                                        {!! DNS1D::getBarcodeHTML($viewdata['scannedID'], 'CODABAR', 2,20) !!}
                                        {!! DNS1D::getBarcodeHTML($viewdata['scannedID'], 'UPCA', 2,25) !!}
                                    </div> --}}
                                    <div class="center" style="width: 180px;margin: auto;">
                                        {!! DNS1D::getBarcodeHTML($viewdata['scannedID'], 'UPCA', 2,25) !!}
                                    </div>
                                </caption>
                                <thead style="font-size: 15px;">
                                    {{-- Head --}}
                                    <tr>
                                        <th class="text-center" colspan="2">WORK ORDER No.</th>
                                        <th class="text-center" colspan="3">PROCESSING DETAILS</th>
                                        <th class="text-center" colspan="2">ENGINE REFERENCE NO.</th>
                                    </tr>
                                    {{-- End Head --}}
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <div style="font-weight: bold;text-align: center;margin-top: -1px;font-size: 15px;">
                                                JO NO.
                                            </div>
                                            <div style="text-align: center;font-size: 13px;">{{ $viewdata['records']->getJobOrder->jo_no }}</div>
                                        </td>

                                        <td class="text-center">
                                            <div style="font-weight: bold;text-align: center;margin-top: -3px;font-size: 15px;">
                                                REFERENCE NO.
                                            </div>
                                            <div style="text-align: center;font-size: 13px;">{{ $viewdata['records']->reference_no_id }}</div>
                                        </td>

                                        {{-- processing details --}}
                                        <td class="text-left">
                                            <div style="font-weight: bold;text-align: center;margin-top: -5px;font-size: 15px;">
                                                Date:
                                            </div>
                                            <div style="text-align: center;font-size: 13px;">{{ $viewdata['work_date_start'] }}</div>
                                        </td>
                                        <td class="text-left">
                                            <div style="font-weight: bold;text-align: center;margin-top: -5px;font-size: 15px;">
                                                Time:
                                            </div>
                                            {{-- <b>TIME:</b> {{ $viewdata['CURRENT_TIME'] }} --}}
                                            <div style="text-align: center;font-size: 13px;">{{ $viewdata['CURRENT_TIME'] }}</div>
                                        </td>
                                        <td class="text-left">
                                            <div style="font-weight: bold;text-align: center;margin-top: -2px;font-size: 15px;">
                                                Encoder:
                                            </div>
                                            <div style="text-align: center;font-size: 13px;">{{ $viewdata['jo_encoder'] }}</div>
                                        </td>
                                        {{-- end processing details --}}

                                        {{-- engine reference no. --}}
                                        <td class="text-center">
                                            <div style="text-align: center; font-weight: bold;font-size: 15px;">Make/Model</div><br>
                                            <div style="text-align: center;font-size: 13px;">{{ $viewdata['makelist'] }}/{{ $viewdata['jo_model'] }}</div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <div style="text-align: center; font-weight: bold;font-size: 15px;">Serial No.</div><br>
                                                <div style="text-align: center;font-size: 13px;">{{ $viewdata['jo_serial'] }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="sit-in-the-corner" style="float:left;margin-left: 5px;margin-top: 1px;font-size: 15px;"><b><u>WORK ONLY ON JOB(s) STATED BELOW</u></b></div>
                                            <div style="font-size: 13px;text-align: left;">
                                                @if ($viewdata['records']->calib_work_group_id)
                                                    {{ $viewdata['records']->getGeneralProcedure->general_procedure_name }}
                                                @else
                                                    <div>{{ $viewdata['records']->general_procedure }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="center" style="width:85px;margin: auto;">
                                                        {!! DNS2D::getBarcodeHTML($viewdata['user_id'], 'QRCODE', 3,3) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div style="font-size: 15px;">
                                                <b>Remarks: </b><br>
                                                {{ $viewdata['records']->remarks ? $viewdata['records']->remarks : "None" }}
                                            </div>
                                        </td>
                                        <td style="font-size: 15px;">
                                            <b>HRS:</b> - <br>
                                            <b>QTY:</b> {{ $viewdata['records']->qty }}
                                        </td>
                                        <td colspan="2">
                                            <div style="font-weight: bold;text-align: left;margin-top: -1px;font-size: 15px;">
                                                <u>CREDITABLE INCENTIVE, ON-GOING QC</u>
                                            </div><br>

                                            <div style="text-align: center; font-weight: bold;font-size: 13px;">Operator</div>
                                            <br>
                                            <div style="font-size: 13px;">Sign</div>
                                            <div style="text-align: center;font-size: 13px;">$viewdata['operator']</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><hr style="width:50%; margin:auto;">
                        </div>
                        {{-- End Table --}}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
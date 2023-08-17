<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<style>
    .header{
        text-align: center;
        line-height: 20%;
        font-size: 11px;
    }
    .header-work-group{
        text-transform: uppercase;
    }

</style>
<body>
    @foreach ($viewdata['records'] as $key=>$record)
        @if($record->status !== 3)
            @foreach ($record->workers as $opt_key => $operator)
                <div class="header">
                    <h3 class="header-title">
                        WM Global Holdings Dumaguete
                    </h3>
                    @if ($record->mf_work_group_id)
                        <p>
                            <u>MACHINE FABRICATION WORK REPORT</b></u>
                        </p>
                        <p class="header-work-group">{{ $record->getMFWorkGroup->group_name }}</p>
                    @elseif($record->er_work_group_id)
                        <p><u><b>ENGINE RECONDITIONING WORK REPORT</b></u></p>
                        <p class="header-work-group">{{ $record->getERWorkGroup->group_name }}</p>
                    @elseif ($record->calib_work_group_id)
                        <p><u><b>CALIBRATION WORK REPORT</b></u></p>
                        <p class="header-work-group">{{ $record->getCalibWorkGroup->group_name }}</p>
                    @endif
                    <small>Printed on {{ $viewdata['current_date_printed'] }}</small>
                    <br><br>
                </div>
                <div class="body-table">
                    @if($viewdata['scannedID'])
                        <div class="table-reponsive">
                            <table border="1" style="border-collapse: collapse;" width="100%">
                                <?php
                                    $operator_id = strval($operator->assigned_worker_id);
                                    $result = strval($operator->work_order_id) . "-" . $operator_id;
                                ?>
                                <caption>
                                    <div class="center" style="width: 105px;margin: auto;">
                                        {!! DNS1D::getBarcodeHTML($result, 'CODABAR', 2,20) !!}
                                    </div>
                                </caption>
                                <thead style="font-size: 11px;">
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
                                            <div style="font-weight: bold;text-align: center;margin-top: -2px;font-size: 11px;">
                                                JO NO.
                                            </div>
                                            <div style="text-align: center;font-size: 11px;">{{ $record->getJobOrder->jo_no }}</div>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                $work_order_no = ++$opt_key;
                                            ?>
                                            @if($viewdata['type_of_print'] == "BWT")
                                                <div style="font-weight: bold;text-align: center;margin-top: -2px;font-size: 11px;">
                                                    Page(s)
                                                </div>
                                                <div style="text-align: center;font-size: 11px;">{{ $operator->page_no ?? "" }}</div>
                                            @else
                                                <div style="font-weight: bold;text-align: center;margin-top: -2px;font-size: 11px;">
                                                    REFERENCE NO.
                                                </div>
                                                <div style="text-align: center;font-size: 11px;">{{ $record->reference_no_id }}</div>
                                            @endif
                                        </td>
                                        {{-- processing details --}}
                                        <td class="text-left">
                                            <div style="font-weight: bold;text-align: center;margin-top: -2px;font-size: 11px;">
                                                Date:
                                            </div>
                                            <div style="text-align: center;font-size: 11px;">{{ $viewdata['work_date_start'] }}</div>
                                        </td>
                                        <td class="text-left">
                                            <div style="font-weight: bold;text-align: center;margin-top: -2px;font-size: 11px;">
                                                Time:
                                            </div>
                                            {{-- <b>TIME:</b> {{ $viewdata['CURRENT_TIME'] }} --}}
                                            <div style="text-align: center;font-size: 11px;">{{ $viewdata['CURRENT_TIME'] }}</div>
                                        </td>
                                        <td class="text-left">
                                            
                                            <div style="font-weight: bold;text-align: center;margin-top: -2px;font-size: 11px;">
                                                Encoder:
                                            </div>
                                            <div style="text-align: center;font-size: 11px;">
                                                {{ $viewdata['encoder'] }}
                                            </div>
                        
                                        </td>
                                        {{-- end processing details --}}
                                        {{-- engine reference no. --}}
                                        <td class="text-left">
                                            <div style="text-align: center; font-weight: bold;margin-top: -2px; font-size: 11px;">Make/Model</div>
                                            <div style="text-align: center;font-size: 11px;">{{ $viewdata['makelist'] }}/{{ $viewdata['jo_model'] }}</div>
                                        </td>
                                        <td class="text-left">
                                            <div style="text-align: center; font-weight: bold;margin-top: -2px; font-size: 11px;">Serial No.</div>
                                            <div style="text-align: center;font-size: 11px;">{{ $viewdata['jo_serial'] }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: left;">
                                            <span class="sit-in-the-corner" style="float:left;margin-left: 5px;margin-top: 1px;font-size: 10px;"><b><u>WORK ONLY ON JOB(s) STATED BELOW</u></b></span><br>
                                            <span class="text-left" style="font-size: 10px;float: left;">
                                                @if ($record->mf_work_group_id)
                                                    {{-- {{ $record->getGeneralProcedure->general_procedure_name }} --}}
                                                    {{ $record->scope_description }}
                                                @elseif($record->calib_work_group_id)
                                                    {{ $record->getScopeDescription->scope_description_name }}
                                                @else
                                                    {{ $record->general_procedure }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col">
                                                    <?php
                                                        $operator_id = strval($operator->assigned_worker_id);
                                                        $result = strval($operator->work_order_id) . "-" . $operator_id;
                                                    ?>
                                                    <div class="center" style="width:50px;margin: auto;">
                                                        {!! DNS2D::getBarcodeHTML($result, 'QRCODE', 2.3,2.3) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <hr> --}}
                                            {{-- <div style="font-size: 11px;">
                                                <b>Remarks: </b>
                                                {{ $record->remarks ? $record->remarks : "None" }}
                                            </div> --}}
                                        </td>
                                        <td style="font-size: 11px;">
                                            <b>HRS:</b> - &nbsp;
                                            <b>QTY:</b> {{ $record->qty }} <br>
                                            <div style="font-size: 11px;">
                                                <b>Remarks: </b>
                                                {{ $record->remarks ? $record->remarks : "None" }}
                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <div style="font-weight: bold;text-align: left;margin-top: -2px;font-size: 11px;">
                                                <u>CREDITABLE INCENTIVE, ON-GOING QC</u>
                                            </div>

                                            <div style="text-align: center; font-weight: bold;font-size: 11px;">Operator</div>
                                            <br>
                                            <div style="font-size: 10px;">Sign</div>
                                            <div style="text-align: center;font-size: 11px;">{{ $operator->getWorker->name }}</div>
                                        </td>
                                        {{-- $operator[$key]->operator_name --}}
                                    </tr>
                                </tbody>
                            </table>
                            <br><hr style="width:50%; margin:auto;">
                        </div>
                        <br><br>
                    @endif
                </div>
            @endforeach
        @endif
    @endforeach
</body>
</html>
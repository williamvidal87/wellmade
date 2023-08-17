<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        tr.border_bottom td {
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
    <div>
        <div class="row">
            <div class="col-xs-12" style="font-family: Arial;">
                <div style="opacity: 0.3; color: BLACK; position: fixed; top: 40%; left: 20%;transform: rotate(-50deg); font-size: 45px;">
                    @if ($records['type'] == 'original')
                        <h1 style="font-family: Arial;">ORIGINAL</h1>
                    @elseif ($records['type'] == 'duplicate')
                        <h1>DUPLICATE</h1>
                    @elseif ($records['type'] == 'triplicate')
                        <h1>TRIPLICATE</h1>
                    @endif
                </div>
                <div class="panel">
                    <div class="panel-head" style="text-align: center;line-height: 50%;font-size: 15px;">
                        <b><span style="font-size: 25px;">{{ $business_info->company_name ?? 'Dumaguete Wellmade Ventures Inc.' }}</span></b><br><br>
                            <small>{{ $business_info->address ?? 'Dumaguete Valencia National High way, Tabuc Tubig, Dumaguete City' }}</small><br><br>
                            <small>Tel #: {{ $business_info->contact_no ?? '(035) 522-0324' }}</small>
    
                        <h2 style="font-family: Arial;">
                            Job Order Acceptance & Warranty Certificate
                        </h2>
                    </div>

                    <small style="font-weight: bold; display: inline-block;">
                        <div style="display: inline-block;">
                            <span>Receive with thanks:</span>
                        </div>
                        @if ($records['type'] == 'triplicate')
                            <div style="display: inline-block;">
                                <span style="margin-left: 500px; display: inline-block;">
                                    <small style="font-weight: bold">{{ $records['wv'] ?? '' }}</small>
                                </span>
                            </div>
                        @endif
                    </small>

                    <div class="panel_body">
                        <div>
                            <div style="font-size: 11px; display: inline-block;">
                                <div style="display: inline-block; width: 350px; border-bottom: 1px solid #444; font-size: 13px; font-weight:bold;">
                                    {{ $records['data']->clientProfile->name ?? '' }}
                                </div>
                                &nbsp;&nbsp;
                                <div style="display: inline-block; width: 75px;">
                                    <span>Date Prepared:</span>
                                </div>
                                <div style="display: inline-block; width: 85px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ date("Y-m-d", strtotime($records['data']->getJobOrderTransaction->date )) ?? '' }}
                                </div>
                                <div style="display: inline-block; width: 40px;">
                                    <span>JO No.</span>
                                </div>
                                <div style="display: inline-block; width: 130px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->jo_no ?? '' }}
                                </div>
                            </div>

                            <div style="font-size: 11px; display: inline-block;">
                                <div style="display: inline-block; width: 78px;">
                                    <span>Transact info:</span>
                                </div>
                                <div style="display: inline-block; width: 270px; border-bottom: 1px solid #444;">
                                    {{ $records['data']->getContact->name ?? '' }}
                                </div>
                                &nbsp;&nbsp;
                                <div style="display: inline-block; width: 75px;">
                                    <span>Date Released:</span>
                                </div>
                                <div style="display: inline-block; width: 85px;border-bottom: 1px solid #444; text-align:center;">
                                    {{-- {{ date("Y-m-d", strtotime($records['data']->date)) ?? '' }} --}}
                                </div>
                                <div style="display: inline-block; width: 40px;">
                                    <span>CSA:</span>
                                </div>
                                <div style="display: inline-block; width: 130px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->clientProfile->forCSA->csa_type ?? '' }}
                                </div>
                            </div>

                            <div style="font-size: 11px; display: inline-block;">
                                <div style="display: inline-block; width: 88px;">
                                    <span>Approved PO No.</span>
                                </div>
                                <div style="display: inline-block; width: 100px; border-bottom: 1px solid #444;">
                                    {{ $records['data']->po_no ?? '' }}
                                </div>
                                <div style="display: inline-block; width: 90px;">
                                    <span>Approval PO Date.</span>
                                </div>
                                <div style="display: inline-block; width: 100px; border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->po_date->isoFormat('MMMM D, Y') ?? '' }}
                                </div>
                                &nbsp;&nbsp;
                                <div style="display: inline-block; width: 65px;">
                                    <span>Released by:</span>
                                </div>
                                <div style="display: inline-block; width: 75px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->po_no ?? '' }}
                                </div>
                                <div style="display: inline-block; width: 35px;">
                                    <span>Terms:</span>
                                </div>
                                <div style="display: inline-block; width: 120px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->typesofPayment->payment_type ?? '' }}
                                </div>
                            </div>

                            <div style="font-size: 11px; display: inline-block;">
                                <div style="display: inline-block; width: 78px;">
                                    <span>Delivery Point:</span>
                                </div>
                                <div style="display: inline-block; width: 270px; border-bottom: 1px solid #444;">
                                    {{ $records['data']->clientProfile->address ?? '' }}
                                </div>
                                &nbsp;&nbsp;
                                <div style="display: inline-block; width: 60px;">
                                    <span>Printed By:</span>
                                </div>
                                <div style="display: inline-block; width: 85px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ Auth::user()->username ?? '' }}
                                </div>
                                <div style="display: inline-block; width: 75px;">
                                    <span>Engine Model:</span>
                                </div>
                                <div style="display: inline-block; width: 110px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->engineModel->model ?? '' }}
                                </div>
                            </div>

                            <div style="font-size: 11px; display: inline-block;">
                                <div style="display: inline-block; width: 60px;">
                                    <span>Remarks:</span>
                                </div>
                                <div style="display: inline-block; width: 288px; border-bottom: 1px solid #444;">
                                    {{ $records['remarks']->getRemarks->type ?? '' }}
                                </div>
                                &nbsp;&nbsp;
                                <div style="display: inline-block; width: 30px;">
                                    <span>Serial:</span>
                                </div>
                                <div style="display: inline-block; width: 125px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->serial_no ?? '' }}
                                </div>
                                <div style="display: inline-block; width: 45px;">
                                    <span>Make:</span>
                                </div>
                                <div style="display: inline-block; width: 130px;border-bottom: 1px solid #444; text-align:center;">
                                    {{ $records['data']->getMakeList->make_name ?? '' }}
                                </div>
                            </div>
                        </div>
                        <table cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="text-align:left; font-size:15px; background-color:rgb(197, 236, 241); border-top:1px solid black;" colspan="6">Scope of works & Summary of Charges</th>
                                </tr>
                                <tr style="font-size: 15px;">
                                    <th style="text-align:left;">Description</th>
                                    <th style="text-align:right;">SRP</th>
                                    <th style="text-align:right;">% / <span style="font-family: DejaVu Sans; sans-serif;font-weight:normal;">&#8369;</span></th>
                                    <th style="text-align:right;">Unit Price</th>
                                    <th style="text-align:right;">Qty</th>
                                    <th style="text-align:right;">Net Amount</th>
                                </tr>
                                {{-- <tr>
                                    <th style="text-align:left;font-size: 13px;">-- ENGINE REBUILDING --</th>
                                </tr> --}}
                            </thead>
                            <tbody>
                                @php
                                    $mf_counter = 0;
                                    $er_counter = 0;
                                    $calib_counter = 0;
                                @endphp
                                @foreach($records['related_work_order'] as $key => $data_records)
                                    @if ($key == "MF")
                                        <tr>
                                            <td style="text-align:left;font-size: 13px;" colspan="6">-- MACHINING FABRICATION --</td>
                                        </tr>
                                    @elseif ($key == "ER")
                                        <tr>
                                            <td style="text-align:left;font-size: 13px;" colspan="6">-- ENGINE REBUILDING --</td>
                                        </tr>
                                    @elseif ($key == "Calib")
                                        <tr>
                                            <td style="text-align:left;font-size: 13px;" colspan="6">-- CALIBRATION --</td>
                                        </tr>
                                    @endif
                                    @foreach ($data_records as $data_record)
                                        <tr style="font-size: 12px;" class="border_bottom">
                                            {{-- {{ Log::debug( "ER: ". $data_record->er_work_group_id. " => MF". $data_record->mf_work_group_id) }} --}}
                                            @if($data_record->mf_work_group_id)
                                                <td><small>{{ $data_record->scope_description ?? '' }}</small></td>
                                            @elseif ($data_record->er_work_group_id)
                                                @if (preg_match("/Others/i", $data_record->getERScope->scope_name))
                                                    <td><small>{{ $data_record->scope_description ?? '' }}</small></td>    
                                                @else
                                                <td><small>{{ $data_record->general_procedure ?? '' }}</small></td>
                                                @endif
                                            @else
                                                <td><small>{{ $data_record->getGeneralProcedure->general_procedure_name ?? '' }}</small></td>
                                            @endif
                                            <td style="text-align:right;"> {{ number_format(($data_record->price + $data_record->amount_increase), 2) }} </td>
                                            <td style="text-align:right;">
                                                <small>{{ $data_record->max_discount }}</small>
                                                @if ($data_record->discount_id == 1)
                                                {{ $data_record->getDiscount->discount }}
                                                @else
                                                <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                @endif
                                            </td>
                                            <td style="text-align:right;">
                                                @php
                                                    $unit_price_total = 0;
                                                    if($data_record->max_discount == 0){
                                                        $data_record->max_discount == 1;
                                                        $output = ($data_record->price+$data_record->amount_increase);
                                                    }else{
                                                        // $output = (($data_record->price + $data_record->amount_increase)) / $data_record->max_discount;
                                                        $output= ($data_record->price+$data_record->amount_increase) - (($data_record->price+$data_record->amount_increase) * ($data_record->max_discount/100));
                                                    }
        
                                                    $unit_price_total = $output;
                                                @endphp
                                                <small>{{ number_format($unit_price_total, 2) }}</small>
                                            </td>
                                            <td style="text-align:right;"><small>{{ $data_record->qty ?? '' }}</small></td>
                                            <td style="text-align:right;"><small>{{ number_format( $unit_price_total * $data_record->qty, 2) }}</small></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @if (!empty($records['request_part']))
                            <table cellspacing="0" width="100%">
                                <thead>
                                    <tr style="font-size: 13px;">
                                        <th style="text-align:left;">PARTS:</th>
                                        <th style="text-align:center;"></th>
                                        <th style="text-align:center;"></th>
                                        <th style="text-align:center;"></th>
                                        <th style="text-align:center;"></th>
                                        <th style="text-align:right;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($records['request_part']->getRequestTool->requestToolsData as $value)
                                        <tr style="font-size: 12px;" class="border_bottom">
                                            <td style="width: 260px;"><small>{{ $value->getStockManagment->name ?? '' }}</small></td>
                                            <td style="text-align:right; width: 70px;">{{ number_format($value->selling_price, 2) ?? '' }}</td>
                                            <td style="text-align:right; width: 70px;">{{ 0 }}</td>
                                            <td style="text-align:right; width: 100px;">{{ number_format($value->selling_price, 2) ?? '' }}</td>
                                            <td style="text-align:right; width: 67px;"><small>{{ $value->qty ?? '' }}</small></td>
                                            <td style="text-align:right;"><small>{{ number_format($value->qty * $value->selling_price, 2) }}</small></td>
                                        </tr>
                                    @endforeach --}}
                                    @foreach ($records['request_part'] as $request)
                                        @foreach ($request->requestToolsData as $tools)
                                            @foreach ($tools->getStockManagment as $data)
                                                @if ($loop->first)
                                                    <tr style="font-size: 12px;" class="border_bottom">
                                                        <td style="width: 260px;"><small>{{ $tools->getStockManagment->name ?? '' }}</small></td>
                                                        <td style="text-align:right; width: 70px;">{{ number_format($tools->selling_price, 2) ?? '' }}</td>
                                                        <td style="text-align:right; width: 70px;">{{ 0 }}</td>
                                                        <td style="text-align:right; width: 100px;">{{ number_format($tools->selling_price, 2) ?? '' }}</td>
                                                        <td style="text-align:right; width: 67px;"><small>{{ $tools->qty ?? '' }}</small></td>
                                                        <td style="text-align:right;"><small>{{ number_format($tools->qty * $tools->selling_price, 2) }}</small></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if ($records['type'] == 'triplicate')
                            <table cellspacing="0" width="100%">
                                <thead>
                                    <tr style="font-size: 13px;">
                                        <th style="text-align:left;">CANCELLED ITEM(S):</th>
                                        <th style="text-align:center;">by:</th>
                                        <th style="text-align:center;">Reason:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($records['cancelled_work_order'] as $data_record)
                                        <tr style="font-size: 12px;" class="border_bottom">
                                            @if($data_record->mf_work_sub_type_id)
                                                <td><small>{{ $data_record->scope_description ?? '' }}</small></td>
                                            @elseif ($data_record->scopes_id)
                                                @if (preg_match("/Others/i", $data_record->getERScope->scope_name))
                                                    <td><small>{{ $data_record->scope_description ?? '' }}</small></td>    
                                                @else
                                                <td><small>{{ $data_record->getERScope->scope_name ?? '' }}</small></td>
                                                @endif
                                            @else
                                                <td><small>{{ $data_record->getScopeDescription->scope_description_name ?? '' }}</small></td>
                                            @endif
                                            <td style="text-align:center;"><small>{{ $data_record->getUserCancel->name ?? '' }}</small></td>
                                            <td style="text-align:center;"><small>{{ $data_record->getCancelReason->reason ?? '' }}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- <hr> --}}
                            </table>
                        @endif
    
                        <p style="text-align:right;font-size: 15px;"><b>TOTAL AMOUNT DUE: <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span></b>
                            &nbsp;<u>{{ number_format($records['total_amount'], 2) }}</u>
                        </p>
                        <div style="border: 1px solid black; text-align:justify; padding: 5px;">
                            <p style="text-align: center;font-size: 13px; margin-top: 0; padding-top: 0;">
                                <u><b>Terms and Condition on<br>
                                JOB ORDER & LIMITED LIABILITY AGREEMENT</b></u>
                            </p>
                            <p style="text-align: justify;font-size: 13px;">
                                This Agreement is made and executed between DUMAGUETE WELMADE VENTURE INC.
                                and it's subsidiary companies and the CUSTOMER representative herein by his/her
                                Authorized Signatory, the following:
                            </p>
                            <p style="font-size: 13px;">
                                1. That the CUSTOMER acknowledges the competence and acceptance of DUMAGUETE WELLMADE
                                VENTURE INC. in undertaking the Job Order per scope of work indicated through the supervision
                                and approval by the CUSTOMER'S/OWNER'S representative (CR/OR);<br>
                                2. That the CUSTOMER agrees on the provisions at the back of the Job Order Estimate &
                                liabilities hereof.<br>
                                3. That the liability of DUMAGUETE WELLMADE VENTURES INC. whenever applicable and upon
                                formal complaint in writing is hereby expressly limited to the extent not exceeding the
                                amount qouted as stipulated and agrred in the Job Order/Service Order.<br>
                                4. That any claims for  warranty on machining and fabrication of metal
                                component parts must be made in writing within 30 days form acknowledgement of item.
                                prior to assembly or commisioning.<br>
                                5. That in order for the customer to avoid STORAGE of <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>200.00 per day (including holidays),
                                all finished or pending items/vehicles must be paid and withdrawn on or before 30 days from 
                                date of received hereof.
                            </p>
                            <p style="text-align: center;line-height: 65%;font-size: 13px;">
                                <span style="color:red;font-size: 13px;">USED SPARE PARTS/ITEMS</span><br><br>
                                CONFIRMED AND ACCEPTED BY
                            </p>
                            <p style="text-align: center;line-height: 65%;">
                                ____________________________<br><br>
                                <span style="font-size: 11px;">
                                    Print Name & Signature of Customer or<br>
                                    His/Her Authorized Representative (CR/OR)
                                </span><br>
                                <span style="font-size: 11px;">
                                    Date Signed & Acceptance of Delivery____________________
                                </span>
                            </p>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

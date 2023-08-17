<style>
    h4,#date{text-align:center}
    table, th, td {
        border: 0.5px solid black;    
        border-collapse: collapse;
        font-size: 12px;
    }
    thead{
        display: table-row-group;
    }
</style>
<div class="panel-heading text-center" style="padding-top: 15px">
    <h4 style="margin-top: 20px; margin-bottom: 5px">Daily Maintenance Report</h4>
    <h4 style="margin-top: 5px; margin-bottom: 5px">SUMMARY OF RELEASES FOR THE DAY</h4>
    <div id="date" style="margin-top: 5px; margin-bottom: 5px">Date of Report: {{ $end_d != null ? '('. date('Y-m-d', strtotime($end_d)) . ')' : ''}}</div>    
</div>
<table class="table table-striped table-bordered" style="font-size: 10px" cellspacing="0" width="100%">
    <thead>
        <tr class="bg-trans-dark">
            <th style="text-align:center" rowspan="2">Time:</th>
            <th style="text-align:center" rowspan="2">Description:</th>
            <th style="text-align:center" rowspan="2">Qty:</th>
            <th style="text-align:center" rowspan="2">Price:</th>
            <th style="text-align:center" colspan="5">Northern Repairs Maintenance</th>
            <th style="text-align:center" rowspan="2">by:</th>
            <th style="text-align:center" rowspan="2">Ref JO/RO:</th>
        </tr>
        <tr class="bg-trans-dark">
            <th style="text-align:center">Trans.</th>
            <th style="text-align:center">Mach/Equip</th>
            <th style="text-align:center">Off.Equip</th>
            <th style="text-align:center">Measure Inst. & Tool</th>
            <th style="text-align:center">Office/Blgs</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_measuring_equip = 0;
            $total_transportation = 0;
            $total_machine_equip = 0;
            $total_office_equip = 0;
            $total_office_building = 0;

            //total
            $total_selling_price = 0;
            $totalMachineEquip = 0;
            $totalMeasurinEquip = 0;
            $totalTransportation = 0;
            $totalOfficeEquip = 0;
            $totalOfficeBuilding = 0;
        @endphp
        @foreach($maintenance as $data)
        {{-- @dd($data) --}}
        <tr>
            <td style="text-align:center">{{$data->created_at->format('Y-m-d, h:i a')}}</td>
            <td style="text-align:center">{{$data->getStockManagment->name .' '.'-'.' '. '['.$data->getStockManagment->description.']'}}</td>
            <td style="text-align:center">{{$data->qty}}</td>
            <td style="text-align:center">{{$data->selling_price}}</td>
            @php                                              
                if(str_contains($data->getRequestTool->request_type,'4')) {
                    $measuring_equip = $data->qty*$data->selling_price;
                    $total_measuring_equip += $measuring_equip;
                }elseif(str_contains($data->getRequestTool->request_type,'6')) {
                    $transportation = $data->qty*$data->selling_price;
                    $total_transportation += $transportation;
                }elseif(str_contains($data->getRequestTool->request_type,'7')) {
                    $machine_equip = $data->qty*$data->selling_price;
                    $total_machine_equip += $machine_equip;
                }elseif(str_contains($data->getRequestTool->request_type,'8')) {
                    $office_equip = $data->qty*$data->selling_price;
                    $total_office_equip += $office_equip;
                }elseif(str_contains($data->getRequestTool->request_type,'9')) {
                    $office_building = $data->qty*$data->selling_price;
                    $total_office_building += $office_building;
                };
            @endphp
            <td style="text-align:center">{{number_format($total_transportation,2)}}</td>
            <td style="text-align:center">{{number_format($total_machine_equip,2)}}</td>
            <td style="text-align:center">{{number_format($total_office_equip,2)}}</td>
            <td style="text-align:center">{{number_format($total_measuring_equip,2)}}</td>
            <td style="text-align:center">{{number_format( $total_office_building,2)}}</td>
            <td style="text-align:center">{{$data->getRequestTool->getRequestBy->name ?? ''}}</td>
            <td style="text-align:center">{{$data->getRequestTool->getJobOrder->jo_no ?? ''}}</td>
        </tr>
        @php
           //total
            $total_selling_price += $data->selling_price;
            $totalMachineEquip +=  $total_machine_equip;
            $totalMeasurinEquip += $total_measuring_equip;
            $totalTransportation += $total_transportation;
            $totalOfficeEquip += $total_office_equip;
            $totalOfficeBuilding += $total_office_building;
        @endphp
        @endforeach
        <tr>
            
            <td style="text-align:right" colspan="2">
                <span style="font-weight: bold">TOTAL:</span>
            </td>
            <td style="text-align:right" colspan="2">{{number_format($total_selling_price,2)}}</td>
            <td style="text-align:center">{{number_format($totalTransportation,2)}}</td>
            <td style="text-align:center">{{number_format($totalMachineEquip,2)}}</td>
            <td style="text-align:center">{{number_format($totalOfficeEquip,2)}}</td>
            <td style="text-align:center">{{number_format($totalMeasurinEquip,2)}}</td>
            <td style="text-align:center">{{number_format($totalOfficeBuilding,2)}}</td>
            <td colspan="2"></td>          
        </tr>
        <tr>
            <td style="text-align:center; border-bottom: hidden" colspan="4">Certified True & Correct</td>
            <td style="text-align:center; border-bottom: hidden" colspan="4">Tech. Sprd't</td>
            <td style="text-align:center; border-bottom: hidden" colspan="3">Reviewed by:</td>
        </tr>
        <tr>
            <td style="text-align:center" colspan="4">Warehouse</td>
            <td style="text-align:center" colspan="4">Maintenance</td>
            <td style="text-align:center">S&P Coordinator</td>
            <td style="text-align:center">Plant Admin</td>
            <td style="text-align:center">ICDP</td>
        </tr>
    </tbody>
</table>      
<style>
    table, th, td {
      border: 0.5px solid black;    
      border-collapse: collapse;
      font-size: 8px;
    }
</style>
<div>
    <div style="text-align:center;">
        <h5 style="padding-top:10px; padding-bottom:0; margin-bottom:3px">Wellmade Dumaguete Plant</h5>   
        <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px">Engineering Sales Division</h4>
        <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px"  class="text-bold">Month-to-Month Industry & Customer Performance Report</h4>     
        <p style="padding-top:0; padding-bottom:0; margin-top:0px; margin-bottom:3px; font-size: 12px"  class="text-bold">Report as of {{ date('Y-m-d', strtotime($todayDate)) }}</p>                   
    </div>
    <div class="panel-body">
        <h6 style="text-align:center;">{{ $date_one }}</h6>
        <div class="table-responsive">
            <table width="100%" style="border: 1px solid black; font-size: 8px">
                <thead>
                    <tr class="bg-trans-dark">
                        <th colspan="16" style="border: 1px solid black; text-align: right;">NEW CUSTOMER</th>
                    </tr>
                    <tr class="bg-trans-dark">
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">C.S.R.</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Freelance Mechanic</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Repair Shop/Service Center</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Transaport (Taxi/Bus/Jeepney)</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Trucking Hauling (Heavy Equipments)</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Industrial / Manufacturing / Mining</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Power Plants</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Marine / Shipping</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">MEPZ Companies</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Logistics</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Constructions</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Miscellaneous</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Total:</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" colspan="2">New Customer</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Percentage(%)</th>
                    </tr>
                    <tr class="bg-trans-dark">
                        <th style="border: 1px solid black; width: 3%; text-align: center;">ER</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;">MF</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalFreelanceMechanic = 0;
                        $totalRepairShopServiceCenter = 0;
                        $totalTransport = 0;
                        $totalTrucking = 0;
                        $totalIndustrial = 0;
                        $totalPower = 0;
                        $totalMarine = 0;
                        $totalMEPZ = 0;
                        $totalLogistics = 0;
                        $totalConstructions = 0;
                        $totalMisc = 0;
                        $totalTOTAL = 0;
                        $totalER = 0;
                        $totalMF = 0;
                    @endphp
                    @forelse ($option_one as $key => $customers)
                        @php
                            $initFreelanceMechanic = 0;
                            $initRepairShopServiceCenter = 0;
                            $initTransport = 0;
                            $initTrucking = 0;
                            $initIndustrial = 0;
                            $initPower = 0;
                            $initMarine = 0;
                            $initMEPZ = 0;
                            $initLogistics = 0;
                            $initConstructions = 0;
                            $initMisc = 0;
                            $initTOTAL = 0;
                            $initER = 0;
                            $initMF = 0;
                        @endphp
                        
                        @foreach ($customers as $customer)
                            {{-- @dd($customer->jobOrder->WorkOrders->er_work_sub_type_id) --}}
                            @php
                                switch ($customer->jobOrder->clientProfile->clientTypes->id) {
                                    case 1:
                                        $initFreelanceMechanic += $customer->all_total_debits;
                                        break;
                                    case 2:
                                        $initRepairShopServiceCenter += $customer->all_total_debits;
                                        break;
                                    case 3:
                                        $initTransport += $customer->all_total_debits;
                                        break;
                                    case 4:
                                        $initTrucking += $customer->all_total_debits;
                                        break;
                                    case 5:
                                        $initIndustrial += $customer->all_total_debits;
                                        break;
                                    case 6:
                                        $initPower += $customer->all_total_debits;
                                        break;
                                    case 7:
                                        $initMarine += $customer->all_total_debits;
                                        break;
                                    case 8:
                                        $initMEPZ += $customer->all_total_debits;
                                        break;
                                    case 9:
                                        $initLogistics += $customer->all_total_debits;
                                        break;
                                    case 10:
                                        $initConstructions += $customer->all_total_debits;
                                        break;
                                    case 11:
                                        $initMisc += $customer->all_total_debits;
                                        break;
                                    default:
                                        # code...
                                        break;
                                }

                                $jo_nums = [];
                                foreach ($customer->jobOrder->WorkOrders as $index => $workOrder) {
                                    // dd($workOrder->er_work_group_id != null, $customer->all_total_debits);
                                    if($workOrder->er_work_group_id != null && !in_array($workOrder->jo_no_id, $jo_nums)){
                                        $jo_nums[] = $workOrder->jo_no_id;
                                        $initER += $customer->all_total_debits;
                                    }elseif($workOrder->mf_work_group_id != null && !in_array($workOrder->jo_no_id, $jo_nums)){
                                        $jo_nums[] = $workOrder->jo_no_id;
                                        $initMF += $customer->all_total_debits;
                                    }
                                }
                            @endphp
                        @endforeach
                        @php
                            $totalER += $initER;
                            $totalMF += $initMF;
                            $totalFreelanceMechanic += $initFreelanceMechanic;
                            $totalRepairShopServiceCenter += $initRepairShopServiceCenter;
                            $totalTransport += $initTransport;
                            $totalTrucking += $initTrucking;
                            $totalIndustrial += $initIndustrial;
                            $totalPower += $initPower;
                            $totalMarine += $initMarine;
                            $totalMEPZ += $initMEPZ;
                            $totalLogistics += $initLogistics;
                            $totalConstructions += $initConstructions;
                            $totalMisc += $initMisc;
                            $totalTOTAL += $initFreelanceMechanic+$initRepairShopServiceCenter+$initTransport+$initTrucking+$initIndustrial+$initPower+$initMarine+$initMEPZ+$initLogistics+$initConstructions+$initMisc;
                            $initTOTAL = $initFreelanceMechanic+$initRepairShopServiceCenter+$initTransport+$initTrucking+$initIndustrial+$initPower+$initMarine+$initMEPZ+$initLogistics+$initConstructions+$initMisc;
                        @endphp
                        <tr>
                            <td style="border: 1px solid black; width: 3%; text-align: center;">{{ $key ?? '' }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initFreelanceMechanic, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initRepairShopServiceCenter, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initTransport, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initTrucking, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initIndustrial, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initPower, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMarine, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMEPZ, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initLogistics, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initConstructions, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMisc, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initTOTAL, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initER, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMF, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">
                                @if ($initER == 0 && $iniMF == 0 && $initTOTAL == 0)
                                    {{ round(0 * 100) . '%' }}
                                @else
                                    {{ round((($initER + $initMF) / $initTOTAL) * 100 ) . '%' }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        @foreach ($allCsa as $csa)
                            <tr>
                                <td style="border: 1px solid black; width: 3%; text-align: center;">{{ $csa->csa_type ?? '' }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ round(0 * 100) . '%' }}</td>
                            </tr>            
                        @endforeach
                    @endforelse
                    {{-- @dd($jo_nums) --}}
                    {{-- @dd($initFreelanceMechanic, $initRepairShopServiceCenter, $initTransport, $initTrucking, $initIndustrial, $initPower, $initMarine, $initMEPZ, $initLogistics, $initConstructions, $initMisc, $totalMisc) --}}
                    <tr>
                        <td style="border: 1px solid black; width: 3%; text-align: center;">Grand Total</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalFreelanceMechanic, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalRepairShopServiceCenter, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalTransport, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalTrucking, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalIndustrial, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalPower, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMarine, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMEPZ, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalLogistics, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalConstructions, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMisc, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalTOTAL, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalER, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMF, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">
                            @if ($totalER == 0 && $totalMF == 0 && $totalTOTAL == 0)
                                {{ round(0 * 100) . '%' }}
                            @else
                                {{ round((($totalER + $totalMF) / (int) $totalTOTAL) * 100 ) . '%' }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> 
        
        <h6 style="text-align:center;">{{ ($date_two) }}</h6>
        <div class="table-responsive">
            <table width="100%" style="border: 1px solid black; font-size: 8px">
                <thead>
                    <tr class="bg-trans-dark">
                        <th colspan="16" style="border: 1px solid black; text-align: right;">NEW CUSTOMER</th>
                    </tr>
                    <tr class="bg-trans-dark">
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">C.S.R.</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Freelance Mechanic</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Repair Shop/Service Center</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Transaport (Taxi/Bus/Jeepney)</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Trucking Hauling (Heavy Equipments)</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Industrial / Manufacturing / Mining</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Power Plants</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Marine / Shipping</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">MEPZ Companies</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Logistics</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Constructions</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Miscellaneous</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Total:</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" colspan="2">New Customer</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;" rowspan="2">Percentage(%)</th>
                    </tr>
                    <tr class="bg-trans-dark">
                        <th style="border: 1px solid black; width: 3%; text-align: center;">ER</th>
                        <th style="border: 1px solid black; width: 3%; text-align: center;">MF</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalFreelanceMechanic = 0;
                        $totalRepairShopServiceCenter = 0;
                        $totalTransport = 0;
                        $totalTrucking = 0;
                        $totalIndustrial = 0;
                        $totalPower = 0;
                        $totalMarine = 0;
                        $totalMEPZ = 0;
                        $totalLogistics = 0;
                        $totalConstructions = 0;
                        $totalMisc = 0;
                        $totalTOTAL = 0;
                        $totalER = 0;
                        $totalMF = 0;
                    @endphp
                    @forelse ($option_two as $key => $customers)
                        @php
                            $initFreelanceMechanic = 0;
                            $initRepairShopServiceCenter = 0;
                            $initTransport = 0;
                            $initTrucking = 0;
                            $initIndustrial = 0;
                            $initPower = 0;
                            $initMarine = 0;
                            $initMEPZ = 0;
                            $initLogistics = 0;
                            $initConstructions = 0;
                            $initMisc = 0;
                            $initTOTAL = 0;
                            $initER = 0;
                            $initMF = 0;
                        @endphp
                        
                        @foreach ($customers as $customer)
                            {{-- @dd($customer->jobOrder->WorkOrders->er_work_sub_type_id) --}}
                            @php
                                switch ($customer->jobOrder->clientProfile->clientTypes->id) {
                                    case 1:
                                        $initFreelanceMechanic += $customer->all_total_debits;
                                        break;
                                    case 2:
                                        $initRepairShopServiceCenter += $customer->all_total_debits;
                                        break;
                                    case 3:
                                        $initTransport += $customer->all_total_debits;
                                        break;
                                    case 4:
                                        $initTrucking += $customer->all_total_debits;
                                        break;
                                    case 5:
                                        $initIndustrial += $customer->all_total_debits;
                                        break;
                                    case 6:
                                        $initPower += $customer->all_total_debits;
                                        break;
                                    case 7:
                                        $initMarine += $customer->all_total_debits;
                                        break;
                                    case 8:
                                        $initMEPZ += $customer->all_total_debits;
                                        break;
                                    case 9:
                                        $initLogistics += $customer->all_total_debits;
                                        break;
                                    case 10:
                                        $initConstructions += $customer->all_total_debits;
                                        break;
                                    case 11:
                                        $initMisc += $customer->all_total_debits;
                                        break;
                                    default:
                                        # code...
                                        break;
                                }

                                $jo_nums = [];
                                foreach ($customer->jobOrder->WorkOrders as $index => $workOrder) {
                                    // dd($workOrder->er_work_group_id != null, $customer->all_total_debits);
                                    if($workOrder->er_work_group_id != null && !in_array($workOrder->jo_no_id, $jo_nums)){
                                        $jo_nums[] = $workOrder->jo_no_id;
                                        $initER += $customer->all_total_debits;
                                    }elseif($workOrder->mf_work_group_id != null && !in_array($workOrder->jo_no_id, $jo_nums)){
                                        $jo_nums[] = $workOrder->jo_no_id;
                                        $initMF += $customer->all_total_debits;
                                    }
                                }
                            @endphp
                        @endforeach
                        @php
                            $totalER += $initER;
                            $totalMF += $initMF;
                            $totalFreelanceMechanic += $initFreelanceMechanic;
                            $totalRepairShopServiceCenter += $initRepairShopServiceCenter;
                            $totalTransport += $initTransport;
                            $totalTrucking += $initTrucking;
                            $totalIndustrial += $initIndustrial;
                            $totalPower += $initPower;
                            $totalMarine += $initMarine;
                            $totalMEPZ += $initMEPZ;
                            $totalLogistics += $initLogistics;
                            $totalConstructions += $initConstructions;
                            $totalMisc += $initMisc;
                            $totalTOTAL += $initFreelanceMechanic+$initRepairShopServiceCenter+$initTransport+$initTrucking+$initIndustrial+$initPower+$initMarine+$initMEPZ+$initLogistics+$initConstructions+$initMisc;
                            $initTOTAL = $initFreelanceMechanic+$initRepairShopServiceCenter+$initTransport+$initTrucking+$initIndustrial+$initPower+$initMarine+$initMEPZ+$initLogistics+$initConstructions+$initMisc;
                        @endphp
                        <tr>
                            <td style="border: 1px solid black; width: 3%; text-align: center;">{{ $key ?? '' }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initFreelanceMechanic, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initRepairShopServiceCenter, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initTransport, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initTrucking, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initIndustrial, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initPower, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMarine, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMEPZ, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initLogistics, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initConstructions, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMisc, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initTOTAL, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initER, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($initMF, 2) }}</td>
                            <td style="border: 1px solid black; width: 3%; text-align: right;">
                                @if ($initER == 0 && $iniMF == 0 && $initTOTAL == 0)
                                    {{ round(0 * 100) . '%' }}
                                @else
                                    {{ round((($initER + $initMF) / $initTOTAL) * 100 ) . '%' }}
                                @endif
                            </td>
                        </tr>
                    @empty
                    @foreach ($allCsa as $csa)
                            <tr>
                                <td style="border: 1px solid black; width: 3%; text-align: center;">{{ $csa->csa_type ?? '' }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format(0, 2) }}</td>
                                <td style="border: 1px solid black; width: 3%; text-align: right;">{{ round(0 * 100) . '%' }}</td>
                            </tr>            
                        @endforeach
                    @endforelse
                    {{-- @dd($jo_nums) --}}
                    {{-- @dd($initFreelanceMechanic, $initRepairShopServiceCenter, $initTransport, $initTrucking, $initIndustrial, $initPower, $initMarine, $initMEPZ, $initLogistics, $initConstructions, $initMisc, $totalMisc) --}}
                    <tr>
                        <td style="border: 1px solid black; width: 3%; text-align: center;">Grand Total</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalFreelanceMechanic, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalRepairShopServiceCenter, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalTransport, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalTrucking, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalIndustrial, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalPower, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMarine, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMEPZ, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalLogistics, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalConstructions, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMisc, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalTOTAL, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalER, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">{{ number_format($totalMF, 2) }}</td>
                        <td style="border: 1px solid black; width: 3%; text-align: right;">
                            @if ($totalER == 0 && $totalMF == 0 && $totalTOTAL == 0)
                                {{ round(0 * 100) . '%' }}
                            @else
                                {{ round((($totalER + $totalMF) / (int) $totalTOTAL) * 100 ) . '%' }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </div>
    <!--===================================================-->
    <!--End Data Table-->
</div>
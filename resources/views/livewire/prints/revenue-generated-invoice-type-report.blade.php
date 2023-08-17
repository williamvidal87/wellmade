<style>
    table, th, td {
      border: 0.5px solid black;    
      border-collapse: collapse;
      font-size: 10px;
    }
</style>
<div>
    <div>
        <h5 style="padding-top:10px; padding-bottom:0; margin-bottom:3px; text-align:center; padding-top~">Dumaguete Wellmade Ventures Inc. - Dumaguete Plant</h5>   
        <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px; text-align:center">Revenue Generated by Invoice Type</h4>
        <p style="padding-top:0; padding-bottom:0; margin-top:0px; margin-bottom:3px; text-align:center; font-size: 12px"  class="text-bold">{{ $start_date }} - {{ $end_date }}</p>                 
    </div>   
    <br><br>
    <div class="panel-body">
        <div class="table-responsive">     
        <table class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size:10px; align-text: center;">                                       
                                        <thead class="bg-trans-dark">
                                            <tr>
                                                <th colspan="2"  style="line-height: 0.9; width: 3%;">#</th>
                                                <th colspan="2"  style="line-height:   1; width: 3%; text-align: center;">Inv. No.</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 3%; text-align: center;">Inv Date</th>
                                                <th colspan="2"  style="line-height:   1; width: 2%">JOEAF No.</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 2%;" class="text-center">JOEAF Date</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 2%;" class="text-center">Customer</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 2%;">STSR</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 4%;">Labor</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 4%;">Parts</th>                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $all_labor_total = 0;
                                                $all_part_total = 0;
                                            @endphp
                                            @foreach ($revenue_generated_invoices as $key => $revenue)
                                                <tr>
                                                    <th colspan="2"  style="line-height: 0.9; width: 3%;">{{ ++$key }}</th>
                                                    <th colspan="2"  style="line-height:   1; width: 3%; text-align: center;">
                                                        @if ($revenue->invoice_type_id == 2)
                                                            {{ $revenue->wv_invoice_no ?? '' }}
                                                        @elseif ($revenue->invoice_type_id == 1)
                                                            {{ $revenue->sb_invoice_no ?? '' }}
                                                        @endif
                                                    </th>
                                                    <th colspan="2"  style="line-height: 0.9; width: 3%; text-align: center;">
                                                        {{ date('Y-m-d', strtotime($revenue->date)) }}
                                                    </th>
                                                    <th colspan="2"  style="line-height:   1; width: 2%">{{ $revenue->jobOrder->jo_no ?? '' }}</th>
                                                    <th colspan="2"  style="line-height: 0.9; width: 2%;" class="text-center">{{ date('Y-m-d', strtotime($revenue->jobOrder->date)) }}</th>
                                                    <th colspan="2"  style="line-height: 0.9; width: 2%;" class="text-center">{{ $revenue->jobOrder->clientProfile->name ?? '' }}</th>
                                                    <th colspan="2"  style="line-height: 0.9; width: 2%;">STSR</th>
                                                    @php
                                                        $labor = 0;
                                                        foreach($revenue->jobOrder->WorkOrders as $work_order) {    
                                                            if($work_order->cancel_reason_id == null) {
                                                                $labor += ($work_order->price + $work_order->amount_increase) * $work_order->qty;
                                                                // (($data->price+$data->amount_increase) * $data->qty)
                                                            }
                                                        }  
                                                    @endphp
                                                    <th colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;">{{ number_format($labor, 2) }}</th>
                                                    <th colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;">{{ number_format($revenue->jobOrder->part_total, 2) }}</th>
                                                    @php
                                                        $all_labor_total += $labor;
                                                        $all_part_total += $revenue->jobOrder->part_total;
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th style="line-height: 0.9; width: 2%; text-align: center;" colspan="14">TOTAL</th>
                                                <th style="line-height: 0.9; width: 4%; text-align: right;" colspan="2">{{ number_format($all_labor_total, 2) }}</th>
                                                <th style="line-height: 0.9; width: 4%; text-align: right;" colspan="2">{{ number_format($all_part_total, 2) }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
        </div>    
    </div>
    <!--===================================================-->
    <!--End Data Table-->
</div>
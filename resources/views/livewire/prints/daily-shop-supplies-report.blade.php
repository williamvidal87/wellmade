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
<div class="panel">
    <div class="panel-heading text-center" style="padding-top: 15px">
        <h4 style="margin-top: 20px; margin-bottom: 5px">Daily Consumption Report V2</h4>
        <h4 style="margin-top: 5px; margin-bottom: 5px">SUMMARY OF SHOP SUPPLIES FOR THE DAY</h4>
        <div id="date" style="margin-top: 5px; margin-bottom: 5px">Date of Report: {{ $end_d != null ? '('. date('Y-m-d', strtotime($end_d)) . ')' : now()->format('Y-m-d')}}</div>    
    </div>
                           
    <!--Data Table-->                           
    <!--===================================================-->
    <div class="panel-body">
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr class="bg-trans-dark">
                        <th style="text-align: center">Description</th>
                        <th style="text-align: center">Dept</th>
                        <th style="text-align: center">Balance</th>
                        <th style="text-align: center">Price</th>
                        <th style="text-align: center">Amount</th>
                    </tr>
                </thead>
                <tbody>

                   
                    @forelse($request_tool_data as $key => $data)
                    <tr>
                        <td colspan="5" style="font-weight: bold">JO# {{$key}}</td>
                    </tr>
                        @php($total_amount=0)
                        @foreach($data as $value)
                        <?php
                        $amount = $value->qty*$value->selling_price;
                        ?>                                              
                        <tr>
                            <td>{{$value->getStockManagment->item_code .' '.'-'.' '. $value->getStockManagment->name}}</td>
                            <td style="text-align: center">
                                @if($value->getStockManagment->getDepartment->id == 1)
                                    {{$value->getStockManagment->getDepartment->name}}
                                @elseif($value->getStockManagment->getDepartment->id == 2)
                                    {{$value->getStockManagment->getDepartment->name}}
                                @elseif($value->getStockManagment->getDepartment->id == 4)
                                    {{$value->getStockManagment->getDepartment->name}}  
                                @endif
                            </td>
                            <td style="text-align: center">{{$value->qty}}</td>
                            <td style="text-align: center">{{$value->selling_price}}</td>
                            <td style="text-align: right">{{ number_format($amount, 2) }}</td>
                        </tr>   
                        <?php
                            $total_amount += $amount;
                        ?>                                           
                        @endforeach
                        <tr>
                            <td colspan="3" style="font-weight: bold; text-align:right">TOTAL :</td>
                            <td colspan="2" style="text-align: right">{{ number_format($total_amount ,2) ?? 0}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="color: red; text-align:center;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No Data Found. </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>    
        </div>    
    </div>
    <!--===================================================-->
    <!--End Data Table-->
</div>
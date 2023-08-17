<style>
    h5,h4 {
        text-align: center
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-heading text-center">
                <h5 style="padding-top:10px; padding-bottom:0; margin-bottom:3px">JO Item Usage Report</h5>
                <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px"  class="text-bold">JO Number: {{ $jo_no }}</h4>                  
            </div>              
            <!--Data Table-->                           
            <!--===================================================-->
            <div class="panel-body">   
                <br>
                <div class="table-responsive">
                    <table cellspacing="0" width="100%" style="font-size: 11px" >
                        <thead>
                            <tr class="bg-trans-dark">
                                <th style="text-align:center; border: 0.5px solid black">Item Description</th>
                                <th style="text-align:center; border: 0.5px solid black">Date</th>
                                <th style="text-align:center; border: 0.5px solid black">Requester</th>
                                <th style="text-align:center; border: 0.5px solid black">Department</th>
                                <th style="text-align:center; border: 0.5px solid black">Quantity</th>
                                <th style="text-align:center; border: 0.5px solid black">Price</th>
                                <th style="text-align:center; border: 0.5px solid black">Total</th>
                            </tr>                          
                        </thead>
                        <tbody>
                            @php
                                //grandtotal
                                $total = 0;
                            @endphp
                            {{-- @dd($transaction_summarry) --}}
                            @foreach($jo_used_parts as $key => $value)
                                @foreach ($value->requestToolsData as $data)
                                    @php
                                        $total += $data->qty * $data->selling_price;
                                    @endphp
                                    <tr>
                                        <td style="text-align:center; border: 0.5px solid black;">{{ $data->getStockManagment->name ?? '' }}</td>
                                        <td style="text-align:right; border: 0.5px solid black;">{{ $value->date ?? '' }}</td>
                                        <td style="text-align:right; border: 0.5px solid black;">{{ $value->getRequestBy->name ?? '' }}</td>
                                        <td style="text-align:right; border: 0.5px solid black;">{{ $data->getStockManagment->getDepartment->name ?? '' }}</td>
                                        <td style="text-align:right; border: 0.5px solid black;">{{ $data->qty ?? '' }}</td>
                                        <td style="text-align:right; border: 0.5px solid black;">{{ number_format($data->selling_price, 2) ?? '' }}</td>
                                        <td style="text-align:right; border: 0.5px solid black;">{{ number_format( $data->qty * $data->selling_price, 2) ?? '' }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align: right; border: 0.5px solid black;">TOTAL</td>
                                <td style="text-align:right; border: 0.5px solid black;">
                                    {{ number_format($total, 2) }}
                                </td>
                            </tr>
                        </tbody>      
                    </table>  
                </div>    
            </div>          
        </div>      
    </div>
</div>

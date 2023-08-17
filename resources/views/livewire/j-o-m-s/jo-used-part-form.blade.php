<div>
    <div class="modal-content">
        <form>
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Used Parts</h4>
                <h3 class="modal-title">JO Number: {{ $jo_no }} </h3>
                <a type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></a>
            </div>
            <!-- Modal body -->
            <div class=" modal-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                    <thead>
                        <tr>
                            <th style="width: 300px;">ITEM DESC</th>
                            <th style="width: 160px;">DATE</th>
                            <th style="width: 240px;">REQUESTER</th>
                            <th style="width: 150px;">DEPARTMENT</th>
                            <th style="width: 150px;">QUANTITY</th>
                            <th style="width: 150px;">PRICE</th>
                            <th style="width: 150px;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    //grandtotal
                    $total = 0;
                    @endphp
                    {{-- @dd($transaction_summarry) --}}
                    {{-- @dd($jo_used_parts); --}}
                    @foreach($jo_used_parts as $key => $value)
                        @foreach ($value->requestToolsData as $data)
                            @php
                                $total += $data->qty * $data->selling_price;
                            @endphp
                            <tr>
                                <td style="text-align:center;">{{ $data->getStockManagment->name ?? '' }}</td>
                                <td style="text-align:right;">{{ $value->date ?? '' }}</td>
                                <td style="text-align:right;">{{ $value->getRequestBy->name ?? '' }}</td>
                                <td style="text-align:right;">{{ $data->getStockManagment->getDepartment->name ?? '' }}</td>
                                <td style="text-align:right;">{{ $data->qty ?? '' }}</td>
                                <td style="text-align:right;">{{ number_format($data->selling_price, 2) ?? '' }}</td>
                                <td style="text-align:right;">{{ number_format( $data->qty * $data->selling_price, 2) ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td colspan="6" style="text-align: right;">TOTAL</td>
                        <td style="text-align:right;">
                            {{ number_format($total, 2) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </form>
    </div>
</div>

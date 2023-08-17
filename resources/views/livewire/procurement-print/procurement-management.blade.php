 {{-- <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style> --}}

<div class="modal-header">
<h2 class="modal-title" style="text-align: center">Procurement Management Report</h2>
</div>

<!-- Modal body -->
@foreach ($report_data as $data)

    <table>
        <tr>
            <td><label>Date</label></td>
            <td><input  type="text" value="{{ $data->date }}" required readonly></td>
        </tr>
        <tr>
            <td><label>PR NO:</label></td>
            <td><input  type="text" value="{{ $data->pr_no }}" required readonly></td>
        </tr>
        <tr>
            <td><label>Supplier</label></td>
            <td><input  type="text" value="{{ $data->suppliers->name }}" required readonly></td>
        </tr>
    </table>
    <br>
    <table style="border: 1px solid black; border-collapse:collapse;" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
        <thead>
            <tr>
                <th style="border: 1px solid black; border-collapse:collapse;" class="col-lg-2">PRODUCT</th>
                <th style="border: 1px solid black; border-collapse:collapse;" class="col-lg-2">QTY</th>
                <th style="border: 1px solid black; border-collapse:collapse;" class="col-lg-2">UNIT</th>
                <th style="border: 1px solid black; border-collapse:collapse;">PRICE</th>
                <th style="border: 1px solid black; border-collapse:collapse;">TOTAL PRICE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                @foreach ($item->stockManagement as $stock)
                    <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ $stock->name }}</td>
                @endforeach
                <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ $item->qty }}</td>
                <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ $item->unit }}</td>
                <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ number_format($item->price, 2) }}</td>
                <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ number_format($item->total_price, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td style="text-align:center;border: 1px solid black; border-collapse:collapse;" colspan="3"></td>
                <td style="text-align:right"><b>Total:</b></td>
                <td style="text-align: center;border: 1px solid black; border-collapse:collapse;">{{number_format($data->all_total_price, 2)}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="form-group">
        <label>Remarks</label>
        <textarea class="form-control"  rows="5" readonly>{{$data->remarks}}</textarea>
    </div>

@endforeach


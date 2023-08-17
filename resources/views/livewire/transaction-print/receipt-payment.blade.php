 {{-- <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style> --}}

<div class="modal-header">
    <h2 class="modal-title" style="text-align: center">Receipt Payment Report</h2>
    </div>
    
    <!-- Modal body -->
    @foreach ($report_data as $data)
    
        <table>
            <tr>
                <td><label>Date</label></td>
                <td><input  type="text" value="{{ $data->date }}" required readonly></td>
                <td colspan="3"></td>
            </tr>
                <tr>
                    <td><label>Receipt Type:</label></td>
                    <td><input  type="text" value="{{ $data->receiptType->receipt_type }}" required readonly></td>
                    <td colspan="3"></td>
                    <td><label>Check Date</label></td>
                    <td><input  type="text" value="{{ $data->sb_date }}" required readonly></td>
                </tr>
                <tr>
                    <td><label>Receipt For:</label></td>
                    <td><input  type="text" value="{{ $data->receiptFor->type }}" required readonly></td>
                    <td colspan="3"></td>
                    <td><label>Document Type</label></td>
                    <td><input  type="text" value="{{ $data->fors->type }}" required readonly></td>
                </tr>
                <tr>
                    <td><label>Jo No</label></td>
                    <td><input  type="text" value="{{ $data->jobOrder->jo_no }}" required readonly></td>
                    <td colspan="3"></td>
                    <td><label>Customer Name</label></td>
                    <td><input  type="text" value="{{ $data->jobOrder->clientProfile->name }}" required readonly></td>
                </tr>
                <tr>
                    <td><label>Bank</label></td>
                    <td><input  type="text" value="{{ $data->bankType->abbrv_bank }}" required readonly></td>
                    <td colspan="3"></td>
                    <td><label>GL Account for Bank</label></td>
                    <td><input  type="text" value="{{ $data->gl_account_bank }}" required readonly></td>
                </tr>

        </table>
        <br>
        <table style="border: 1px solid black; border-collapse:collapse;" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
            <thead>
                <tr>
                    <th style="border: 1px solid black; border-collapse:collapse;" class="col-lg-2">ACCOUNT NUMBER</th>
                    <th style="border: 1px solid black; border-collapse:collapse;" class="col-lg-2">ACCOUNT TITLE</th>
                    <th style="border: 1px solid black; border-collapse:collapse;" class="col-lg-2">DEBITS</th>
                    <th style="border: 1px solid black; border-collapse:collapse;">CREDITS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    {{-- @foreach ($item->chartOfAccounts as $stock) --}}
                        <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ $item->chartOfAccounts->account_code }}</td>
                    {{-- @endforeach --}}
                    <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ $item->chartOfAccounts->account_desc }}</td>
                    <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ number_format($item->debits, 2) }}</td>
                    <td style="text-align:center;border: 1px solid black; border-collapse:collapse;">{{ number_format($item->credits, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="text-align:right" colspan="2"><b>Total:</b></td>
                    <td style="text-align: center;border: 1px solid black; border-collapse:collapse;">{{number_format($data->all_total_debits, 2)}}</td>
                    <td style="text-align: center;border: 1px solid black; border-collapse:collapse;">{{number_format($data->all_total_credits, 2)}}</td>
                </tr>
            </tbody>
        </table>
    
    @endforeach
    
    
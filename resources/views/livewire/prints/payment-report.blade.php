<style>
    h6,{text-align:center}
    
    table, th, td {
      border: 0.5px solid black;    
      border-collapse: collapse;
      font-size: 10px;
    }
</style>
<div>
    <h6 style="line-height: 20%">DUMAGUETE WELLMADE VENTURES, INC.</h6>    
    <h6 style="line-height: 20%; margin-bottom: 0">SERVICE INVOICES REGISTER - {{ $invoice_types == 1 ? 'SB' : ($invoice_types == 2 ? 'WV' : 'WV & SB') }}</h6>      
    <p style="font-size: 8px; padding-top: 0; margin-top: 0; text-align: center">FOR THE MONTH OF {{ $mn == null ? Carbon\Carbon::now()->format('M') : date("F", mktime(0, 0, 0, $mn, 1)) }}, {{ $yr ?? Carbon\Carbon::now()->format('Y') }}</p>
    <div class="panel-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                <thead>
                    <tr style="font-size: 10px;">
                        <th>#</th>
                        <th>Invoice Type & No</th>
                        <th>Inv. Date</th>
                        <th>JOAR No.</th>
                        <th>JOAR Date</th>
                        <th>Net Amount</th>
                        <th>Customer</th>
                        <th>Cust. Rep</th>                                              
                        <th>Posted To</th>                                              
                    </tr>
                </thead>
                <tbody>
                    @php
                        $wv_total = 0;
                        $sb_total = 0;
                        $overall_total = 0;
                    @endphp
                    @foreach ($report_data as $key => $payment_report)
                        <tr>
                            <td>{{ ++$key }}</td>
                            @if ($payment_report->invoice_type_id == 1)
                                <td>{{ $payment_report->sb_invoice_no ?? '' }}</td>
                                @php
                                    $sb_total += $payment_report->all_total_debits;
                                @endphp
                            @else
                                <td>{{ $payment_report->wv_invoice_no ?? '' }}</td>
                                @php
                                    $wv_total += $payment_report->all_total_debits;
                                @endphp
                            @endif
                            <td>{{ date('Y-m-d', strtotime($payment_report->date)) }}</td>
                            <td>{{ $payment_report->jobOrder->jo_no ?? '' }}</td>
                            <td>{{ date('Y-m-d', strtotime($payment_report->jobOrder->date)) ?? '' }}</td>
                            <td style="text-align: right;">{{ number_format($payment_report->all_total_debits, 2) ?? '' }}</td>
                            <td>{{ $payment_report->jobOrder->clientProfile->name ?? '' }}</td>
                            <td>{{ $payment_report->jobOrder->clientProfile->forCSA->csa_type ?? '' }}</td>
                            <td>{{ date('MY',strtotime($payment_report->date)). ';MRR' ?? '' }}</td>
                        </tr>
                    @endforeach
                    @php
                        $overall_total = $wv_total + $sb_total;
                    @endphp
                    <tr>
                        <td colspan="2" style="text-align: right;"><b>WV TOTAL: </b> {{ number_format($wv_total, 2) }}</td>
                        <td colspan="2" style="text-align: right;"><b>SB TOTAL: </b> {{ number_format($sb_total, 2) }}</td>
                        <td colspan="2" style="text-align: right;"><b>OVERALL TOTAL: </b> {{ number_format($overall_total, 2) }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
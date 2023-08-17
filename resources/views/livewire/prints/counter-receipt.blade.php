<div class="panel-head" style="text-align: center;line-height: 50%;font-size: 15px;">
    <b><span style="font-size: 25px;">{{ $business_info->company_name ?? 'Dumaguete Wellmade Ventures Inc.' }}</span></b><br><br>
    <small>{{ $business_info->address ?? 'Tabuc Tubig' }}</small><br><br>
    <small>{{ 'Dumaguete City, Negros Oriental' }}</small><br><br>
    <small>{{ 'Tel. No.: (035 522-0324)' }}</small><br><br>
    <h2>COUNTER RECEIPT</h2>

    <div style="font-size: 14px; display: inline-block;">
        <div style="display: inline-block; width: 45px;">
            <span><b>No:</b></span>
        </div>
        <div style="display: inline-block; width: 85px;border-bottom: 1px solid #444;">
            {{ str_pad($counter_receipt_data->id , 5, '0', STR_PAD_LEFT) }}
        </div>
    </div>
</div>

<div style="font-size: 12px; display: inline-block;">
    <div style="display: inline-block; width: 25px;">
        <span>To:</span>
    </div>
    <div style="display: inline-block; width: 425px; border-bottom: 1px solid #444;">
        {{ strtoupper($counter_receipt_data->getClient->name ?? '') }}
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 30px;">
        <span>Date:</span>
    </div>
    <div style="display: inline-block; width: 195px;border-bottom: 1px solid #444;">
        {{ date('F d, Y', strtotime($counter_receipt_data->date)) ?? '' }}
    </div>
</div>

<div style="font-size: 12px; display: inline-block;">
    <div style="display: inline-block; width: 25px;">
    </div>
    <div style="display: inline-block; width: 670px; border-bottom: 1px solid #444;">
        {{ strtoupper($counter_receipt_data->getClient->address ?? '' . '/' . $counter_receipt_data->getClient->contact_no ?? '') }}</small>
    </div>
</div>

<table width="100%" style="border:3px dotted #444; font-size: 12px;">            
    <thead>
        <tr>
            <th style="border-right:3px dotted #444; border-bottom: 3px dotted #444; padding:5px;"></th>
            <th style="border-right:3px dotted #444; border-bottom: 3px dotted #444; padding:5px;">REF. DATE</th>
            <th style="border-right:3px dotted #444; border-bottom: 3px dotted #444; padding:5px;">REF. NO.</th>
            <th style="border-right:3px dotted #444; border-bottom: 3px dotted #444; padding:5px;">JOAR#</th>
            <th style="border-right:3px dotted #444; border-bottom: 3px dotted #444; padding:5px;">P.O. NO.</th>
            <th style="border-bottom: 3px dotted #444;">NET AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        <br><br>
        @php
            $total = 0;
        @endphp
        @foreach ($counter_receipt_data->getCounterReceiptData as $key => $data)
            <tr>
                <td style="text-align: center;">{{ ++$key ?? '' }}</td>
                <td style="text-align: center;">{{ date('Y-m-d', strtotime($data->getTransactionSummary->date)) ?? '' }}</td>
                <td style="text-align: center;">
                    @if ($data->getTransactionSummary->invoice_type_id == 1)
                        {{ $data->getTransactionSummary->sb_invoice_no ?? '' }}
                    @else
                        {{ $data->getTransactionSummary->wv_invoice_no ?? '' }}    
                    @endif
                </td>
                <td style="text-align: center;">{{ $data->getTransactionSummary->jobOrder->jo_no ?? '' }}</td>
                <td style="text-align: center;">{{ $data->getTransactionSummary->jobOrder->po_no ?? '' }}</td>
                <td style="text-align: right;">{{ number_format($data->getTransactionSummary->jobOrder->overall_total, 2) ?? '' }}</td>
            </tr>
            @php
                $total += $data->getTransactionSummary->jobOrder->overall_total;
            @endphp            
        @endforeach
        <br><br>
        <tr>
            <th style="border-right:3px dotted #444; border-top:3px dotted #444; border-bottom:3px dotted #444; text-align:center; padding: 5px;"> {{ count($counter_receipt_data->getCounterReceiptData) }} </th>
            <th style="border-right:3px dotted #444; border-top:3px dotted #444; border-bottom:3px dotted #444; text-align:center; padding: 5px;">TOTAL</th>
            <th style="border-right:3px dotted #444; border-top:3px dotted #444; border-bottom:3px dotted #444; text-align:center; padding: 5px;" colspan="3">PLEASE PAY THIS</th>
            <th style="border-top:3px dotted #444; border-bottom:3px dotted #444; text-align:right; padding: 5px;">{{ number_format($total, 2) }}</th>
        </tr>
        <tr>
            <th style="text-align: left;" colspan="3">
                <span>Prepared by:</span>
                <div style="font-size: 12px; display: inline-block; margin-top: 25px; ">
                    <div style="display: inline-block; width: 340px; border-bottom: 1px solid #444;">
                        <span></span>
                    </div>
                </div>
                <br>
                <div style="font-size: 10px; text-align: center;">
                    <span>MRR</span>
                </div>
            </th>

            <th style="text-align: left;" colspan="3">
                <span>Received by:</span>
                <div style="font-size: 12px; display: inline-block; margin-top: 25px; ">
                    <div style="display: inline-block; width: 340px; border-bottom: 1px solid #444;">
                        <span></span>
                    </div>
                </div>
                <br>
                <div style="font-size: 10px; text-align: center;">
                    <span>Signature over Printed Name</span>
                </div>
            </th>
        </tr>
    </tbody>
</table>
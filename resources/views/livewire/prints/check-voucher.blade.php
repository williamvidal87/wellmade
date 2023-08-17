<style>
    /* td, th{
        border: 1px solid #444;
    } */
</style>
<?php
use NumberToWords\NumberToWords;

class NumToWords{

    public function convertNumberToWords($num)
    {
            // create the number to words "manager" class
            $numberToWords = new NumberToWords();

            $num = 100 * $num;
            // build a new currency transformer using the RFC 3066 language identifier
            $currencyTransformer = $numberToWords->getCurrencyTransformer('en');
            return $currencyTransformer->toWords($num, 'PHP');
    }
}

?>

<div class="panel-head" style="text-align: center;line-height: 50%;font-size: 15px;">
    <b><span style="font-size: 25px;">{{ $business_info->company_name ?? 'Dumaguete Wellmade Ventures Inc.' }}</span></b><br><br>
        <small>{{ $business_info->address ?? 'Tabuc Tubig' }}</small><br><br>
        <small>{{ 'Dumaguete City, Negros Oriental' }}</small>

    <h2 style="font-family: Arial;">
        CHECK VOUCHER
    </h2>
</div>

<div style="font-size: 12px; display: inline-block;">
    <div style="display: inline-block; width: 50px;">
        <span>Payee:</span>
    </div>
    <div style="display: inline-block; width: 400px; border-bottom: 1px solid #444;">
        {{ $voucher->getSupplierId->name ?? '' }}
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 60px;">
        <span>Date:</span>
    </div>
    <div style="display: inline-block; width: 165px;border-bottom: 1px solid #444;">
        {{ date('F d, Y', strtotime($voucher->date)) ?? '' }}
    </div>
</div>

<?php
    $numToWords = new NumToWords();
?>

<div style="font-size: 12px; display: inline-block;">
    <div style="display: inline-block; width: 50px;">
        <span>Amount:</span>
    </div>
    <div style="display: inline-block; width: 400px; border-bottom: 1px solid #444;">
        {{ ucwords($numToWords->convertNumberToWords($voucher->amount)) }}
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 60px;">
        <span>Bank:</span>
    </div>
    <div style="display: inline-block; width: 165px;border-bottom: 1px solid #444;">
        {{ $voucher->getBankId->abbrv_bank ?? '' }}
    </div>
</div>

<div style="font-size: 12px; display: inline-block;">
    <div style="display: inline-block; width: 50px;">
    </div>
    <div style="display: inline-block; width: 400px; border-bottom: 1px solid #444;">
        <small><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ number_format($voucher->amount ?? 0, 2) }}</small>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 60px;">
        <span>Check No:</span>
    </div>
    <div style="display: inline-block; width: 165px;border-bottom: 1px solid #444;">
        {{ $voucher->check_no }}
    </div>
</div>

<table width="100%" style="align-text: center; border: 3px dotted #444; min-height: 200px; font-size: 12px;" >                             
    <thead>
        <tr>
            <th style="text-align: left">Explanation:</th>                                             
        </tr>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: left">
                &nbsp;&nbsp;&nbsp;{{ $voucher->particulars ?? '' }}
            </td>
        </tr>
    </tbody>
</table>
<div style="text-align: center;">
    <small>Received the above amount in payment of the mentioned Item(s).</small>
</div>
<br><br>
<div style="font-size: 12px; display: inline-block;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 200px; border-bottom: 1px solid #444;">
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 200px;border-bottom: 1px solid #444;">
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 200px; border-bottom: 1px solid #444;">
    </div>
</div>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div style="display: inline-block; width: 100px; font-size: 10px;">
    <span>Signature</span>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div style="display: inline-block; width: 100px; font-size: 10px;">
    <span>Name in Print</span>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div style="display: inline-block; width: 100px; font-size: 10px;">
    <span>Date</span>
</div>
<br><br>
<table width="100%" style="border:3px dotted #444; min-height: 200px; font-size: 12px;">            
    <thead>
        <tr>
            <th style="border-right:3px dotted #444; border-bottom: 1px solid #444;">Accnt. No.</th>
            <th style="border-right:3px dotted #444; border-bottom: 1px solid #444;">Account Title</th>
            <th style="border-right:3px dotted #444; border-bottom: 1px solid #444;">Debit</th>
            <th style="border-bottom: 1px solid #444;">Credit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($voucher->getCheckVoucherData as $data)
            <tr>
                <td style="border-bottom: 1px solid #444;">{{ $data->getChartOfAccounts->account_code ?? '' }}</td>
                <td style="border-bottom: 1px solid #444;">{{ $data->getChartOfAccounts->account_desc ?? '' }}</td>
                <td style="text-align: right;border-bottom: 1px solid #444;">{{ number_format($data->debits, 2) ?? '' }}</td>
                <td style="text-align: right;border-bottom: 1px solid #444;">{{ number_format($data->credits, 2) ?? '' }}</td>
            </tr>            
        @endforeach
    </tbody>
</table>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div style="display: inline-block; width: 100px; font-size: 10px;">
    <span>Prepared by:</span>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div style="display: inline-block; width: 100px; font-size: 10px;">
    <span>Checked & Verified by:</span>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div style="display: inline-block; width: 100px; font-size: 10px;">
    <span>Approved by:</span>
</div>
<br><br>
<div style="font-size: 12px; display: inline-block;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 200px; border-bottom: 1px solid #444;">
        <span>MRR</span>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 200px;border-bottom: 1px solid #444;">
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div style="display: inline-block; width: 200px;border-bottom: 1px solid #444;">
    </div>
</div>
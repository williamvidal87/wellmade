<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INCENTIVE VOUCHER</title>
    <style>
        small {
            font-family: Arial, Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        table {
            font-family: Arial, Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th{
            border: 1px solid #444;
        }
    </style>
</head>
<body>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="panel-head" style="text-align: center;line-height: 50%;font-size: 15px;">
                <small style="font-size: 15px; font-weight:bold;">Dumaguete Plant</small><br><br><br><br>
                <b><span style="font-size: 25px; font-weight:bold;">INCENTIVE VOUCHER</span></b><br><br>
            </div>
            <div class="center" style="width:50px;margin: auto;">
                {!! DNS2D::getBarcodeHTML($records['token_scan'], 'QRCODE', 2.3,2.3) !!}
            </div>
            <br>
            <div class="row">
                <table class="table table-bordered" style="font-size: 9px;">
                    <tr style="padding: 0; margin: 0;">
                        <td style="font-weight:bold; width: 90px;">PAID TO:</td>
                        <td style="width: 230px;">{{ $records['data']->getContact->name ?? '' }}</td>
                        <td style="font-weight:bold;">Cover Period:</td>
                        <td>Selected JO</td>
                        <td style="font-weight:bold;">Date Processed:</td>
                        <td>{{ date('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Shop/Address:</td>
                        <td>{{ $records['data']->getContact->address ?? '' }}</td>
                        <td style="font-weight:bold;">ID Num:</td>
                        <td>{{ $records['data']->getContact->getClientType->getIndustry->name. '-'. $records['data']->getContact->id  ?? '' }}</td>
                        <td style="font-weight:bold;">Date Released:</td>
                        <td>{{ date('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Company:</td>
                        <td>{{ $records['data']->clientProfile->name ?? '' }}</td>
                        <td style="font-weight:bold;">PhoneCell:</td>
                        <td>{{ $records['data']->getContact->contact_no ?? '' }}</td>
                        <td style="font-weight:bold;">Assigned CSA:</td>
                        <td>{{ $records['data']->getContact->getCsaType->csa_type ?? '' }}</td>
                    </tr>
                </table>
                <table class="table table-bordered" style="font-size: 9px;">
                    <tr>
                        <td style="font-weight:bold; text-align:center; width: 80px; border-bottom: 0;">
                            Prepared by:
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 80px; border-bottom: 0;">
                            Certified Correct:
                        </td>
                        <td colspan="2" style="font-weight:bold; text-align:center; width: 300px;">
                            Approved for Release either by the:
                        </td>
                        <td style="text-align:center ;font-weight:bold; border-bottom: 0;">C/A Approved by:</td>
                        <td style="text-align:center ;font-weight:bold; border-bottom: 0;">Approved Cash Advance:</td>
                    </tr>
                    <tr>
                        <td style="text-align:center; width: 80px; border-top: 0; height: 40px !important;">
                            <br><br><br>
                            S&P Coord.
                        </td>
                        <td style="text-align:center; width: 80px; border-top: 0; height: 40px !important;">
                            <br><br><br>
                            Plant Admin/OIC
                        </td>
                        <td style="text-align:center; width: 150px; border-top: 0; height: 40px !important;">
                            <br><br><br>
                            Group Head - Optns
                        </td>
                        <td style="text-align:center; width: 150px; border-top: 0; height: 40px !important;">
                            <br><br><br>
                            Group Head - Finance
                        </td>
                        <td style="text-align:center; border-top: 0; height: 40px !important;">
                            <br><br><br>
                            Office of the President
                        </td>
                        <td style="text-align:center; border-top: 0; height: 40px !important;">
                            <br><br><br>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" style="font-size: 9px;">
                    <tr>
                        {{-- 170 || 161 || 152 || 143 || 137 --}}
                        <td colspan="3" style="font-weight:bold; text-align:center; width: 137px;"> 
                            Sales Control Reference
                        </td>
                        <td colspan="3" style="font-weight:bold; text-align:center; width: 150px;">
                            PAYMENT
                        </td>
                        <td colspan="5" style="font-weight:bold; text-align:center; width: 130px;">
                            DEDUCTION/ADJUST
                        </td>
                        <td style="text-align:center ;font-weight:bold; width: 60px; border-bottom: 0;">Net Amount</td>
                        <td colspan="3" style="text-align:center ;font-weight:bold; width: 100px;">Final % Incentive</td>
                        <td style="text-align:center ;font-weight:bold; border-bottom: 0; width: 55px">Net</td>
                    </tr>
                    <tr>
                        {{-- 56 || 53 || 47  || 45--}}
                        <td style="font-weight:bold; text-align:center; width: 45px;">
                            JOEAR
                        </td>
                        {{-- 56 || 53 || 47 || 45 --}}
                        <td style="font-weight:bold; text-align:center; width: 45px;">
                            Date
                        </td>
                        {{-- 56 || 53 || 47 || 45 --}}
                        <td style="font-weight:bold; text-align:center; width: 45px;">
                            SO/SI/DHI
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 50px;">
                            Date
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 50px;">
                            AR/OR
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 50px;">
                            Amount
                        </td>
                        <td colspan="2" style="font-weight:bold; text-align:center; width: 43px;">
                            VAT Tax
                        </td>
                        <td colspan="2" style="font-weight:bold; text-align:center; width: 43px;">
                            Discount
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 40px;">
                            Sub Credit %
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 60px; border-top: 0">
                            Subject to Incentive
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 30px;">
                            ER
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 30px;">
                            MF/SP
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 30px;">
                            Calib
                        </td>
                        <td style="font-weight:bold; text-align:center; border-top: 0;">
                            Incentive Amount Due
                        </td>
                    </tr>
                    <?php
                        $total_amount_er = 0;
                        $total_amount_mf = 0;
                        $total_amount_calib = 0;
                        $count_er = 0;
                        $count_mf = 0;
                        $count_calib = 0;
                        $max_discount_er = 0;
                        $max_discount_mf = 0;
                        $max_discount_calib = 0;
                        foreach ($records['related_work_order'] as $key => $value) {
                            if($value->er_work_group_id){
                                $total_amount_er += (($value->price+$value->amount_increase) * $value->qty);
                                if($value->max_discount > 0){
                                    $max_discount_er = $value->max_discount;
                                }
                            }elseif ($value->mf_work_group_id){
                                $total_amount_mf += (($value->price+$value->amount_increase) * $value->qty);
                                if($value->max_discount > 0){
                                    $max_discount_mf = $value->max_discount;
                                }
                            }elseif ($value->calib_work_group_id){
                                $total_amount_calib += (($value->price+$value->amount_increase) * $value->qty);
                                if($value->max_discount > 0){
                                    $max_discount_calib = $value->max_discount;
                                }
                            }
                        }

                        $total_incentive = 0;
                        $incentive = 0;

                        // create a count in here
                        $counter = 0;
                        if($total_amount_er > 0){
                            $counter++;
                        }
                        if($total_amount_mf > 0){
                            $counter++;
                        }
                        if($total_amount_calib > 0){
                            $counter++;
                        }
                    ?>
                    @foreach ($records['related_work_order'] as $key => $value)
                        <?php
                            $incentive = 0;
                        ?>
                        {{-- if the count is greater than then break  --}}
                        @if ($total_amount_er > 0 && $value->er_work_group_id && $count_er == 0)
                        <tr>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    {{ $records['data']->jo_no ?? '' }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                {{-- DATE WHEN RECEIPTS --}}
                                @if ($key == 0)
                                    {!! date('Y-m-d', strtotime($invoice_date)) !!}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    @if ($records['transaction_info']->invoice_type_id == 1)
                                        {{ $records['transaction_info']->sb_invoice_no }} 
                                    @elseif ($records['transaction_info']->invoice_type_id == 2)
                                        {{ $records['transaction_info']->wv_invoice_no }}
                                    @endif
                                    {{-- {{ $records['transaction_info']->sb_invoice_no ?? $records['transaction_info']->wv_invoice_no ?? '' }} --}}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="text-align:center; width: 50px;">
                                {{-- DATE WHEN PAID IN RECEIPTS PAYMENTS --}}
                                @if ($key == 0)
                                    {!! date('Y-m-d', strtotime($receipt_date)) !!}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="text-align:center; width: 50px;">
                                @if ($key == 0)
                                    {{ $records['transaction_id'] }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- ER LOOP --}}
                            @if ($value->er_work_group_id && $count_er == 0)
                                <?php
                                    $total = 0;
                                    $count_er++;
                                    $total = $total_amount_er;
                                ?>
                                <td style="text-align:center; width: 50px;">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if(strstr($records['transaction_id'], '-', true) == "OR"){
                                        $vat = 12;
                                    }else{
                                        $vat = 0;
                                    }
                                ?>
                                <td style="text-align:center; width: 21px;">
                                    {{ $vat }}%
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if (strstr($records['transaction_id'], '-', true) == "OR")
                                        @if ($vat > 0)
                                            {{ number_format($total_amount_er * ($vat/100), 2) }}
                                            <?php
                                            $total = $total_amount_er - ($total_amount_er * ($vat/100)); 
                                            ?>
                                        @elseif ($vat == 0)
                                            {{ number_format($total, 2) }}
                                        @endif
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    {{ $max_discount_er. '%' }}
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if ($max_discount_er > 0)
                                        {{ number_format($total_amount_er * ($max_discount_er/100), 2) }}
                                        <?php 
                                            $total = $total - ($total_amount_er * ($max_discount_er/100));
                                        ?>
                                    @else
                                        0.00
                                    @endif
                                    
                                </td>
                                <td style="text-align:center; width: 40px;">
                                    0
                                </td>
                                <td style="text-align:center; width: 60px; border-top: 0">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if($value->er_work_group_id){
                                        if($max_discount_er > 0){
                                            $er_discount = $value->getIncentiveType->incentive_type - $max_discount_er;
                                        }else{
                                            $er_discount = 20;
                                        }
                                        // $er_discount = $value->getIncentiveType->incentive_type;
                                        $mf_discount = 0;
                                        $calib_discount = 0;
                                    }elseif ($value->mf_work_group_id){
                                        $er_discount = 0;
                                        // $mf_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_mf > 0){
                                            $mf_discount = $value->getIncentiveType->incentive_type - $max_discount_mf;
                                        }else{
                                            $mf_discount = 10;
                                        }
                                        $calib_discount = 0;
                                    }elseif ($value->calib_work_group_id){
                                        $er_discount = 0;
                                        $mf_discount = 0;
                                        // $calib_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_calib > 0){
                                            $calib_discount = $value->getIncentiveType->incentive_type - $max_discount_calib;
                                        }else{
                                            $calib_discount = 10;
                                        }
                                    }
                                ?>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $er_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $mf_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $calib_discount }}%
                                </td>
                                <?php
                                    if($er_discount > 0){
                                        $incentive = $total * ($er_discount/100); 
                                    }elseif($mf_discount > 0){
                                        $incentive = $total * ($mf_discount/100); 
                                    }elseif($calib_discount > 0){
                                        $incentive = $total * ($calib_discount/100); 
                                    }

                                    $total_incentive += $incentive;
                                ?>
                                <td style="text-align:right; border-top: 0;">
                                    {{ number_format($incentive, 2) }}
                                </td>
                            @endif
                        </tr>
                        @endif

                        @if ($total_amount_mf > 0 && $value->mf_work_group_id && $count_mf == 0)
                        <tr>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    {{ $records['data']->jo_no ?? '' }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    {!! date('Y-m-d', strtotime($invoice_date)) !!}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    {{ $records['transaction_info']->sb_invoice_no ?? $records['transaction_info']->wv_invoice_no ?? '' }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="text-align:center; width: 50px;">
                                @if ($key == 0)
                                    {!! date('Y-m-d', strtotime($receipt_date)) !!}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="text-align:center; width: 50px;">
                                @if ($key == 0)
                                    {{ $records['transaction_id'] }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- MF LOOP --}}
                            @if ($value->mf_work_group_id && $count_mf == 0)
                                <?php
                                    $total = 0;
                                    $count_mf++;
                                    $total = $total_amount_mf;
                                ?>
                                <td style="text-align:center; width: 50px;">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if(strstr($records['transaction_id'], '-', true) == "OR"){
                                        $vat = 12;
                                    }else{
                                        $vat = 0;
                                    }
                                ?>
                                <td style="text-align:center; width: 21px;">
                                    {{ $vat }}%
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if (strstr($records['transaction_id'], '-', true) == "OR")
                                        @if ($vat > 0)
                                            {{ number_format($total_amount_mf * ($vat/100), 2) }}
                                            <?php
                                            $total = $total_amount_mf - ($total_amount_mf * ($vat/100)); 
                                            ?>
                                        @elseif ($vat == 0)
                                            {{ number_format($total, 2) }}
                                        @endif
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    {{ $max_discount_mf. '%' }}
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if ($max_discount_mf > 0)
                                        {{ number_format($total_amount_mf * ($max_discount_mf/100), 2) }}
                                        <?php 
                                            $total = $total - ($total_amount_mf * ($max_discount_mf/100));
                                        ?>
                                    @else
                                        0.00
                                    @endif
                                    
                                </td>
                                <td style="text-align:center; width: 40px;">
                                    0
                                </td>
                                <td style="text-align:center; width: 60px; border-top: 0">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if($value->er_work_group_id){
                                        if($max_discount_er > 0){
                                            $er_discount = $value->getIncentiveType->incentive_type - $max_discount_er;
                                        }else{
                                            $er_discount = 20;
                                        }
                                        // $er_discount = $value->getIncentiveType->incentive_type;
                                        $mf_discount = 0;
                                        $calib_discount = 0;
                                    }elseif ($value->mf_work_group_id){
                                        $er_discount = 0;
                                        // $mf_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_mf > 0){
                                            $mf_discount = $value->getIncentiveType->incentive_type - $max_discount_mf;
                                        }else{
                                            $mf_discount = 10;
                                        }
                                        $calib_discount = 0;
                                    }elseif ($value->calib_work_group_id){
                                        $er_discount = 0;
                                        $mf_discount = 0;
                                        // $calib_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_calib > 0){
                                            $calib_discount = $value->getIncentiveType->incentive_type - $max_discount_calib;
                                        }else{
                                            $calib_discount = 10;
                                        }
                                    }
                                ?>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $er_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $mf_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $calib_discount }}%
                                </td>
                                <?php
                                    if($er_discount > 0){
                                        $incentive = $total * ($er_discount/100); 
                                    }elseif($mf_discount > 0){
                                        $incentive = $total * ($mf_discount/100); 
                                    }elseif($calib_discount > 0){
                                        $incentive = $total * ($calib_discount/100); 
                                    }

                                    $total_incentive += $incentive;
                                ?>
                                <td style="text-align:right; border-top: 0;">
                                    {{ number_format($incentive, 2) }}
                                </td>
                            @endif
                        </tr>
                        @endif

                        @if ($total_amount_calib > 0 && $value->calib_work_group_id && $count_calib == 0)
                        <tr>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    {{ $records['data']->jo_no ?? '' }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    {!! date('Y-m-d', strtotime($invoice_date)) !!}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- 56 || 53 || 47 || 45 --}}
                            <td style="text-align:center; width: 45px;">
                                @if ($key == 0)
                                    {{ $records['transaction_info']->sb_invoice_no ?? $records['transaction_info']->wv_invoice_no ?? '' }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="text-align:center; width: 50px;">
                                @if ($key == 0)
                                    {!! date('Y-m-d', strtotime($receipt_date)) !!}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            <td style="text-align:center; width: 50px;">
                                @if ($key == 0)
                                    {{ $records['transaction_id'] }}
                                @else
                                    &nbsp;
                                @endif
                            </td>
                            {{-- CALIB LOOP --}}
                            @if ($value->calib_work_group_id && $count_calib == 0)
                                <?php
                                    $total = 0;
                                    $count_calib++;
                                    $total = $total_amount_calib;
                                ?>
                                <td style="text-align:center; width: 50px;">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if(strstr($records['transaction_id'], '-', true) == "OR"){
                                        $vat = 12;
                                    }else{
                                        $vat = 0;
                                    }
                                ?>
                                <td style="text-align:center; width: 21px;">
                                    {{ $vat }}%
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if (strstr($records['transaction_id'], '-', true) == "OR")
                                        @if ($vat > 0)
                                            {{ number_format($total_amount_calib * ($vat/100), 2) }}
                                            <?php
                                            $total = $total_amount_calib - ($total_amount_calib * ($vat/100)); 
                                            ?>
                                        @elseif ($vat == 0)
                                            {{ number_format($total, 2) }}
                                        @endif
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    {{ $max_discount_calib. '%' }}
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if ($max_discount_calib > 0)
                                        {{ number_format($total_amount_calib * ($max_discount_calib/100), 2) }}
                                        <?php 
                                            $total = $total - ($total_amount_calib * ($max_discount_calib/100));
                                        ?>
                                    @else
                                        0.00
                                    @endif
                                    
                                </td>
                                <td style="text-align:center; width: 40px;">
                                    0
                                </td>
                                <td style="text-align:center; width: 60px; border-top: 0">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if($value->er_work_group_id){
                                        if($max_discount_er > 0){
                                            $er_discount = $value->getIncentiveType->incentive_type - $max_discount_er;
                                        }else{
                                            $er_discount = 20;
                                        }
                                        // $er_discount = $value->getIncentiveType->incentive_type;
                                        $mf_discount = 0;
                                        $calib_discount = 0;
                                    }elseif ($value->mf_work_group_id){
                                        $er_discount = 0;
                                        // $mf_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_mf > 0){
                                            $mf_discount = $value->getIncentiveType->incentive_type - $max_discount_mf;
                                        }else{
                                            $mf_discount = 10;
                                        }
                                        $calib_discount = 0;
                                    }elseif ($value->calib_work_group_id){
                                        $er_discount = 0;
                                        $mf_discount = 0;
                                        // $calib_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_calib > 0){
                                            $calib_discount = $value->getIncentiveType->incentive_type - $max_discount_calib;
                                        }else{
                                            $calib_discount = 10;
                                        }
                                    }
                                ?>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $er_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $mf_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $calib_discount }}%
                                </td>
                                <?php
                                    if($er_discount > 0){
                                        $incentive = $total * ($er_discount/100); 
                                    }elseif($mf_discount > 0){
                                        $incentive = $total * ($mf_discount/100); 
                                    }elseif($calib_discount > 0){
                                        $incentive = $total * ($calib_discount/100); 
                                    }

                                    $total_incentive += $incentive;
                                ?>
                                <td style="text-align:right; border-top: 0;">
                                    {{ number_format($incentive, 2) }}
                                </td>
                            @endif
                        </tr>
                        @endif

                    @endforeach
                    <tr>
                        <td colspan="16" style="text-align:center; width: 56px;">
                            -- Nothing Follows --
                        </td>
                    </tr>
                    <tr>
                        <td colspan="16" style="text-align:center; width: 56px;">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="16" style="text-align:center; width: 56px;">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center; border-left: 1; border-top: 0; border-bottom: 0; border-right: 0;">
                            Amount in Words:
                        </td>
                        <?php
                        $numToWords = new NumToWords();
                        ?>
                        <td colspan="8" style="text-align:center; border: 0;">
                            {{ ucwords($numToWords->convertNumberToWords($total_incentive)) }}
                        </td>
                        <td colspan="4" style="text-align:right;">
                            TOTAL: {{ number_format($total_incentive, 2) }}
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" style="font-size: 9px;">
                    <tr>
                        <td>
                            @if ($records['data']->getContact->image != null)
                                <img src="storage/images/{{ $records['data']->getContact->image}}" style="text-align:center; width: 180px; height: 100px !important;" alt="">
                            @endif
                        </td>
                        <td style="text-align:left; width: 100px; height: 120px !important;">
                            <span style="margin-top: -50px;">Remarks:</span>
                            <br><br><br><br><br><br><br><br><br><br><br><br>
                        </td>
                        <td style="text-align:center; width: 100px; height: 120px !important;">
                            <br><br><br><br><br><br><br><br><br><br><br>
                            Plant Admin/OIC
                        </td>
                        <td style="text-align:center; width: 100px; height: 120px !important;">
                            <br><br><br><br><br><br><br><br><br><br><br>
                            Fin. Admin
                        </td>
                        <td style="text-align:center; height: 120px !important;">
                            Final incentive due after deduction of Cash Advance:
                            <br><br><br><br><br><br><br><br><br><br><br>
                            Signature of Recipient
                        </td>
                    </tr>
                </table>

                <div style="text-align: center; margin-bottom: 3px; border-bottom: 1px dashed #444; border-left: 0; border-right: 0; border-top: 0; width: 100%;">
                    <small style="text-align: center; font-size: 9px;">cut the lower portion and give the copy to the authorized recipient</small>
                </div>

                <?php
                    $span = 0;
                    if($total_amount_er > 0){
                        $span++;
                    }
                    if($total_amount_mf > 0){
                        $span++;
                    }
                    if($total_amount_calib > 0){
                        $span++;
                    }
                ?>
                <table class="table table-bordered" style="font-size: 9px;">
                    <tr>
                        <td rowspan="{{ $span+1 }}" style="text-align:center; width: 220px; border-bottom: 0">
                            In Case of Descrepancies, please contact our office. <br>
                            THANK YOU FOR YOUR <br>
                            CONTINUED PATRONAGE
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 50px;">
                            Amount
                        </td>
                        <td colspan="2" style="font-weight:bold; text-align:center; width: 50px;">
                            VAT Tax
                        </td>
                        <td colspan="2" style="font-weight:bold; text-align:center; width: 50px;">
                            Discount
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 50px;">
                            SC%
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 50px;">
                            &nbsp;
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 30px;">
                            ER
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 30px;">
                            MF/SP
                        </td>
                        <td style="font-weight:bold; text-align:center; width: 30px;">
                            Calib
                        </td>
                        <td style="font-weight:bold; text-align:center; width:60px">
                            Amount Due
                        </td>
                    </tr>
                    <?php
                        $total_amount_er = 0;
                        $total_amount_mf = 0;
                        $total_amount_calib = 0;
                        $count_er = 0;
                        $count_mf = 0;
                        $count_calib = 0;
                        foreach ($records['related_work_order'] as $key => $value) {
                            if($value->er_work_group_id){
                                $total_amount_er += (($value->price+$value->amount_increase) * $value->qty);
                            }elseif ($value->mf_work_group_id){
                                $total_amount_mf += (($value->price+$value->amount_increase) * $value->qty);
                            }elseif ($value->calib_work_group_id){
                                $total_amount_calib += (($value->price+$value->amount_increase) * $value->qty);
                            }
                        }

                        $total_incentive = 0;
                        $incentive = 0;

                        // create a count in here
                        $counter = 0;
                        if($total_amount_er > 0){
                            $counter++;
                        }
                        if($total_amount_mf > 0){
                            $counter++;
                        }
                        if($total_amount_calib > 0){
                            $counter++;
                        }
                    ?>
                    @foreach ($records['related_work_order'] as $key => $value)
                    <?php
                            $incentive = 0;
                    ?>
                    {{-- <tr> --}}
                        {{-- ER LOOP --}}
                        {{-- @if ($key < $counter) --}}
                            @if ($value->er_work_group_id && $count_er == 0)
                            <tr>
                                <?php
                                    $total = 0;
                                    $count_er++;
                                    $total = $total_amount_er;
                                ?>
                                <td style="text-align:center; width: 50px;">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if(strstr($records['transaction_id'], '-', true) == "OR"){
                                        $vat = 12;
                                    }else{
                                        $vat = 0;
                                    }
                                ?>
                                <td style="text-align:center; width: 21px;">
                                    {{ $vat }}%
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if (strstr($records['transaction_id'], '-', true) == "OR")
                                        @if ($vat > 0)
                                            {{ number_format($total_amount_er * ($vat/100), 2) }}
                                            <?php
                                            $total = $total_amount_er - ($total_amount_er * ($vat/100)); 
                                            ?>
                                        @elseif ($vat == 0)
                                            {{ number_format($total, 2) }}
                                        @endif
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    {{ $max_discount_er. '%' }}
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if ($max_discount_er > 0)
                                        {{ number_format($total_amount_er * ($max_discount_er/100), 2) }}
                                        <?php 
                                            $total = $total - ($total_amount_er * ($max_discount_er/100));
                                        ?>
                                    @else
                                        0.00
                                    @endif
                                    
                                </td>
                                <td style="text-align:center; width: 40px;">
                                    0
                                </td>
                                <td style="text-align:center; width: 60px; border-top: 0">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if($value->er_work_group_id){
                                        if($max_discount_er > 0){
                                            $er_discount = $value->getIncentiveType->incentive_type - $max_discount_er;
                                        }else{
                                            $er_discount = 20;
                                        }
                                        // $er_discount = $value->getIncentiveType->incentive_type;
                                        $mf_discount = 0;
                                        $calib_discount = 0;
                                    }elseif ($value->mf_work_group_id){
                                        $er_discount = 0;
                                        // $mf_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_mf > 0){
                                            $mf_discount = $value->getIncentiveType->incentive_type - $max_discount_mf;
                                        }else{
                                            $mf_discount = 10;
                                        }
                                        $calib_discount = 0;
                                    }elseif ($value->calib_work_group_id){
                                        $er_discount = 0;
                                        $mf_discount = 0;
                                        // $calib_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_calib > 0){
                                            $calib_discount = $value->getIncentiveType->incentive_type - $max_discount_calib;
                                        }else{
                                            $calib_discount = 10;
                                        }
                                    }
                                ?>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $er_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $mf_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $calib_discount }}%
                                </td>
                                <?php
                                    if($er_discount > 0){
                                        $incentive = $total * ($er_discount/100); 
                                    }elseif($mf_discount > 0){
                                        $incentive = $total * ($mf_discount/100); 
                                    }elseif($calib_discount > 0){
                                        $incentive = $total * ($calib_discount/100); 
                                    }

                                    $total_incentive += $incentive;
                                ?>
                                <td style="text-align:right; border-top: 0;">
                                    {{ number_format($incentive, 2) }}
                                </td>
                            </tr>
                            {{-- @endif --}}

                            {{-- MF LOOP --}}
                            @elseif ($value->mf_work_group_id && $count_mf == 0)
                            <tr>
                                <?php
                                    $total = 0;
                                    $count_mf++;
                                    $total = $total_amount_mf;
                                ?>
                                <td style="text-align:center; width: 50px;">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if(strstr($records['transaction_id'], '-', true) == "OR"){
                                        $vat = 12;
                                    }else{
                                        $vat = 0;
                                    }
                                ?>
                                <td style="text-align:center; width: 21px;">
                                    {{ $vat }}%
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if (strstr($records['transaction_id'], '-', true) == "OR")
                                        @if ($vat > 0)
                                            {{ number_format($total_amount_mf * ($vat/100), 2) }}
                                            <?php
                                            $total = $total_amount_mf - ($total_amount_mf * ($vat/100)); 
                                            ?>
                                        @elseif ($vat == 0)
                                            {{ number_format($total, 2) }}
                                        @endif
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    {{ $max_discount_mf. '%' }}
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if ($max_discount_mf > 0)
                                        {{ number_format($total_amount_mf * ($max_discount_mf/100), 2) }}
                                        <?php 
                                            $total = $total - ($total_amount_mf * ($max_discount_mf/100));
                                        ?>
                                    @else
                                        0.00
                                    @endif
                                    
                                </td>
                                <td style="text-align:center; width: 40px;">
                                    0
                                </td>
                                <td style="text-align:center; width: 60px; border-top: 0">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if($value->er_work_group_id){
                                        if($max_discount_er > 0){
                                            $er_discount = $value->getIncentiveType->incentive_type - $max_discount_er;
                                        }else{
                                            $er_discount = 20;
                                        }
                                        // $er_discount = $value->getIncentiveType->incentive_type;
                                        $mf_discount = 0;
                                        $calib_discount = 0;
                                    }elseif ($value->mf_work_group_id){
                                        $er_discount = 0;
                                        // $mf_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_mf > 0){
                                            $mf_discount = $value->getIncentiveType->incentive_type - $max_discount_mf;
                                        }else{
                                            $mf_discount = 10;
                                        }
                                        $calib_discount = 0;
                                    }elseif ($value->calib_work_group_id){
                                        $er_discount = 0;
                                        $mf_discount = 0;
                                        // $calib_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_calib > 0){
                                            $calib_discount = $value->getIncentiveType->incentive_type - $max_discount_calib;
                                        }else{
                                            $calib_discount = 10;
                                        }
                                    }
                                ?>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $er_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $mf_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $calib_discount }}%
                                </td>
                                <?php
                                    if($er_discount > 0){
                                        $incentive = $total * ($er_discount/100); 
                                    }elseif($mf_discount > 0){
                                        $incentive = $total * ($mf_discount/100); 
                                    }elseif($calib_discount > 0){
                                        $incentive = $total * ($calib_discount/100); 
                                    }

                                    $total_incentive += $incentive;
                                ?>
                                <td style="text-align:right; border-top: 0;">
                                    {{ number_format($incentive, 2) }}
                                </td>
                            </tr>
                            {{-- @endif --}}

                            {{-- CALIB LOOP --}}
                            @elseif ($value->calib_work_group_id && $count_calib == 0)
                            <tr>
                                <?php
                                    $total = 0;
                                    $count_calib++;
                                    $total = $total_amount_calib;
                                ?>
                                <td style="text-align:center; width: 50px;">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if(strstr($records['transaction_id'], '-', true) == "OR"){
                                        $vat = 12;
                                    }else{
                                        $vat = 0;
                                    }
                                ?>
                                <td style="text-align:center; width: 21px;">
                                    {{ $vat }}%
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if (strstr($records['transaction_id'], '-', true) == "OR")
                                        @if ($vat > 0)
                                            {{ number_format($total_amount_calib * ($vat/100), 2) }}
                                            <?php
                                            $total = $total_amount_calib - ($total_amount_calib * ($vat/100)); 
                                            ?>
                                        @elseif ($vat == 0)
                                            {{ number_format($total, 2) }}
                                        @endif
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    {{ $max_discount_calib. '%' }}
                                </td>
                                <td style="text-align:center; width: 21px;">
                                    @if ($max_discount_calib > 0)
                                        {{ number_format($total_amount_calib * ($max_discount_calib/100), 2) }}
                                        <?php 
                                            $total = $total - ($total_amount_calib * ($max_discount_calib/100));
                                        ?>
                                    @else
                                        0.00
                                    @endif
                                    
                                </td>
                                <td style="text-align:center; width: 40px;">
                                    0
                                </td>
                                <td style="text-align:center; width: 60px; border-top: 0">
                                    {{ number_format($total, 2) }}
                                </td>
                                <?php
                                    if($value->er_work_group_id){
                                        if($max_discount_er > 0){
                                            $er_discount = $value->getIncentiveType->incentive_type - $max_discount_er;
                                        }else{
                                            $er_discount = 20;
                                        }
                                        // $er_discount = $value->getIncentiveType->incentive_type;
                                        $mf_discount = 0;
                                        $calib_discount = 0;
                                    }elseif ($value->mf_work_group_id){
                                        $er_discount = 0;
                                        // $mf_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_mf > 0){
                                            $mf_discount = $value->getIncentiveType->incentive_type - $max_discount_mf;
                                        }else{
                                            $mf_discount = 10;
                                        }
                                        $calib_discount = 0;
                                    }elseif ($value->calib_work_group_id){
                                        $er_discount = 0;
                                        $mf_discount = 0;
                                        // $calib_discount = $value->getIncentiveType->incentive_type;
                                        if($max_discount_calib > 0){
                                            $calib_discount = $value->getIncentiveType->incentive_type - $max_discount_calib;
                                        }else{
                                            $calib_discount = 10;
                                        }
                                    }
                                ?>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $er_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $mf_discount }}%
                                </td>
                                <td style="text-align:center; width: 30px;">
                                    {{ (int) $calib_discount }}%
                                </td>
                                <?php
                                    if($er_discount > 0){
                                        $incentive = $total * ($er_discount/100); 
                                    }elseif($mf_discount > 0){
                                        $incentive = $total * ($mf_discount/100); 
                                    }elseif($calib_discount > 0){
                                        $incentive = $total * ($calib_discount/100); 
                                    }

                                    $total_incentive += $incentive;
                                ?>
                                <td style="text-align:right; border-top: 0;">
                                    {{ number_format($incentive, 2) }}
                                </td>
                            </tr>
                            @endif
                        {{-- @endif --}}

                        
                    {{-- </tr> --}}
                    @endforeach
                </table>
                <table class="table table-bordered" style="font-size: 9px;">
                    <tr>
                        <td colspan="2" style="text-align:center; border-left: 1; border-top: 1; border-bottom: 1; border-right: 0;">
                            Amount in Words:
                        </td>
                        <td colspan="13" style="text-align:center; border-left: 0; border-right: 0; border-top: 1; border-bottom: 1;">
                            {{ ucwords($numToWords->convertNumberToWords($total_incentive)) }}
                        </td>
                        <td colspan="4" style="text-align:right;">
                            TOTAL: <span style="text-align: right;">{{ number_format($total_incentive, 2) }}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

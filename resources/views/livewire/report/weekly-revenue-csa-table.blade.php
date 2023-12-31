<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading text-center" style="padding-top: 20px">
                                <p style="font-size: 10px; line-height: 0.05"><i>Dumaguete Wellmade Plant</i></p>
                                <h5>Job Order Week-end Report to {{ $start_date }} - {{ $end_date }}</h5>
                                <h5 class=" "><b>Revenue Generated by CSA</b></h5>                                         
                            </div>
                            <br><br><br><br>                     
                            <div class="panel-body">
                                
                                <div class="col-md-12">    
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-labeled btn-md" wire:click="addGenerate"  style=" border-radius: 3px; margin-right: 3px"> <i class="fa fa-filter"></i> Generate</button>       
                                        <button class="btn-md btn btn-purple" wire:click="printPdf" style=" border-radius: 3px;" title="Print"> <i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div>                                
                                <br><br><br>
                                <div class="table-responsive">     
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size:10px; align-text: center;">                                       
                                        <thead class="bg-trans-dark">
                                            <tr>
                                                <th colspan="2"  style="line-height: 0.9; width: 3%;">Customer</th>
                                                <th colspan="2"  style="line-height:   1; width: 3%; text-align: center;">JO Num</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 3%; text-align: center;">SO/SI</th>
                                                <th colspan="2"  style="line-height:   1; width: 2%">JOCN</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 2%;" class="text-center">Amount</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 2%;" class="text-center">TAX</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 2%;">Discount</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 4%;">Incentive</th>
                                                <th colspan="2"  style="line-height: 0.9; width: 4%;">Total</th>
                                                @foreach ($csa_types as $csa_type)
                                                    <th colspan="2"  style="line-height: 0.9; width: 4%;">{{ $csa_type->csa_type }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $week_end_grand_total_amount = 0;
                                                $week_end_grand_total_tax = 0;
                                                $week_end_grand_total_discount = 0;
                                                $week_end_grand_total_incentive = 0;
                                                $week_end_grand_total_total = 0;
                                                foreach ($csa_types as $value) {
                                                    ${str_replace(' ', '_', strtolower('week_end_grand_total_' . trim(preg_replace('/[\s.,-]+/', '_', $value->csa_type))))} = 0;
                                                }
                                                $counter = 0;
                                            @endphp
                                            @foreach ($revenue_csa as $key => $data)
                                                <tr>
                                                    <th style="line-height: 0.9; color: rgb(187, 184, 184);" colspan="{{ (count($csa_types) * 2) + 18 }}" class="text-left"><b>{{ $key }}</b></th>
                                                </tr>
                                                @php
                                                    $total_each_date = 0;
                                                    $sub_total_amount = 0;
                                                    $sub_total_tax = 0;
                                                    $sub_total_discount = 0;
                                                    $sub_total_incentive = 0;
                                                    $sub_total_total = 0;
                                                    foreach ($csa_types as $value) {
                                                        ${str_replace(' ', '_', strtolower('sub_total_' . trim(preg_replace('/[\s.,-]+/', '_', $value->csa_type))))} = 0;
                                                    }
                                                @endphp
                                                @foreach ($data as $key => $value)
                                                    <tr>
                                                        <td colspan="2"  style="line-height: 0.9; width: 3%;">{{ ++$counter. ". " }} {{ $value['job_order']['client_profile']['name'] ?? '' }}</td>
                                                        <td colspan="2"  style="line-height:   1; width: 3%; text-align: center;">{{ $value['job_order']['jo_no'] ?? '' }}</td>
                                                        <td colspan="2"  style="line-height: 0.9; width: 3%; text-align: center;">
                                                            @if ($value['invoice_type_id'] == 1)
                                                                {{ $value['sb_invoice_no'] ?? '' }}
                                                            @endif
                                                        </td>
                                                        <td colspan="2"  style="line-height:   1; width: 2%">{{ $value['wv_invoice_no'] ?? '' }}</td>
                                                        <td colspan="2"  style="line-height: 0.9; width: 2%; text-align:right;" class="text-center">
                                                            {{ number_format($value['all_total_debits'] + $value['job_order']['discount'], 2) ?? '' }}
                                                            @php
                                                                $sub_total_amount += $value['all_total_debits'] + $value['job_order']['discount'];
                                                            @endphp
                                                        </td>
                                                        <td colspan="2"  style="line-height: 0.9; width: 2%; text-align:right;" class="text-center">
                                                            @if ($value['invoice_type_id'] == 1)
                                                                {{ number_format(round(($value['all_total_debits']/1.12) * .12), 2) ?? '' }}
                                                                @php
                                                                    $tax = round(($value['all_total_debits']/1.12) * .12);
                                                                    $sub_total_tax += $tax;
                                                                @endphp
                                                            @else
                                                                {{ number_format(0, 2) }}
                                                                @php
                                                                    $tax = 0;
                                                                    $sub_total_tax += $tax;
                                                                @endphp
                                                            @endif
                                                        </td>
                                                        <td colspan="2"  style="line-height: 0.9; width: 2%; text-align:right;">
                                                            {{ number_format($value['job_order']['discount'], 2) }}
                                                            @php
                                                                $sub_total_discount += $value['job_order']['discount'];
                                                            @endphp
                                                        </td>
                                                        <td colspan="2"  style="line-height: 0.9; width: 4%; text-align:right;">
                                                            {{ number_format($value['job_order']['total_incentive'], 2) }}
                                                            @php
                                                                $sub_total_incentive += $value['job_order']['total_incentive'];
                                                            @endphp
                                                        </td>
                                                        <td colspan="2"  style="line-height: 0.9; width: 4%; text-align:right;">
                                                            {{ number_format(($value['all_total_debits'] + $value['job_order']['discount']) - ($tax + $value['job_order']['discount'] + $value['job_order']['total_incentive']), 2)  }}
                                                            @php
                                                                $total_each_date = ($value['all_total_debits'] + $value['job_order']['discount']) - ($tax + $value['job_order']['discount'] + $value['job_order']['total_incentive']);
                                                                $sub_total_total += $total_each_date;
                                                            @endphp
                                                        </td>
                                                        @foreach ($csa_types as $key => $csa_type)
                                                            @if ($value['job_order']['client_profile']['for_c_s_a']['id'] == $csa_type->id)
                                                                <td colspan="2"  style="line-height: 0.9; width: 4%; text-align:right;">{{ number_format($total_each_date, 2) }}</td>
                                                            @else
                                                                <td colspan="2"  style="line-height: 0.9; width: 4%; text-align:right;">{{ number_format(0, 2) }}</td>
                                                            @endif
                                                            
                                                            @if ($value['job_order']['client_profile']['for_c_s_a']['id'] == $csa_type->id)
                                                                @php
                                                                    ${str_replace(' ', '_', strtolower('sub_total_' . trim(preg_replace('/[\s.,-]+/', '_', $csa_type->csa_type))))} += $total_each_date;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <td colspan="8"  style="line-height:   1; width: 2%; text-align: right;"><b><u>Sub-total:</u></b></td>
                                                    <td colspan="2"  style="line-height: 0.9; width: 12%; text-align: right;"><b><u> {{ number_format($sub_total_amount, 2) }} </u></b></td>
                                                    <td colspan="2"  style="line-height: 0.9; width: 12%; text-align: right;"><b><u> {{ number_format($sub_total_tax, 2) }} </u></b></td>
                                                    <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u> {{ number_format($sub_total_discount, 2) }} </u></b></td>
                                                    <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u>{{ number_format($sub_total_incentive, 2) }}</u></b></td>
                                                    <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u> {{ number_format($sub_total_total, 2) }} </u></b></td>
                                                    @foreach ($csa_types as $value)
                                                        <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u>{{ number_format(${str_replace(' ', '_', strtolower('sub_total_' . trim(preg_replace('/[\s.,-]+/', '_', $value->csa_type))))}, 2) }}</u></b></td>
                                                    @endforeach
                                                </tr>
                                                @php
                                                    $week_end_grand_total_amount += $sub_total_amount;
                                                    $week_end_grand_total_tax += $sub_total_tax;
                                                    $week_end_grand_total_discount += $sub_total_discount;
                                                    $week_end_grand_total_incentive += $sub_total_incentive;
                                                    $week_end_grand_total_total += $sub_total_total;
                                                    foreach ($csa_types as $value) {
                                                        ${str_replace(' ', '_', strtolower('week_end_grand_total_' . trim(preg_replace('/[\s.,-]+/', '_', $value->csa_type))))} += ${str_replace(' ', '_', strtolower('sub_total_' . trim(preg_replace('/[\s.,-]+/', '_', $value->csa_type))))};
                                                    }
                                                @endphp
                                            @endforeach

                                            <tr>
                                                <td colspan="8"  style="line-height:   1; width: 2%; text-align: right;"><b><u>Week-end Grand-total:</u></b></td>
                                                <td colspan="2"  style="line-height: 0.9; width: 12%; text-align:right;"><b><u> {{ number_format($week_end_grand_total_amount, 2) }} </u></b></td>
                                                <td colspan="2"  style="line-height: 0.9; width: 12%; text-align:right;"><b><u> {{ number_format($week_end_grand_total_tax, 2) }} </u></b></td>
                                                <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u> {{ number_format($week_end_grand_total_discount, 2) }} </u></b></td>
                                                <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u> {{ number_format($week_end_grand_total_incentive, 2) }} </u></b></td>
                                                <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u>{{ number_format($week_end_grand_total_total, 2) }}</u></b></td>
                                                @foreach ($csa_types as $value)
                                                    <td colspan="2"  style="line-height: 0.9; width: 4%; text-align: right;"><b><u>{{ number_format(${str_replace(' ', '_', strtolower('week_end_grand_total_' . trim(preg_replace('/[\s.,-]+/', '_', $value->csa_type))))}, 2) }}</u></b></td>
                                                @endforeach
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                            <!--===================================================-->
                            <!--End Data Table-->
                        </div>
                        <!-- The Generate Modal -->
                        <div wire.ignore.self class="modal fade" id="weeklyRevenueCsaModel" tabindex="-1" role="dialog" aria-labelledby="weeklyRevenueCsaModel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" style="width: 400px" role="document">
                               <livewire:report.weekly-revenue-csa-form />
                            </div>
                        </div>                          
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.weekly-revenue-csa-scripts');
                @endsection
        </div>
        
    </div>
    
</div>

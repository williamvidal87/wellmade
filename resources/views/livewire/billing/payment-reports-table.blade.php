<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading text-center" style="padding-top: 20px">
                                <h5>DUMAGUETE WELLMADE VENTURES, INC.</h5>
                                <h5 class=" ">SERVICE INVOICES REGISTER - {{ $invoice_type == 1 ? 'SB' : ($invoice_type == 2 ? 'WV' : 'WV & SB') }}</h5>    
                                <h5>FOR THE MONTH OF {{ $mn == null ? Carbon\Carbon::now()->format('M') : date("F", mktime(0, 0, 0, $mn, 1)) }}, {{ $yr ?? Carbon\Carbon::now()->format('Y') }}</h5>                                         
                            </div>
                            <br><br><br><br>                     
                            <div class="panel-body">
                                
                                <div class="col-md-12">    
                                    <div class="btn-group">                                                                         
                                        <button class="btn btn-primary btn-labeled" wire:click="addGenerate" title="Generate"><i class="btn-label demo-pli-add icon-fw"></i> Generate</button>       
                                        <button class="btn btn-purple btn-labeled" wire:click="printPdf" title="Print"> <i class="btn-label fa fa-print"></i> Print</button>   
                                    </div>                   
                                </div>                                
                                <br><br><br>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                        <thead class="bg-trans-dark">
                                            <tr style="font-size: 10px;">
                                                <th style="line-height: 0.9;">#</th>
                                                <th style="line-height: 0.9;">Invoice Type & No</th>
                                                <th style="line-height: 0.9;">Inv. Date</th>
                                                <th style="line-height: 0.9;">JOAR No.</th>
                                                <th style="line-height: 0.9;">JOAR Date</th>
                                                <th style="line-height: 0.9;">Net Amount</th>
                                                <th style="line-height: 0.9;">Customer</th>
                                                <th style="line-height: 0.9;">Cust. Rep</th>                                              
                                                <th style="line-height: 0.9;">Posted To</th>                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $wv_total = 0;
                                                $sb_total = 0;
                                                $overall_total = 0;
                                            @endphp
                                            @foreach ($payment_reports as $key => $payment_report)
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <!-- The Generate Modal -->
                        <div wire.ignore.self class="modal fade" id="paymentReportModal" tabindex="-1" role="dialog" aria-labelledby="paymentReportModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog " style="width: 400px" role="document">
                                <livewire:billing.payment-reports-form />
                            </div>
                        </div>                          
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.payment-report-scripts'); 
                @endsection
        </div>
        
    </div>
    
</div>

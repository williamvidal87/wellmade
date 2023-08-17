<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading text-center" style="padding-top: 20px">
                                <h5>Wellmade Dumaguete Plant</h5>
                                <h5 class=" ">Job Order Daily Report {{ $start_d != null ? '('. date('Y-m-d', strtotime($start_d)) . ')' : '' }}</h5>    
                                <h5>OPERATION & FINANCE DAILY RECONCILIATION</h5>      
                                <p style="font-size: 10px; line-height: 0.05"><i>*Cutoff time is 2:00pm everyday, any entry more than 2:00pm is carried over to the next working day.</i></p>                                                
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
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size:12px; align-text: center;">                                       
                                        <thead class="bg-trans-dark">
                                            <tr>
                                                <th rowspan="3"  style="line-height: 0.9; padding-bottom: 35px">Timestamp:</th>
                                                <th rowspan="3"  style="line-height:   1;  padding-bottom: 30px; width: 5%">Reference SI/SO/DHI /PR/GR</th>
                                                <th rowspan="3"  style="line-height: 0.9;  padding-bottom: 35px; width: 15%">Customer</th>
                                                <th rowspan="3"  style="line-height:   1;  padding-bottom: 30px; width: 5%">J.O. No. SO/SI</th>
                                                <th rowspan="3"  style="line-height: 0.9;  padding-bottom: 35px; width: 5%">JOCN</th>
                                                <th colspan="4"  style="line-height: 0.9" class="text-center">Collection Received for the Day</th>
                                                <th rowspan="3"  style="line-height: 0.9;  padding-bottom: 35px">Incentives</th>
                                                <th rowspan="3"  style="line-height: 0.9;  padding-bottom: 35px">CSR</th>
                                                <th rowspan="3"  style="line-height: 0.9;  padding-bottom: 35px">Receivables/Remarks</th>                                              
                                            </tr>
                                            <tr>
                                                <th  style="line-height: 0.9" colspan="2"  class="text-center">Operations</th>
                                                <th  style="line-height: 0.9" colspan="2"  class="text-center">Finance</th>
                                            </tr>
                                            <tr >
                                                <th  style="line-height: 0.9; width:80px">Cash</th>
                                                <th  style="line-height: 0.9">Check</th>
                                                <th  style="line-height: 0.9">Cash</th>
                                                <th  style="line-height: 0.9">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $grand_total = 0;
                                                $operations_cash= 0;
                                                $operations_check = 0;
                                                $finance_cash = 0;
                                                $finance_check = 0;

                                                $operations_cash_counter= 0;
                                                $operations_check_counter = 0;
                                                $finance_cash_counter = 0;
                                                $finance_check_counter = 0;
                                                $grand_total_receipt = 0;
                                            ?>
                                            {{-- LOOP FOR THE COUNTER RECEIPTS --}}
                                            @foreach($transaction_top_part as $datas)
                                                @foreach ($datas as $data)
                                                    <tr>
                                                        <td style="line-height: 0.9">{{date('m-d H:i', strtotime($data->date))}}</td>
                                                        <td style="line-height: 0.9">
                                                            @if ($data->invoice_type_id == 1)
                                                                {{$data->sb_invoice_no ?? ''}}
                                                            @else
                                                                {{$data->wv_invoice_no ?? ''}}
                                                            @endif
                                                        </td>
                                                        <td style="line-height: 0.9"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->jobOrder->getClient->name ?? ''}}</td>                                               
                                                        <td style="line-height: 0.9">{{$data->jobOrder->jo_no ?? ''}}</td>
                                                        <td style="line-height: 0.9">
                                                        {{-- Apply the WV in here from the SB --}}
                                                            @if ($data->invoice_type_id == 1)
                                                                {{$data->wv_invoice_no ?? ''}}
                                                            @endif
                                                        </td>
                                                        <td style="line-height: 0.9; text-align: right;">{{ number_format(0, 2) }}</td>
                                                        <td style="line-height: 0.9; text-align: right;">{{ number_format(0, 2) }}</td>
                                                        <td style="line-height: 0.9; text-align: right;">{{ number_format(0, 2) }}</td>
                                                        <td style="line-height: 0.9; text-align: right;">{{ number_format(0, 2) }}</td>
                                                        <td style="line-height: 0.9; text-align: right;">{{ number_format(0, 2) }}</td>
                                                        <td style="line-height: 0.9"> {{ $data->jobOrder->getClient->forCSA->csa_type ?? '' }} </td>
                                                        <?php
                                                        $grand_total += ($data->jobOrder->overall_total);
                                                        // $grand_total_receipt += ($operations_cash_counter + $operations_check_counter + $finance_cash_counter + $finance_check_counter)
                                                        ?>
                                                        
                                                        <td style="line-height: 0.9; text-align: right;">
                                                            {{ number_format(($data->jobOrder->overall_total), 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                            <?php
                                                $operations_sub_total = 0;
                                                $finance_sub_total = 0;
                                                $operations_overall_total = 0;
                                                $finance_overall_total = 0;
                                            ?>
                                            {{-- LOOP FOR THE TRANSACTIONS PAID --}}
                                            @foreach($transaction_particulars as $datas)
                                                    {{-- @if (!in_array($data->transactionSummaryInvoice->id, $pluck_ids)) --}}
                                                        @foreach ($datas as $data)
                                                            <tr>
                                                                <td style="line-height: 0.9">{{date('m-d H:i', strtotime($data->transactionSummaryInvoice->date))}}</td>
                                                                <td style="line-height: 0.9">
                                                                    @if ($data->transactionSummaryReceipt->receipt_type_id == 1)
                                                                        {{ $data->transactionSummaryInvoice->jobOrder->jo_no ?? ''}}
                                                                    @elseif($data->transactionSummaryReceipt->receipt_type_id == 2)
                                                                        {{ str_replace('OR-','', $data->transactionSummaryReceipt->or_transaction)  ?? ''}}
                                                                    @endif
                                                                </td>
                                                                <td style="line-height: 0.9"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->transactionSummaryInvoice->jobOrder->getClient->name ?? ''}}</td>                                               
                                                                <td style="line-height: 0.9">
                                                                    @if ($data->transactionSummaryInvoice->invoice_type_id == 1)
                                                                        {{$data->transactionSummaryInvoice->sb_invoice_no ?? ''}}
                                                                    @else
                                                                        {{$data->transactionSummaryInvoice->wv_invoice_no ?? ''}}
                                                                    @endif
                                                                </td>
                                                                <td style="line-height: 0.9">
                                                                    {{-- Apply the WV in here from the SB --}}
                                                                    @if ($data->transactionSummaryInvoice->invoice_type_id == 1)
                                                                        {{$data->transactionSummaryInvoice->wv_invoice_no ?? ''}}
                                                                    @endif
                                                                </td>
                                                                <td style="line-height: 0.9; text-align: right;">
                                                                    @if ($data->transactionSummaryReceipt->getCollect->type == "Operation")
                                                                        @if ($data->transactionSummaryReceipt->getPaymentType->type == "Cash")
                                                                            {{ number_format($data->transactionSummaryInvoice->jobOrder->overall_total, 2) }}
                                                                            <?php
                                                                                $operations_cash += $data->transactionSummaryInvoice->jobOrder->overall_total;
                                                                            ?>
                                                                        @else
                                                                            {{ number_format(0, 2) }}
                                                                        @endif 
                                                                    @else
                                                                        {{ number_format(0, 2) }}                                                           
                                                                    @endif
                                                                </td>
                                                                <td style="line-height: 0.9; text-align: right;">
                                                                    @if ($data->transactionSummaryReceipt->getCollect->type == "Operation")
                                                                        @if ($data->transactionSummaryReceipt->getPaymentType->type == "Cheque")
                                                                            {{ number_format($data->transactionSummaryInvoice->jobOrder->overall_total, 2) }}
                                                                            <?php
                                                                                $operations_check += $data->transactionSummaryInvoice->jobOrder->overall_total;
                                                                            ?>
                                                                        @else
                                                                            {{ number_format(0, 2) }}
                                                                        @endif  
                                                                    @else
                                                                        {{ number_format(0, 2) }}                                                          
                                                                    @endif
                                                                </td>
                                                                <td style="line-height: 0.9; text-align:right;">
                                                                    @if ($data->transactionSummaryReceipt->getCollect->type == "Finance")
                                                                        @if ($data->transactionSummaryReceipt->getPaymentType->type == "Cash")
                                                                            {{ number_format($data->transactionSummaryInvoice->jobOrder->overall_total, 2) }}
                                                                            <?php
                                                                                $finance_cash += $data->transactionSummaryInvoice->jobOrder->overall_total;
                                                                            ?>
                                                                        @else
                                                                            {{ number_format(0, 2) }}
                                                                        @endif 
                                                                    @else
                                                                        {{ number_format(0, 2) }}                                                           
                                                                    @endif
                                                                </td>
                                                                <td style="line-height: 0.9; text-align:right;">
                                                                    @if ($data->transactionSummaryReceipt->getCollect->type == "Finance")
                                                                        @if ($data->transactionSummaryReceipt->getPaymentType->type == "Cheque")
                                                                            {{ number_format($data->transactionSummaryInvoice->jobOrder->overall_total, 2) }}
                                                                            <?php
                                                                                $finance_check += $data->transactionSummaryInvoice->jobOrder->overall_total;
                                                                            ?>
                                                                        @else
                                                                            {{ number_format(0, 2) }}
                                                                        @endif
                                                                    @else
                                                                        {{ number_format(0, 2) }}                                                           
                                                                    @endif
                                                                </td>
                                                                <td style="line-height: 0.9; text-align: right;">
                                                                    {{ number_format(0, 2) }}
                                                                </td>
                                                                <td style="line-height: 0.9"> {{ $data->transactionSummaryInvoice->jobOrder->getClient->forCSA->csa_type ?? '' }} </td>
                                                                <td style="line-height: 0.9">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                            @endforeach
                                        </tbody>    
                                        <thead>
                                            <tr>
                                                <th style="line-height: 0.9" colspan="7" class="text-right">Unincluded Incentive:</th>  
                                                <th style="line-height: 0.9" colspan='2'></th>                                           
                                            </tr>
                                        </thead>    
                                        <tbody>
                                            <tr>
                                                <td style="line-height: 0.9; border-bottom: hidden; padding-top:3px" >Certified By:</td>
                                                <td style="line-height: 0.9; border-bottom: hidden; padding-top:3px" >Audited By:</td>
                                                <td style="line-height: 0.9; text-align: right" colspan="3">Sub-Total:</td>
                                                <td style="line-height: 0.9; text-align: right;"> {{ number_format($operations_cash ?? 0, 2) }} </td>  
                                                <td style="line-height: 0.9; text-align: right;"> {{ number_format($operations_check ?? 0, 2) }} </td>    
                                                <td style="line-height: 0.9; text-align: right;"> {{ number_format($finance_cash, 2) }} </td>
                                                <td style="line-height: 0.9; text-align: right;"> {{ number_format($finance_check, 2) }} </td>
                                                <td style="line-height: 0.9; text-align:center; border-bottom: hidden" colspan="2">Incentive Total:</td>
                                                <td style="line-height: 0.9; text-align:center; border-bottom: hidden" >Grand Total:</td>
                                            </tr>
                                            <tr>                                               
                                                <td style="line-height: 0.9">Plant Admin</td>
                                                <td style="line-height: 0.9">Finance</td>
                                                <td style="line-height: 0.9; text-align: right" colspan="3">Total:</td>
                                                <td style="line-height: 0.9; text-align:right" colspan="2"> {{ number_format($operations_cash + $operations_check ?? 0, 2) }} </td>
                                                <td style="line-height: 0.9; text-align:right" colspan="2"> {{ number_format( $finance_cash + $finance_check, 2) }} </td>
                                                
                                                <td style="line-height: 0.9" colspan="2"></td>
                                                <td style="line-height: 0.9; text-align: right;">{{ number_format($grand_total, 2) }}</td>                                                                                 
                                            </tr>                                            
                                        </tbody>   
                                        <thead>
                                            <tr>
                                                <th colspan="12" style="border-left: hidden; border-right: hidden"></th>
                                            </tr>
                                            <tr class="bg-trans-dark ">
                                                <th style="line-height: 0.9; padding-bottom: 30px " rowspan="2">Timestamp:</th>
                                                <th style="line-height:   1; padding-bottom: 25px;" rowspan="2">Job Order No.</th>
                                                <th style="line-height: 0.9; padding-bottom: 30px " colspan="2" rowspan="2">Customer</th>                                             
                                                <th style="line-height: 0.9; padding-bottom: 30px " rowspan="2">CSA</th>
                                                <th style="line-height: 0.9; text-align:center" colspan="5">JOB ORDERS</th>
                                                <th style="line-height: 0.9; text-align:center; padding-bottom: 30px" colspan="2" rowspan="2">Remarks</th>                                               
                                            </tr>
                                            <tr class="bg-trans-dark ">
                                                <th style="line-height: 0.9">Date Start:</th>
                                                <th style="line-height: 0.9">Date Commit:</th>
                                                <th style="line-height: 0.9">Cost Center:</th>
                                                <th style="line-height: 0.9">On-Going</th>
                                                <th style="line-height: 0.9">Received:</th>                     
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <?php
                                                $on_going_total = 0;
                                                $job_order_total = 0;
                                                $overall_er = 0;
                                                $overall_mf = 0;
                                                $overall_calib = 0;
                                                $overall_total = 0;
                                                $total = 0;
                                            ?>
                                            @foreach($job_order as $data)
                                            <tr>
                                                <td style="line-height: 0.9">{{$data->created_at->format('m-d H:i')}}</td>
                                                <td style="line-height: 0.9">{{$data->jo_no}}</td>
                                                <td style="line-height: 0.9" colspan="2"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->getClient->name ?? ''}}</td>
                                                <td style="line-height: 0.9">{{$data->getCSA->csa_type}}</td>
                                                <td style="line-height: 0.9">{{isset($data->date_receive) ? $data->date_receive->format('Y-m-d') : ''}}</td>
                                                <td style="line-height: 0.9">{{isset($data->date_commited) ? $data->date_commited->format('Y-m-d') : ''}}</td>
                                                <?php
                                                    $work_orders = "";
                                                    foreach ($data->WorkOrders as $key => $value) {
                                                        if($value->mf_work_group_id){
                                                            if(!str_contains($work_orders, "MF")){
                                                                $work_orders .= "MF ";
                                                            }
                                                        }elseif($value->er_work_group_id){
                                                            if (!str_contains($work_orders, "ER")) {
                                                                $work_orders .= "ER ";
                                                            }
                                                        }elseif($value->calib_work_group_id){
                                                            if (!str_contains($work_orders, "CALIB")) {
                                                                $work_orders .= "CALIB ";
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <?php
                                                    $total = 0;
                                                    foreach ($data->WorkOrders as $datas) {
                                                            $overall_er = 0;
                                                            $overall_mf = 0;
                                                            $overall_calib = 0;
                                                        if($data->payment_status_id == 13){
                                                            if($datas->mf_work_group_id != null){
                                                                if($datas->max_discount == 0){
                                                                    $datas->max_discount == 1;
                                                                    $output = 0;
                                                                }else{
                                                                    $output = (($datas->price + $datas->amount_increase) * $datas->qty) / $datas->max_discount;
                                                                }

                                                                $overall_mf += (($datas->price+$datas->amount_increase) * $datas->qty) - $output;
                                                                $total += $overall_mf;
                                                            }

                                                            if($datas->er_work_group_id != null){
                                                                if($datas->max_discount == 0){
                                                                    $datas->max_discount == 1;
                                                                    $output = 0;
                                                                }else{
                                                                    $output = (($datas->price + $datas->amount_increase) * $datas->qty) / $datas->max_discount;
                                                                }

                                                                $overall_er += (($datas->price+$datas->amount_increase) * $datas->qty) - $output;                 
                                                                $total += $overall_er;
                                                            }

                                                            if($datas->calib_work_group_id != null){
                                                                if($datas->max_discount == 0){
                                                                    $datas->max_discount == 1;
                                                                    $output = 0;
                                                                }else{
                                                                    $output = (($datas->price + $datas->amount_increase) * $datas->qty) / $datas->max_discount;
                                                                }

                                                                $overall_calib += (($datas->price+$datas->amount_increase) * $datas->qty) - $output;
                                                                $total += $overall_calib;
                                                            }
                                                        }
                                                        $job_order_total += $overall_er + $overall_mf + $overall_calib;
                                                    }
                                                ?>
                                                <td style="line-height: 0.9">
                                                    {{ $work_orders }}
                                                </td>
                                                <td style="line-height: 0.9; text-align: right;">
                                                    @if ($data->payment_status_id == 13)
                                                        {{ number_format($total, 2) }}
                                                    @endif
                                                </td>
                                                <td style="line-height: 0.9; text-align: right;">
                                                    @if ($data->payment_status_id == 12)
                                                        {{ number_format($data->overall_total, 2) }}
                                                        <?php
                                                            $on_going_total += $data->overall_total;
                                                        ?>
                                                    @endif
                                                </td>
                                                <td style="line-height: 0.9" colspan="2">
                                                    {{ $data->remarks ?? '' }}
                                                </td>                                               
                                            </tr>
                                            @endforeach
                                            <?php
                                                $overall_total += $job_order_total + $on_going_total;
                                            ?>
                                            <tr>
                                                <td style="line-height: 0.9; text-align: right" colspan="8">Total:</td>
                                                <td style="line-height: 0.9; text-align:right;" colspan="2">
                                                    {{ number_format($overall_total, 2) }}
                                                </td>
                                                <td style="line-height: 0.9" colspan="3">
                                                    {{ $data->remarks ?? '' }}
                                                </td>
                                            </tr>                                          
                                        </tbody>                        
                                    </table>
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size:11px;">              
                                        <thead>
                                            <tr>
                                                <th colspan="6" style="line-height: 0.9" class="text-center">Completed Transactions Waiting For SO Processing</th>
                                            </tr>
                                            <tr class="bg-trans-dark">
                                                <th style="line-height: 0.9; text-align:center" >JO#</th>
                                                <th style="line-height: 0.9; text-align:center" >Date Created</th>
                                                <th style="line-height: 0.9; text-align:center" >Date Completed</th>
                                                <th style="line-height: 0.9; text-align:center" >Customer</th>
                                                <th style="line-height: 0.9; text-align:center" >CSA</th>
                                                <th style="line-height: 0.9; text-align:center" >Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $job_order_total_pending = 0;
                                            ?>
                                            @foreach($job_order_pending as $key => $data)
                                            @if ($data->getJobOrderTransaction == null)
                                            <tr>
                                                <td style="line-height: 0.9" >{{$data->jo_no ?? ''}}</td>
                                                <td style="line-height: 0.9" >{{ isset($data->date_receive) ? $data->date_receive->format('Y-m-d') : '' }}</td>
                                                <td style="line-height: 0.9" >{{ isset($data->date_commited) ? $data->date_commited->format('Y-m-d') : '' }}</td>
                                                @if($data->client_id != null)
                                                    <td style="line-height: 0.9"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->getClient->name ?? ''}}</td>
                                                @else
                                                    <td style="line-height: 0.9"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->getClient->name ?? ''}}</td>
                                                @endif                                              
                                                <td style="line-height: 0.9;text-align:center" >{{$data->getCSA->csa_type ?? ''}}</td>
                                                <?php
                                                    $overall_er_total = 0;
                                                    $overall_mf_total = 0;
                                                    $overall_calib_total = 0;
                                                    foreach ($data->WorkOrders as $datas) {
                                                            if($datas->mf_work_group_id != null){

                                                                if($datas->max_discount == 0){
                                                                    $datas->max_discount == 1;
                                                                    $output = 0;
                                                                }else{
                                                                    $output = (($datas->price + $datas->amount_increase) * $datas->qty) / $datas->max_discount;
                                                                }

                                                                $overall_mf_total += (($datas->price+$datas->amount_increase) * $datas->qty) - $output;
                                                            }
                                                            
                                                            if($datas->er_work_group_id != null){
                                                                if($datas->max_discount == 0){
                                                                    $datas->max_discount == 1;
                                                                    $output = 0;
                                                                }else{
                                                                    $output = (($datas->price + $datas->amount_increase) * $datas->qty) / $datas->max_discount;
                                                                }

                                                                $overall_er_total += (($datas->price+$datas->amount_increase) * $datas->qty) - $output;                 
                                                            }
                                                            
                                                            if($datas->calib_work_group_id != null){
                                                                if($datas->max_discount == 0){
                                                                    $datas->max_discount == 1;
                                                                    $output = 0;
                                                                }else{
                                                                    $output = (($datas->price + $datas->amount_increase) * $datas->qty) / $datas->max_discount;
                                                                }

                                                                $overall_calib_total += (($datas->price+$datas->amount_increase) * $datas->qty) - $output;
                                                            }
                                                    }
                                                ?>
                                                <?php
                                                    $job_order_total_pending += $overall_er_total + $overall_mf_total + $overall_calib_total; 
                                                ?>
                                                <td style="line-height: 0.9; text-align:right" >
                                                    {{number_format(($overall_er_total + $overall_mf_total + $overall_calib_total), 2) }}
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            <tr>
                                                <td colspan="4" style="line-height: 0.9;text-align:right; margin-right: 20px" >TOTAL:</td>
                                                <td colspan='2' style="text-align:right">
                                                    {{ number_format($job_order_total_pending, 2) }}
                                                </td>
                                            </tr>   
                                            <tr>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center; padding-bottom: 40px">Total Cash Fund:</td>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center">Cash in Box:</td>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center">Expenses for tde day:</td>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center">Total Cash & Expenses:</td>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center">Net Petty Cash:</td>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center">Cash Short or Over:</td>
                                            </tr>
                                            <tr>
                                                {{-- <td colspan="7" style="line-height: 0.9; text-align:center">isong</td> --}}
                                            </tr>
                                            <tr>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center; padding-bottom: 60px">Net Remitted:</td>
                                                <td rowspan="2" style="line-height: 0.9; text-align:center">Cash Remitted:</td>
                                                <td rowspan="2"style="line-height: 0.9; text-align:center">Total Petty Cash Replenished:</td>
                                                <td colspan="3"style="line-height: 0.9; text-align:center; text-align: center;">Petty Cash Per Cost Center</td>                                               
                                            </tr>
                                            <tr>
                                                <td style="line-height: 0.9; text-align:center; padding-top: 4px">Operations:</td>
                                                <td style="line-height: 0.9; text-align:center;padding-top: 4px">Warehouse:</td>
                                                <td style="line-height: 0.9; text-align:center;padding-top: 4px">Incentive:</td>
                                            </tr>                                        
                                        </tbody>
                                      
                                    </table>
                                </div>    
                            </div>
                            <!--===================================================-->
                            <!--End Data Table-->
                        </div>
                        <!-- The Generate Modal -->
                        <div wire.ignore.self class="modal fade" id="reconciliationModal" tabindex="-1" role="dialog" 
                        aria-labelledby="reconciliationModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog " style="width: 400px" role="document">
                               @include('livewire.report.reconciliation-form')
                            </div>
                        </div>                          
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.reconciliation-scripts');
                @endsection
        </div>
        
    </div>
    
</div>

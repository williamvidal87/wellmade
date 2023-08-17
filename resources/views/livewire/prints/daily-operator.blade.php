<style>
    h6,{text-align:center}
    
    table, th, td {
      border: 0.5px solid black;    
      border-collapse: collapse;
      font-size: 10px;
    }
</style>
<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading text-center" style="padding-top: 20px">
                                <h6 style="line-height: 20%; padding-top: 5px">Dumaguete Wellmade Ventures Inc. - Dumaguete Plant</h6>
                                <h6 style="line-height: 20%; margin-bottom: 0">{{ $work_type_id == 1 ? 'MF' : ($work_type_id == 2 ? 'ER' : ($work_type_id == 3 ? 'CALIB' : '')) }} DAILY Machine Operator Efficiency & Productivity Performance Review</h6>    
                                <h6 style="line-height: 20%; margin-bottom: 0">For the date of {{ $start_date != null ? '('. date('Y-m-d', strtotime($start_date)) . ')' : '' }}</h6>      
                                <p style="font-size: 8px; padding-top: 0; margin-top: 0; text-align: center"><b>Report as of {{ '('. Carbon\Carbon::now()->format('Y-m-d') . ')' }} by {{ Auth::user()->username ?? '' }}.</b></p> 
                            </div>                    
                            <div class="panel-body">
                                <div class="table-responsive">     
                                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size:10px; align-text: center;">                                       
                                        <thead class="bg-trans-dark">
                                            <tr>
                                                <th rowspan="2"  style="line-height: 0.9;">#</th>
                                                <th rowspan="2"  style="line-height:   1;">JO Date</th>
                                                <th rowspan="2"  style="line-height: 0.9;">Work Order Ref No.</th>
                                                <th rowspan="2"  style="line-height:   1;">Pages(s)</th>
                                                <th colspan="4"  style="line-height: 0.9; text-align:center;">Time</th>
                                                <th colspan="4"  style="line-height: 0.9; text-align:center;">Hours</th>
                                                <th rowspan="2"  style="line-height: 0.9;">Submission of WorkOrder</th>                                              
                                            </tr>
                                            <tr>
                                                <th  style="line-height: 0.9" colspan="2">Start</th>
                                                <th  style="line-height: 0.9" colspan="2">End</th>
                                                <th  style="line-height: 0.9" colspan="1">Productive</th>
                                                <th  style="line-height: 0.9" colspan="1">Overtime</th>
                                                <th  style="line-height: 0.9" colspan="1">Target</th>
                                                <th  style="line-height: 0.9" colspan="1">Eff.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Store all the possible names of operator --}}
                                            @php
                                                $time = 0;
                                                $target_total = 0;
                                                $grand_total_hours = 0;
                                                $counter = 0; 
                                                $total_hours = 0;
                                                $total_eff = 0;
                                                $counter = 0;
                                            @endphp
                                            @foreach ($work_orders as $key => $work_orders)
                                                @php
                                                    $total_hours = 0;
                                                @endphp
                                                <tr>
                                                    <th style="line-height: 0.9; color: rgb(187, 184, 184); text-align:left;" colspan="13">{{ $key }}</th>
                                                </tr>
                                                @foreach ($work_orders as $work_order)
                                                    <tr>
                                                        <td colspan="1"  style="line-height: 0.9; width: 3%;"> {{ ++$counter }}</td>
                                                        <td colspan="1"  style="line-height:   1; width: 8%; text-align: center;">{{ date('Y-M-d', strtotime($work_order['get_work_order']['get_job_order']['date'])) ?? '' }}</td>
                                                        <td colspan="1"  style="line-height: 0.9; width: 6%; text-align: center;">{{ $work_order['get_work_order']['reference_no_id'] ?? '' }}</td>
                                                        <td colspan="1"  style="line-height:   1; width: 2%">
                                                            {{ $work_order['page_no'] ?? '' }}
                                                        </td>
                                                        @php
                                                            $start_time = Carbon\Carbon::createFromFormat('H:i:s', "08:15:00");
                                                            $end_time = Carbon\Carbon::createFromFormat('H:i:s', "16:45:00");

                                                            $work_date_start = Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($work_order['start'])));
                                                            $work_start_time = Carbon\Carbon::createFromFormat('H:i:s', date('H:i:s', strtotime($work_order['start'])));
                                                            $work_date_end = Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($work_order['end'])));
                                                            $work_end_time = Carbon\Carbon::createFromFormat('H:i:s', date('H:i:s', strtotime($work_order['end'])));
                                                            $work_start = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', strtotime($work_order['start'])));
                                                            $work_end = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', strtotime($work_order['end'])));
                                                            $time = 0;
                                                            $work_span_time = 0;
                                                            
                                                            if($work_date_start == $work_date_end){
                                                                $time = $work_start->diffInMinutes($work_end);
                                                                // $total_hours += $time;
                                                            }else{
                                                                // Calculate the time difference from work start
                                                                if(strtotime($work_start_time) >= strtotime($start_time) && strtotime($work_start_time) <= strtotime($end_time)){
                                                                    $time += $work_start_time->diffInMinutes($end_time);
                                                                }

                                                                // Calculate the time difference from work end
                                                                if(strtotime($work_end_time) >= strtotime($start_time) && strtotime($work_end_time) <= strtotime($end_time)){
                                                                    $time += $start_time->diffInMinutes($work_end_time);
                                                                    $work_span_time = $start_time->diffInMinutes($work_end_time);
                                                                }

                                                                //If multiple days are different
                                                                $current_date = Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($work_order['start'])));
                                                                if($work_date_start->diffInDays($work_date_end) > 1){
                                                                    for ($i=0; $i < $work_date_start->diffInDays($work_date_end); $i++) { 
                                                                        // Get the current date
                                                                        $current_date->addDay();
                                                                        if($holidays != null){
                                                                            foreach ($holidays as $data) {
                                                                                if(date('Y-m-d', strtotime($current_date)) == date('Y-m-d', strtotime($data->date))){
                                                                                    continue;
                                                                                }
                                                                            }
                                                                        }elseif(date('l', strtotime($current_date)) == "Sunday"){
                                                                            continue;
                                                                        }elseif (date('Y-m-d', strtotime($current_date)) != date('Y-m-d', strtotime($work_date_end))){
                                                                            $date_hours_diff = 8;
                                                                            $time += 60 * $date_hours_diff; 
                                                                            $work_span_time += $time;
                                                                        }

                                                                    }
                                                                }
                                                                // $total_hours += $time;
                                                            }

                                                            if($time == 0){
                                                                continue;
                                                            }

                                                            $total_hours += $time;
                                                            $productive = floor($time / 60) . "h ". $time % 60 . "m";
                                                            $convert_to_minutes_productive = $time % 60;
                                                            $convert_to_minutes_productive += floor($time / 60) * 60;
                                                            $convert_to_minutes_allot_hours = floor($work_order['allot_hours'] * 60);
                                                        @endphp
                                                        @if ($convert_to_minutes_productive > $convert_to_minutes_allot_hours)
                                                            <td  style="line-height: 0.9; color: red; text-align:center;" colspan="2">{{ date('Y-M-d H:i', strtotime($work_order['start'])) ?? '' }}</td>
                                                            <td  style="line-height: 0.9; color: red; text-align:center;" colspan="2">{{ date('Y-M-d H:i', strtotime($work_order['end'])) ?? '' }}</td>
                                                            <td  style="line-height: 0.9; color: red; text-align:center;" colspan="1">
                                                                <span style="text-align: center;">
                                                                @if (floor($time / 60) == 0)
                                                                    {{ $time % 60 . "m" }}
                                                                @else
                                                                    {{ floor($time / 60) . "h ". $time % 60 . "m" }}
                                                                @endif
                                                                </span>
                                                            </td>
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="1"></td>
                                                            @php
                                                                if($work_order['allot_hours'] < 1){
                                                                    $allot_hour = ($work_order['allot_hours'] * 60);
                                                                    $target_total += ($work_order['allot_hours'] * 60);
                                                                }else{
                                                                    $allot_hour = ($work_order['allot_hours'] * 60);
                                                                    $target_total += ($work_order['allot_hours'] * 60);
                                                                }
                                                                // $target_total += $work_order->allot_hours;
                                                                $convert_to_minutes_allot_hours = floor($work_order['allot_hours'] * 60);
                                                            @endphp
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="1">
                                                                <span style="text-align: center;">
                                                                @if (floor($allot_hour / 60) == 0)
                                                                    {{ $allot_hour % 60 . "m" }}
                                                                @else
                                                                    {{ floor($allot_hour / 60) . "h ". $allot_hour % 60 . "m" }}
                                                                @endif
                                                                </span>
                                                                {{-- {{ floor($allot_hour / 60) . "h ". $allot_hour % 60 . "m" }} --}}
                                                            </td>
                                                            @php
                                                                $efficiency = ($convert_to_minutes_allot_hours / $convert_to_minutes_productive) * 100;
                                                                $total_eff += round($efficiency, 2);
                                                            @endphp
                                                            <td  style="line-height: 0.9; color: red; text-align:center;" colspan="1">{{ round($efficiency, 2) . "%" }}</td>
                                                            <td colspan="1"  style="line-height: 0.9; width: 4%; color: red; text-align: center;">Delayed</td>    
                                                        @else
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="2">{{ date('Y-M-d H:i', strtotime($work_order['start'])) ?? '' }}</td>
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="2">{{ date('Y-M-d H:i', strtotime($work_order['end'])) ?? '' }}</td>
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="1">
                                                                @if (floor($time / 60) == 0)
                                                                    {{ $time % 60 . "m" }}
                                                                @else
                                                                    {{ floor($time / 60) . "h ". $time % 60 . "m" }}
                                                                @endif
                                                            </td>
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="1"></td>
                                                            @php
                                                                if($work_order['allot_hours'] < 1){
                                                                    $allot_hour = ($work_order['allot_hours'] * 60);
                                                                    $target_total += ($work_order['allot_hours'] * 60);
                                                                }else{
                                                                    $allot_hour = ($work_order['allot_hours'] * 60);
                                                                    $target_total += ($work_order['allot_hours'] * 60);
                                                                }
                                                                // $target_total += $work_order->allot_hours;
                                                                $convert_to_minutes_allot_hours = floor($work_order['allot_hours'] * 60);
                                                            @endphp
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="1">
                                                                @if (floor($allot_hour / 60) == 0)
                                                                    {{ $allot_hour % 60 . "m" }}
                                                                @else
                                                                    {{ floor($allot_hour / 60) . "h ". $allot_hour % 60 . "m" }}
                                                                @endif
                                                                {{-- {{ floor($allot_hour / 60) . "h ". $allot_hour % 60 . "m" }} --}}
                                                            </td>
                                                            @php
                                                                $efficiency = ($convert_to_minutes_allot_hours / $convert_to_minutes_productive) * 100;
                                                                $total_eff += round($efficiency, 2);
                                                            @endphp
                                                            <td  style="line-height: 0.9; text-align:center;" colspan="1">{{ round($efficiency, 2) . "%" }}</td>
                                                            <td colspan="1"  style="line-height: 0.9; width: 4%; color: green; text-align: center;">Compliant</td>
                                                        @endif

                                                    </tr>
                                                    @if ($convert_to_minutes_productive > $convert_to_minutes_allot_hours && $work_date_start != $work_date_end)
                                                        <tr>
                                                            <td style="line-height: 0.9; text-align: right;" colspan="8"><small><b>Work Spans multiple days, Actual Productive hours for the requested day:</b></small></td>  
                                                            @php
                                                                Log::debug("BEFORE IMPLEMENT A TIME FORMAT: ". $work_span_time);
                                                                $work_span_time = floor($work_span_time / 60) . "h ". $work_span_time % 60 . "m";
                                                                Log::debug("AFTER IMPLEMENT A TIME FORMAT: ". $work_span_time);
                                                            @endphp
                                                            <td style="line-height: 0.9; color: red; text-align:center;">
                                                                <span style="text-align: center;">
                                                                {{ $work_span_time}}
                                                                </span>
                                                            </td>                                           
                                                            <td style="line-height: 0.9; color: red;" colspan='4'></td>                                           
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                    <tr>
                                                        <td style="line-height: 0.9; text-align:right;" colspan="8"><small><b>Total:</b></small></td>  
                                                        <td style="line-height: 0.9; text-align:center;">
                                                            <span style="text-align: center;">
                                                            @if (floor($total_hours / 60) == 0)
                                                                {{ $total_hours % 60 . "m" }}
                                                            @else
                                                                {{ floor($total_hours / 60) . "h ". $total_hours % 60 . "m" }}
                                                            @endif
                                                            </span>
                                                            @php
                                                                $grand_total_hours += $total_hours;
                                                            @endphp
                                                        </td>    
                                                        <td></td>
                                                        <td style="line-height: 0.9; text-align:center;" colspan='1'>
                                                            <span style="text-align:center;">
                                                            {{ floor($target_total / 60) . "h ". $target_total % 60 . "m" }}
                                                            </span>
                                                        </td>
                                                        @php
                                                            if(round($total_eff/$counter, 2) >= 110){
                                                                $total_eff = round(110, 2);
                                                            }else{
                                                                $total_eff = round($total_eff/$counter, 2);
                                                            }
                                                        @endphp
                                                        <td style="line-height: 0.9; text-align:center;" colspan='1'>
                                                            <span style="text-align:center;">
                                                                {{ $total_eff  . "%" }}(<span>avg</span>)
                                                            </span>
                                                        </td>
                                                        <td></td>
                                                    </tr>
        
                                                    <tr>
                                                        <td style="line-height: 0.9; text-align: right;" colspan="8"><small><b>Total Performance (6.3Hrs/Day):</b></small></td>  
                                                        <td style="line-height: 0.9; text-align:center;">
                                                            <span style="text-align: center;">
                                                                {{ round(($total_hours/378) * 100, 2) . "%" }}
                                                            </span>
                                                        </td>
                                                        <td></td>
                                                        <td style="line-height: 0.9; font-size: 8px;" colspan='1'><small>AVG % Eff. for the day</small></td>
                                                        @php
                                                            $total_performance = (((($total_hours/378) * 100) +  ($total_eff))) / 2
                                                        @endphp  
                                                        {{-- @dd($total_performance) --}}
                                                        <td style="line-height: 0.9; text-align:center;" colspan='1'>
                                                            <span style="text-align: center;">
                                                            @if (round($total_performance, 2) >= 110)
                                                                {{ round(110, 2) . "%" }}(<span>avg</span>)
                                                            @else
                                                                {{ round($total_performance, 2) . "%" }}(<span>avg</span>)
                                                            @endif
                                                            </span>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                            @endforeach
                                            <tr>
                                                <th style="line-height: 0.9; text-align: right;" colspan="8"><b>GRAND TOTAL:</b></th>  
                                                <th style="line-height: 0.9; text-align:center;" colspan='1'>
                                                    <span style="text-align: center;">
                                                    {{ floor($grand_total_hours  / 60) . "h ". $grand_total_hours  % 60 . "m" }}
                                                    </span>
                                                </th>
                                                <td></td>
                                                <th colspan="3"></th>                                  
                                            </tr>

                                            <tr>
                                                <th style="line-height: 0.9" rowspan="2" class="text-right"></th>  
                                                <th style="line-height: 0.9; text-align: center;" colspan='12'>Operations</th>
                                            </tr>

                                            <tr>
                                                <th style="line-height: 0.9; text-align: center;" colspan="6" class="text-right">Nelsa T. Agbay</th>
                                                <th style="line-height: 0.9" colspan="6" class="text-right"></th>
                                            </tr>

                                            <tr>
                                                <th style="font-size: 8px;" colspan="1" class="text-left"><small>Date</small></th>  
                                                <th style="font-size: 8px; text-align: left;" colspan='6'><small>Date</small></th>
                                                <th style="font-size: 8px; text-align: left;" colspan='6'><small>Date</small></th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                            <!--===================================================-->
                            <!--End Data Table-->
                        </div>
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.daily-operator-scripts');
                @endsection
        </div>
        
    </div>
    
</div>

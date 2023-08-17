<style>
    table, th, td {
      border: 0.5px solid black;    
      border-collapse: collapse;
    }
    thead{ 
        display: table-row-group;
        }    
</style>
<div class="col-xs-12">
    <div class="panel">
        <div class="panel-heading text-center">
            <h5 style="padding-bottom:0; margin-bottom:0; text-align: center">Dumaguete Wellmade Venture Inc. - Dumaguete Plant</h5>   
            <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px; text-align: center" class="text-bold">
                    {{ $worker->where('id',$current_workers)->pluck('name')->first() }}
            </h4>
            <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px; text-align: center"  class="text-bold">
                {{ 
                    $current_work_type == 1 ? 'MF' : ((
                    $current_work_type == 2) ? 'ER' : ((
                    $current_work_type == 3) ? 'Calib' : null ))
                }} Machine Operator General Efficiency & Productivity Performance Report</h4>
            <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:0; text-align: center"  class="text-bold">For the month of {{ $start_d != null ? '('. date('M Y', strtotime($start_d)) . ')' : '('. date('M Y',strtotime(now())) . ')' }}</h4>                    
            <p style="padding-top:0; padding-bottom:0; margin-top:0px; margin-bottom:3px; font-size: 12px; text-align: center"  class="text-bold">Report as of  {{ isset($start_d) ? date('Y-m-d') : date('Y-m-d') }} {{ $start_d != null ?  'by'. ' ' .auth()->user()->name  :  'by'. ' ' .auth()->user()->name  }}  </p>    
        </div>      
        <!--Data Table-->                           
        <!--===================================================-->
        <div class="panel-body">        
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size: 11px"> 
                    <thead class="bg-trans-dark">
                        <tr>
                            <th>Date</th>
                            <th>Jo No.</th>
                            <th>Work Desc.</th>
                            <th>Work Type</th>
                            <th>Actual Time (hrs)</th>
                            <th>Commit Time (hrs)</th>
                            <th>% Efficiency</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total_ef = 0; 
                            $total_hours = 0;
                            //TOTAL
                            $total_all_actual_time = 0;
                            $total_all_commited_time = 0;
                        ?>           
                                        
                        @foreach($work_order as $key => $data)
                                                                   
                        <tr>
                            <td>{{ $data->getJobOrder->date->format('Y-m-d') ?? '' }}</td>
                            <td>{{ $data->getJobOrder->jo_no ?? '' }}</td>
                            <td>{{ $data->getScope->scope_name ?? '' }}</td>
                            <td style="text-align: center">{{ $data->getJobType->abbriv_code ?? '' }}</td>                                   
                            @foreach($data->getWorker as $works)

                                <?php 
                                    $start_time = Carbon\Carbon::createFromFormat('H:i:s', "08:15:00");
                                    $end_time = Carbon\Carbon::createFromFormat('H:i:s', "16:45:00");
                                
                                    $work_date_start = Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($works->start)));
                                    $work_start_time = Carbon\Carbon::createFromFormat('H:i:s', date('H:i:s', strtotime($works->start)));
                                    $work_date_end = Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($works->end)));
                                    $work_end_time = Carbon\Carbon::createFromFormat('H:i:s', date('H:i:s', strtotime($works->end)));
                                    $time = 0;
                                    $total_hours = 0;

                                        //Calculate time difference from start to end (same date)
                                    if($work_date_start == $work_date_end){
                                        $time = $works->start->diffInMinutes($works->end);
                                        //add all $time
                                        $total_hours += $time;
                                    }else{
                                        // Calculate the time difference from work start (current date)
                                        if(strtotime($work_start_time) >= strtotime($start_time) && strtotime($work_start_time) <= strtotime($end_time)){
                                            $time += $work_start_time->diffInMinutes($end_time);
                                        }
                                
                                        // Calculate the time difference from work end (next date)
                                        if(strtotime($work_end_time) >= strtotime($start_time) && strtotime($work_end_time) <= strtotime($end_time)){
                                            $time += $start_time->diffInMinutes($work_end_time);
                                        }
                                
                                        //If multiple days are different  (multiple date)
                                        $current_date = Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($works->start)));
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
                                        // add all $time 
                                        $total_hours += $time;
                                    
                                    }

                                    $hours = floor($total_hours / 60);
                                    $minutes =  $total_hours % 60;
                                    $actual_time = $hours + round($minutes/ 60, 2);

                                    //EFFICIENCY
                                    if($actual_time != 0) {
                                    $efficiency = ($works->allot_hours / $actual_time) * 100;
                                    }else{
                                    $efficiency = 0; 
                                    }
                                    //TOTAL
                                    $total_all_actual_time += $actual_time;
                                    $total_all_commited_time += $works->allot_hours;                                          
                                ?>                                      

                                @if($actual_time > $works->allot_hours)   
                                <td class="text-center" style="color: red">{{ $actual_time ?? ""}}</td>
                                    {{--CONTINUE IF $actual time == 0  --}}
                                @elseif ($actual_time == 0)
                                    @php
                                        continue;
                                    @endphp
                                @else
                                <td class="text-center" style="color: green">{{ $actual_time ?? ''}}</td>
                                @endif   
                                 
                                <td class="text-center">{{ $works->allot_hours ?? "" }}</td>  

                              
                                @if($efficiency >= 110)
                                <?php  
                                    $efficiency = 110;
                                ?>
                                 <td class="text-center">{{ 110 }} %</td> 
                                @else
                                <td class="text-center">{{ round($efficiency ?? '') }} %</td>
                                @endif
                                <?php
                                    //TOTAL
                                    $total_ef += $efficiency;
                                ?>
                            @endforeach  
                        @endforeach
                        </tr>                               
                        <tr>
                            <td colspan="4" class="text-right h4">TOTAL:</td>
                            <td class="h4 text-center">{{ $total_all_actual_time ?? '' }}</td>
                            <td class="h4 text-center">{{ $total_all_commited_time ?? '' }}</td> 
                            <td class="h4 text-center">
                            @if($total_ef != 0)                                    
                                {{ round($total_ef/($counter)).' '. "%" }}   
                            @else
                                {{ 0 }}   
                            @endif
                            </td>
                        </tr>                               
                    </tbody>
                </table>
                <table  cellspacing="0" width="100%" style="font-size: 11px"> 
                    <thead>
                        <tr class="h4">
                            <th style="border-left:hidden;text-align:left" >Individual Month-End Report on Production:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="h5">
                            <td>A - Total Actual Time for the month:</td>
                            <td style="width: 32%; padding-left: 40px">{{ $start_d ? $total_all_actual_time : 0 }} hrs</td>
                        </tr>
                        <tr class="h5">
                            <td>B - Total Committed Time for the month:</td>
                           <td style="width: 32%; padding-left: 40px">{{ $start_d ? $total_all_commited_time : 0 }} hrs</td>
                        </tr>
                        <tr class="h5">
                            <td>C - Average Efficiency on Committed Time (A / B):</td>
                            <td style="width: 32%; padding-left: 40px"> 
                                @if($start_d != null)  
                                    @if($total_all_commited_time != 0 && $total_all_actual_time != 0)
                                        @php($average_commited = ($total_all_actual_time / $total_all_commited_time) * 100)                                    
                                        @if($average_commited >= 110)                                                                    
                                            {{ 110 }} %                                    
                                        @else
                                            {{ number_format($average_commited, 2) ." ".'%' }}                               
                                        @endif     
                                    @else
                                        {{0 ." ".'%'}}
                                    @endif
                                @else
                                    {{0 ." ".'%'}}
                                @endif
                            </td>                      
                        </tr>
                        <tr class="h5">
                            <?php
                                $workdays = array();
                                $type = CAL_GREGORIAN;
                                $month = date('n',strtotime($start_d)); // Month ID, 1 through to 12.                                       
                                $year = date('Y',strtotime($start_d)); // Year in 4 digit 2009 format.
                                $day_count = cal_days_in_month($type, $month, $year); // Get the amount of day                                              

                                //loop through all days
                                for ($i = 1; $i <= $day_count; $i++) {
                                    $date = $year.'/'.$month.'/'.$i; //format date
                                    $get_name = date('l', strtotime($date)); //get week day
                                    $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
                                   
                                    if($holidays != null){
                                        foreach ($holidays as $data) {
                                            // Log::debug("DATE FROM: ". date('Y-m-d', strtotime($date)) . " | DATE HOLIDAY: ". date('Y-m-d', strtotime($data->date)));
                                            if(date('Y-m-d', strtotime($date)) == date('Y-m-d', strtotime($data->date))){
                                                continue;
                                            }elseif($day_name == 'Sun'){
                                                continue;
                                            }else{
                                                $workdays[] = $i;      
                                            }
                                        }
                                    }                                                                                  
                                }
                       
                            ?>
                            <td>D - Total Working Hours for the Month ( 85% x 7.5hrs working days):</td>
                            <td style="width: 32%; padding-left: 40px">       
                                @if($start_d != null)                                
                                @php($total_working_hrs = .85 * 7.5 * count($workdays))
                                    {{ $total_all_actual_time != null ? number_format($total_working_hrs, 2) : 0 }} {{ $total_all_actual_time != null ? '('. count($workdays) .'working days for the month' .')' : null }}                                      
                                @else
                                    {{0}} {{'('. 0 .' '.'working days for the month' .')'}}
                                @endif
                            </td>
                        </tr>
                        <tr class="h5">
                            <td>E - Average Efficiency on Working Hours (A / D):</td>
                            <td style="width: 32%; padding-left: 40px">
                                @if($start_d != null && $total_all_actual_time != 0 && $total_working_hrs != 0)            
                                    @php($average_efficiency =  $total_all_actual_time / $total_working_hrs)
                                        {{ number_format($average_efficiency, 2)." "."%" }}
                                @else
                                    {{0 .' '.'%'}}
                                @endif
                            </td>
                        </tr>
                        <tr class="h5">
                            <td>F - Month Transaction on Contribution og Emp to Dept [(Total Emp WO /Total Dept WO)* 100]: </td>
                            <td style="width: 32%; padding-left: 40px">
                            @if($start_d != null)    
                                @if(count($work_order) != null && $total_dept_wo != null)
                                @php($mont_transaction = (count($work_order)/$total_dept_wo) * 100)
                                    @if($mont_transaction >= 110)
                                        {{ 110 }} %
                                    @else
                                        {{ number_format($mont_transaction, 2)." "."%" }}
                                    @endif
                                @else
                                    {{0 ." "."%"}}
                                @endif
                            @else
                                {{0 ." "."%"}}
                            @endif
                            </td>
                        </tr>
                        <tr class="h5">
                            <td style="padding-left: 20px">Total Emp WO:</td>
                           <td style="width: 32%; padding-left: 40px">{{ $start_d ? count($work_order) : 0 }}</td>
                        </tr>
                        <tr class="h5">
                            <td style="padding-left: 20px">Total Dept WO:</td>
                           <td style="width: 32%; padding-left: 40px">{{ $start_d ? $total_dept_wo : 0 }}</td>
                        </tr>
                        <tr class="h5">
                            <td>G - Total Efficiency for the Month [ (C + E) /2]:</td>
                            <td style="width: 32%; padding-left: 40px">
                            @if($start_d != null)
                                @isset($average_commited, $average_efficiency)
                                    <?php
                                    $total_efficiency = $average_commited + $average_efficiency / 2
                                    ?>
                                    @if($total_efficiency >= 110)                                                                    
                                        {{ 110 }} %                                     
                                    @else
                                        {{ number_format($total_efficiency, 2) ." ".'%' }}                               
                                    @endif   
                                @else
                                    {{0  ." ".'%' }}
                                @endisset
                            @else
                                {{0  ." ".'%' }}
                            @endif
                        </tr>
                        <tr class="h5">
                            <td>H - Month Committed Time Contribution of Emp to Dept [( Total Emp Commit / Total Dept Commit) * 100]:</td>
                          
                           
                           <td style="width: 32%; padding-left: 40px">
                            @if($start_d != null)
                                @if($total_all_commited_time != null && $total_emp_commit != null)
                                @php($month_commited_time = ($total_all_commited_time/$total_emp_commit) * 100 )
                                    @if($month_commited_time >= 110)
                                    {{ 110 }} %
                                    @else
                                    {{ number_format($month_commited_time, 2)." "."%" }}
                                    @endif
                                @else
                                    {{0 ." "."%" }} 
                                @endif
                            @else
                                {{0 ." "."%" }} 
                            @endif
                             </td>
                        </tr>
                    </tbody>
                </table>
            </div>    
        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>
    <!-- The Generate Modal -->   
</div>
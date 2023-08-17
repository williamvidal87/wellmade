<div>
    <div class="row">
        <livewire:flash-message.flash-messages />
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-heading text-center">
                    <h5 style="padding-top:10px; padding-bottom:0; margin-bottom:3px">Wellmade Dumaguete Plant</h5>   
                    <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px">Engineering Sales Division</h4>
                    <h4 style="padding-top:0; padding-bottom:0; margin-top:3px; margin-bottom:3px"  class="text-bold">Month-to-Month Complience Report</h4>     
                    <p style="padding-top:0; padding-bottom:0; margin-top:0px; margin-bottom:3px; font-size: 12px"  class="text-bold">Report as of {{  '('. date('Y-m-d',strtotime(now())) .')'  }} </p>                 
                </div>                        
                <br><br>           
                <!--Data Table-->                           
                <!--===================================================-->
                <div class="panel-body">      
                    <div class="btn-group">                                   
                        <button class="btn btn-primary btn-labeled" wire:click="addGenerate" title="Generate"><i class="btn-label demo-pli-add icon-fw"></i> Generate</button>   
                        <button class="btn btn-primary btn-labeled" wire:click="addDelayed" title="Delayed"> <i class="btn-label demo-pli-add icon-fw"></i> Delayed</button>                      
                        <button class="btn btn-purple btn-labeled" wire:click="printPdf" title="Print"> <i class="btn-label fa fa-print"></i> Print</button>                                  
                    </div>                      
                    <br><br>
                    <div class="table-responsive">
                        <table width="100%" style="border: 1px solid black; font-size: 12px">
                            <thead>
                                <tr class="bg-dark">
                                    <th colspan="28" style="border: 1px solid black">ER</th>
                                </tr>
                                <tr class="bg-info">
                                    <th style="border: 1px solid black; width: 9%" colspan="2">{{ $year != null ? $year : '' }}</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JAN</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">FEB</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">MAR</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">APR</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">MAY</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JUN</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JUL</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">AUG</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">SEP</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">OCT</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">NOV</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">DEC</th>
                                    <th style="border: 1px solid black; width: 6%; text-align: center" class="bg-warning" colspan="2">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>                         
                                <!--count only er in given month with status 9 & 5 [done,doing]-->   
                                <tr>    
                                    <td style="border: 1px solid black" colspan="2">Total JOER Started</td>
                                    @php
                                        $jan = "01";
                                        $feb = "02";
                                        $mar = "03";
                                        $apr = "04";
                                        $may = "05";
                                        $june = "06";
                                        $july = "07";
                                        $aug = "08";
                                        $sept = "09";
                                        $oct = "10";
                                        $nov = "11";
                                        $dec = "12";

                                        $jan_er_doing = 0;
                                        $jan_er_done = 0;
                                        $jan_mf_doing = 0;
                                        $jan_mf_done = 0;
                                        $jan_calib_doing = 0;
                                        $jan_calib_done = 0;
                                        $feb_er_doing = 0;
                                        $feb_er_done = 0;
                                        $feb_mf_doing = 0;
                                        $feb_mf_done = 0;
                                        $feb_calib_doing = 0;
                                        $feb_calib_done = 0;
                                        $mar_er_doing = 0;
                                        $mar_er_done = 0;
                                        $mar_mf_doing = 0;
                                        $mar_mf_done = 0;
                                        $mar_calib_doing = 0;
                                        $mar_calib_done = 0;
                                        $apr_er_doing = 0; //
                                        $apr_er_done = 0;
                                        $apr_mf_doing = 0;
                                        $apr_mf_done = 0;
                                        $apr_calib_doing = 0;
                                        $apr_calib_done = 0; //
                                        $may_er_doing = 0;
                                        $may_er_done = 0;
                                        $may_mf_doing = 0;
                                        $may_mf_done = 0;
                                        $may_calib_doing = 0;
                                        $may_calib_done = 0;
                                        $june_er_doing = 0;
                                        $june_er_done = 0;
                                        $june_mf_doing = 0;
                                        $june_mf_done = 0;
                                        $june_calib_doing = 0;
                                        $june_calib_done = 0;
                                        $july_er_doing = 0;
                                        $july_er_done = 0;
                                        $july_mf_doing = 0;
                                        $july_mf_done = 0;
                                        $july_calib_doing = 0;
                                        $july_calib_done = 0;
                                        $aug_er_doing = 0;
                                        $aug_er_done = 0;
                                        $aug_mf_doing = 0;
                                        $aug_mf_done = 0;
                                        $aug_calib_doing = 0;
                                        $aug_calib_done = 0;
                                        $sept_er_doing = 0;
                                        $sept_er_done = 0;
                                        $sept_mf_doing = 0;
                                        $sept_mf_done = 0;
                                        $sept_calib_doing = 0;
                                        $sept_calib_done = 0;
                                        $oct_er_doing = 0;
                                        $oct_er_done = 0;
                                        $oct_mf_doing = 0;
                                        $oct_mf_done = 0;
                                        $oct_calib_doing = 0;
                                        $oct_calib_done = 0;
                                        $nov_er_doing = 0;
                                        $nov_er_done = 0;
                                        $nov_mf_doing = 0;
                                        $nov_mf_done = 0;
                                        $nov_calib_doing = 0;
                                        $nov_calib_done = 0;
                                        $dec_er_doing = 0;
                                        $dec_er_done = 0;
                                        $dec_mf_doing = 0;
                                        $dec_mf_done = 0;
                                        $dec_calib_doing = 0;
                                        $dec_calib_done = 0;
                                    @endphp
                                    @foreach ($monthly_complience as $key => $data)
                                        @foreach ($data as $value)
                                        @php
                                            switch ($key) {
                                                case '01':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $jan_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $jan_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $jan_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $jan_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $jan_calib_done++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $jan_calib_done++;
                                                    }
                                                    break;
                                                case '02':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $feb_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $feb_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $feb_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $feb_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $feb_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $feb_calib_done++;
                                                    }

                                                    break;
                                                case '03':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $mar_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $mar_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $mar_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $mar_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $mar_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $mar_calib_done++;
                                                    }
                                                    
                                                    break;
                                                case '04':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $apr_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $apr_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $apr_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $apr_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $apr_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $apr_calib_done++;
                                                    }
                                                    break;
                                                case '05':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $may_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $may_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $may_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $may_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $may_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $may_calib_done++;
                                                    }
                                                    break;
                                                case '06':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $june_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $june_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $june_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $june_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $june_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $june_calib_done++;
                                                    }
                                                    break;
                                                case '07':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $july_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $july_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $july_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $july_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $july_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $july_calib_done++;
                                                    }
                                                    break;
                                                case '08':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $aug_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $aug_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $aug_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $aug_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $aug_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $aug_calib_done++;
                                                    }
                                                    break;
                                                case '09':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $sept_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $sept_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $sept_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $sept_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $sept_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $sept_calib_done++;
                                                    }
                                                    break;
                                                case '10':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $oct_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $oct_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $oct_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $oct_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $oct_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $oct_calib_done++;
                                                    }
                                                    break;
                                                case '11':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $nov_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $nov_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $nov_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $nov_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $nov_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $nov_calib_done++;
                                                    }
                                                    break;
                                                case '12':
                                                    if($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 4  && $value->getWorkOrder->work_order_start_id != null){
                                                        $dec_er_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 2 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $dec_er_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $dec_mf_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 1 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $dec_mf_done++;

                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 4 && $value->getWorkOrder->work_order_start_id != null){
                                                        $dec_calib_doing++;
                                                    }elseif($value->getWorkOrder->job_type_id == 3 && $value->getWorkOrder->status == 9 && $value->getWorkOrder->work_order_start_id != null){
                                                        $dec_calib_done++;
                                                    }
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                        @endphp                                        
                                        @endforeach
                                    @endforeach
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                                    
                                        {{ $jan_er_doing + $jan_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">             
                                        {{ $feb_er_doing + $feb_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                         
                                        {{ $mar_er_doing + $mar_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                                        
                                        {{ $apr_er_doing + $apr_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">  
                                        {{ $may_er_doing + $may_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $june_er_doing + $june_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $july_er_doing + $july_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $aug_er_doing + $aug_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $sept_er_doing + $sept_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $oct_er_doing + $oct_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $nov_er_doing + $nov_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $dec_er_doing + $dec_er_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $jan_er_doing + $jan_er_done + $feb_er_doing + $feb_er_done + $mar_er_doing + $mar_er_done + $apr_er_doing + $apr_er_done + $may_er_doing + $may_er_done + $june_er_doing + $june_er_done + $july_er_doing + $july_er_done + $aug_er_doing + $aug_er_done + $sept_er_doing + $sept_er_done + $oct_er_doing + $oct_er_done + $nov_er_doing + $nov_er_done + $dec_er_doing + $dec_er_done }}
                                    </th>                                                             
                                </tr>
                                 <!--count only er in given month with status 9  [done]-->   
                                <tr>
                                    <td style="border: 1px solid black" colspan="2">On-Time:</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $jan_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_jan = 0)
                                        @php($total_er_jan+=$jan_er_doing+$jan_er_done)
                                        {{ ($jan_er_done != $total_er_jan ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($jan_er_done == $total_er_jan && $jan_er_done != 0 && $total_er_jan != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $feb_er_done }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                       @php($total_er_feb = 0)
                                       @php($total_er_feb+=$feb_er_doing+$feb_er_done)
                                        {{ ($feb_er_done != $total_er_feb ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($feb_er_done == $total_er_feb && $feb_er_done != 0 && $total_er_feb != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $mar_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_mar = 0)
                                        @php($total_er_mar+=$mar_er_doing+$mar_er_done)
                                         {{ ($mar_er_done != $total_er_mar ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($mar_er_done == $total_er_mar && $mar_er_done != 0 && $total_er_mar != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $apr_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_apr = 0)
                                        @php($total_er_apr+=$apr_er_doing+$apr_er_done)
                                         {{ ($apr_er_done != $total_er_apr ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($apr_er_done == $total_er_apr && $apr_er_done != 0 && $total_er_apr != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $may_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_may = 0)
                                        @php($total_er_may+=$may_er_doing+$may_er_done)
                                         {{ ($may_er_done != $total_er_may ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($may_er_done == $total_er_may && $may_er_done != 0 && $total_er_may != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $june_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_june = 0)
                                        @php($total_er_june+=$june_er_doing+$june_er_done)
                                         {{ ($june_er_done != $total_er_june ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($june_er_done == $total_er_june && $june_er_done != 0 && $total_er_june != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $july_er_done }}
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_july = 0)
                                        @php($total_er_july+=$july_er_doing+$july_er_done)
                                         {{ ($july_er_done != $total_er_july ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($july_er_done == $total_er_july && $july_er_done != 0 && $total_er_july != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">          
                                    {{ $aug_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_aug = 0)
                                        @php($total_er_aug+=$aug_er_doing+$aug_er_done)
                                         {{ ($aug_er_done != $total_er_aug ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($aug_er_done == $total_er_aug && $aug_er_done != 0 && $total_er_aug != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">                        
                                    {{ $sept_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_sept = 0)
                                        @php($total_er_sept+=$sept_er_doing+$sept_er_done)
                                         {{ ($sept_er_done != $total_er_sept ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($sept_er_done == $total_er_sept && $sept_er_done != 0 && $total_er_sept != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $oct_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_oct = 0)
                                        @php($total_er_oct+=$oct_er_doing+$oct_er_done)
                                         {{ ($oct_er_done != $total_er_oct ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($oct_er_done == $total_er_oct && $oct_er_done != 0 && $total_er_oct != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $nov_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_nov = 0)
                                        @php($total_er_nov+=$nov_er_doing+$nov_er_done)
                                         {{ ($nov_er_done != $total_er_nov ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($nov_er_done == $total_er_nov && $nov_er_done != 0 && $total_er_nov != 0  ? 100 ."%" : 0 ."%" ))  }}
                                     
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $dec_er_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_er_id">
                                        @php($total_er_dec = 0)
                                        @php($total_er_dec+=$dec_er_doing+$dec_er_done)
                                         {{ ($dec_er_done != $total_er_dec ? (!empty($calculate_on_time_percentage_er_id) ?  number_format($calculate_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($dec_er_done == $total_er_dec && $dec_er_done != 0 && $total_er_dec != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        @php($total_er_done=0)
                                        @php($total_er_doing=0)
                                        @php($total_er_doing += $jan_er_doing + $feb_er_doing + $mar_er_doing + $apr_er_doing + $may_er_doing + $june_er_doing + $july_er_doing + $aug_er_doing + $sept_er_doing + $oct_er_doing + $nov_er_doing + $dec_er_doing  )
                                        @php($total_er_done += $jan_er_done + $feb_er_done + $mar_er_done + $apr_er_done + $may_er_done + $june_er_done + $july_er_done + $aug_er_done + $sept_er_done + $oct_er_done + $nov_er_done + $dec_er_done )
                                        {{ $total_er_done }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:right" wire:model="calculate_total_on_time_percentage_er_id">
                                        @php($total_done_er_doing=0)
                                        @php($total_done_er_doing += $total_er_doing+$total_er_done)
                                        {{ ($total_er_done != $total_done_er_doing ? (!empty($calculate_total_on_time_percentage_er_id) ? number_format($calculate_total_on_time_percentage_er_id,2) ."%" : 0 ."%") :  ($total_done_er_doing == $total_er_done && $total_er_done != 0 && $total_done_er_doing != 0  ? 100 ."%" : 0 ."%" )) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: left; border-bottom: hidden">DELAYED:</td>
                                    <td style="border: 1px solid black; text-align: right; border-left: hidden; border-bottom: hidden">MAN</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_er_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($total_delayed_er_id) ? $total_delayed_er_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($calculate_total_delayed_percentage_er_id) ? number_format($calculate_total_delayed_percentage_er_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>                                   
                                    <td style="border: 1px solid black; text-align: right; border-bottom: hidden" colspan="2">MACHINE</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_er_id">                             
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 ) }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 ) }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($total_delayed_er_id) ? $total_delayed_er_id  : 0 ) : 0 ) }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($calculate_total_delayed_percentage_er_id) ? number_format($calculate_total_delayed_percentage_er_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: right; border-bottom: hidden" colspan="2">METHOD</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_er_id">                             
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($total_delayed_er_id) ? $total_delayed_er_id  : 0 ) : 0 ) }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($calculate_total_delayed_percentage_er_id) ? number_format($calculate_total_delayed_percentage_er_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; font-size: 6px; font-weight: bold; text-align: left">Signature Coordinator:</td>
                                    <td style="border: 1px solid black; text-align: right; border-left: hidden">MATERIAL</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $jan_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $feb_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_er_id">                             
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $mar_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $apr_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $may_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $june_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $july_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $aug_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $sept_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $oct_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $nov_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($delayed_er_id) ? $delayed_er_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && $dec_er_doing && !empty($calculate_delayed_percentage_er_id) ? number_format($calculate_delayed_percentage_er_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($total_delayed_er_id) ? $total_delayed_er_id  : 0 ) : 0 ) }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_er_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[2]) && !empty($calculate_total_delayed_percentage_er_id) ? number_format($calculate_total_delayed_percentage_er_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>                    
                            </tbody>
                            <thead>
                                <tr class="bg-dark">
                                    <th colspan="28" style="border: 1px solid black">MF</th>
                                </tr>
                                <tr class="bg-info">
                                    <th style="border: 1px solid black; width: 9%" colspan="2">{{  $year != null ? $year : ''  }}</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JAN</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">FEB</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">MAR</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">APR</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">MAY</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JUN</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JUL</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">AUG</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">SEP</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">OCT</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">NOV</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">DEC</th>
                                    <th style="border: 1px solid black; width: 6%; text-align:center" class="bg-warning" colspan="2">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--count only mf in given month with status 9 & 5 [done,doing]-->   
                              <tr>
                                    <td style="border: 1px solid black" colspan="2">Total JOER Started</td>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                                    
                                        {{ $jan_mf_doing + $jan_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">             
                                        {{ $feb_mf_doing + $feb_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                         
                                        {{ $mar_mf_doing + $mar_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                                        
                                        {{ $apr_mf_doing + $apr_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">  
                                        {{ $may_mf_doing + $may_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $june_mf_doing + $june_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $july_mf_doing + $july_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $aug_mf_doing + $aug_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $sept_mf_doing + $sept_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $oct_mf_doing + $oct_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $nov_mf_doing + $nov_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $dec_mf_doing + $dec_mf_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $jan_mf_doing + $jan_mf_done + $feb_mf_doing + $feb_mf_done + $mar_mf_doing + $mar_mf_done + $apr_mf_doing + $apr_mf_done + $may_mf_doing + $may_mf_done + $june_mf_doing + $june_mf_done + $july_mf_doing + $july_mf_done + $aug_mf_doing + $aug_mf_done + $sept_mf_doing + $sept_mf_done + $oct_mf_doing + $oct_mf_done + $nov_mf_doing + $nov_mf_done + $dec_mf_doing + $dec_mf_done }}
                                    </th>          
                                </tr>
                                <tr>
                                    <td style="border: 1px soli" colspan="2">On-Time:</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $jan_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_jan = 0)
                                        @php($total_mf_jan+=$jan_mf_doing+$jan_mf_done)
                                        {{ ($jan_mf_done != $total_mf_jan ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($jan_mf_done == $total_mf_jan && $jan_mf_done != 0 && $total_mf_jan != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $feb_mf_done }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                       @php($total_mf_feb = 0)
                                       @php($total_mf_feb+=$feb_mf_doing+$feb_mf_done)
                                        {{ ($feb_mf_done != $total_mf_feb ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($feb_mf_done == $total_mf_feb && $feb_mf_done != 0 && $total_mf_feb != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $mar_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_mar = 0)
                                        @php($total_mf_mar+=$mar_mf_doing+$mar_mf_done)
                                         {{ ($mar_mf_done != $total_mf_mar ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($mar_mf_done == $total_mf_mar && $mar_mf_done != 0 && $total_mf_mar != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $apr_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_apr = 0)
                                        @php($total_mf_apr+=$apr_mf_doing+$apr_mf_done)
                                         {{ ($apr_mf_done != $total_mf_apr ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($apr_mf_done == $total_mf_apr && $apr_mf_done != 0 && $total_mf_apr != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $may_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_may = 0)
                                        @php($total_mf_may+=$may_mf_doing+$may_mf_done)
                                         {{ ($may_mf_done != $total_mf_may ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($may_mf_done == $total_mf_may && $may_mf_done != 0 && $total_mf_may != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $june_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_june = 0)
                                        @php($total_mf_june+=$june_mf_doing+$june_mf_done)
                                         {{ ($june_mf_done != $total_mf_june ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($june_mf_done == $total_mf_june && $june_mf_done != 0 && $total_mf_june != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $july_mf_done }}
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_july = 0)
                                        @php($total_mf_july+=$july_mf_doing+$july_mf_done)
                                         {{ ($july_mf_done != $total_mf_july ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($july_mf_done == $total_mf_july && $july_mf_done != 0 && $total_mf_july != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">          
                                    {{ $aug_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_aug = 0)
                                        @php($total_mf_aug+=$aug_mf_doing+$aug_mf_done)
                                         {{ ($aug_mf_done != $total_mf_aug ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($aug_mf_done == $total_mf_aug && $aug_mf_done != 0 && $total_mf_aug != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">                        
                                    {{ $sept_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_sept = 0)
                                        @php($total_mf_sept+=$sept_mf_doing+$sept_mf_done)
                                         {{ ($sept_mf_done != $total_mf_sept ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($sept_mf_done == $total_mf_sept && $sept_mf_done != 0 && $total_mf_sept != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $oct_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_oct = 0)
                                        @php($total_mf_oct+=$oct_mf_doing+$oct_mf_done)
                                         {{ ($oct_mf_done != $total_mf_oct ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($oct_mf_done == $total_mf_oct && $oct_mf_done != 0 && $total_mf_oct != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $nov_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_nov = 0)
                                        @php($total_mf_nov+=$nov_mf_doing+$nov_mf_done)
                                         {{ ($nov_mf_done != $total_mf_nov ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($nov_mf_done == $total_mf_nov && $nov_mf_done != 0 && $total_mf_nov != 0  ? 100 ."%" : 0 ."%" ))  }}
                                     
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $dec_mf_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_mf_id">
                                        @php($total_mf_dec = 0)
                                        @php($total_mf_dec+=$dec_mf_doing+$dec_mf_done)
                                         {{ ($dec_mf_done != $total_mf_dec ? (!empty($calculate_on_time_percentage_mf_id) ?  number_format($calculate_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($dec_mf_done == $total_mf_dec && $dec_mf_done != 0 && $total_mf_dec != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        @php($total_mf_done=0)
                                        @php($total_mf_doing=0)
                                        @php($total_mf_doing += $jan_mf_doing + $feb_mf_doing + $mar_mf_doing + $apr_mf_doing + $may_mf_doing + $june_mf_doing + $july_mf_doing + $aug_mf_doing + $sept_mf_doing + $oct_mf_doing + $nov_mf_doing + $dec_mf_doing  )
                                        @php($total_mf_done += $jan_mf_done + $feb_mf_done + $mar_mf_done + $apr_mf_done + $may_mf_done + $june_mf_done + $july_mf_done + $aug_mf_done + $sept_mf_done + $oct_mf_done + $nov_mf_done + $dec_mf_done )
                                        {{ $total_mf_done }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:right" wire:model="calculate_total_on_time_percentage_mf_id">
                                        @php($total_done_mf_doing=0)
                                        @php($total_done_mf_doing += $total_mf_doing+$total_mf_done)
                                        {{ ($total_mf_done != $total_done_mf_doing ? (!empty($calculate_total_on_time_percentage_mf_id) ? number_format($calculate_total_on_time_percentage_mf_id,2) ."%" : 0 ."%") :  ($total_done_mf_doing == $total_mf_done && $total_mf_done != 0 && $total_done_mf_doing != 0  ? 100 ."%" : 0 ."%" )) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: left; border-bottom: hidden">DELAYED:</td>
                                    <td style="border: 1px solid black; text-align: right; border-left: hidden; border-bottom: hidden">MAN</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_mf_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($total_delayed_mf_id) ? $total_delayed_mf_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($calculate_total_delayed_percentage_mf_id) ? number_format($calculate_total_delayed_percentage_mf_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: right; border-bottom: hidden" colspan="2">MACHINE</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_mf_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($total_delayed_mf_id) ? $total_delayed_mf_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($calculate_total_delayed_percentage_mf_id) ? number_format($calculate_total_delayed_percentage_mf_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: right; border-bottom: hidden" colspan="2">METHOD</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_mf_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($total_delayed_mf_id) ? $total_delayed_mf_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($calculate_total_delayed_percentage_mf_id) ? number_format($calculate_total_delayed_percentage_mf_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; font-size: 6px; font-weight: bold; text-align: left">Signature Coordinator:</td>
                                    <td style="border: 1px solid black; text-align: right; border-left: hidden">MATERIAL</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $jan_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $feb_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_mf_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $mar_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $apr_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $may_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $june_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $july_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $aug_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $sept_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $oct_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $nov_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($delayed_mf_id) ? $delayed_mf_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && $dec_mf_doing && !empty($calculate_delayed_percentage_mf_id) ? number_format($calculate_delayed_percentage_mf_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($total_delayed_mf_id) ? $total_delayed_mf_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_mf_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[1]) && !empty($calculate_total_delayed_percentage_mf_id) ? number_format($calculate_total_delayed_percentage_mf_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>

                            </tbody>
                            <thead>
                                <tr class="bg-dark">
                                    <th colspan="28" style="border: 1px solid black">CALIB</th>
                                </tr>
                                <tr class="bg-info">
                                    <th style="border: 1px solid black; width: 9%" colspan="2">{{  $year != null ? $year : '' }}</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JAN</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">FEB</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">MAR</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">APR</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">MAY</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JUN</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">JUL</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">AUG</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">SEP</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">OCT</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">NOV</th>
                                    <th style="border: 1px solid black; width: 6%" colspan="2">DEC</th>
                                    <th style="border: 1px solid black; width: 6%; text-align: center" class="bg-warning" colspan="2">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--count only calib in given month with status 9 & 5 [done,doing]-->
                               <tr>    
                                    <td style="border: 1px solid black" colspan="2">Total JOER Started</td>                                   
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                                    
                                        {{ $jan_calib_doing + $jan_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">             
                                        {{ $feb_calib_doing + $feb_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                         
                                        {{ $mar_calib_doing + $mar_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">                                        
                                        {{ $apr_calib_doing + $apr_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">  
                                        {{ $may_calib_doing + $may_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $june_calib_doing + $june_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $july_calib_doing + $july_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $aug_calib_doing + $aug_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $sept_calib_doing + $sept_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $oct_calib_doing + $oct_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $nov_calib_doing + $nov_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">      
                                        {{ $dec_calib_doing + $dec_calib_done }}
                                    </th>
                                    <th style="border: 1px solid black; text-align:center " colspan="2">
                                        {{ $jan_calib_doing + $jan_calib_done + $feb_calib_doing + $feb_calib_done + $mar_calib_doing + $mar_calib_done + $apr_calib_doing + $apr_calib_done + $may_calib_doing + $may_calib_done + $june_calib_doing + $june_calib_done + $july_calib_doing + $july_calib_done + $aug_calib_doing + $aug_calib_done + $sept_calib_doing + $sept_calib_done + $oct_calib_doing + $oct_calib_done + $nov_calib_doing + $nov_calib_done + $dec_calib_doing + $dec_calib_done }}
                                    </th>  
                                </tr> 
                                <!--count all calib with status done 9 -->
                                <tr>
                                    <td style="border: 1px solid black" colspan="2">On-Time:</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $jan_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_jan = 0)
                                        @php($total_calib_jan+=$jan_calib_doing+$jan_calib_done)
                                        {{ ($jan_calib_done != $total_calib_jan ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($jan_calib_done == $total_calib_jan && $jan_calib_done != 0 && $total_calib_jan != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $feb_calib_done }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                       @php($total_calib_feb = 0)
                                       @php($total_calib_feb+=$feb_calib_doing+$feb_calib_done)
                                        {{ ($feb_calib_done != $total_calib_feb ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($feb_calib_done == $total_calib_feb && $feb_calib_done != 0 && $total_calib_feb != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $mar_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_mar = 0)
                                        @php($total_calib_mar+=$mar_calib_doing+$mar_calib_done)
                                         {{ ($mar_calib_done != $total_calib_mar ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($mar_calib_done == $total_calib_mar && $mar_calib_done != 0 && $total_calib_mar != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $apr_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_apr = 0)
                                        @php($total_calib_apr+=$apr_calib_doing+$apr_calib_done)
                                         {{ ($apr_calib_done != $total_calib_apr ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($apr_calib_done == $total_calib_apr && $apr_calib_done != 0 && $total_calib_apr != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $may_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_may = 0)
                                        @php($total_calib_may+=$may_calib_doing+$may_calib_done)
                                         {{ ($may_calib_done != $total_calib_may ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($may_calib_done == $total_calib_may && $may_calib_done != 0 && $total_calib_may != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $june_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_june = 0)
                                        @php($total_calib_june+=$june_calib_doing+$june_calib_done)
                                         {{ ($june_calib_done != $total_calib_june ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($june_calib_done == $total_calib_june && $june_calib_done != 0 && $total_calib_june != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                       {{ $july_calib_done }}
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_july = 0)
                                        @php($total_calib_july+=$july_calib_doing+$july_calib_done)
                                         {{ ($july_calib_done != $total_calib_july ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($july_calib_done == $total_calib_july && $july_calib_done != 0 && $total_calib_july != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">          
                                    {{ $aug_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_aug = 0)
                                        @php($total_calib_aug+=$aug_calib_doing+$aug_calib_done)
                                         {{ ($aug_calib_done != $total_calib_aug ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($aug_calib_done == $total_calib_aug && $aug_calib_done != 0 && $total_calib_aug != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">                        
                                    {{ $sept_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_sept = 0)
                                        @php($total_calib_sept+=$sept_calib_doing+$sept_calib_done)
                                         {{ ($sept_calib_done != $total_calib_sept ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($sept_calib_done == $total_calib_sept && $sept_calib_done != 0 && $total_calib_sept != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $oct_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_oct = 0)
                                        @php($total_calib_oct+=$oct_calib_doing+$oct_calib_done)
                                         {{ ($oct_calib_done != $total_calib_oct ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($oct_calib_done == $total_calib_oct && $oct_calib_done != 0 && $total_calib_oct != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $nov_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_nov = 0)
                                        @php($total_calib_nov+=$nov_calib_doing+$nov_calib_done)
                                         {{ ($nov_calib_done != $total_calib_nov ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($nov_calib_done == $total_calib_nov && $nov_calib_done != 0 && $total_calib_nov != 0  ? 100 ."%" : 0 ."%" ))  }}
                                     
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        {{ $dec_calib_done }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_on_time_percentage_calib_id">
                                        @php($total_calib_dec = 0)
                                        @php($total_calib_dec+=$dec_calib_doing+$dec_calib_done)
                                         {{ ($dec_calib_done != $total_calib_dec ? (!empty($calculate_on_time_percentage_calib_id) ?  number_format($calculate_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($dec_calib_done == $total_calib_dec && $dec_calib_done != 0 && $total_calib_dec != 0  ? 100 ."%" : 0 ."%" ))  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden">
                                        @php($total_calib_done=0)
                                        @php($total_calib_doing=0)
                                        @php($total_calib_doing += $jan_calib_doing + $feb_calib_doing + $mar_calib_doing + $apr_calib_doing + $may_calib_doing + $june_calib_doing + $july_calib_doing + $aug_calib_doing + $sept_calib_doing + $oct_calib_doing + $nov_calib_doing + $dec_calib_doing  )
                                        @php($total_calib_done += $jan_calib_done + $feb_calib_done + $mar_calib_done + $apr_calib_done + $may_calib_done + $june_calib_done + $july_calib_done + $aug_calib_done + $sept_calib_done + $oct_calib_done + $nov_calib_done + $dec_calib_done )
                                        {{ $total_calib_done }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:right" wire:model="calculate_total_on_time_percentage_calib_id">
                                        @php($total_done_calib_doing=0)
                                        @php($total_done_calib_doing += $total_calib_doing+$total_calib_done)
                                        {{ ($total_calib_done != $total_done_calib_doing ? (!empty($calculate_total_on_time_percentage_calib_id) ? number_format($calculate_total_on_time_percentage_calib_id,2) ."%" : 0 ."%") :  ($total_done_calib_doing == $total_calib_done && $total_calib_done != 0 && $total_done_calib_doing != 0  ? 100 ."%" : 0 ."%" )) }}
                                    </td>                             
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: left; border-bottom: hidden">DELAYED:</td>
                                    <td style="border: 1px solid black; text-align: right; border-left: hidden; border-bottom: hidden">MAN</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_calib_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($total_delayed_calib_id) ? $total_delayed_calib_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 1 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($calculate_total_delayed_percentage_calib_id) ? number_format($calculate_total_delayed_percentage_calib_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: right; border-bottom: hidden" colspan="2">MACHINE</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_calib_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($total_delayed_calib_id) ? $total_delayed_calib_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 2 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($calculate_total_delayed_percentage_calib_id) ? number_format($calculate_total_delayed_percentage_calib_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: right; border-bottom: hidden" colspan="2">METHOD</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_calib_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($total_delayed_calib_id) ? $total_delayed_calib_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 3 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($calculate_total_delayed_percentage_calib_id) ? number_format($calculate_total_delayed_percentage_calib_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; font-size: 6px; font-weight: bold; text-align: left">Signature Coordinator:</td>
                                    <td style="border: 1px solid black; text-align: right; border-left: hidden">MATERIAL</td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $jan_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}    
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $feb_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_delayed_percentage_calib_id">                             
                                        {{(!empty($value ) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $mar_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                               
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $apr_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $may_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $june_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $july_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>                              
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $aug_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $sept_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $oct_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $nov_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($delayed_calib_id) ? $delayed_calib_id : 0 ) : 0 )  }}
                                    </td>         
                                    <td style="border: 1px solid black; text-align:right"  wire:model.defer="calculate_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && $dec_calib_doing && !empty($calculate_delayed_percentage_calib_id) ? number_format($calculate_delayed_percentage_calib_id,2) ."%": 0 . '%' ) : 0 .'%') }}
                                    </td>                                                   
                                    <td style="border: 1px solid black; text-align:center; border-right: hidden" wire:model.defer="total_delayed_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($total_delayed_calib_id) ? $total_delayed_calib_id  : 0 ) : 0 )  }}
                                    </td>
                                    <td style="border: 1px solid black; text-align:right" wire:model.defer="calculate_total_delayed_percentage_calib_id">
                                        {{ (!empty($value) ? ($delayed_reason_id == 4 && $value->getWorkOrder->whereIn('job_type_id',[3]) && !empty($calculate_total_delayed_percentage_calib_id) ? number_format($calculate_total_delayed_percentage_calib_id, 2) .'%' : 0 .'%' ) : 0 .'%' ) }}
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
            <div wire.ignore.self class="modal fade" id="monthlyComplienceReportGenerateModal" tabindex="-1" role="dialog" 
            aria-labelledby="monthlyComplienceReportGenerateModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                   @include('livewire.report.monthly-complience-report-form')
                </div>
            </div>
            <!-- The Generate Delayed -->
            <div wire.ignore.self class="modal fade" id="monthlyComplienceReportDelayedModal" tabindex="-1" role="dialog" 
            aria-labelledby="monthlyComplienceReportDelayedModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" style="width: 400px" role="document">
                   @include('livewire.report.monthly-complience-report-delayed-form')
                </div>
            </div>
        </div>
    </div>
</div>
    @section('custom_script')
        @include('layouts.scripts.monthly-complience-report-script');
    @endsection
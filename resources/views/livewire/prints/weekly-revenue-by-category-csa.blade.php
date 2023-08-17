<div class="row">
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-heading text-center">
                <h5 style="padding-top:10px; text-align:center; padding-bottom:0; margin-bottom:3px">Wellmade Dumaguete Plant</h5>   
                <h4 style="padding-top:0; text-align:center; padding-bottom:0; margin-top:3px; margin-bottom:3px" class="text-bold">Job Order Week-end Report {{$startDate != null ? date('Y-m-d',strtotime($startDate)) : now()->firstOfMonth()->format("Y-m-d")}} - {{$endDate != null ? date('Y-m-d',strtotime($endDate)) :  now()->format("Y-m-d")}}</h4>
                <h4 style="padding-top:0; text-align:center; padding-bottom:0; margin-top:3px; margin-bottom:3px"  class="text-bold">Revenue Generated by CSA per Category</h4>                  
            </div>                        
            <br>               
            <!--Data Table-->                           
            <!--===================================================-->
            <div class="panel-body"> 
                <div class="table-responsive">
                    <table width="100%" style="font-size: 11px" >
                        <thead>
                            <tr class="bg-dark">
                                <th style="border: 1px solid black; text-align: left">Date</th>
                                <th style="text-align:center; border: 1px solid black">Office</th>
                                <th style="text-align:center; border: 1px solid black">CGC</th>
                            </tr>                              
                        </thead>
                        <tbody>
                          
                             @foreach($transaction_summary as $key => $data) 
                           
                                 <tr class="bg-trans-dark">
                                     <td style="border: 1px solid black; font-weight: bold" colspan="3">{{ $key }}</td>
                                 </tr>

                                 @php
                                     $overall_office = 0;  
                                     $overall_salesman = 0;  
                                     $engine_office = 0;
                                     $engine_salesman = 0;
                                     $machining_office = 0;
                                     $machining_salesman = 0;
                                     $calib_office = 0;
                                     $calib_salesman = 0;
                                     $part_office = 0;
                                     $part_salesman = 0;

                                 @endphp
                                 @foreach ($data as $item)
                                     @php
                                         //ADD TOTAL IN SAME DATE
                                         if($item->jobOrder->csa == 1 && $item->jobOrder->er_total != null){
                                             $engine_office += $item->jobOrder->er_total;
                                         }elseif ($item->jobOrder->csa == 2 && $item->jobOrder->er_total != null){
                                             $engine_salesman += $item->jobOrder->er_total;
                                         }

                                         if($item->jobOrder->csa == 1 && $item->jobOrder->mf_total != null){
                                             $machining_office += $item->jobOrder->mf_total;
                                         }elseif ($item->jobOrder->csa == 2 && $item->jobOrder->mf_total != null){
                                             $machining_salesman += $item->jobOrder->mf_total;
                                         }

                                         if($item->jobOrder->csa == 1 && $item->jobOrder->calib_total != null){
                                             $calib_office += $item->jobOrder->calib_total;
                                         }elseif ($item->jobOrder->csa == 2 && $item->jobOrder->calib_total != null){
                                             $calib_salesman += $item->jobOrder->calib_total;
                                         }
                                         
                                         if($item->jobOrder->csa == 1 && $item->jobOrder->part_total != null) {
                                             $part_office += $item->jobOrder->part_total;
                                         }elseif ($item->jobOrder->csa == 2 && $item->jobOrder->part_total != null) {
                                             $part_salesman += $item->jobOrder->part_total;
                                         }

                                         $overall_office = $engine_office + $machining_office + $calib_office + $part_office;
                                         $overall_salesman = $engine_salesman + $machining_salesman + $calib_salesman + $part_salesman;

                                     @endphp
                                 @endforeach
                                 
                                 <tr> 
                                     <td style="text-align: right; border: 1px solid black ">Engine Recon</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($engine_office, 2) }}</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($engine_salesman, 2) }}</td>
                                 </tr>
                                 <tr>
                                     <td style="text-align: right; border: 1px solid black ">Machining & Fabr.</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($machining_office, 2) }}</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($machining_salesman, 2) }}</td>
                                 </tr>
                                 <tr>
                                     <td style="text-align: right; border: 1px solid black ">Calibration</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($calib_office, 2)  }}</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($calib_salesman, 2)  }}</td>
                                 </tr>
                                 <tr>
                                     <td style="text-align: right; border: 1px solid black ">Parts</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($part_office, 2) }}</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($part_salesman, 2) }}</td>
                                 </tr>
                                 <tr class="bg-info">
                                     <td style="text-align: right; border: 1px solid black; font-weight: bold ">TOTAL :</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($overall_office, 2) }}</td>
                                     <td style="text-align: right; border: 1px solid black ">{{ number_format($overall_salesman, 2) }}</td>
                                 </tr>

                             @endforeach 
                             <tr>
                                <th colspan="4" style="border-left: hidden; border-right: hidden; color: #FFFFFF">.</th>
                           </tr>
                             <tr> 
                                 <?php
                                 $er_total_offc = 0;
                                 $er_total_cgc = 0;
                                 $mf_total_offc = 0;
                                 $mf_total_cgc = 0;
                                 $calib_total_offc = 0;
                                 $calib_total_cgc = 0;
                                 $part_total_offc = 0;
                                 $part_total_cgc = 0;
                                 ?>
                               
                                 @foreach ($transaction_summary as $data1)
                                     @foreach ($data1 as $data)
                                         <?php
                                         //ADD TOTAL
                                         if($data->jobOrder->csa == 1) {
                                             $er_total_offc+=$data->jobOrder->er_total;
                                         }elseif($data->jobOrder->csa == 2) {
                                             $er_total_cgc+=$data->jobOrder->er_total;
                                         }
                                         if($data->jobOrder->csa == 1) {
                                             $mf_total_offc+=$data->jobOrder->mf_total;
                                         }elseif($data->jobOrder->csa == 2) {
                                             $mf_total_cgc+=$data->jobOrder->mf_total;
                                         }
                                         if($data->jobOrder->csa == 1) {
                                             $calib_total_offc+=$data->jobOrder->calib_total;
                                         }elseif($data->jobOrder->csa == 2) {
                                             $calib_total_cgc+=$data->jobOrder->calib_total;
                                         }
                                         if($data->jobOrder->csa == 1) {
                                             $part_total_offc+=$data->jobOrder->part_total;
                                         }elseif($data->jobOrder->csa == 2) {
                                             $part_total_cgc+=$data->jobOrder->part_total;
                                         } 

                                         ?>                                            
                                     @endforeach
                                 @endforeach
                                 <td style="text-align: right; border: 1px solid black ">ER TOTAL:</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($er_total_offc,2) }}</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($er_total_cgc, 2) }}</td>
                             </tr>
                             <tr>
                                 <td style="text-align: right; border: 1px solid black ">MF TOTAL:</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($mf_total_offc, 2) }}</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($mf_total_cgc, 2) }}</td>
                             </tr>
                             <tr>
                                 <td style="text-align: right; border: 1px solid black ">CALIB TOTAL:</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($calib_total_offc, 2) }}</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($calib_total_cgc, 2) }}</td>
                             </tr>
                             <tr>
                                 <td style="text-align: right; border: 1px solid black ">PARTS TOTAL:</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($part_total_offc, 2) }}</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($part_total_cgc, 2) }}</td>
                             </tr>
                             <tr class="bg-warning">
                                 <?php
                                 $grand_total_offc = 0;
                                 $grand_total_cgc = 0;
                                 ?>
                                 <?php
                                 $grand_total_offc+=$er_total_offc+$mf_total_offc+$calib_total_offc+$part_total_offc;
                                 $grand_total_cgc+=$er_total_cgc+$mf_total_cgc+$calib_total_cgc+$part_total_cgc;
                                 ?>
                                 <td style="text-align: right; border: 1px solid black; font-weight: bold ">GRAND TOTAL :</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($grand_total_offc, 2) }}</td>
                                 <td style="text-align: right; border: 1px solid black ">{{ number_format($grand_total_cgc, 2) }}</td>
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
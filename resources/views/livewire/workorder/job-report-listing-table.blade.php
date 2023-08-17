<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading text-center" style="padding-top: 20px">
                                <h4 class="text-bold">Daily Consume Report V2</h4>
                                <h4 class="text-bold ">SUMMARY OF CONSUME FOR THE DAY</h4>    
                                <div class="text-center text-bold ">Date of Report: {{ $end_d != null ? '('. date('Y-m-d', strtotime($end_d)) . ')' : now()->format('Y-m-d')}}</div>    
                            </div>
                            <br><br><br>                               
                            <!--Data Table-->                           
                            <!--===================================================-->
                            <div class="panel-body">
                                <div class="btn-group">                                   
                                    <button class="btn btn-primary btn-labeled" wire:click="addGenerate" title="Generate"><i class="btn-label demo-pli-add icon-fw"></i> Generate</button>       
                                    <button class="btn btn-purple btn-labeled" wire:click="printPdf" title="Print"> <i class="btn-label fa fa-print"></i> Print</button>                                  
                                </div>        
                                {{-- <div class="btn-group">                                    --}}
                                    {{-- <button class="btn btn-success btn-md btn-labeled"  wire:click="openModalConsumable" title="Add"><i class="btn-label demo-pli-add icon-fw"></i> Add</button>     --}}
                                    {{-- <button class="btn btn-primary btn-md btn-labeled " style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;; margin-right:5px" title="Generete" wire:click="addGenerate" > <i class="btn-label demo-pli-add icon-fw"></i> Generate</button>                           --}}
                                    {{-- <button class="btn-md " wire:click="printExcel" style="padding: 6px; color: green" title="download"> <i class="fa fa-download"></i> Excel</button> | --}}
                                    {{-- <button class="btn-md" wire:click="printPdf" style="padding: 6px; color: red" title="download"> <i class="fa fa-download"></i> Pdf</button>              --}}
                                {{-- </div>                         --}}
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="font-size: 10px" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th colspan="18"style="color: white">
                                                    ER
                                                </th>
                                            </tr>
                                            <tr class="bg-trans-dark">
                                                <th>#</th>
                                                <th colspan="2" class="text-center">Description</th>                                               
                                                <th>Qty</th> 
                                                <th>Price</th>                                                                                                                              
                                                <th>On-Site</th>
                                                <th>Bench Work's</th>
                                                <th>Boring</th>
                                                <th>Conrod Resizing</th>
                                                <th>Grinding</th>
                                                <th>Honing</th>
                                                <th>Lathe Work's</th>
                                                <th>Line Boring</th>
                                                <th>Surfacing</th>
                                                <th>Tig Welding</th>
                                                <th>ValveSeat Refacing</th>
                                                <th>Washing</th>
                                                <th>Welding Smaw</th> 
                                            </tr>
                                        </thead>
                                        <tbody>     
                                            <?php
                                            // $total=0;                                           
                                            $totalEr=0;
                                            $counter = 0;
                                            ?>                         
                                            @foreach ($request_tools as $index => $request)                                                
                                                @foreach($request->requestToolsData as $data)   
                                                    <?php
                                                    $total_er = $data->qty*$data->getDepartment->unit_price;      //from aquisition_cost to unit_price                                  
                                                    ?>   
                                                    @if($data->getDepartment->department_id == 2 && $request->work_area_id  != null)
                                                        <tr>        
                                                            <td>{{++$counter}}</td>
                                                            <td colspan="2"style="white-space: nowrap;">{{$data->getDepartment->item_code}} - {{$data->getDepartment->name}}</td>                                                   
                                                            <td style="text-align:center">{{$data->qty}}</td>
                                                            <td>{{$data->getDepartment->unit_price}}</td>
                                                            <td>{{$request->getWorkArea->id == 1 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 2 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 3 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 5 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 6 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 7 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 8 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 9 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 10 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 11 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 12 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 13 ? number_format($total_er,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 14 ? number_format($total_er,2) : 0}}</td>
                                                        </tr>   
                                                        <?php
                                                        // $totalEr += $total_er;
                                                        $totalEr += $data->getDepartment->unit_price;
                                                        ?>
                                                    @endif
                                                @endforeach 
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-bold h5" style="text-align: right">
                                                    TOTAL&nbsp;&nbsp;&nbsp;: &nbsp;                                                                                           
                                                </td> 
                                                <td class="text-bold">
                                                    {{number_format($totalEr,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 1)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>  
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 2)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>                                                  
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 3)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">   
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 5)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>                                                  
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 6)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>                                                     
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 7)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>                                                      
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 8)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>                                                      
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 9)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 10)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 11)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 12)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 13)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 2 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 14)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>                                                
                                            </tr>
                                        </tbody>
                                       <thead width=" 100%">
                                            <tr class="bg-dark">
                                                <th colspan="18"style="color: white">
                                                    MF &nbsp;
                                                    {{-- <span class="badge badge-success">{{$request_tools->whereHas('requestToolsData', function ($count) { $count->getDepartment->where('department_id',[4])})->count()}}</span> --}}
                                                </th>
                                            </tr>
                                            <tr class="bg-trans-dark">
                                                <th>#</th>                                              
                                                <th colspan="9" class="text-center">Description</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th class="text-center">Bench Works</th>
                                                <th class="text-center">Gear Milling</th>
                                                <th class="text-center">Lathe Works</th>
                                                <th>On-Site</th>
                                                <th class="text-center">Welding Smaw</th>
                                                <th class="text-center">Welding Tig</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $total=0;                                           
                                            $totalMf=0;
                                            $counter = 0;
                                            ?>                         
                                            @foreach ($request_tools as $request)                                                
                                                @foreach($request->requestToolsData as $data)   
                                                    <?php
                                                    $total_mf = $data->qty*$data->getDepartment->unit_price;                                        
                                                    ?>   
                                                    @if($data->getDepartment->department_id == 4 && $request->work_area_id  != null)
                                                        <tr>          
                                                            <td>{{++$counter}}</td>
                                                            <td colspan="9">{{$data->getDepartment->item_code}} - {{$data->getDepartment->name}}</td>                                                 
                                                            <td style="text-align:center">{{$data->qty}}</td>
                                                            <td>{{$data->getDepartment->unit_price}}</td>
                                                            <td>{{$request->getWorkArea->id == 15 ?  number_format($total_mf,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 16 ?  number_format($total_mf,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 17 ?  number_format($total_mf,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 18 ?  number_format($total_mf,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 19 ?  number_format($total_mf,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 20 ?  number_format($total_mf,2) : 0}}</td>
                                                        </tr>   
                                                        <?php
                                                        // $totalMf += $total_mf;
                                                        $totalMf += $data->getDepartment->unit_price;
                                                        ?>
                                                    @endif
                                                @endforeach 
                                            @endforeach
                                            <tr>
                                                <td colspan="11" class="text-bold h5" style="text-align: right">
                                                    TOTAL&nbsp;&nbsp;&nbsp;: &nbsp;                                                                                         
                                                </td> 
                                                <td class="text-bold">
                                                   {{number_format($totalMf,2)}}
                                                </td>  
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 4 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 15)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>   
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 4 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 16)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td> 
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 4 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 17)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td> 
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 4 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 18)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td> 
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 4 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 19)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td> 
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 4 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 20)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>                                       
                                            </tr>
                                        </tbody>  
                                        <thead width="100%">
                                            <tr class="bg-dark">
                                                <th colspan="18"style="color: white">
                                                    Calib
                                                    {{-- <span class="badge badge-success">{{$request_tools->requestToolsData->getDepartment->whereIn('department_id', [1])->count()}}</span> --}}
                                                </th>
                                            </tr>
                                            <tr class="bg-trans-dark">
                                                <th>#</th>                                              
                                                <th colspan="13" class="text-center">Description</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Calibration</th>
                                                <th>Spare Parts</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            // $total=0;        
                                            $totalPrice=0;
                                            $totalSpareParts=0;
                                            $counter = 0;
                                            ?>                         
                                            @foreach ($request_tools as $index => $request)  
                                                @foreach($request->requestToolsData as $key => $data)   
                                                    <?php
                                                    $total_calib = $data->qty*$data->getDepartment->unit_price;        
                                                    $total_spare_parts = $data->qty*$data->getDepartment->unit_price;                                   
                                                    ?>                                              
                                                    <tr>   
                                                        <!--consumable er-calibration-->  
                                                        @if($data->getDepartment->department_id == 1 && $request->work_area_id != null )        
                                                            <td>{{ ++$counter }}</td>
                                                            <td colspan="13">{{ $data->getDepartment->item_code}} - {{$data->getDepartment->name}}</td>                                                
                                                            <td style="text-align:center">{{$data->qty}}</td>
                                                            <td>{{ number_format($data->getDepartment->unit_price,2)}}</td>
                                                            <td>{{ $request->getWorkArea->id == 4 ? number_format( $total_calib,2) : 0}}</td>                              
                                                            <td>{{ 0 }}</td>
                                                            <?php
                                                                $totalPrice += $data->getDepartment->unit_price;
                                                            ?>
                                                        <!--spare parts-->       
                                                        @elseif($data->getDepartment->department_id == 1 && $request->request_type == 'a:1:{i:0;s:1:"5";}' )
                                                            <td>{{ ++$counter }}</td>
                                                            <td colspan="13">{{ $data->getDepartment->item_code}} - {{$data->getDepartment->name}}</td>                                                
                                                            <td style="text-align:center">{{$data->qty}}</td>
                                                            <td>{{ number_format($data->getDepartment->unit_price,2)}}</td>
                                                            <td>{{ 0 }}</td>
                                                            <td>{{ number_format($total_spare_parts,2)}}</td>        
                                                            <?php
                                                                $totalPrice += $data->getDepartment->unit_price;
                                                                $totalSpareParts += $total_spare_parts;
                                                            ?>                                                           
                                                        @endif
                                                    </tr>                                                       
                                                @endforeach 
                                            @endforeach
                                            <tr>                                              
                                                <td colspan="15" class="text-bold h5" style="text-align: right">                                                   
                                                    TOTAL&nbsp;&nbsp;&nbsp;: &nbsp;   
                                                </td> 
                                                <td class="text-bold"> 
                                                    {{number_format($totalPrice,2)}}
                                                </td>   
                                                <td class="text-bold">
                                                    @php($total_er_calib=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 1 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 4 )
                                                                @php($total_er_calib+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($total_er_calib,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    {{-- @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($data->getDepartment->department_id == 1 && $request->request_type == 'a:1:{i:0;s:1:"5";}' )   
                                                                @if($request->where('request_type','a:1:{i:0;s:1:"5";}'))
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach   --}}
                                                    {{number_format($totalSpareParts,2)}}
                                                </td>
                                            </tr> 
                                        </tbody>                                                                            
                                        <thead width="100%">
                                            <tr class="bg-dark">
                                                <th colspan="18"style="color: white">
                                                    OFF
                                                    {{-- <span class="badge badge-success">{{$daily_consume->whereIn('department_id', [6])->count()}}</span> --}}
                                                </th>
                                            </tr>
                                            <tr class="bg-trans-dark">
                                                <th>#</th>                                              
                                                <th colspan="12" class="text-center">Description</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Finance</th>
                                                <th>Operation</th>
                                                <th>Warehouse</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            // $total=0;                                           
                                            $totalOff=0;
                                            $counter = 0;
                                            ?>                         
                                            @foreach ($request_tools as $request)                                                
                                                @foreach($request->requestToolsData as $data)   
                                                    <?php
                                                    $total_office = $data->qty*$data->getDepartment->unit_price;                                        
                                                    ?>   
                                                    @if($data->getDepartment->department_id == 6 || $data->getDepartment->department_id == 7 && $request->work_area_id  != null)
                                                        <tr>          
                                                            <td>{{++$counter}}</td>
                                                            <td colspan="12">{{$data->getDepartment->item_code}} - {{$data->getDepartment->name}}</td>                                                
                                                            <td style="text-align:center">{{$data->qty}}</td>
                                                            <td>{{$data->getDepartment->unit_price}}</td>
                                                            <td>{{$request->getWorkArea->id == 21 ? number_format($total_office,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 22 ? number_format($total_office,2) : 0}}</td>
                                                            <td>{{$request->getWorkArea->id == 23 ? number_format($total_office,2) : 0}}</td>
                                                        </tr>   
                                                        <?php
                                                        $totalOff += $data->getDepartment->unit_price;
                                                        ?>
                                                    @endif
                                                @endforeach 
                                            @endforeach
                                            <tr>                                              
                                                <td colspan="14" class="text-bold h5" style="text-align: right">                                                   
                                                    TOTAL&nbsp;&nbsp;&nbsp;: &nbsp;   
                                                </td> 
                                                <td class="text-bold"> 
                                                   {{number_format($totalOff,2)}}
                                                </td>   
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 6 || $data->getDepartment->department_id == 7 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 21)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 6 || $data->getDepartment->department_id == 7 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 22)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
                                                </td>
                                                <td class="text-bold">
                                                    @php($totals=0) 
                                                    @foreach($request_tools as $request)
                                                        @foreach($request->requestToolsData as $stock) 
                                                            @if($stock->getDepartment->department_id == 6 || $data->getDepartment->department_id == 7 && $request->work_area_id  != null)   
                                                                @if($request->getWorkArea->id == 23)
                                                                @php($totals+=$stock->qty*$stock->getDepartment->unit_price)    
                                                                @endif 
                                                            @endif 
                                                        @endforeach  
                                                    @endforeach  
                                                    {{number_format($totals,2)}}
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
                        <div wire.ignore.self class="modal fade" id="jobReportModal" tabindex="-1" role="dialog" 
                        aria-labelledby="jobReportModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog " style="width: 400px" role="document">
                               @include('livewire.workorder.job-report-listing-form')
                            </div>
                        </div>    
                        <!-- The Add Consumable Modal-->
                        <div wire.ignore.self class="modal fade" id="consumableModal" tabindex="-1" role="dialog" 
                        aria-labelledby="consumableModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-md" role="document">                             
                               <livewire:workorder.job-report-listing-consumable-form/>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.job-report-listing-scripts');
                @endsection
        </div>
        
    </div>
    
</div>

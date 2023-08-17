
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr class="bg-primary">
            <th colspan="18"style="color: white; text-align: left; background-color: black">
                ER 
            </th>
        </tr>
        <tr class="bg-trans-dark">          
            <th>Date</th>           
            <th class="text-center">Description</th>                                               
            <th>Qty</th> 
            <th>Price</th>                                                                                                                              
            <th>On-Site</th>
            <th>Bench Work's</th>
            <th>Boring</th>
            <th>Calibration</th>
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
                                    
        @foreach ($daily_consume as $data) 
        @if($data->getDepartment->id == 2)
            <tr>                                                    
               
                <td>{{$data->created_at->format('Y/m/d')}}</td>              
                <td>{{$data->getStockManagement->item_code}} - {{$data->getStockManagement->name}} [{{$data->getStockManagement->description}}]</td>                                                      
                <td>{{$data->quantity}}</td>
                <td>{{$data->getStockManagement->unit_price}}</td>
                @if($data->getWorkArea->id == 1 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)  
                    <td>{{$data->total}}</td>
                @else
                <td>0</td>
                @endif
                @if($data->getWorkArea->id == 2 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 3 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 4 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 5 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif   
                @if($data->getWorkArea->id == 6 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)                                                  
                <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 7 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                 @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 8 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                 @else
                    <td>0</td>                                                    
                @endif
                @if($data->getWorkArea->id == 9 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                 @else
                    <td>0</td>                                                    
                @endif
                @if($data->getWorkArea->id == 10 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total?? 0}}</td>
                 @else
                    <td>0</td>                                                    
                @endif
                @if($data->getWorkArea->id == 11 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                 @else
                    <td>0</td>                                                    
                @endif
                @if($data->getWorkArea->id == 12 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                 @else
                    <td>0</td>                                                    
                @endif
                @if($data->getWorkArea->id == 13 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                 @else
                    <td>0</td>                                                    
                @endif
                @if($data->getWorkArea->id == 14 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                @else
                <td>0</td>                                                     
                @endif                                                  
                                                                                              
            </tr>   
        @endif
        @endforeach 
            <!--TOTAL TABLE ROW-->
            {{-- @foreach($daily_consume as $data) --}}
            <tr>
                <td colspan="2" class="text-bold h5" style="text-align: right">               
                    TOTAL&nbsp;&nbsp;&nbsp;: &nbsp;                                                                                                    
                </td> 
                <td colspan="2" class="text-bold h5" style="text-align: right">
                   <span class="pull-left">  </span>
                   <span class="pull-right">{{number_format($totalEr,2)}}</span>
                </td>
                <td>
                    @php($totals=0) 
                    @foreach($daily_consume as $data)
                        @if($data->getWorkArea->id == 1 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0 )
                        @php($totals+=$data->total)    
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>  
                <td>
                    @php($totals=0) 
                    @foreach($daily_consume as $data)
                        @if($data->getWorkArea->id == 2  && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)     
                        @endif  
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>                                                  
                <td>
                    @php($totals=0) 
                    @foreach($daily_consume as $data)
                        @if($data->getWorkArea->id == 3 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)     
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>
                <td>
                    @php($totals=0)     
                    @foreach($daily_consume as $data)
                        @if($data->getWorkArea->id == 4 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)                   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td> 
                <td>   
                    @php($totals=0)     
                    @foreach($daily_consume as $data)                                        
                        @if($data->getWorkArea->id == 5 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>                                                  
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data)    
                        @if($data->getWorkArea->id == 6 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)                                                  
                        @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>                                                     
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data)   
                        @if($data->getWorkArea->id == 7 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)   
                        @endif      
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>                                                      
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data)   
                        @if($data->getWorkArea->id == 8  && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>                                                      
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data)  
                         @if($data->getWorkArea->id == 9 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                         @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data)  
                        @if($data->getWorkArea->id == 10 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data) 
                        @if($data->getWorkArea->id == 11 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data) 
                        @if($data->getWorkArea->id == 12 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data) 
                        @if($data->getWorkArea->id == 13 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)   
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>
                <td>
                    @php($totals=0)
                    @foreach($daily_consume as $data) 
                        @if($data->getWorkArea->id == 14 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                        @php($totals+=$data->total)                                                               
                        @endif 
                    @endforeach  
                    {{number_format($totals,2)}}
                </td>                                                
            </tr>
    </tbody>
    <thead width=" 1oo%">
        <tr class="bg-primary">
            <th colspan="18"style="color: white; text-align: left; background-color: black">
                MF 
            </th>
        </tr>
        <tr class="bg-trans-dark">
            <th>Date</th>                                              
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
        @foreach ($daily_consume as $data) 
        @if($data->getDepartment->id == 4)
        {{-- @php($totals=0) --}}
            <tr>
                <td>{{$data->created_at->format('Y/m/d')}}</td>
                {{-- <td>{{strstr($data->getWorkArea->name,  '-', true)}}</td> --}}
                <td colspan="9">{{$data->getStockManagement->item_code}} - {{$data->getStockManagement->name}} [{{$data->getStockManagement->description}}]</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->getStockManagement->unit_price}}</td>
                @if($data->getWorkArea->id == 15 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 16 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 17 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 18 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 19 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
               
                @if($data->getWorkArea->id == 20 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                {{-- @php($totals+=$data->total) --}}
                <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
            </tr>
        @endif
        @endforeach 
        <tr>
            <td colspan="10" class="text-bold h5" style="text-align: right">
                TOTAL&nbsp;&nbsp;&nbsp;: &nbsp;                                                                                         
            </td> 
            <td colspan="2" class="text-bold h5" style="text-align: right">
                <span class="pull-left">  </span>
                <span class="pull-right">{{number_format($totalMf,2)}}</span>
            </td>  
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 15 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total) 
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td>   
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 16 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)  
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td> 
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 17 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)  
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td> 
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 18 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)  
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td> 
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 19 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)      
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td> 
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 20 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)                                                           
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td>                                       
        </tr>
    </tbody>                                        
    <thead width="100%">
        <tr class="bg-primary">
            <th colspan="18"style="color: white; text-align: left; background-color: black">
                OFF               
            </th>
        </tr>
        <tr class="bg-trans-dark">
            <th>Date</th>                                              
            <th colspan="12" class="text-center">Description</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Finance</th>
            <th>Operation</th>
            <th>Warehouse</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($daily_consume as $data)                                           
        @if($data->getDepartment->id == 6)
        {{-- @php($totals = 0) --}}
                                      
            <tr>
               
                <td>{{$data->created_at->format('Y/m/d')}}</td>
                {{-- <td> {{strstr($data->getWorkArea->name,  '-', true)}}    </td> --}}
                <td colspan="12">{{$data->getStockManagement->item_code}} - {{$data->getStockManagement->name}} [{{$data->getStockManagement->description}}]</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->getStockManagement->unit_price}}</td>
                @if($data->getWorkArea->id == 21 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)                                                 
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
                @if($data->getWorkArea->id == 22 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)                                                   
                    <td>{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
             
                @if($data->getWorkArea->id == 23 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)                                                   
                    <td >{{$data->total}}</td>
                @else
                    <td>0</td>
                @endif
            </tr>
        @endif
        @endforeach
        <tr>                                              
            <td colspan="13" class="text-bold h5" style="text-align: right">                                                   
                TOTAL&nbsp;&nbsp;&nbsp;: &nbsp;   
            </td> 
            <td colspan="2" class="text-bold h5" style="text-align: right">
                <span class="pull-left">  </span>     
                <span class="pull-right">{{number_format($totalOff,2)}}</span>
            </td>   
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 21 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)                                                           
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td>
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 22 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)                                                            
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td>
            <td>
                @php($totals=0)
                @foreach($daily_consume as $data)
                    @if($data->getWorkArea->id == 23 && floatval(preg_replace('/[^\d.]/', '', $data->total)) > 0)
                    @php($totals+=$data->total)   
                    @endif
                @endforeach
                {{number_format($totals,2)}}
            </td>

        </tr> 
    </tbody>
</table>   
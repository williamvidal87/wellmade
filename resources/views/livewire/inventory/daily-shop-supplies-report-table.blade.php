<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading text-center" style="padding-top: 20px">
                                <h4 class="text-bold">Daily Consumption Report V2</h4>
                                <h4 class="text-bold ">SUMMARY OF SHOP SUPPLIES FOR THE DAY</h4>    
                                <div class="text-center text-bold ">Date of Report: {{ $end_d != null ? '('. date('Y-m-d', strtotime($end_d)) . ')' : now()->format('Y-m-d')}}</div>    
                            </div>
                            <br><br><br>                               
                            <!--Data Table-->                           
                            <!--===================================================-->
                            <div class="panel-body">
                                <br>
                                <div class="btn-group">                                   
                                    <button class="btn btn-primary btn-labeled" wire:click="addGenerate" title="Generate"><i class="btn-label demo-pli-add icon-fw"></i> Generate</button>       
                                    <button class="btn btn-purple btn-labeled" wire:click="printPdf" title="Print"> <i class="btn-label fa fa-print"></i> Print</button>                                  
                                </div> 
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="font-size: 12px" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="bg-trans-dark">
                                                <th style="text-align: center">Description</th>
                                                <th style="text-align: center">Dept</th>
                                                <th style="text-align: center">Balance</th>
                                                <th style="text-align: center">Price</th>
                                                <th style="text-align: center">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                           
                                            @forelse($request_tool_data as $key => $data)
                                            <tr>
                                                <td colspan="5" style="font-weight: bold">JO# {{$key}}</td>
                                            </tr>
                                                @php($total_amount=0)
                                                @foreach($data as $value)
                                                <?php
                                                $amount = $value->qty*$value->selling_price;
                                                ?>                                              
                                                <tr>
                                                    <td>{{$value->getStockManagment->item_code .' '.'-'.' '. $value->getStockManagment->name}}</td>
                                                    <td style="text-align: center">
                                                        @if($value->getStockManagment->getDepartment->id == 1)
                                                            {{$value->getStockManagment->getDepartment->name}}
                                                        @elseif($value->getStockManagment->getDepartment->id == 2)
                                                            {{$value->getStockManagment->getDepartment->name}}
                                                        @elseif($value->getStockManagment->getDepartment->id == 4)
                                                            {{$value->getStockManagment->getDepartment->name}}  
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center">{{$value->qty}}</td>
                                                    <td style="text-align: center">{{$value->selling_price}}</td>
                                                    <td style="text-align: right">{{ number_format($amount, 2)}}</td>
                                                </tr>   
                                                <?php
                                                    $total_amount += $amount;
                                                ?>                                           
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" style="font-weight: bold; text-align:right">TOTAL :</td>
                                                    <td colspan="2" style="text-align: right">{{ number_format($total_amount ,2) ?? 0}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" style="color: red; text-align:center;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No Data Found. </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>    
                                </div>    
                            </div>
                            <!--===================================================-->
                            <!--End Data Table-->
                        </div>
                        <!-- The Generate Modal -->
                        <div wire.ignore.self class="modal fade" id="dailyShopSuppliesReportModal" tabindex="-1" role="dialog" 
                        aria-labelledby="dailyShopSuppliesReportModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog " style="width: 400px" role="document">
                               @include('livewire.inventory.daily-shop-supplies-report-form')
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.daily-shop-supplies-report-scripts');
                @endsection
        </div>
        
    </div>
    
</div>

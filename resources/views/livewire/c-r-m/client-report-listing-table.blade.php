<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            
                            <div class="panel-heading">
                                <h3 class="panel-title">Client Report Listing</h3>
                            </div>
            
                            <!--Data Table-->
                            <!--===================================================-->
                            <div class="panel-body">
                               
                                <div class="col-md-12">   
                                    <div class="form-inline pull-left">         
                                        {{-- @can('addGenerate','printExcel','printPdf')                                 --}}
                                        <button class="btn btn-primary btn-md" wire:click="addGenerate"  style="padding: 4px; border-radius: 3px; margin-right: 5px"> <i class="fa fa-plus-circle"></i> Generate</button>                                    
                                        <button class="btn-md" wire:click="printExcel" style="padding: 4px; border-radius: 3px; color: green" title="download"> <i class="fa fa-download"></i> Excel</button> |    
                                        <button class="btn-md" wire:click="printPdf" style="padding: 4px; border-radius: 3px; color: red" title="download"> <i class="fa fa-download"></i> Pdf</button>                
                                        {{-- @endcan                 --}}
                                    </div>                                                           
                                </div>                                
                                <br><br><br>
                                <div class="table-responsive">
                                    <table id="clientReportTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                        <thead>
                                            <tr class="bg-trans-dark">
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Client Type</th>
                                                <th>Csa Type</th>                                               
                                                <th>Branch</th>
                                                <th>Contact no.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($client_profile as $data)
                                            <tr>  
                                               <td>{{$data->created_at->format('d/m/Y')}}</td>
                                               <td><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->name}}</td> 
                                               <td>{{$data->clientTypes->industry_id }} - {{$data->clientTypes->client_type}}</td>
                                               <td>{{$data->forCSA->csa_type}}</td>
                                               <td>{{$data->forBranch->branch_name}}</td>
                                               <td>{{$data->contact_no}}</td>                                                            
                                            </tr>    
                                            @endforeach  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--===================================================-->
                            <!--End Data Table-->
            
                        </div>
                        <!-- The Modal -->
                        <div wire.ignore.self class="modal fade" id="clientReportModal" tabindex="-1" role="dialog" 
                        aria-labelledby="clientReportModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-sm" role="document">                          
                                @include('livewire.c-r-m.client-report-listing-form')
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.client-report-listing-scripts');
                @endsection            
            </div>
        
    </div>
    
</div>

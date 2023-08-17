
<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">
                            
                            <div class="panel-heading">
                                <h3 class="panel-title">User Report Listing</h3>
                            </div>
            
                            <!--Data Table-->
                            <!--===================================================-->
                            <div class="panel-body">
                               
                                <div class="col-md-12">   
                                    <div class="form-inline pull-left">         
                                        <button class="btn btn-primary btn-md" wire:click="addGenerate"  style="padding: 4px; border-radius: 3px; margin-right: 5px"> <i class="fa fa-plus-circle"></i> Generate</button>                                    
                                        <button class="btn-md" wire:click="printExcel" style="padding: 4px; border-radius: 3px; color: green" title="download"> <i class="fa fa-download"></i> Excel</button> |    
                                        <button class="btn-md" wire:click="printPdf" style="padding: 4px; border-radius: 3px; color: red" title="download"> <i class="fa fa-download"></i> Pdf</button>                                
                                    </div>                                                           
                                </div>                                
                                <br><br><br>
                                <div class="table-responsive">
                                    <table id="userReportTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                        <thead>
                                            <tr class="bg-trans-dark">                                             
                                                <th>Name</th>
                                                <th>Roles</th>
                                                <th>Email</th>
                                                <th>Contact no.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user_report as $data)
                                            <tr>                                                
                                               <td><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->name}}</td> 
                                               <td>
                                                @foreach ($data->roles as $role)
                                                    <span class="badge badge-success">{{ $role->name }}</span>
                                                @endforeach
                                                </td>
                                               <td>{{$data->email}}</td>                                              
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
                        <div wire.ignore.self class="modal fade" id="userReportModal" tabindex="-1" role="dialog" 
                        aria-labelledby="userReportModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" style="width: 400px" role="document">                          
                                @include('livewire.u-m-s.user-report-listing-form')
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
                @section('custom_script')
                    @include('layouts.scripts.user-report-listing-scripts');
                @endsection            
            </div>
        
    </div>
    
</div>

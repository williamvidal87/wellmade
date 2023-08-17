<div>
    <div class="row">
        <div class="col-xs-12">
        <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">User Activity Log</h3>
                </div>
               
                {{-- <div class="col-md-12">                                                               
                    <div class="form-inline pull-left">         
                        <button class="btn btn-primary btn-md" wire:click="addGenerate"  style="padding: 4px; border-radius: 3px; margin-right: 5px; margin-left: 10px"> <i class="fa fa-plus-circle"></i> Generate</button>    
                        <button class="btn-md btn btn-purple" wire:click="printPdf" style="padding: 4px; border-radius: 3px;" title="Print"> <i class="fa fa-print"></i> Print Logs</button>                                
                    </div>                                                   
                </div>      --}}

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-labeled" wire:click="addGenerate" title="Generate"><i class="btn-label demo-pli-add icon-fw"></i> Generate</button>               
                        <button class="btn btn-purple btn-labeled" wire:click="printPdf" title="Print"> <i class="btn-label fa fa-print"></i> Print</button>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="activityLogTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead class="bg-trans-dark">
                                <tr> 
                                    <th>Date</th>                                 
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Url</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_log as $data)
                                <tr>
                                    <td>{{$data->logged_at}}</td>
                                    <td><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->description}}</td>
                                    <td>{{$data->log_name}}</td>
                                    <td>{{$data->subject_type}}</td>
                                </tr>
                            
                                @endforeach   
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->
            </div>
            <div wire.ignore.self class="modal fade" id="activityLogtModal" tabindex="-1" role="dialog" 
            aria-labelledby="activityLogtModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                   @include('livewire.user-log.user-activity-log-form')
                </div>
            </div>                
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.activityLog-scripts'); 
@endsection
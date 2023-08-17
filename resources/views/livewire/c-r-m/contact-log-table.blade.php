<div>
    <div class="row">
        <div class="col-xs-12">
        <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact Incentive Log</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-primary btn-md" wire:click="addGenerate"  style="padding: 4px; border-radius: 3px; margin-right: 5px; margin-left: 10px"> <i class="fa fa-plus-circle"></i> Generate</button>    
                                <button class="btn-md btn btn-purple" wire:click="printPdf" style="padding: 4px; border-radius: 3px;" title="Print"> <i class="fa fa-print"></i> Print Logs</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="contactLogTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>ACTIVITY</th>
                                    <th>CONTACT</th>
                                    <th>URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact_incentives_logs as $data)
                                <tr>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->description}}</td>
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
            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="contactLogModal" tabindex="-1" role="dialog" aria-labelledby="contactLogModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <livewire:c-r-m.contact-log-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.contact-incentives-scripts'); 
@endsection
<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Chart of Accounts</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createChartAccounts"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="chartaccountsTable" class="table table-striped table-bordered table-hover " cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>Account Code</th>
                                    <th>Account Description</th>
                                    <th>Account Type</th>
                                    <th>Statement</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billingchartaccounts as $data)
                                <tr>
                                    <td>{{$data->account_code}}</td>
                                    <td>{{$data->account_desc}}</td>
                                    <td>
                                        {{-- @php($day = $data->getAccountTypes()->first())
                                        @if(!is_null($day))
                                        {{ $day->account_type }}
                                        @endif --}}
                                        {{-- OR --}}
                                        {{$data->getAccountTypes->account_type ?? " "}}
                                    </td>
                                    <td>{{$data->statement}}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">

                                            <button wire:click="editChartAccounts({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                            <button wire:click="deleteConfirmChartAccounts({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

                                        </div>                
                                    </td>
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
            <div wire.ignore.self class="modal fade" id="chartaccountsModal" tabindex="-1" role="dialog" aria-labelledby="chartaccountsModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:billing.chart-accounts-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.chart-accounts-scripts'); 
@endsection
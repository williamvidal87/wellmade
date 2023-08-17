<div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Purchase History</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                {{-- <button class="btn btn-purple" wire:click="createProcurementManagement"><i class="demo-pli-add icon-fw"></i>Add</button> --}}
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>From</label>
                                    <input wire:model="dateFrom" type="date" class="form-control">
                                    @if($errors->has('dateFrom'))
                                    <p style="color:red">{{$errors->first('dateFrom')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>To</label>
                                    <input wire:model="dateTo" type="date" class="form-control">
                                    @if($errors->has('dateTo'))
                                    <p style="color:red">{{$errors->first('dateTo')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="procurementManagementTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>STAFF</th>
                                    <th>PR-NO</th>
                                    <th>TOTAL PRICE</th>
                                    <th>SUPPLIER</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($procurementManagement as $data)
                                <tr>
                                    <td>{{$data->date}}</td>
                                    <td>{{$data->users->name}}</td>
                                    <td>{{$data->pr_no}}</td>
                                    <td>{{number_format($data->all_total_price, 2)}}</td>
                                    <td>{{$data->suppliers->name}}</td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            {{-- @can('editProcurementManagement') --}}
                                            <button wire:click="editProcurementManagement({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            {{-- @endcan --}}

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
            <div wire.ignore.self class="modal fade" id="procurementManagementModal" tabindex="-1" role="dialog" aria-labelledby="procurementManagementModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog  modal-lg" style="width:1200px" role="document">
                    <livewire:inventory.purchase-history-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.procurement-management-scripts'); 
@endsection

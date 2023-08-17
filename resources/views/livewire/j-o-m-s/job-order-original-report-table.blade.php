<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Job Order Receipts</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="jobtypeTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">DATE</th>
                                    <th class="text-center">JO NO</th>
                                    <th class="text-center">CUSTOMER NAME</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_orders_original as $data)
                                    <tr>
                                        <td class="text-center">{{ date("Y-m-d", strtotime($data->jobOrder->date)) }}</td>
                                        <td class="text-center">{{ $data->jobOrder->jo_no }}</td>
                                        <td class="text-center">{{ $data->jobOrder->clientProfile->name }}</td>
                                        <td class="text-center"> <span class="badge badge-success">{{ $data->jobOrder->getStatus->status }}</span></td>
                                        <td class="text-center">
                                            {{-- If the user role is encoder only once can print the receipts --}}
                                            @if (Auth::user()->hasRole(['Encoder', 'Admin', 'Super Admin']))
                                                <button wire:click="originalExport2PDF({{$data->jobOrder->id}})" class="btn btn-purple  m-1 btn-sm" {{ $this->checkAbleToPrint() && $data->jobOrder->printed_original >= 1 ? 'disabled' : '' }}><i class="fa fa-print"></i>&nbsp;Original</button>
                                                <button wire:click="duplicateExport2PDF({{$data->jobOrder->id}})" class="btn btn-purple  m-1 btn-sm" {{ $this->checkAbleToPrint() && $data->jobOrder->printed_duplicate >= 1 ? 'disabled' : '' }}><i class="fa fa-print"></i>&nbsp;Duplicate</button>
                                                <button wire:click="triplicateExport2PDF({{$data->jobOrder->id}})" class="btn btn-purple  m-1 btn-sm" {{ $this->checkAbleToPrint() && $data->jobOrder->printed_triplicate >= 1 ? 'disabled' : '' }}><i class="fa fa-print"></i>&nbsp;Triplicate</button>
                                            @endif
                                            {{-- Only admin who can access this unlock access --}}
                                            @if ($this->checkRole())
                                                <a wire:click="originalApproveUnlockAccess({{$data->jobOrder->id}})" class="btn btn-primary  m-1 btn-sm"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Original</a>
                                                <a wire:click="duplicateApproveUnlockAccess({{$data->jobOrder->id}})" class="btn btn-primary  m-1 btn-sm"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Duplicate</a>
                                                <a wire:click="triplicateApproveUnlockAccess({{$data->jobOrder->id}})" class="btn btn-primary  m-1 btn-sm"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Triplicate</a>
                                            @endif
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
            <div wire.ignore.self class="modal fade" id="jobtypeModal" tabindex="-1" role="dialog"
                aria-labelledby="jobtypeModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:j-o-m-s.j-o-type-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.job-order-report-scripts');
@endsection

<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Job Order Incentives</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="jobtypeTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">JO NO</th>
                                    <th class="text-center">CUSTOMER NAME</th>
                                    <th class="text-center">INV  DATE</th>
                                    <th class="text-center">CONTACT PERSON</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_orders as $data)
                                    <tr>
                                        <td class="text-center">{{ $data->jo_no ?? '' }}</td>
                                        <td class="text-center">{{ $data->clientProfile->name ?? '' }}</td>
                                        <td class="text-center">{{ date("Y-m-d", strtotime($data->date)) ?? '' }}</td>
                                        <td class="text-center">{{ $data->getContact->name ?? '' }}</td>
                                        <td class="text-center">
                                            <button wire:click="viewReport({{$data->id}})" class="btn btn-info  m-1 btn-sm"><i class="fa fa-eye"></i>&nbsp;View</button>
                                            @if (Auth::user()->hasRole(['Encoder', 'Admin', 'Super Admin']))
                                                <button wire:click="incentiveReport({{$data->id}})" class="btn btn-purple  m-1 btn-sm" {{ $this->checkAbleToPrint() && $data->printed_incentive >= 1 ? 'disabled' : '' }}><i class="fa fa-print"></i>&nbsp;Print</button>
                                            @endif
                                            {{-- Only admin who can access this unlock access --}}
                                            @if ($this->checkRole())
                                                <a wire:click="approveUnlockAccess({{$data->id}})" class="btn btn-primary  m-1 btn-sm"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Unlock Access</a>
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
            <div wire.ignore.self class="modal fade" id="jobOrderIncentivesModal" tabindex="-1" role="dialog"
                aria-labelledby="jobOrderIncentivesModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:j-o-m-s.unlock-access-form />
                </div>
            </div>

            <!-- The View Job Order Incentives -->
            <div wire.ignore.self class="modal fade" id="jobOrderViewIncentivesModal" tabindex="-1" role="dialog"
                aria-labelledby="jobOrderViewIncentivesModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:j-o-m-s.view-incentives />
                </div>
            </div>

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.job-order-report-scripts');
@endsection

<div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title fw-bold text-center text-primary">Scan Incentive</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 has-purple">
                            <input type="text" class="form-control" id="incentiveScannedID" onblur="this.focus()" wire:model="incentiveScannedID" style="background-color: rgb(255, 255, 255)" autofocus>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        {{ Log::debug($isValid == false && $dupScanId != "") }}
                        {{ Log::debug("ISVALUD: ". $isValid) }}
                        {{ Log::debug("DUPSCANID: ". $dupScanId) }}
                        @if ($isValid && $job_orders != null)
                            <div class="col-xs-12">
                                <h4 class="text-center text-success fs-3">
                                    Incentive is valid! <br>
                                    <i class="ion-checkmark-circled icon-2x"></i>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fs-4"><i class="fa fa-cog"></i> NAME: <span class="text-dark">{{ $job_orders->getContact->name ?? '' }}</span></h5>
                                <h5 class="fs-4"><i class="fa fa-cog"></i> ADDRESS: <span class="text-dark">{{ $job_orders->getContact->address ?? '' }}</span></h5>
                                <h5 class="fs-4"><i class="fa fa-cog"></i> JO NO: <span class="text-dark">{{ $job_orders->jo_no ?? '' }}</span></h5>
                                <h5 class="fs-4"><i class="fa fa-cog"></i> AMOUNT DUE: <span class="text-dark">{{ number_format($job_orders->total_incentive,2) }}</span></h5>
                            </div>
                        @elseif ($isValid == false && $dupScanId != "")
                            <div class="col-xs-12">
                                <h4 class="text-center text-danger fs-3">
                                    Incentive is not valid! <br>
                                    <i class="ion-alert-circled icon-2x"></i>
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.barcode-scan-scripts');
@endsection
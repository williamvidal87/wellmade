<div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title fw-bold text-center text-primary">Scan Work Order</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 has-purple">
                            <input type="text" class="form-control" id="scannedID" onblur="this.focus()" value="{{ $scannedID }}" wire:model="scannedID" style="background-color: rgb(255, 255, 255)" autofocus>
                        </div>
                        {{-- <div class="col-sm-3 has-primary">
                            <input type="text" class="form-control" id="scannedID" onblur="this.focus()" value="{{ $scannedID }}" wire:model="scannedID" placeholder="Scan here" autofocus>
                        </div> --}}
                    </div>
                    <hr>
                    <h2 class="text-left fs-2 fw-bold text-dark">Timeout: 
                        @if ($worker && $work_order && $jo && $count_down !== 0)
                            <span class="text-primary" id="countdown"></span>
                        @endif
                        
                        @if ($count_down !== 0 && $worker && $work_order && $jo && $proceed_working !== "rescanq" && $worker->status !== 9 && $worker->status !== 15 && $worker->start && is_null($worker->end)
                            && $match !== "Invalid scanned Qr code")
                            <span class="pull-right">
                                <button wire:click="actionButton('pause')"
                                    class="btn btn-primary delete-header m-1 btn-sm btn-labeled"
                                    title="Pause Work Order">
                                    <i class="btn-label fa fa-pause"></i>
                                    Pause
                                </button>
                            </span>
                        @endif
                    </h2>
                    <div class="row">
                        @if($proceed_working == "cannot proceed")
                            <div class="col-xs-12">
                                <h4 class="text-center text-danger fs-3">
                                    Work Order and Operator not Authorized <br>
                                    <i class="ion-alert-circled icon-2x"></i>
                                </h4>
                            </div>
                        @elseif ($proceed_working == "error scan properly")
                            <div class="col-xs-12">
                                <h4 class="text-center text-dark fs-2">
                                    <i class="ion-qr-scanner icon-2x mr-3"></i><i class="ion-alert-circled icon-2x"></i> <br>
                                    Try to scan the Qr Code properly
                                </h4>
                                <p class="text-center text-dark">QR CODE UNRECOGNIZED. TRY SCANNING IN A SHORT DISTANCE.</p>
                            </div>
                        @elseif($proceed_working == "rescanq")
                            <div class="col-xs-12">
                                <h3 class="text-center text-danger fs-3">
                                    You are trying to end the work order immediately.<br>
                                    <i class="ion-alert-circled icon-2x"></i>
                                </h3>
                                {{-- <script>
                                    rescanAgain();
                                </script> --}}
                            </div>
                        @else
                            <div class="col-md-6">
                                @if($worker && $work_order && $jo)

                                    @if ( $match !== "error scan properly")
                                        <script>
                                            countDownTimer();
                                        </script>  
                                    @endif

                                    @if($count_down !== 0)

                                        <h5 class="fs-4"><i class="fa fa-cog"></i> Work Order ID: <span class="text-dark">{{ $work_order->id }}</span></h5>
                                        <h5 class="fs-4">
                                            <i class="fa fa-cog"></i> Work Order Type:
                                            <span class="text-dark">
                                                @if($work_order->mf_work_group_id)
                                                    Machining & Fabrication
                                                @elseif ($work_order->er_work_group_id)
                                                    Engine Reconditioning
                                                @else
                                                    Calibration
                                                @endif
                                            </span>
                                        </h5>
                                        <h5 class="fs-4"><i class="fa fa-cog"></i> Quantity: <span class="text-dark">{{ $work_order->qty }}</span></h5>
                                        <h5 class="fs-4"><i class="fa fa-cog"></i> JO NO: <span class="text-dark">{{ $jo->jo_no }}</span></h5>
                                        <h5 class="fs-4"><i class="fa fa-cog"></i> Encoder: <span class="text-dark">{{ $encoder }}</span></h5>
                                        <h5 class="fs-4"><i class="fa fa-cog"></i> Make: <span class="text-dark">{{ $jo->getMakeList->make_name ?? "" }}</span></h5>
                                        <h5 class="fs-4"><i class="fa fa-cog"></i> Model: <span class="text-dark">{{ $jo->engineModel->model ?? "" }}</span></h5>
                                        <h5 class="fs-4"><i class="fa fa-cog"></i> Operator Name: <span class="text-dark">{{ $worker->getWorker->name }}</span></h5>
                                        <h5 class="fs-4"><i class="fa fa-cog"></i> CSA: <span class="text-dark">{{ $jo->getCSA->csa_type }}</span></h5>
                                        @if(is_null($worker->start))
                                            <h5><span class="text-success"><i class="fa fa-calendar-o"></i></span> Start: <span class="text-success">{{ $worker->start }}</span></h5>
                                        @else
                                            <h5>
                                                <span class="text-success">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </span> Start: <span class="text-success mr-2">{{ $worker->start->format('Y-m-d h:i') }}</span>
                                                {{-- @if($match == "match r")
                                                    <span class="text-warning">UPDATED!</span>
                                                @endif --}}
                                            </h5>
                                        @endif
                                        @if(is_null($worker->end))
                                            <h5><span class="text-danger"><i class="fa fa-calendar-o"></i></span> End: <span class="text-danger">{{ $worker->end }}</span></h5>
                                        @else
                                            <h5><span class="text-danger"><i class="fa fa-calendar-check-o"></i></span> End: <span class="text-danger">{{ $worker->end->format('Y-m-d h:i') }}</span></h5>
                                        @endif
                                        <h5><span class="text-dark"><i class="fa fa-clock-o"></i></span>
                                             Total Time: {{ $total_time }}
                                             @if ($worker->status == 15)
                                                <span class="ml-2 text-warning">PAUSED</span>
                                             @endif
                                        </h5>
                                        @if(is_null($worker->pause))
                                            <h5><span class="text-warning"><i class="fa fa-calendar-o"></i></span> Last Pause: <span class="text-warning">{{ $worker->pause }}</span></h5>
                                        @else
                                            <h5><span class="text-success"><i class="fa fa-calendar-check-o"></i></span> Last Pause: <span class="text-warning">{{ $worker->pause }}</span></h5>
                                        @endif

                                        @if(is_null($worker->resume))
                                            <h5><span class="text-primary"><i class="fa fa-calendar-o"></i></span> Last Resume: <span class="text-primary">{{ $worker->resume }}</span></h5>
                                        @else
                                            <h5><span class="text-primary"><i class="fa fa-calendar-check-o"></i></span> Last Resume: <span class="text-primary">{{ $worker->resume }}</span></h5>
                                        @endif
                    
                                    @endif
                                @endif
                            </div>
                            <div class="col-md-6">
                                
                                @if ($match == "fwo")

                                    <h3 class="text-center text-success mt-4">
                                        <i class="ion-checkmark-circled icon-2x mb-2"></i><br>
                                        This Work Order is already DONE
                                    </h3>
                                @endif

                                @if($count_down !== 0)
                                    @if($match == "match")
                                        <h3 class="text-center text-success">
                                            <i class="ion-checkmark-circled icon-2x"></i><br>
                                            Matched Operator ID
                                        </h3>
                                        @if ($worker->start && is_null($worker->start))
                                            <p class="text-center text-success">
                                                Starting Work Order
                                            </p>
                                        @elseif ($worker->end)
                                            <p class="text-center text-success">
                                                Ending Work Order
                                            </p>
                                        @endif
                                    @elseif ($match == "match r")
                                        <h3 class="text-center text-success">
                                            <i class="ion-checkmark-circled icon-2x"></i><br>
                                            Matched Operator ID
                                        </h3>
                                        <h3 class="text-center text-success">
                                            <i class="ion-play icon-2x"></i><br>
                                            Work Order Resumed
                                        </h3>
                                    @elseif ($match == "not match")
                                        <h3 class="text-center text-danger">
                                            <i class="ion-close-circled icon-2x"></i><br>
                                            Operator ID does not match
                                        </h3>
                                    @elseif($match == "pause")
                                        <h3 class="text-center text-warning">
                                            <i class="ion-pause icon-3x"></i><br>
                                            Work Order Paused
                                        </h3>
                                        <p class="text-center text-dark">
                                            Scan with your QR Code to resume Work Order.<br>
                                            <i class="fa fa-info-circle mr-2"></i>This will update your Starting Date Time.
                                        </p>
                                    @elseif ($match == "Invalid scanned Qr code")
                                        <h3 class="text-center text-warning">
                                            <i class="ion-alert-circled icon-2x"></i><br>
                                            Invalid! Please match with your Qr Code.
                                        </h3>
                                    @endif
                                    

                                @endif
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

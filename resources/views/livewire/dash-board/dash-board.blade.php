<div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-bordered-primary">
                {{-- Panel Head --}}
                <div id="page-title">
                    <h1 class="page-header text-overflow">Dashboard</h1>
                </div>
                {{-- End Panel Head --}}
                {{-- Panel Body --}}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <h3 class="text-main text-normal text-2x mar-no">
                                <i class="fa fa-users"></i> Clients
                            </h3>
                            <h5 class="text-uppercase text-muted text-normal">Daily Reports</h5>
                            <hr class="new-section-xs">
                            <div class="row mar-buttom">
                                <div class="col-sm-5">
                                    <div class="text-lg"><p class="text-5x text-thick text-main mar-no">{{ $no_clients }}</p></div>
                                    {{-- <p class="text-sm">Total Clients</p> --}}
                                    <br>
                                    <p class="text-sm text-bold text-uppercase">Total Clients</p>
                                    {{-- <p class="text-sm">{{ $no_clients }} clients already recorded in {{ date("Y"); }}.</p> --}}
                                    <p class="text-sm-left"><span class="text-dark fw-bold">{{ $monthly_added_clients }}</span> {{ $client_word }} Added for the month of {{ date("M"); }}.</p>
                                </div>
                                <div class="col-sm-7">
                                    <div class="list-group bg-trans mar-no">
                                        <a class="list-group-item" href="{{route('client-type')}}"><i class="fa fa-user-circle-o"></i> Client Types</a>
                                        <hr>
                                        <a class="list-group-item" href="{{route('branch')}}"><i class="fa fa-bank icon-2x"></i> Branch</a>
                                        <hr>
                                        <a class="list-group-item" href="{{ route('type-of-payment') }}"><i class="fa fa-credit-card"></i> Payment Options</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <button class="btn btn-pink mar-ver" wire:click="viewDetails">View Details</button> --}}
                            <br>
                            {{-- <p class="text-sm-left">{{ $no_clients }} Clients Added for the past 7 days.</p> --}}
                            {{-- <h5 class="text-uppercase text-muted text-normal">Report for last 7-days ago</h5> --}}
                        </div>
                        <div class="col-md-7">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Job Orders <span class="badge badge-success">{{ date("Y") }}</span></h3>
                                </div>
                                <div class="panel-body">
                                    <div id="demo-flot-bar" style="height: 250px; padding: 0px; position: relative;"><canvas class="flot-base" width="297" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 297px; height: 250px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 15px; text-align: center;">1</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 43px; text-align: center;">2</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 71px; text-align: center;">3</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 100px; text-align: center;">4</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 128px; text-align: center;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 156px; text-align: center;">6</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 184px; text-align: center;">7</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 213px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 241px; text-align: center;">9</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 266px; text-align: center;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 266px; text-align: center;">11</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 42px; top: 235px; left: 266px; text-align: center;">12</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 221px; left: 6px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 166px; left: 6px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 111px; left: 0px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 56px; left: 0px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 0px; text-align: right;">20</div></div></div><canvas class="flot-overlay" width="297" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 297px; height: 250px;"></canvas></div>
                                </div>
                            </div>
                            {{-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas> --}}
                            <hr class="new-section-xs bord-no">
                            {{-- <div id="demo-bar-chart" style="height:250px"></div> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-warning panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-ios-paper-outline icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="text-2x mar-no text-semibold">{{ $job_orders }}</p>
                                    <p class="mar-no">Job Orders</p>
                                </div>
                                <small class="text-light">
                                    {{ $jb_pending }} Pending | {{ $jb_processing }} Processing | {{ $jb_done }} Finished
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-info panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-ios-gear-outline icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="text-2x mar-no text-semibold">{{ $mf_work_order }}</p>
                                    <p class="mar-no">MF Work Order</p>
                                </div>
                                <small class="text-light">
                                    {{ $mf_doing }} Doing | {{ $mf_approval }} Approval | {{ $mf_done }} Finished
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-mint panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-ios-gear icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="text-2x mar-no text-semibold">{{ $er_work_order }}</p>
                                    <p class="mar-no">ER Work Order</p>
                                </div>
                                <small class="text-light">
                                    {{ $er_doing }} Doing | {{ $er_approval }} Approval | {{ $er_done }} Finished
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-purple panel-colorful media middle pad-all">
                                <div class="media-left">
                                    <div class="pad-hor">
                                        <i class="ion-gear-b icon-3x"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="text-2x mar-no text-semibold">{{ $callib_work_order }}</p>
                                    <p class="mar-no">Calib Work Order</p>
                                </div>
                                <small class="text-light">
                                    {{ $calib_doing }} Doing | {{ $calib_approval }} Approval | {{ $calib_done }} Finished
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <h2>Recent Clients <i class="fa fa-users"></i></h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">BRANCH</th>
                                            <th class="text-center">
                                                ADDRESS
                                            </th>
                                            <th class="text-center">CONTACT NO.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $data)
                                            <tr>
                                                <td class="text-dark">
                                                    <span class="mr-2 text-primary"><i class="fa fa-user-circle"></i></span>
                                                    {{ $data->name }}
                                                </td>
                                                <td class="text-center text-primary">
                                                    {{ $data->email ?? "No Email Provided" }}
                                                </td>
                                                <td class="text-center">{{ $data->forBranch->branch_name }}</td>
                                                <td class="text-center">
                                                    {{ $data->address }}
                                                </td>
                                                <td class="text-primary text-center">{{ $data->contact_no }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <h2>Need Restock&nbsp;&nbsp;<i class="fa fa-list"></i></h2>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th class="text-center">BRAND</th>
                                            <th class="text-center">SUPPLIER</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($stockManagements as $stockManagement)
                                            <tr>
                                                <td><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;{{ $stockManagement->name }}</td>
                                                <td class="text-center">{{ $stockManagement->brand }}</td>
                                                <td class="text-center">{{ $stockManagement->suppliers->name }}</td>
                                                <td class="text-center">{{ $stockManagement->qty }}</td>
                                                <td class="text-center">
                                                    @if ($stockManagement->qty <= 10 && $stockManagement->qty > 0)
                                                        <span class="text-warning">Refill the Stock</span>
                                                    @elseif ($stockManagement->qty <=0 )
                                                        <span class="text-danger">Out of Stock</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <p class="text-center">No results found</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- End Panel Body --}}
            </div>

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.dashboard-scripts');
@endsection
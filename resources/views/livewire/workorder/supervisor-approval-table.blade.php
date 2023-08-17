<div>
    <div class="row">

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Supervisor's Approval</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <livewire:flash-message.flash-message-modal1 />
                    <div class="table-responsive">
                        <table id="supervisorApprovalTable" class="table table-striped table-bordered table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Job Order Number</th>
                                    <th class="text-center">Work Orders</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobOrders as $jos)
                                    <tr>
                                        <td>{{ $jos->jo_no }}</td>
                                        <td class="text-center">
                                            <span class="label label-primary">
                                                {{ count($jos->WorkOrders->where('status',6)) }} Work Order(s)
                                            </span>
                                        </td>
                                        <td class="text-success text-center">Waiting For Approval</td>
                                        <td class="text-center align-middle">
                                            <?php
                                                $cond1 = count($jos->WorkOrders->where('status', 6));
                                                $cond2 = $user_name == "Mary Cris Rabina";
                                            ?>
                                            <div class="btn-group">
                                                @if ($cond1 > 0 || $cond1 !== 0)
                                                    @foreach ($user as $user_role)
                                                        @if ($user_role->name == "Supervisor" || $user_role->name == "Salesman" || $user_role->name == "Admin" || $cond2)
                                                            <button wire:click="startALLworkOrders({{ $jos->id }})"
                                                                class="btn btn-warning delete-header m-1 btn-sm btn-labeled pull-left"
                                                                title="Start All Work orders">
                                                                Start Work Orders
                                                            </button>
                                                            @break
                                                        @else
                                                            <p class="text-center text-dark">
                                                                <i class="fa fa-warning mr-3 text-warning"></i>
                                                                You don't have any permission for this
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.approved-work-order-scripts');
@endsection

<div>
    <div wire:ignore.self class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Job Order No.</h4>
            <button type="button" class="close" data-dismiss="modal"><i
                    class="pci-cross pci-circle"></i></button>
            {{-- <a type="button" class="close" data-dismiss="modal" wire:click="closemodal">&times;</a> --}}
        </div>
        <livewire:flash-message.flash-message-modal1/>
        <!-- Modal body -->
        <div class=" modal-body d-flex justify-content-between">
            <div class="panel">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="approvedbyjoTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <th>JO NO.</th>
                                    <th class="text-center">Work Orders</th>
                                    <th class="text-center">Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($jos as $data)
                                        <tr>
                                            <td>{{ $data->jo_no }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-warning">
                                                    {{ count($data->WorkOrders) }}
                                                </span>
                                                {{-- <span class="badge badge-success">
                                                    {{ count($data->WorkOrders->where('status', 6)) }} Waiting to start
                                                    {{-- {{ count($data->WorkOrders) == 1 ? "Starting Work Order" : "Starting Work Orders" }} --}}
                                                {{-- </span>
                                                <span class="badge badge-danger">
                                                    {{ count($data->WorkOrders->where('status', 8)) }} Waiting to release
                                                </span> --}}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php 
                                                        $cond1 = count($data->WorkOrders->where('status', 6));
                                                        $cond2 =  count($data->WorkOrders->where('status', 8));
                                                        $cond3 = count($data->WorkOrders->where('status', 5));
                                                    ?>
                                                    {{-- @dd($cond2); --}}
                                                    @if($cond1 > 0 || $cond1 !== 0)
                                                        <button wire:click="startALLworkOrders({{ $data->id }})"
                                                        class="btn btn-success delete-header m-1 btn-sm btn-labeled" title="Work Order Group">
                                                        <span class="btn-label">{{ count($data->WorkOrders->where('status', 6)) }}</span>Start All Work Orders</button>
                                                    @elseif ($cond1 == 0 && $cond2 !== 0)
                                                        <span class="badge badge-info">Currently Working</span>
                                                    @elseif ($cond1 == 0 && $cond2 == 0 && $cond3 == 0)
                                                        <span class="text-success">
                                                            <i class="fa fa-check-circle-o"></i>
                                                            Work Done
                                                        </span>
                                                    @elseif ($cond2 > 0 || $cond2 !== 0)
                                                        <button wire:click="finishALLworkOrders({{ $data->id }})"
                                                            class="btn btn-danger delete-header m-1 btn-sm btn-labeled" title="Work Order Group">
                                                            <span class="btn-label">{{ count($data->WorkOrders->where('status', 8)) }}</span>Finish All Work Order</button>
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

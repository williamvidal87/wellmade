<div>
    <div wire:ignore.self class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Work Order Details</h4>
            <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            {{-- <a type="button" class="close" data-dismiss="modal" wire:click="closemodal">&times;</a> --}}
        </div>
        <!-- Modal body -->
        <div class=" modal-body d-flex justify-content-between">
            <div class="panel">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Group</th>
                                        <th class="text-center">Work</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">increase</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Est.Incnt(VAT)</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($a=0;$a<count($types);$a++)
                                        <tr>
                                            {{-- @if($data->job_type_id == 1)
                                                <th colspan="7">Job Type: {{ $types[$a] }} {{ $job_types[$types[$a]] }} item(s)</th>
                                            @endif --}}
                                            <th colspan="8">Job Type: {{ $types[$a] }} <span class="badge badge-info">{{ $job_types[$types[$a]] }}</span></th>
                                        </tr>
                                        @foreach ($workorders as $data)
                                            @if ($data->getJobType->abbriv_code == $types[$a])
                                                <tr>
                                                    <td>
                                                        <span class="text-purple"><i class="fa fa-circle"></i></span>
                                                        @if($data->mf_work_group_id)
                                                            {{ $data->getMFWorkGroup->group_name }}
                                                        @elseif($data->er_work_group_id)
                                                            {{ $data->getERWorkGroup->group_name }}
                                                        @else
                                                            {{ $data->getCalibWorkGroup->group_name }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($data->calib_work_group_id)
                                                            {{ $data->getGeneralProcedure->general_procedure_name }}
                                                        @else
                                                            {{ $data->general_procedure }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $data->qty }}</td>
                                                    <td class="text-center">{{ number_format($data->price, 2, '.', ',') }}</td>
                                                    <td class="text-center">{{ $data->amount_increase }}</td>
                                                    <td class="text=center">
                                                        @if($data->discount_id == 2)
                                                            {{ $data->getDiscount->discount }}{{ $data->max_discount }}
                                                        @else
                                                            {{ $data->max_discount }}{{ $data->getDiscount->discount }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format($data->incentive, 2, '.', ',') }}
                                                    </td>
                                                    <td class="text-center">{{ number_format($data->price * $data->qty, 2, '.', ',') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td class="text-dark text-bold">Total: {{ number_format($total, 2, '.', ',') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
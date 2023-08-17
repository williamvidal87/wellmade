<div>
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Work Order{{ auth()->user()->id }}</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
        </div>
        <!-- Modal body -->
        <div class="panel-body">
            <div class="pad-btm form-inline">
                {{-- <livewire:flash-message.flash-message-modal1 /> --}}
                <div class="row">
                    <div class="col-sm-3 table-toolbar-left">
                    </div>
                    <div class="col-sm-2 table-toolbar-left">
                        <button <?php
                            if($this->compare_status_id==9){
                                echo "disabled";
                            }
                            ?> class="btn btn-primary btn-labeled" wire:click="openModalMF"><i
                            class="btn-label demo-pli-add icon-fw"></i>Add MF</button>
                    </div>
                    <div class="col-sm-2 table-toolbar-left">
                        <button <?php
                            if($this->compare_status_id==9){
                                echo "disabled";
                            }
                            ?> class="btn btn-primary btn-labeled" wire:click="openModalEr"><i
                            class="btn-label demo-pli-add icon-fw"></i>Add ER</button>
                    </div>
                    <div class="col-sm-2 table-toolbar-left">
                        <button <?php
                            if($this->compare_status_id==9){
                                echo "disabled";
                            }
                            ?> class="btn btn-primary btn-labeled" wire:click="openModalCalib"><i
                            class="btn-label demo-pli-add icon-fw"></i>Add Calib</button>
                    </div>
                    <div class="col-sm-3 table-toolbar-left">
                    </div>
                </div>
            </div>
            <div class="table-responsive">

                <h4 class="text-dark">Job Order No: {{ $JOBNO }}</h4>
                <h4 class="text-dark">
                    Customer Name: {{ $CUSTOMER }}
                </h4>
                <div class="tableFixHead">
                <table id="work-order-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

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
                            <th class="text-center" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($a=0;$a<count($types);$a++)
                            <tr>

                                <th colspan="9">
                                    Job Type: {{ $types[$a] }} <span class="badge badge-info">{{ $job_types[$types[$a]] }}</span>

                                    @foreach ($user_role as $role)
                                        @if ($role->name == "Admin" || $role->name == "Encoder")
                                        
                                            @if ($a !== 2)
                                                <span class="pull-right mr-3">
                                                    @if($a == 0)
                                                        <button wire:click="PrintWorkTypes({{ $a }})" class="btn btn-mint delete-header m-1 btn-xs btn-labeled pull-left" title="Print All {{ $types[$a] }}">
                                                            <i class="btn-label ion-archive"></i>
                                                            Print All {{ $types[$a] }}
                                                        </button>
                                                    @elseif ($a == 1)
                                                        <button wire:click="PrintWorkTypes({{ $a }})" class="btn btn-mint delete-header m-1 btn-xs btn-labeled pull-left" title="Print All {{ $types[$a] }}">
                                                            <i class="btn-label ion-archive"></i>
                                                            Print All {{ $types[$a] }}
                                                        </button>
                                                    @endif
                                                </span>
                                            @endif

                                            @break

                                        @endif
                                    @endforeach
                                </th>
                            </tr>
                            @foreach ($work_orders_count as $data)
                                @if ($data->getJobType->abbriv_code == $types[$a])
                                    <tr 
                                        @if($data->status==3)
                                        style="background-color:#e86161"
                                        @endif
                                    >
                                        <td>
                                            <div class="checkbox">
                                                @if (count($data->workers) == 0 || $data->status == 3)
                                                    <input class="magic-checkbox" type="checkbox" name="wv_checkbox" id="{{ $data->id }}" value="{{ $data->id }}" disabled>
                                                @else
                                                    <input class="magic-checkbox" type="checkbox" name="wv_checkbox" id="{{ $data->id }}" value="{{ $data->id }}">
                                                @endif
                                                <label for="{{ $data->id }}">
                                                    @if($data->mf_work_group_id)
                                                        {{ $data->general_procedure }} 
                                                    @elseif($data->er_work_group_id)
                                                        {{ $data->getERWorkGroup->group_name }}
                                                    @else
                                                        {{ $data->getCalibWorkGroup->scope_description_name }}
                                                    @endif
                                                </label>
                                            </div>
                                            {{-- <input type="checkbox" name="wv_checkbox" id="{{ $data->id }}" value="{{ $data->id }}">
                                            @if($data->mf_work_group_id)
                                                {{ $data->general_procedure }} 
                                            @elseif($data->er_work_group_id)
                                                {{ $data->getERWorkGroup->group_name }}
                                            @else
                                                {{ $data->getCalibWorkGroup->scope_description_name }}
                                            @endif --}}
                                        </td>
                                        <td class="text-center">
                                            @if($data->calib_work_group_id)
                                                {{ $data->getGeneralProcedure->general_procedure_name }}
                                            @elseif($data->mf_work_group_id)
                                                {{ $data->scope_description }}
                                            @else
                                                {{ $data->general_procedure }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $data->qty }}</td>
                                        <td class="text-right">{{ number_format($data->price, 2, '.', ',') }}</td>
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
                                        <td class="text-right"><?php
                                                //mf
                                            // if($data->job_type_id==3){
                                            //         $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                                                
                                            // }
                                                //end mf
                                            if ($data->max_discount==0) {
                                                $data->max_discount=1;
                                                $output=0;
                                            }
                                            else{
                                                $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                                                $output=(($data->price+$data->amount_increase) * $data->qty)/$data->max_discount;
                                                if($data->job_type_id==3){
                                                    $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                                                
                                                }
                                            }
                                            if($data->status!=3){
                                            $total_add+=(($data->price+$data->amount_increase) * $data->qty)-$output;
                                            }
                                            
                                        ?>
                                        {{ number_format((($data->price+$data->amount_increase) * $data->qty)-$output, 2, '.', ',') }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                @if(count($data->getWorker) == 0)
                                                    <button wire:click="AddWorker({{ $data->id }})" class="btn btn-warning delete-header m-1 btn-sm" title="No Worker Added">
                                                        Add Worker
                                                    </button>
                                                @else
                                                    <button wire:click="AddWorker({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm" title="Add Worker">
                                                        Worker
                                                    </button>
                                                @endif
                            
                                                <button <?php
                                                if($this->compare_status_id==9){
                                                    echo "disabled";
                                                }
                                                    ?> wire:click="edit({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                {{-- @if($this->compare_status_id!=9)
                                                    <button wire:click="deleteConfirm({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                @endif --}}
                                                @if($data->status!=3)
                                                    <button wire:click="cancelWorkOrder({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Cancel">Cancel</button>
                                                @endif
                                            </div>                
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endfor
                        @php
                            $total_parts = 0;
                        @endphp
                        @if (!empty($request_parts))
                                <tr>
                                    <th colspan="9" style="text-align: left;"><b>Parts</b></th>
                                </tr>
                                @foreach ($request_parts as $request)
                                    @foreach ($request->requestToolsData as $tools)
                                        @foreach ($tools->getStockManagment as $data)
                                            @if ($loop->first)
                                                <tr>
                                                    <td colspan="2">{{ $tools->getStockManagment->name ?? '' }}</td>
                                                    <td style="text-align: center;">{{ $tools->qty ?? '' }}</td>
                                                    <td style="text-align: right;">{{ number_format($tools->selling_price, 2) ?? '' }}</td>
                                                    <td colspan="3"></td>
                                                    <td style="text-align: right;">{{ number_format($tools->qty * $tools->selling_price, 2) }}</td>
                                                    <td style="text-align: center;">
                                                        <button wire:click="editPrice({{ $tools->id }}, {{ $jo_no_id }})" class="btn btn-primary delete-header m-1 btn-sm" title="Edit Price">
                                                            Update Price
                                                        </button>
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_parts += $tools->qty * $tools->selling_price;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                                @php
                                    $total_add += $total_parts;
                                @endphp
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7"></td>
                            <td class="text-dark text-bold text-right">Total: {{ number_format($total_add, 2, '.', ',') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
                @if ($disable_print == 'error')
                    <h3 class="text-warning text-left">
                        You Haven't select any Work Order.
                    </h3>
                @endif
                {{-- <livewire:flash-message.flash-message-modal1 /> --}}
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <div class="form-group">
                @if(empty(json_decode($work)) == true)
                    {{-- <div class="pull-left btn-group">
                        <button wire:click="selectAllMethod" class="btn btn-purple delete-header m-1 btn-sm pull-left" title="Select All" disabled>
                            Select All
                        </button>
                        <button wire:click="deselect" class="btn btn-purple delete-header m-1 btn-sm pull-left" title="Deselect All" disabled>
                            Deselect All
                        </button>
                    </div> --}}
                    <div class="pull-left">
                        @if ($select_deselect == true)
                            <button wire:click="selectAllMethod" class="btn btn-purple delete-header m-1 btn-sm pull-left" title="Select All" disabled>
                                Select All
                            </button>
                        @elseif ($select_deselect == false)
                            <button wire:click="deselect" class="btn btn-purple delete-header m-1 btn-sm pull-left" title="Deselect All" disabled>
                                Deselect All
                            </button>
                        @endif
                    </div>
                    <button wire:click="PrintingWorkOrders" class="btn btn-warning delete-header m-1 btn-sm btn-labeled pull-right" title="No Work Order(s) found" disabled>
                        <i class="btn-label ion-archive"></i>
                        Print Work Orders
                    </button>
                @else
                    @foreach ($user_role as $role)

                        @if ($role->name == "Admin" || $role->name == "Encoder")
                            {{-- <div class="pull-left btn-group">
                                <button wire:click="selectAllMethod" class="btn btn-purple delete-header m-1 btn-sm pull-left" title="Select All">
                                    Select All
                                </button>
                                <button class="btn btn-purple delete-header m-1 btn-sm pull-left" wire:click="deselect" title="Deselect All">
                                    Deselect All
                                </button>
                   
                            </div> --}}
                            <div class="pull-left">
                                @if ($select_deselect == true)
                                    <button wire:click="selectAllMethod" class="btn btn-primary delete-header m-1 btn-sm pull-left btn-labeled" title="Select All">
                                        <i class="btn-label fa fa-check-square-o"></i>
                                        Select All
                                    </button>
                                @elseif ($select_deselect == false)
                                    <button wire:click="deselect" class="btn btn-danger delete-header m-1 btn-sm pull-left btn-labeled" title="Deselect All">
                                        <i class="btn-label fa fa-check-square"></i>
                                        Deselect All
                                    </button>
                                @endif
                            </div>
                            <button wire:click="PrintingWorkOrders" class="btn btn-primary delete-header m-1 btn-sm pull-right" title="Print All">
                                <i class="fa fa-download"></i>
                            </button>
                        @endif

                        @break

                    @endforeach

                @endif
            </div>
        </div>
    </div>
    
    
</div>
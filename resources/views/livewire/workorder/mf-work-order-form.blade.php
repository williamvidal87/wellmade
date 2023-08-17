<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">MF Work Order</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">

                {{-- start sample --}}
                <div class="panel">

                    <!--Panel heading-->
                    <div class="panel-heading">
                        <div class="panel-control">
                            <ul class="nav nav-tabs">
                                <li class="active" wire:ignore><a href="#detailsMF" data-toggle="tab" aria-expanded="false">Details</a></li>
                                <li class="" wire:ignore><a href="#toolsMF" data-toggle="tab" aria-expanded="true">Tools and Equipments</a></li>
                            </ul>
                        </div>
                    </div>

                    <!--Panel body-->
                    <div class="panel-body">
                        <div class="tab-content">
                            <div wire:ignore.self class="tab-pane fade active in" id="detailsMF">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right" for="reference_no_id">Reference No</label>
                                            <div class="col-sm-8">
                                                <input type="text" wire:model.defer="reference_no_id" name="reference_no_id" class="form-control" id="reference_no_id" readonly>
                                            </div>
                                            @if($errors->has('reference_no_id'))
                                            <p style="color:red">{{$errors->first('reference_no_id')}}</p>
                                            @endif
                                        </div>
                                        <br>
                                        <div>
                                            <br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right" for="mf_work_group_select">MF Work Group</label>
                                                <div class="col-sm-8">
                                                    <select name="mf_work_group_id" wire:model="mf_work_group_id"class="form-control select_design" id="mf_work_group_select" required>
                                                        <option value=''>Choose mf work group</option>
                                                        @foreach($workgroups as $data)
                                                        <option value="{{ $data->id }}">{{ $data->group_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('mf_work_group_id'))
                                                <p style="color:red">{{$errors->first('mf_work_group_id')}}</p>
                                                @endif
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right" for="work_sub_type_select">Work Sub Type</label>
                                                <div class="col-sm-8">
                                                    <select name="mf_work_sub_type_id" wire:model="mf_work_sub_type_id" class="form-control select_design" id="work_sub_type_select"
                                                        required>
                                                        <option value=''>Choose Work Sub Type</option>
                                                        @foreach($subType as $data)
                                                        <option value="{{ $data->id }}">{{ $data->work_sub_type_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('mf_work_sub_type_id'))
                                                <p style="color:red">{{$errors->first('mf_work_sub_type_id')}}</p>
                                                @endif
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right"
                                                    for="general_procedure">General Procedure</label>
                                                <div class="col-sm-8">
                                                    <input type="text" wire:model="general_procedure" wire:change="populateScopeDescription($event.target.value)" name="general_procedure" class="form-control" id="general_procedure" required>
                                                </div>
                                                @if($errors->has('general_procedure'))
                                                <p style="color:red">{{$errors->first('general_procedure')}}</p>
                                                @endif
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right"
                                                    for="scope_input">Scope/Description</label>
                                                <div class="col-sm-8">
                                                    <input type="text" wire:model.defer="scope_description" name="scope_description" class="form-control" id="scope_input" required>
                                                </div>
                                                @if($errors->has('scope_description'))
                                                <p style="color:red">{{$errors->first('scope_description')}}</p>
                                                @endif
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right" for="process_group_select">Process Group</label>
                                                <div class="col-sm-8">
                                                    <select name="process_group_id" wire:model="process_group_id" class="form-control select_design" id="process_group_select" required>
                                                        <option value=''>Choose Process Group</option>
                                                        @foreach($processgroup as $data)
                                                        <option value="{{ $data->id }}">{{ $data->process_group_name}}</option>
                                                        @endforeach
                                                        @foreach($processgroup as $data)
                                                        @if($data->id==$mf_work_sub_type_id)
                                                        <option value="{{ $data->id }}">{{ $data->process_group_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('process_group_id'))
                                                <p style="color:red">{{$errors->first('process_group_id')}}</p>
                                                @endif
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right" for="process_subgroup_select">Process SubGroup</label>
                                                <div class="col-sm-8">
                                                    <select name="process_subgroup_id" wire:model.defer="process_subgroup_id" class="form-control select_design" id="process_subgroup_select" required>
                                                        <option value=''>Choose Process SubGroup</option>
                                                        @foreach($processsubgroup as $data)
                                                        @if($data->process_group_id==$process_group_id)
                                                        <option value="{{ $data->id }}">{{ $data->process_sub_group_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('process_subgroup_id'))
                                                <p style="color:red">{{$errors->first('process_subgroup_id')}}</p>
                                                @endif
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right" for="machine_select">Machine</label>
                                                <div class="col-sm-8">
                                                    <select name="machine_id" wire:model.defer="machine_id" class="form-control select_design" id="machine_select">
                                                        <option value=''>Choose Machine</option>
                                                        </option>
                                                        @foreach($machines as $data)
                                                        <option value="{{ $data->id }}">{{ $data->getGroups->machine_group_name ?? '?'}} - {{ $data->getAssignSubGroup->getMachineSubGroup->machine_sub_group_name ?? '?'}} - {{ $data->getMachineDescriptionName->description ?? '?'}} [ {{ $data->getGroups->getMachineGroupIdNumber->machine_id_number ?? '?'}}-{{ $data->getAssignSubGroup->getMachineNumber->machine_id_number ?? '?'}}-{{ $data->getMachineDescriptionName->getmachinedescriptionnumberid->machine_id_number ?? '?'}}-<?php
                                                            $yearOnly=substr($data->arrival_date,0,4);
                                                                echo 'Y'.$yearOnly ?? '?';
                                                                echo '-';
                                                            if($data->capacity==0||$data->capacity==null){
                                                                echo 'nc';
                                                            }else{
                                                                echo $data->capacity;
                                                                echo $data->getmachineunit->machine_unit_name;
                                                            }
                                                                echo '-';
                                                                echo $data->getmachinebrand->acro_name ?? 'NB';
                                                        ?>
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if($errors->has('machine_id'))
                                                <p style="color:red">{{$errors->first('machine_id')}}</p>
                                                @endif
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right" for="suggested_cost_input">Suggested Cost</label>
                                                <div class="col-sm-8">
                                                    <input type="text" wire:model.defer="suggested_cost" name="suggested_cost" class="form-control" id="suggested_cost_input" disabled style="width: 10rem">
                                                    @if($errors->has('suggested_cost'))
                                                    <p style="color:red">{{$errors->first('suggested_cost')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label text-right" for="process_cost_input">Process Cost</label>
                                                <div class="col-sm-8">
                                                    <input type="text" wire:model.defer="process_cost" name="process_cost" class="form-control" id="process_cost_input" style="width: 10rem">
                                                    @if($errors->has('process_cost'))
                                                    <p style="color:red">{{$errors->first('process_cost')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 border border-info" style="border-style: dashed">
                                        <div class="form-group pt-2">
                                            <label class="col-sm-4 control-label text-right"
                                                for="part_required_input">Parts Required</label>
                                            <div class="col-sm-8">
                                                <select name="parts_required_id" wire:model.defer="parts_required_id"
                                                    class="form-control select_design" id="part_required_input"
                                                    required>
                                                    <option value="" selected>Choose Parts Required</option>
                                                    @foreach($statuses as $data)
                                                    <option value="{{ $data->id }}" selected>{{ $data->status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if($errors->has('parts_required_id'))
                                            <p style="color:red">{{$errors->first('parts_required_id')}}</p>
                                            @endif
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right"
                                                for="hours_input">Hours</label>
                                            <div class="col-sm-8">
                                                <input type="number" step="any" wire:model.defer="hours" name="hours"
                                                    class="form-control" id="hours_input" required style="width: 10rem">
                                            </div>
                                            @if($errors->has('hours'))
                                            <p style="color:red">{{$errors->first('hours')}}</p>
                                            @endif
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right"
                                                for="Quantity_input">Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" wire:model="qty" name="qty"
                                                    class="form-control" id="Quantity_input" required
                                                    style="width: 10rem" wire:change="change">
                                            </div>
                                            @if($errors->has('qty'))
                                            <p style="color:red">{{$errors->first('qty')}}</p>
                                            @endif
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right"
                                                for="price_input">Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" step="any" wire:model="price" name="price" class="form-control" id="price_input" required style="width: 10rem" wire:change="change">
                                                @if($errors->has('price'))
                                                <p style="color:red">{{$errors->first('price')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right"
                                                for="amount_increase_input">Amnt. Increase</label>
                                            <div class="col-sm-8">
                                                <input type="number" step="any" wire:model="amount_increase"
                                                    name="amount_increase" class="form-control"
                                                    id="amount_increase_input" required style="width: 10rem" wire:change="change">
                                                @if($errors->has('amount_increase'))
                                                <p style="color:red">{{$errors->first('amount_increase')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right"
                                                for="discount_select">Discount</label>
                                            <div class="col-sm-2">
                                                <select name="discount_id" wire:model.defer="discount_id"
                                                    class="form-control select_design" id="discount_select" required
                                                    style="width: 7rem">
                                                    <option value=''>Type</option>
                                                    @foreach($discount as $data)
                                                    <option value="{{ $data->id }}">{{ $data->discount}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" max="{{ $this->display_max_discount }}" step="any" wire:model="max_discount" name="max_discount"
                                                    class="form-control" id="maxdiscount_input" required
                                                    style="width: 7rem" wire:change="change">
                                                    {{-- commented by william --}}
                                            </div>
                                            {{-- commented by william --}}
                                            <label class="col-sm-4 control-label text-right"
                                                for="maxdiscount_input">MaxDiscount: {{ $this->display_max_discount }}%</label>
                                        </div>
                                        <br>
                                        @if($errors->has('discount_id'))
                                        <p class="col-sm-4"></p>
                                        <p style="color:red">{{$errors->first('discount_id')}}</p>
                                        @endif
                                        <br>
                                        @if($errors->has('max_discount'))
                                        <p class="col-sm-4"></p>
                                        <p style="color:red" class="col-sm-8">{{$errors->first('max_discount')}}</p>
                                        @endif
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right"
                                                for="incentive_type_select">Incentive Type</label>
                                            <div class="col-sm-8">
                                                <select name="incentive_type_id" wire:model.defer="incentive_type_id"
                                                    class="form-control select_design" id="incentive_type_select"
                                                    required wire:change="change">
                                                    <option value=''>Choose Incentive Type</option>
                                                    @foreach($incentive_types as $data)
                                                    <option value="{{ $data->id }}">{{ $data->incentive_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if($errors->has('incentive_type_id'))
                                            <p style="color:red">{{$errors->first('incentive_type_id')}}</p>
                                            @endif
                                        </div>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label text-right"
                                                for="incentive_input">Incentive</label>
                                            <div class="col-sm-8">
                                                <input type="text" wire:model="incentive" name="incentive" readonly
                                                    class="form-control" id="incentive_input">
                                            </div>
                                            @if($errors->has('incentive'))
                                            <p style="color:red">{{$errors->first('incentive')}}</p>
                                            @endif
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label text-right"
                                                for="remarks_input">Remark(s)</label>
                                            <div class="col-sm-10">
                                                <textarea wire:model.defer="remarks" name="remarks" class="form-control"
                                                    id="remarks_input" rows="4"></textarea>
                                            </div>
                                            @if($errors->has('remarks'))
                                            <p style="color:red">{{$errors->first('remarks')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- tools start --}}
                            <div wire:ignore.self class="tab-pane fade" id="toolsMF">
                                <table class="table" id="products_table">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderProducts as $index => $orderProduct)
                                        <tr>
                                            <td>
                                                <select name="orderProducts[{{$index}}][item_names]"
                                                    wire:model="orderProducts.{{$index}}.item_names"
                                                    class="form-control" required>
                                                    <option value="">-- choose product --</option>
                                                    @foreach ($select_items as $product)
                                                    <option 
                                                    <?php 
                                                    for ($i=0; $i < count($this->orderProducts); $i++) {
                                                    
                                                    if(!empty($this->orderProducts[$i]['item_names'])){
                                                    
                                                    
                                                        if ($product->id == $this->orderProducts[$i]['item_names']) {
                                                        if ($this->orderProducts[$index]['item_names'] == $this->orderProducts[$i]['item_names']) {
                                                        // echo "none";
                                                        } else {
                                                        echo "disabled";
                                                        }
                                                            }
                                                        }
                                                        }
                                                        ?> value="{{ $product->id }}">
                                                        {{ $product->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="orderProducts[{{$index}}][quantity]"
                                                    class="form-control" wire:model="orderProducts.{{$index}}.quantity"
                                                    required />
                                                @if($bagerror[$index]==1)
                                                <p style="color:red">selected quantity is greater than stocks on hand
                                                </p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" wire:click.prevent="removeProduct({{$index}})"
                                                    class="btn btn-danger btn-sm" title="delete"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-primary" wire:click.prevent="addProduct">+ Add
                                            Tools</button>
                                    </div>
                                </div>
                            </div>
                            {{-- tools end --}}
                        </div>
                    </div>
                </div>
                {{-- end sample --}}


            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Calib Work Order</h4>
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
                            <li class="active" wire:ignore><a href="#detailsCalib" data-toggle="tab" aria-expanded="false">Details</a></li>
                            <li class="" wire:ignore><a href="#toolsCalib" data-toggle="tab" aria-expanded="true">Tools and Equipments</a></li>
                        </ul>
                    </div>
                </div>
            
                <!--Panel body-->
                <div class="panel-body">
                    <div class="tab-content">
                        <div wire:ignore.self class="tab-pane fade active in" id="detailsCalib">
                            <div class="row">
                                       
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="reference_no_id">Job Order no:</label>
                                        <div class="col-sm-8">
                                            <input  type="text" wire:model.defer="reference_no_id" name="reference_no_id" class="form-control" id="reference_no_id" readonly>
                                        </div>
                                            @if($errors->has('reference_no_id'))
                                                <p style="color:red">{{$errors->first('reference_no_id')}}</p>
                                            @endif
                                    </div>
                                    <br><br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="calib_work_group_id">Calib Work Group:</label>
                                        <div class="col-sm-8">                                
                                            <select name="calib_work_group_id" wire:model="calib_work_group_id" class="form-control select_design" id="calib_work_group_id" required>                                    
                                                <option value=''>Select Calib Work Group</option>
                                                @foreach($calibworkgroup as $data)
                                                    <option value="{{ $data->id }}">{{ $data->group_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            @if($errors->has('calib_work_group_id'))
                                            <p style="color:red">{{$errors->first('calib_work_group_id')}}</p>
                                            @endif
                                    </div><br><br>                           
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="calib_work_sub_type_id">Work Sub Type:</label>
                                        <div class="col-sm-8">
                                            <select name="calib_work_sub_type_id" wire:model="calib_work_sub_type_id" class="form-control select_design" id="calib_work_sub_type_id" required>
                                                <option value=''>Select Work Sub Type</option>
                                                @foreach($worksubtype as $data)
                                                <option value="{{ $data->id }}">{{ $data->sub_group}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            @if($errors->has('calib_work_sub_type_id'))
                                                <p style="color:red">{{$errors->first('calib_work_sub_type_id')}}</p>
                                            @endif
                                    </div><br><br>                           
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="general_procedure_id">General Procedure:</label>
                                        <div class="col-sm-8">
                                            <select name="general_procedure_id" wire:model="general_procedure_id" class="form-control select_design" id="general_procedure_id" required>
                                                <option>Select General Procedure</option>
                                                @foreach($generalprocedure as $data)
                                                @if($data->work_sub_type_id==$calib_work_sub_type_id)
                                                <option value="{{ $data->id }}">{{ $data->general_procedure_name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                            @if($errors->has('general_procedure_id'))
                                                <p style="color:red">{{$errors->first('general_procedure_id')}}</p>
                                            @endif
                                    </div><br><br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="scope_description_id">Scope/Description:</label>
                                        <div class="col-sm-8">
                                            <select name="scope_description_id" wire:model="scope_description_id" class="form-control select_design" id="scope_description_id" required>
                                                    <option 
                                                    <?php
                                                        if(!empty($scope_description_id)){
                                                        echo "disabled";
                                                        }
                                                    ?>
                                                    >-- Select Scope/Description --</option>
                                                    @foreach($scopedescriptions as $data)
                                                    @if($data->general_procedure_id==$general_procedure_id)
                                                    <option value="{{ $data->id }}"
                                                    @foreach($exist_scope_description_id as $nextdata)
                                                        <?php
                                                            if($nextdata->jo_no_id==$jo_no_id){
                                                                if($nextdata->scope_description_id==$data->id){
                                                                    if($data->id==$scope_description_id){
                                                                    //none
                                                                    }
                                                                    else{
                                                                        echo "disabled";
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    @endforeach
                                                    >{{ $data->scope_description_name}}</option>
                                                    @endif
                                                    @endforeach
                                            </select>
                                        </div>
                                            @if($errors->has('scope_description_id'))
                                                <p style="color:red">{{$errors->first('scope_description_id')}}</p>
                                            @endif
                                    </div><br><br>                       
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="machine_id">Machine:</label>
                                        <div class="col-sm-8">
                                            <select name="machine_id" wire:model.defer="machine_id" class="form-control select_design" id="machine_id">
                                                <option value=''>Select Machine</option>
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
                                    </div><br><br>   
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="remarks">Remark(s):</label>
                                        <div class="col-sm-8">                                
                                                <textarea wire:model.defer="remarks" name="remarks" class="form-control" id="remarks" rows="8"></textarea>                                
                                        </div>
                                            @if($errors->has('remarks'))
                                                <p style="color:red">{{$errors->first('remarks')}}</p>
                                            @endif
                                    </div>   
                                </div>
                                <div class="col-md-6 border border-info " style="border-style: dashed">
                                    <div class="form-group mt-3">
                                        <label class="col-sm-4 control-label text-right" for="parts_required_id">Parts Required?:</label>
                                        <div class="col-sm-8">
                                            <select name="parts_required_id" wire:model.defer="parts_required_id" class="form-control select_design" id="parts_required_id" required>
                                                <option value=''>Select Option</option>
                                                    @foreach($statuses as $data)
                                                        <option value="{{ $data->id }}">{{ $data->status}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                            @if($errors->has('parts_required_id'))
                                                <p style="color:red">{{$errors->first('parts_required_id')}}</p>
                                            @endif
                                    </div>
                                    <br><br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="hours">Hours:</label>
                                        <div class="col-sm-4">
                                            <input  type="number" step="any" wire:model.defer="hours" name="hours" class="form-control" id="hours" required>
                                        </div>
                                            @if($errors->has('hours'))
                                                <p style="color:red">{{$errors->first('hours')}}</p>
                                            @endif
                                    </div><br><br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="qty">Quantity:</label>
                                        <div class="col-sm-4">
                                            <input  type="number" wire:model="qty" name="qty" class="form-control" id="qty" required wire:change="change">
                                        </div>
                                            @if($errors->has('qty'))
                                                <p style="color:red">{{$errors->first('qty')}}</p>
                                            @endif
                                    </div><br><br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="price">Price:</label>
                                        <div class="col-sm-4">
                                            <input  type="number" step="any" wire:model="price" name="price" class="form-control" id="price" required wire:change="change">
                                        </div>
                                            @if($errors->has('price'))
                                                <p style="color:red">{{$errors->first('price')}}</p>
                                            @endif
                                    </div><br><br>                          
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="amount_increase">Amount Increase:</label>
                                        <div class="col-sm-4">
                                            <input  type="number" step="any" wire:model="amount_increase" name="amount_increase" class="form-control" id="amount_increase" required wire:change="change">
                                        </div>
                                            @if($errors->has('amount_increase'))
                                                <p style="color:red">{{$errors->first('amount_increase')}}</p>
                                            @endif
                                    </div><br><br>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label text-right" for="discount_id">Discount:</label>
                                        <div class="col-sm-2">
                                            <select name="discount_id" wire:model.defer="discount_id" class="form-control select_design" id="discount_id" required style="width: 7rem">
                                                <option value=''>Type</option>
                                                    @foreach($discount as $data)
                                                        <option value="{{ $data->id }}">{{ $data->discount}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <input  type="number" max="{{ $this->display_max_discount }}" step="any" wire:model="max_discount" name="max_discount" class="form-control" id="max_discount" required style="width: 7rem" wire:change="change">
                                        </div>
                                            <label class="col-sm-4 control-label text-right" for="max_discount">MaxDiscount: {{ $this->display_max_discount }}%</label>
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
                                        <label class="col-sm-4 control-label text-right" for="incentive">Incentive:</label>
                                        <div class="col-sm-4">
                                            <input  type="text" wire:model="incentive" name="incentive" class="form-control" id="incentive" readonly>
                                        </div>
                                            @if($errors->has('incentive'))
                                                <p style="color:red">{{$errors->first('incentive')}}</p>
                                            @endif
                                    </div><br><br>                          
                                </div>      

                            </div>   
                        </div>
                        <div wire:ignore.self class="tab-pane fade " id="toolsCalib">
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
                                            <select name="orderProducts[{{$index}}][item_names]" wire:model="orderProducts.{{$index}}.item_names" class="form-control" required>
                                                <option value="">-- choose product --</option>
                                                @foreach ($select_items as $product)
                                                    <option 
                                                    <?php
                                                    for ($i=0; $i < count($this->orderProducts); $i++) {
                                                        if(!empty($this->orderProducts[$i]['item_names'])){
                                                        if ($product->id==$this->orderProducts[$i]['item_names']) {
                                                        
                                                            if($this->orderProducts[$index]['item_names']==$this->orderProducts[$i]['item_names']){
                                                            // echo "none";
                                                            }
                                                            else{
                                                            echo "disabled";
                                                            }
                                                        }
                                                    }
                                                    }
                                                    ?>
                                                    value="{{ $product->id }}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="orderProducts[{{$index}}][quantity]" class="form-control" wire:model="orderProducts.{{$index}}.quantity" required/>
                                            @if($bagerror[$index]==1)
                                                <p style="color:red">selected quantity is greater than stocks on hand</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" wire:click.prevent="removeProduct({{$index}})" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>            
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary" wire:click.prevent="addProduct">+ Add Tools</button>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
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
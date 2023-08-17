<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Request Tools/Supplies</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group rounded p-2" style="border: 1px dashed #444;">
                            <label class="text-bold">Request Type</label>
                            @if ($viewRequestToolsId != null)
                                <div style="height: 150px; overflow-y: scroll;">
                                    @foreach ($loan_consumables as $loan_consume)
                                        <div class="form-check mb-2">
                                            <input wire:model.lazy="request_type" type="checkbox" class="form-check-input"  value="{{ $loan_consume->id }}" id="{{ $loan_consume->name }}" disabled="disabled">
                                            <label class="form-check-label" for="{{ $loan_consume->name }}">
                                                {{ $loan_consume->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div style="height: 150px; overflow-y: scroll;">
                                    @foreach ($loan_consumables as $loan_consume)
                                        <div class="form-check mb-2">
                                            <input wire:model.lazy="request_type" type="checkbox" class="form-check-input"  value="{{ $loan_consume->id }}" id="{{ $loan_consume->name }}">
                                            <label class="form-check-label" for="{{ $loan_consume->name }}">
                                                {{ $loan_consume->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @if($errors->has('request_type'))
                        <p style="color:red">{{$errors->first('request_type')}}</p>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        @if ($viewRequestToolsId != null)
                            <div class="form-group">
                                <label>Work Area:</label>
                                    <select name="work_area_id" wire:model="work_area_id" class="form-control select_design" id="work_area_id" disabled="disabled">
                                        <option value=''>--Choose Work Area--</option>
                                        @foreach($work_area as $data)
                                        <option value="{{ $data->id }}">{{ $data->name}}</option>
                                        @endforeach
                                    </select>
                                @if($errors->has('work_area_id'))
                                <p style="color:red">{{$errors->first('work_area_id')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input  type="date" wire:model="date" name="date" class="form-control" required readonly>
                                @if($errors->has('date'))
                                <p style="color:red">{{$errors->first('date')}}</p>
                                @endif
                            </div> 
                            <div class="form-group">
                                <label>Request by</label>
                                <select wire:model="request_by_id" name="request_by_id" id="request_by_id" class="form-control" required disabled="disabled">
                                    <option value="">-- Select Request by --</option>
                                    @foreach ($requests as $request)
                                        <option value="{{ $request->id }}">{{ $request->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('request_by_id'))
                                <p style="color:red">{{$errors->first('request_by_id')}}</p>
                                @endif
                            </div>
                            <div class="form-group" wire:ignore>
                                <label>JO No</label>
                                <select wire.ignore.self id="jo_no_id" style="width: 100%;" wire:model="jo_no_id" name="jo_no_id" class="form-control" required disabled="disabled">
                                    <option value="">-- Select a Jo No --</option>
                                    @foreach ($job_orders as $data)
                                        <option value="{{ $data->id }}">{{ $data->jo_no }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('jo_no_id'))
                                <p style="color:red">{{$errors->first('jo_no_id')}}</p>
                                @endif
                            </div>
                        @else
                        <div class="form-group">
                            <label>Work Area:</label>
                                <select name="work_area_id" wire:model="work_area_id" class="form-control select_design" id="work_area_id" {{ $hasSpareparts ? 'disabled="disabled"' : ''}}>
                                    <option value=''>--Choose Work Area--</option>
                                    @foreach($work_area as $data)
                                    <option value="{{ $data->id }}">{{ $data->name}}</option>
                                    @endforeach
                                </select>
                            @if($errors->has('work_area_id'))
                            <p style="color:red">{{$errors->first('work_area_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input  type="date" wire:model="date" name="date" class="form-control" required>
                            @if($errors->has('date'))
                            <p style="color:red">{{$errors->first('date')}}</p>
                            @endif
                        </div> 
                        <div class="form-group">
                            <label>Request by</label>
                            <select wire:model="request_by_id" name="request_by_id" id="request_by_id" class="form-control" required>
                                <option value="">-- Select Request by --</option>
                                @foreach ($requests as $request)
                                    <option value="{{ $request->id }}">{{ $request->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('request_by_id'))
                            <p style="color:red">{{$errors->first('request_by_id')}}</p>
                            @endif
                        </div> 
                            <div class="form-group" wire:ignore>
                                <label>JO No</label>
                                <select wire.ignore.self id="jo_no_id" style="width: 100%;" wire:model="jo_no_id" name="jo_no_id" class="form-control" {{ $has_jo ? 'required' : '' }}>
                                    <option value="">-- Select a Jo No --</option>
                                    @foreach ($job_orders as $data)
                                        <option value="{{ $data->id }}">{{ $data->jo_no }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('jo_no_id'))
                                <p style="color:red">{{$errors->first('jo_no_id')}}</p>
                                @endif
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @if ($viewRequestToolsId != null)
                            <button class="btn btn-info" wire:click.prevent="addItem" disabled><i class="demo-pli-add icon-fw"></i>Add Item</button>
                        @else
                            <button class="btn btn-info" wire:click.prevent="addItem"><i class="demo-pli-add icon-fw"></i>Add Item</button>
                        @endif
                        <br><br>
                        <table id="tools" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th class="col-lg-2">ITEM NAME</th>
                                    <th class="col-lg-2">DEPT</th>
                                    <th class="col-lg-2">PRICE</th>
                                    <th>QTY</th>
                                    <th>TOTAL</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listItems as $index => $item)
                                @if ($viewRequestToolsId != null)
                                    <tr>
                                        <td class="col-lg-2" wire:ignore>
                                            <select wire.ignore.self wire:model="listItems.{{$index}}.item_name" style="width: 100%;" name="listItems[{{$index}}][item_name]" class="form-control product_id"  {{ empty($request_type) ? 'disabled' : '' }} required disabled="disabled">
                                                <option value="">-- Choose a product --</option>
                                                @if(!empty($this->consumes))
                                                    @foreach ($products as $product)
                                                        <option
                                                        <?php
                                                        for ($i=0; $i < sizeof($listItems); $i++) {
                                                            if(!empty($listItems[$i]['item_name'])){
                                                                if(!empty($index)){
                                                                    if($product->id == $listItems[$i]['item_name']){
                                                                        if($listItems[$index]['item_name']==$listItems[$i]['item_name']){
                                                                        // echo "";
                                                                        }else{
                                                                        echo "disabled";
                                                                        }   
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td class="col-lg-2">
                                            <input  type="text" wire:model="listItems.{{$index}}.dept" name="listItems[{{$index}}][dept]" class="form-control" min="1" required readonly disabled="disabled">
                                        </td>
                                        <td class="col-lg-2">
                                            <input  type="text" wire:model="listItems.{{$index}}.price" name="listItems[{{$index}}][price]" class="form-control" required readonly disabled="disabled">
                                        </td>
                                        <td>
                                            <input style="text-align:right;"  type="text" wire:model="listItems.{{$index}}.qty" min="1" name="listItems[{{$index}}][qty] " class="form-control" required {{ empty($request_type) ? 'disabled' : '' }} disabled="disabled">
                                            @if ($custom_qty_error[$index] ?? [] == true)
                                                <small style="color:red">Selected quantity is greater than stocks on hand</small>
                                            @endif
                                        </td>
                                        <td>
                                            <input style="text-align:right;"  type="text" wire:model="listItems.{{$index}}.total" name="listItems[{{$index}}][total] " class="form-control" readonly disabled="disabled">
                                        </td>
                                        <td>
                                            <button wire:click="deleteItem({{ $index }})" class="btn btn-info delete-header m-1 btn-sm"  title="Delete Item" disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="col-lg-2">
                                            <select wire.ignore.self wire:model="listItems.{{$index}}.item_name" style="width: 100%;" name="listItems[{{$index}}][item_name]" class="form-control product_id"  {{ empty($request_type) ? 'disabled' : '' }} required>
                                                <option value="">-- Choose a product --</option>
                                                @if(!empty($this->consumes))
                                                    @foreach ($products as $product)
                                                        <option
                                                        <?php
                                                        for ($i=0; $i < sizeof($listItems); $i++) {
                                                            if(!empty($listItems[$i]['item_name'])){
                                                                if(!empty($index)){
                                                                    if($product->id == $listItems[$i]['item_name']){
                                                                        if($listItems[$index]['item_name']==$listItems[$i]['item_name']){
                                                                        // echo "";
                                                                        }else{
                                                                        echo "disabled";
                                                                        }   
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td class="col-lg-2">
                                            <input  type="text" wire:model="listItems.{{$index}}.dept" name="listItems[{{$index}}][dept]" class="form-control" min="1" required readonly>
                                        </td>
                                        <td class="col-lg-2">
                                            <input  type="text" wire:model="listItems.{{$index}}.price" name="listItems[{{$index}}][price]" class="form-control" required readonly>
                                        </td>
                                        <td>
                                            <input style="text-align:right;"  type="text" wire:model.lazy="listItems.{{$index}}.qty" min="1" name="listItems[{{$index}}][qty] " class="form-control" required {{ empty($request_type) ? 'disabled' : '' }}>
                                            @if ($custom_qty_error[$index] ?? [] == true)
                                                <small style="color:red">Selected quantity is greater than stocks on hand</small>
                                            @endif
                                        </td>
                                        <td>
                                            <input style="text-align:right;"  type="text" wire:model="listItems.{{$index}}.total" name="listItems[{{$index}}][total] " class="form-control" readonly>
                                        </td>
                                        <td>
                                            <a wire:click="deleteItem({{ $index }})" class="btn btn-info delete-header m-1 btn-sm"  title="Delete Item"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td colspan="3" style="text-align: center;"><b>-- TOTAL --</b></td>
                                    <td><input style="text-align:right;"  type="text" wire:model="all_total_qty" name="all_total_qty" class="form-control" readonly></td>
                                    <td><input style="text-align:right;"  type="text" wire:model="all_total_price" name="all_total_price" class="form-control" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        @if ($viewRequestToolsId != null)
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea  wire:model.defer="remarks" name="remarks" class="form-control"  rows="5" disabled="disabled"></textarea>
                                @if($errors->has('remarks'))
                                <p style="color:red">{{$errors->first('remarks')}}</p>
                                @endif
                            </div>
                        @else
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea  wire:model.defer="remarks" name="remarks" class="form-control"  rows="5"></textarea>
                                @if($errors->has('remarks'))
                                <p style="color:red">{{$errors->first('remarks')}}</p>
                                @endif
                            </div>
                        @endif
                    </div>  
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                @if ($viewRequestToolsId != null)
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary  pull-right" disabled="disabled">Save</button>
                    </div>
                @else
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary  pull-right">Save</button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

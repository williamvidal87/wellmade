<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Procurement Management</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-2">
                        @if ($viewProcurementManagement != null)
                            <div class="form-group">
                                <label>Date</label>
                                <input  type="date" wire:model.defer="date" name="date" class="form-control" required disabled="disabled">
                                @if($errors->has('date'))
                                <p style="color:red">{{$errors->first('date')}}</p>
                                @endif
                            </div>
                        @else
                            <div class="form-group">
                                <label>Date</label>
                                <input  type="date" wire:model.defer="date" name="date" class="form-control" required>
                                @if($errors->has('date'))
                                <p style="color:red">{{$errors->first('date')}}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        @if ($viewProcurementManagement != null)
                            <div class="form-group">
                                <label>PR NO:</label>
                                <input  type="text" wire:model.defer="pr_no" name="pr_no" class="form-control" required disabled="disabled">
                                @if($errors->has('pr_no'))
                                <p style="color:red">{{$errors->first('pr_no')}}</p>
                                @endif
                            </div>
                        @else
                            <div class="form-group">
                                <label>PR NO:</label>
                                <input  type="text" wire:model.defer="pr_no" name="pr_no" class="form-control" required>
                                @if($errors->has('pr_no'))
                                <p style="color:red">{{$errors->first('pr_no')}}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6">
                        @if ($viewProcurementManagement != null)
                            <div class="form-group">
                                <label>Supplier</label>
                                <select wire:model="supplier_id" name="supplier_id" id="supplier_id" class="form-control" required disabled="disabled">
                                    <option value="">-- Select a type --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('supplier_id'))
                                <p style="color:red">{{$errors->first('supplier_id')}}</p>
                                @endif
                            </div>
                        @else
                            <div class="form-group" wire:ignore>
                                <label>Supplier</label>
                                <select wire.ignore.self wire:model.defer="supplier_id" name="supplier_id" id="supplierId" style="width: 100%;" class="form-control" required>
                                    <option value="">-- Select a type --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('supplier_id'))
                                <p style="color:red">{{$errors->first('supplier_id')}}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-info" wire:click.prevent="addItem" {{ $viewProcurementManagement != null ? "disabled='disabled'" : '' }}><i class="demo-pli-add icon-fw"></i>Add Item/Product</button>
                        <br><br>
                        <table id="tools" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th class="col-lg-2">PRODUCT</th>
                                    <th class="col-lg-2">QTY</th>
                                    <th class="col-lg-2">UNIT</th>
                                    <th>PRICE</th>
                                    <th>TOTAL PRICE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listItems as $index => $item)
                                    @if ($viewProcurementManagement != null)
                                        <tr>
                                            <td class="col-lg-2" wire:ignore>
                                                <select wire.ignore.self wire:model="listItems.{{$index}}.product" style="width: 100%;" name="listItems[{{$index}}][product]" class="form-control product_id" required {{ empty($supplier_id) ? 'disabled' : '' }} disabled="disabled">
                                                    <option value="">-- Choose a product --</option>
                                                    @if (!empty($supplier_id))
                                                        @foreach ($products as $product)
                                                            <option
                                                                <?php
                                                                for ($i=0; $i < sizeof($listItems); $i++) {
                                                                    if(!empty($listItems[$i]['product'])){
                                                                        if(!empty($index)){
                                                                            if($product->id == $listItems[$i]['product']){
                                                                                if($listItems[$index]['product']==$listItems[$i]['product']){
                                                                                // echo "";
                                                                                }else{
                                                                                echo "disabled";
                                                                                }   
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            value="{{ $product->id }}">
                                                                {{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="col-lg-2">
                                                <input  type="text" wire:model.lazy="listItems.{{$index}}.qty" name="listItems[{{$index}}][qty]" class="form-control" min="1" required {{ empty($supplier_id) ? 'disabled' : '' }} disabled="disabled"></td>
                                            <td class="col-lg-2">
                                                <input  type="text" wire:model="listItems.{{$index}}.unit" name="listItems[{{$index}}][unit]" class="form-control" required readonly></td>
                                            </td>
                                            <td>
                                                <input style="text-align:right;"  type="text" wire:model="listItems.{{$index}}.price" name="listItems[{{$index}}][price] " class="form-control" required readonly></td>
                                            </td>
                                            <td>
                                                <input style="text-align:right;"  type="text" wire:model="listItems.{{$index}}.total_price" name="listItems[{{$index}}][total_price] " class="form-control" readonly></td>
                                            </td>
                                            <td>
                                            <button wire:click="deleteItem({{ $index }})" class="btn btn-info delete-header m-1 btn-sm"  title="Delete Item" disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="col-lg-2">
                                                <select wire.ignore.self wire:model="listItems.{{$index}}.product" style="width: 100%;" name="listItems[{{$index}}][product]" class="form-control product_id" required {{ empty($supplier_id) ? 'disabled' : '' }}>
                                                    <option value="">-- Choose a product --</option>
                                                    @if (!empty($supplier_id))
                                                        @foreach ($products as $product)
                                                            <option
                                                                <?php
                                                                for ($i=0; $i < sizeof($listItems); $i++) {
                                                                    if(!empty($listItems[$i]['product'])){
                                                                        if(!empty($index)){
                                                                            if($product->id == $listItems[$i]['product']){
                                                                                if($listItems[$index]['product']==$listItems[$i]['product']){
                                                                                // echo "";
                                                                                }else{
                                                                                echo "disabled";
                                                                                }   
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            value="{{ $product->id }}">
                                                                {{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="col-lg-2">
                                                <input  type="text" wire:model.lazy="listItems.{{$index}}.qty" name="listItems[{{$index}}][qty]" class="form-control" min="1" required {{ empty($supplier_id) ? 'disabled' : '' }}></td>
                                            <td class="col-lg-2">
                                                <input  type="text" wire:model="listItems.{{$index}}.unit" name="listItems[{{$index}}][unit]" class="form-control" required readonly></td>
                                            </td>
                                            <td>
                                                <input style="text-align:right;"  type="text" wire:model="listItems.{{$index}}.price" name="listItems[{{$index}}][price] " class="form-control" required readonly></td>
                                            </td>
                                            <td>
                                                <input style="text-align:right;"  type="text" wire:model="listItems.{{$index}}.total_price" name="listItems[{{$index}}][total_price] " class="form-control" readonly></td>
                                            </td>
                                            <td>
                                            <a wire:click="deleteItem({{ $index }})" class="btn btn-info delete-header m-1 btn-sm"  title="Delete Item"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td style="text-align:center" colspan="3">
                                        @if (!empty($supplier_id))
                                            <div class="pull-left ">
                                                <button type="button" class="btn btn-warning" wire:click.prevent="addStock({{ $supplier_id }})" {{ $viewProcurementManagement != null ? "disabled='disabled'" : '' }}><i class="fa fa-plus-circle"></i> Add new stock</button>
                                            </div>
                                        @endif
                                    </td>
                                    <td style="text-align:right"><b>Total:</b></td>
                                    <td><input style="text-align:right;"  type="text" wire:model="all_total_price" name="all_total_price" class="form-control" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea  wire:model.defer="remarks" name="remarks" class="form-control"  rows="5" {{ $viewProcurementManagement != null ? "disabled='disabled'" : '' }}></textarea>
                            @if($errors->has('remarks'))
                            <p style="color:red">{{$errors->first('remarks')}}</p>
                            @endif
                        </div>
                    </div>  
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                @if ($procurementManagementId != null)
                    <button wire:click.prevent="printReports({{$procurementManagementId}})" class="btn btn-purple  m-1 btn-sm pull-left" {{ $viewProcurementManagement != null ? "disabled='disabled'" : '' }}><i class="fa fa-print"></i>&nbsp;Print Reports</button>
                    @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right" {{ $viewProcurementManagement != null ? "disabled='disabled'" : '' }}>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

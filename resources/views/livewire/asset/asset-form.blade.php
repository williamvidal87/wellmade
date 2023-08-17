<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header bg-trans-dark" style="margin-top: 10px">
                <h4 class="modal-title modal-primary">Asset</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>
            <!--Panel headings-->         
            <div class="panel-control">
                <ul class="nav nav-pills">
                    <li class="active" wire:ignore><a href="#details_id" data-toggle="tab"><i class="fa fa-pencil-square"></i> Details</a></li>
                    <li wire:ignore><a href="#extra_info_id" data-toggle="tab"><i class="fa fa-pencil-square"></i> Extra Info</a></li>
                </ul>
            </div>           
            <br><br><br>
            <!-- Modal body -->           
            {{-- <div class=" modal-body"> --}}
            <div class="panel-body">
                <div class="tab-content">
                    <div wire:ignore.self class="tab-pane fade in active" id="details_id" >     
                        <div class="form-group col-md-6">              
                            <label for="description_id">Description</label>
                            <select type="text" wire:model="machine_description_id" name="machine_description_id" class="form-control select_design" id="description_id"required>
                                <option value="">-- Select Description --</option>
                                @foreach($MachineDescription as $data)
                                <option value="{{$data->id}}">{{$data->description}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_description_id'))
                                <p style="color:red">{{ $errors->first('machine_description_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_plant_assigned_id">Plant Assigned</label>
                            <select type="text" wire:model="machine_plant_assigned_id" name="machine_plant_assigned_id" class="form-control select_design" id="machine_plant_assigned_id">
                                <option value="">-- Select Plant Assigned --</option>
                                @foreach($machine_plant_assigned as $data)
                                <option value="{{$data->id}}">{{$data->machine_plant_assigned_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_plant_assigned_id'))
                                <p style="color:red">{{ $errors->first('machine_plant_assigned_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="group_id">Group</label>
                            <select type="text" wire:model="machine_group_id" name="machine_group_id" class="form-control select_design" id="group_id"required>
                                <option value="">-- Select Group --</option>
                                @foreach($MachineGroup as $data)
                                <option value="{{$data->id}}">{{$data->getMachineGroupCategory->machine_category_name ?? ''}} - {{$data->getMachineGroupIdNumber->machine_id_number ?? ''}} - {{ $data->machine_group_name }}</option>
                                @endforeach
                            </select>   
                            @if ($errors->has('machine_group_id'))
                                <p style="color:red">{{ $errors->first('machine_group_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_dept_location_id">Dept/Location</label>
                            <select type="text" wire:model="machine_dept_location_id" name="machine_dept_location_id" class="form-control select_design" id="machine_dept_location_id" required>
                                <option value="">-- Select Dept/Location --</option>
                                @foreach($machine_dept_location as $data)
                                <option value="{{$data->id}}">{{$data->machine_dept_location_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_dept_location_id'))
                                <p style="color:red">{{ $errors->first('machine_dept_location_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_sub_group_id">Sub Group</label>
                            <select type="text" wire:model="machine_sub_group_id" name="machine_sub_group_id" class="form-control select_design" id="machine_sub_group_id"required>
                                <option value="">-- Select Sub Group --</option>
                                @foreach($MachineSubGroup as $data)
                                @if($machine_group_id==$data->machine_group_id)
                                <option value="{{$data->id}}">{{$data->getMachineSubGroup->machine_sub_group_name ?? 'none'}}</option>
                                @endif
                                @endforeach
                            </select>
                            @if ($errors->has('machine_sub_group_id'))
                                <p style="color:red">{{ $errors->first('machine_sub_group_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_cost_center_id">Cost Center</label>
                            <select type="number" wire:model="machine_cost_center_id" name="machine_cost_center_id" class="form-control select_design" id="machine_cost_center_id">
                                <option value="">-- Select Cost Center --</option>
                                @foreach($machine_cost_center as $data)
                                <option value="{{$data->id}}">{{$data->machine_cost_center_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_cost_center_id'))
                                <p style="color:red">{{ $errors->first('machine_cost_center_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="serial">Serial</label>
                            <input type="text" wire:model="serial" name="serial" class="form-control" id="serial">
                            @if ($errors->has('serial'))
                                <p style="color:red">{{ $errors->first('serial') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_status_id">Status</label>
                            <select type="text" wire:model="machine_status_id" name="machine_status_id" class="form-control select_design" id="machine_status_id">
                                <option value="">-- Select Status --</option>
                                @foreach($machine_status as $data)
                                <option value="{{$data->id}}">{{$data->machine_status}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_status_id'))
                                <p style="color:red">{{ $errors->first('machine_status_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_brand_id">Brand</label>
                            <select type="text" wire:model="machine_brand_id" name="machine_brand_id" class="form-control select_design" id="machine_brand_id">
                                <option value="">-- Select Brand --</option>
                                @foreach($machine_brand as $data)
                                <option value="{{$data->id}}">{{$data->brand_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_brand_id'))
                                <p style="color:red">{{ $errors->first('machine_brand_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="item_image">Photo</label>
                            <input type="file" wire:model="item_image" name="item_image" class="form-control-file" style="padding: 5px" id="item_image" multiple >
                        </div> 
                        <div class="form-group col-md-6 pull-left">              
                            <label for="machine_model_id">Model</label>
                            <select type="text" wire:model="machine_model_id" name="machine_model_id" class="form-control select_design" id="machine_model_id">
                                <option value="">-- Select Model --</option>
                                @foreach($model_name as $data)
                                <option value="{{$data->id}}">{{$data->machine_model_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_model_id'))
                                <p style="color:red">{{ $errors->first('machine_model_id') }}</p>
                            @endif
                        </div>  
                        <div class="form-group col-md-6">       
                            <div wire:loading wire:target="item_image">Uploading...</div>
                            @error('item_image.*') <span class="error">{{ $message }}</span> @enderror
                        </div>  
                        @if($item_image)
                                <br>
                                Photo Preview:
                                @if($change_images)
                                    <ul style="list-style-type: none;margin: 0;padding: 0;overflow: hidden;padding: 16px;">
                                        @foreach($item_image as $image)
                                            
                                            <li style="float: left;display: block;text-decoration: none;"><img src="{{$image->temporaryUrl()}} " class="img-thumbnail" style="border: 1px solid rgb(5, 0, 0);border-radius: 4px;padding: 5px;width: 100px;"></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul style="list-style-type: none;margin: 0;padding: 0;overflow: hidden;padding: 16px;">
                                        @foreach($item_image as $image)
                                            
                                            <li style="float: left;display: block;text-decoration: none;"><img src="{{ $isUploaded ? $image->temporaryUrl() : url('storage/images/'.$image)}} " class="img-thumbnail" style="border: 1px solid rgb(5, 0, 0);border-radius: 4px;padding: 5px;width: 100px;"></li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                    </div>              
                    <div wire:ignore.self class="tab-pane"  id="extra_info_id">
                        <div class="form-group col-md-6">              
                            <label for="machine_purchase_from_id">Purchase From</label>
                            <select type="text" wire:model="machine_purchase_from_id" name="machine_purchase_from_id" class="form-control select_design" id="machine_purchase_from_id">
                                <option value="">-- Select Purchase From --</option>
                                @foreach($machine_purchased_from as $data)
                                <option value="{{$data->id}}">{{$data->machine_purchase_from_name}}</option>
                                @endforeach
                            </select>    
                            @if ($errors->has('machine_purchase_from_id'))
                                <p style="color:red">{{ $errors->first('machine_purchase_from_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_depreciation_id">Depreciation</label>
                            <select type="number" wire:model="machine_depreciation_id" name="machine_depreciation_id" class="form-control select_design" id="machine_depreciation_id">
                                <option value="">-- Select Depreciation --</option>
                                @foreach($machine_depreciation as $data)
                                <option value="{{$data->id}}">{{$data->machine_depreciation_number}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_depreciation_id'))
                                <p style="color:red">{{ $errors->first('machine_depreciation_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_purchase_type_id">Purchase Type</label>
                            <select type="text" wire:model="machine_purchase_type_id" name="machine_purchase_type_id" class="form-control select_design" id="machine_purchase_type_id" >
                                <option value="">-- Select Purchase Type --</option>
                                @foreach($machine_purchased_type as $data)
                                <option value="{{$data->id}}">{{$data->machine_purchase_type_name}}</option>
                                @endforeach  
                            </select>
                            @if ($errors->has('machine_purchase_type_id'))
                                <p style="color:red">{{ $errors->first('machine_purchase_type_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-3">              
                            <label for="capacity">Capacity</label>
                            <input type="number" step="any" wire:model="capacity" name="capacity" class="form-control" id="capacity" style="width: 15rem">
                            @if ($errors->has('capacity'))
                                <p style="color:red">{{ $errors->first('capacity') }}</p>
                            @endif
                        </div>   
                        <div class="form-group col-md-3">              
                            <label for="machine_unit_id">Unit</label>
                            <select type="number" wire:model="machine_unit_id" name="machine_unit_id" class="form-control select_design" id="machine_unit_id" style="width: 14rem">
                                <option value="">-- Select unit --</option>
                                @foreach($machine_unit as $data)
                                <option value="{{$data->id}}">{{$data->machine_unit_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_unit_id'))
                                <p style="color:red">{{ $errors->first('machine_unit_id') }}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">              
                            <label for="machine_year_made_id">Year Made</label>
                            <select type="number" wire:model="machine_year_made_id" name="machine_year_made_id" class="form-control select_design" id="machine_year_made_id">
                                <option value="">-- Select Year Made --</option>
                                @foreach($year_made as $data)
                                <option value="{{$data->id}}">{{$data->year_made}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_year_made_id'))
                                <p style="color:red">{{ $errors->first('machine_year_made_id') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="total_motor">Total Motor(s)</label>
                            <input type="number" step="any" wire:model="total_motor" name="total_motor" class="form-control" id="total_motor">
                            @if ($errors->has('total_motor'))
                                <p style="color:red">{{ $errors->first('total_motor') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="machine_country_made_id">Country Made</label>
                            <select type="text" wire:model="machine_country_made_id" name="machine_country_made_id" class="form-control select_design" id="machine_country_made_id">
                                <option value="">-- Select Country Made --</option>
                                @foreach($machine_country_made as $data)
                                <option value="{{$data->id}}">{{$data->machine_country_made_name}}</option>
                                @endforeach                               
                            </select>
                            @if ($errors->has('machine_country_made_id'))
                                <p style="color:red">{{ $errors->first('machine_country_made_id') }}</p>
                            @endif
                        </div>  
                        <div class="form-group col-md-6">              
                            <label for="landed_cost">Landed Cost</label>
                            <input type="number" step="any" wire:model="landed_cost" name="landed_cost" class="form-control" id="landed_cost">
                            @if ($errors->has('landed_cost'))
                                <p style="color:red">{{ $errors->first('landed_cost') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="arrival_date">Arrival Date</label>
                            <input type="date" wire:model="arrival_date" name="arrival_date" class="form-control" id="arrival_date" required>
                            @if ($errors->has('arrival_date'))
                                <p style="color:red">{{ $errors->first('arrival_date') }}</p>
                            @endif
                        </div>    
                        <div class="form-group col-md-6">              
                            <label for="rehab_cost_id">Rehab Cost</label>
                            <input type="number" step="any" wire:model="rehab_cost" name="rehab_cost" class="form-control" id="rehab_cost_id">
                            @if ($errors->has('rehab_cost'))
                                <p style="color:red">{{ $errors->first('rehab_cost') }}</p>
                            @endif
                        </div> 
                        <div class="form-group col-md-6 pull-left">              
                            <label for="machine_condition_aquired_id">Condition Acq</label>
                            <select type="text" wire:model="machine_condition_aquired_id" name="machine_condition_aquired_id" class="form-control select_design" id="machine_condition_aquired_id">
                                <option value="">-- Select Condition Acq --</option>
                                @foreach($machine_condition_aquired as $data)
                                <option value="{{$data->id}}">{{$data->machine_condition_acquired_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_condition_aquired_id'))
                                <p style="color:red">{{ $errors->first('machine_condition_aquired_id') }}</p>
                            @endif
                        </div>    
                    </div>          
                </div>     
            </div>
            <!-- Modal footer -->
            <div class="modal-footer bg-trans-dark">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

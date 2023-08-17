<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Engine Model</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group row">
                    <label for="engine_category_input" class="col-sm-4 col-form-label col-form-label-sm">Model</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="model" name="model" class="form-control form-control-sm" id="engine_category_input" required>
                            @if($errors->has('model'))
                                <p style="color:red">{{$errors->first('model')}}</p>
                            @endif
                    </div>
                </div>
                
                <br>
                
                <div class="form-group row">
                    <label for="year_made_select" class="col-sm-4 col-form-label col-form-label-sm">Year Made:</label>
                    <div class="col-sm-8">
                        <select wire:model="year_made_id" name="year_made_id" class="form-control" id="year_made_select" required>
                            <option>--Select Year Made--</option>
                        @foreach($yearmade as $data)
                            <option value="{{ $data->id }}">{{ $data->year_made }}</option>
                        @endforeach
                        </select>
                            @if($errors->has('year_made_id'))
                                <p style="color:red">{{$errors->first('year_made_id')}}</p>
                            @endif
                    </div>
                </div>
                
                <br>
                
                <div class="form-group row">
                    <label for="make_select" class="col-sm-4 col-form-label col-form-label-sm">Make:</label>
                    <div class="col-sm-8">
                        <select wire:model="make_id" name="make_id" class="form-control" id="make_select" required>
                            <option>--Select a Make--</option>
                        @foreach($makes as $data)
                            <option value="{{ $data->id }}">{{ $data->make_name }}</option>
                        @endforeach
                        </select>
                            @if($errors->has('make_id'))
                                <p style="color:red">{{$errors->first('make_id')}}</p>
                            @endif
                    </div>
                </div>
                
                <br>
                
                <div class="form-group row">
                    <label for="category_select" class="col-sm-4 col-form-label col-form-label-sm">Category:</label>
                    <div class="col-sm-8">
                        <select wire:model="category_id" name="category_id" class="form-control" id="category_select" required>
                            <option>--Select Category--</option>
                        @foreach($category as $data)
                            <option value="{{ $data->id }}">{{ $data->category }}</option>
                        @endforeach
                        </select>
                            @if($errors->has('category_id'))
                                <p style="color:red">{{$errors->first('category_id')}}</p>
                            @endif
                    </div>
                </div>
                
                <br>
                
                <div class="form-group row">
                    <label for="cylinder_select" class="col-sm-4 col-form-label col-form-label-sm">Cylinder:</label>
                    <div class="col-sm-8">
                        <select wire:model="cylinder_id" name="cylinder_id" class="form-control" id="cylinder_select" required>
                            <option>--Select number of Cylinders--</option>
                        @foreach($cylinder as $data)
                            <option value="{{ $data->id }}">{{ $data->cylinder }}</option>
                        @endforeach
                        </select>
                            @if($errors->has('cylinder_id'))
                                <p style="color:red">{{$errors->first('cylinder_id')}}</p>
                            @endif
                    </div>
                </div>
                
                <br>
                
                <div class="form-group row">
                    <label for="valve_select" class="col-sm-4 col-form-label col-form-label-sm">Valve:</label>
                    <div class="col-sm-8">
                        <select wire:model="valve_id" name="valve_id" class="form-control" id="valve_select" required>
                            <option>--Select Valve--</option>
                        @foreach($valves as $data)
                            <option value="{{ $data->id }}">{{ $data->valve }}</option>
                        @endforeach
                        </select>
                            @if($errors->has('valve_id'))
                                <p style="color:red">{{$errors->first('valve_id')}}</p>
                            @endif
                    </div>
                </div>
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

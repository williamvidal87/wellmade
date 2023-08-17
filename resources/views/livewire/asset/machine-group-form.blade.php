<div>
    <div>
        <div>
            <div class="modal-content"> 
                <form wire:submit.prevent="store()" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Machine Group</h4>
                    <a type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    
                    <!-- Modal body -->
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="machine_group_category_ids">Machine Group Category:</label>
                            <select  type="text" wire:model.defer="machine_group_category_id" name="machine_group_category_id" class="form-control" id="machine_group_category_ids" required>
                                <option value="">-- Select Machine Group Category --</option>
                                @foreach($machine_category as $category)
                                    <option value="{{$category->id}}">{{$category->machine_category_name}}</option>
                                @endforeach
                            </select>
                            </select>
                            @if($errors->has('machine_group_category_id'))
                            <p style="color:red">{{$errors->first('machine_group_category_id')}}</p>
                            @endif
                        </div>     
                        <div class="form-group">
                            <label for="machine_group_number_ids">Machine Group Number:</label>
                            <select  type="text" wire:model.defer="machine_group_number_id" name="machine_group_number_id" class="form-control" id="machine_group_number_ids" >
                                <option value="">-- Select Machine Group Number --</option>
                                @foreach($machine_number as $number)
                                    <option value="{{$number->id}}">{{$number->machine_id_number}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('machine_group_number_id'))
                            <p style="color:red">{{$errors->first('machine_group_number_id')}}</p>
                            @endif
                        </div>     
                        <div class="form-group">
                            <label for="machine_group_name_ids">Machine Group:</label>
                            <input  type="text" wire:model.defer="machine_group_name" name="machine_group_name" class="form-control" id="machine_group_name_ids" required>                               
                            @if($errors->has('machine_group_name'))
                            <p style="color:red">{{$errors->first('machine_group_name')}}</p>
                            @endif
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
        
    </div>
    
</div>

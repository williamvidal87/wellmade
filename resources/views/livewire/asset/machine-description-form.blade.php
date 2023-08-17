<div>
    <div>
        <div>
            <div class="modal-content"> 
                <form wire:submit.prevent="store()" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Machine Description</h4>
                    <a type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    
                    <!-- Modal body -->
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="machine_sub_group_number_ids">Machine Description Number:</label>
                            <select  type="text" wire:model.defer="machine_description_number_id" name="machine_description_number_id" class="form-control" id="machine_sub_group_number_ids" required>
                                <option value="">-- Select Machine Description Number --</option>
                                @foreach($machine_number as $number)
                                {{ $true=0; }}
                                @foreach($check_machine_number_exist as $key => $check_machine_number)
                                @if($check_machine_number->machine_description_number_id==$number->id)
                                    {{ $true=1; }}
                                @break
                                @endif
                                @endforeach
                                @if($true==0)
                                <option value="{{$number->id}}">{{$number->machine_id_number}}</option>
                                @endif
                                @endforeach
                            </select>
                            @if($errors->has('machine_description_number_id'))
                            <p style="color:red">{{$errors->first('machine_description_number_id')}}</p>
                            @endif
                        </div>       
                        <div class="form-group">
                            <label for="machine_group_ids">Machine Description:</label>
                            <input type="text" wire:model="description" name="description" id="description" class="form-control" required>
                            @if($errors->has('description'))
                            <p style="color:red">{{$errors->first('description')}}</p>
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

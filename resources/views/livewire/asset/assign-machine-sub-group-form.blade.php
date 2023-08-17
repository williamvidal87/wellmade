<div>
    <div>
        <div>
            <div class="modal-content"> 
                <form wire:submit.prevent="store()" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Assign Machine Sub Group</h4>
                    <a type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>
                    
                    <!-- Modal body -->
                    <div class=" modal-body">
                        <div class="form-group">
                            <label for="machine_sub_group_number_ids">Machine Sub Group Number:</label>
                            <select  type="text" wire:model.defer="machine_sub_group_number_id" name="machine_sub_group_number_id" class="form-control" id="machine_sub_group_number_ids" required>
                                <option value="">-- Select Machine Sub Group Number --</option>
                                @foreach($machine_number as $number)
                                {{ $true=0; }}
                                @foreach($check_machine_number_exist as $key => $check_machine_number)
                                @if($check_machine_number->machine_sub_group_number_id==$number->id)
                                    {{ $true=1; }}
                                @break
                                @endif
                                @endforeach
                                @if($true==0)
                                <option value="{{$number->id}}">{{$number->machine_id_number}}</option>
                                @endif
                                @endforeach
                            </select>
                            @if($errors->has('machine_sub_group_number_id'))
                            <p style="color:red">{{$errors->first('machine_sub_group_number_id')}}</p>
                            @endif
                        </div>       
                        <div class="form-group">
                            <label for="machine_group_ids">Machine Group:</label>
                            <select  type="text" wire:model.defer="machine_group_id" name="machine_group_id" class="form-control" id="machine_group_ids" required>
                                <option value="">-- Select Machine Group --</option>
                                @foreach($machine_group as $group)
                                    <option value="{{$group->id}}">{{$group->machine_group_name}}</option>
                                @endforeach
                                <option value=""></option>
                            </select>
                            @if($errors->has('machine_group_id'))
                            <p style="color:red">{{$errors->first('machine_group_id')}}</p>
                            @endif
                        </div>     
                        <div class="form-group">
                            <label for="machine_sub_group_ids">Machine Sub Group:</label>
                            <select  type="text" wire:model.defer="machine_sub_group_id" name="machine_sub_group_id" class="form-control" id="machine_sub_group_ids"required>
                                <option value="">-- Select Machine Sub Group --</option>
                                @foreach($machine_sub_group as $sub_group)
                                <option value="{{$sub_group->id}}">{{$sub_group->machine_sub_group_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('machine_sub_group_id'))
                            <p style="color:red">{{$errors->first('machine_sub_group_id')}}</p>
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

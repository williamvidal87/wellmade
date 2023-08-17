<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Chart Of Accounts</h4>
            <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label>Account Code</label>
                    <input  type="text" wire:model="account_code" name="account_code" class="form-control" required>
                    @if($errors->has('account_code'))
                    <p style="color:red">{{$errors->first('account_code')}}</p>
                    @endif
                    <label>Account Description</label>
                    <textarea  wire:model.defer="account_desc" name="account_desc" class="form-control" required></textarea>
                    @if($errors->has('account_desc'))
                    <p style="color:red">{{$errors->first('account_desc')}}</p>
                    @endif
                    {{-- sample --}}
                    <div class="form-group">
                        <label>Chart Accounts</label>
                        <select name="account_type_id" wire:model="account_type_id" 
                            class="form-control">
                            <option value=''>Choose Account Type</option>
                            @foreach($AccountTypes as $data)
                                <option value="{{ $data->id }}">{{ $data->account_type }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('account_type_id'))
                        <p style="color:red">{{$errors->first('account_type_id')}}</p>
                        @endif
                    </div>
                    {{-- endsample --}}
                    <label>Statement</label>
                    <input  type="text" wire:model="statement" name="statement" class="form-control">
                    @if($errors->has('statement'))
                    <p style="color:red">{{$errors->first('statement')}}</p>
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

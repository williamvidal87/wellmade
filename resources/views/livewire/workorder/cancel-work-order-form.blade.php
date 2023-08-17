<div>
    <div class="modal-content">
        <form wire:submit.prevent="saveCancelRemarks" enctype="multipart/form-data">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" style="margin-top: -10px;"><i class="pci-cross pci-circle"></i></button>
                <div class="bootbox-body"><h4>Cancel Work Order Reason</h4>
                    <br>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label text-left" for="cancel_reason_id">Reason:</label>
                        <div class="col-sm-8">
                            <select name="cancel_reason_id" wire:model="cancel_reason_id" class="form-control select_design" id="cancel_reason_id" required>
                                <option value=''>Select Reason</option>
                                @foreach($cancelreason as $data)
                                <option value="{{ $data->id }}">{{ $data->reason}}</option>
                                @endforeach
                            </select>
                        </div>
                            @if($errors->has('cancel_reason_id'))
                                <p style="color:red">{{$errors->first('cancel_reason_id')}}</p>
                            @endif
                    </div> 
                    <br>
                    <br>
                </div>
        </div>
        <div class="modal-footer">
                    <button data-bb-handler="cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" data-bb-handler="confirm" class="btn btn-primary" value="OK">
        </div>
        </form>
    </div>
</div>

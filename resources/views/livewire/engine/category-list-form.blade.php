<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Category List</h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group row">
                    <label for="category_input" class="col-sm-4 col-form-label col-form-label-sm">Category Name</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="category" name="category" class="form-control form-control-sm" id="category_input" required>
                            @if($errors->has('category'))
                                <p style="color:red">{{$errors->first('category')}}</p>
                            @endif
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="type_select" class="col-sm-4 col-form-label col-form-label-sm">Select Type:</label>
                    <div class="col-sm-8">
                        <select wire:model="type_id" name="type_id" class="form-control" id="type_select" required>
                            <option>--Select Type--</option>
                        @foreach($types as $data)
                            <option value="{{ $data->id }}">{{ $data->type }}</option>
                        @endforeach
                        </select>
                            @if($errors->has('type_id'))
                                <p style="color:red">{{$errors->first('type_id')}}</p>
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

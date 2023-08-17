<div>
    <div class=" shadow-lg modal-content">
        <form wire:submit.prevent="storeScope" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Scope Group</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">

                    <label>Work Group</label>

                    <select name="er_work_group_id" wire:model="er_work_group_id" class="form-control">

                        <option value=''>Choose Work Group:</option>

                        @foreach ($workgoups as $data)
                            <option value="{{ $data->id }}">{{ $data->group_name }}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('er_work_group_id'))
                        <p style="color:red">{{ $errors->first('er_work_group_id') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Scope Name</label>
                    <input type="text" wire:model="scope_name" name="scope_name" class="form-control" required>
                    @if ($errors->has('scope_name'))
                        <p style="color:red">{{ $errors->first('scope_name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Unit</label>
                    <select name="unit_id" wire:model="unit_id" class="form-control">
                        <option value=''>Choose Unit:</option>
                        @foreach ($units as $data)
                            <option value="{{ $data->id }}">{{ $data->unit }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('unit_id'))
                        <p style="color:red">{{ $errors->first('unit_id') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1">
                    <label></label>
                    <p>Price:</p>
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>A</label>
                    <input type="text" style="width: 7rem" wire:model="price_a" name="price_a" class="form-control" required>
                    @if ($errors->has('price_a'))
                        <p style="color:red">{{ $errors->first('price_a') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>B</label>
                    <input type="text" style="width: 7rem" wire:model="price_b" name="price_b" class="form-control" required>
                    @if ($errors->has('price_b'))
                        <p style="color:red">{{ $errors->first('price_b') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>C</label>
                    <input type="text" style="width: 7rem" wire:model="price_c" name="price_c" class="form-control" required>
                    @if ($errors->has('price_c'))
                        <p style="color:red">{{ $errors->first('price_c') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>D</label>
                    <input type="text" style="width: 7rem" wire:model="price_d" name="price_d" class="form-control" required>
                    @if ($errors->has('price_d'))
                        <p style="color:red">{{ $errors->first('price_d') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>E</label>
                    <input type="text" style="width: 7rem" wire:model="price_e" name="price_e" class="form-control" required>
                    @if ($errors->has('price_e'))
                        <p style="color:red">{{ $errors->first('price_e') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>F</label>
                    <input type="text" style="width: 7rem" wire:model="price_f" name="price_f" class="form-control" required>
                    @if ($errors->has('price_f'))
                        <p style="color:red">{{ $errors->first('price_f') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>G</label>
                    <input type="text" style="width: 7rem" wire:model="price_g" name="price_g" class="form-control" required>
                    @if ($errors->has('price_g'))
                        <p style="color:red">{{ $errors->first('price_g') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>H</label>
                    <input type="text" style="width: 7rem" wire:model="price_h" name="price_h" class="form-control" required>
                    @if ($errors->has('price_h'))
                        <p style="color:red">{{ $errors->first('price_h') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>I</label>
                    <input type="text" style="width: 7rem" wire:model="price_i" name="price_i" class="form-control" required>
                    @if ($errors->has('price_i'))
                        <p style="color:red">{{ $errors->first('price_i') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-1" style="text-align: right">
                    <label>J</label>
                    <input type="text" style="width: 7rem" wire:model="price_j" name="price_j" class="form-control" required>
                    @if ($errors->has('price_j'))
                        <p style="color:red">{{ $errors->first('price_j') }}</p>
                    @endif
                </div>
                
            </div>
            <br>
            <br>
            <br><br>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Bank</h4>
            <a type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></a>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div>
                    <div class="form-group">
                        <label>Abbrv Bank</label>
                        <input  type="text" wire:model="abbrv_bank" name="abbrv_bank" class="form-control">
                        @if($errors->has('abbrv_bank'))
                        <p style="color:red">{{$errors->first('abbrv_bank')}}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Bank Name</label>
                        <input  type="text" wire:model="bank_name" name="bank_name" class="form-control" required>
                        @if($errors->has('bank_name'))
                        <p style="color:red">{{$errors->first('bank_name')}}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>GL Account</label>
                        <select wire:model="gl_account_id" name="gl_account_id" class="form-control">
                            {{-- <option value="">-- Select a gl account --</option>
                            @forelse ($gl_accounts as $gl_account)
                                <option value="{{ $gl_account->id }}">
                                    {{ $gl_account->getAccountTypes->account_type }}
                                </option>
                            @empty
                            @endforelse --}}
                            <option value="">-- Select a gl account --</option>
                            @forelse ($gl_accounts as $gl_account)
                                <option value="{{ $gl_account->id }}">
                                    {{ $gl_account->account_code }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                        @if($errors->has('gl_account_id'))
                        <p style="color:red">{{$errors->first('gl_account_id')}}</p>
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

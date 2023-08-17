<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Supplier</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input  type="text" wire:model="name" name="name" class="form-control" required>
                            @if($errors->has('name'))
                            <p style="color:red">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea wire:model="address" name="address" class="form-control"></textarea>
                            @if($errors->has('address'))
                            <p style="color:red">{{$errors->first('address')}}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input  type="text" wire:model="contact_number" name="contact_number" class="form-control">
                            @if($errors->has('contact_number'))
                            <p style="color:red">{{$errors->first('contact_number')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group rounded p-2" style="border: 1px dashed #444;">
                            <label class="text-bold">Chart of Accounts</label>
                            <div style="height: 150px; overflow-y: scroll;">
                                @foreach ($chart_of_accounts as $chart_of_account)
                                    <div class="form-check mb-2">
                                        <input wire:model.lazy="journalize" type="checkbox" class="form-check-input"  value="{{ $chart_of_account->id }}" id="{{ $chart_of_account->account_code }}">
                                        <label class="form-check-label" for="{{ $chart_of_account->account_code }}">
                                            {{ $chart_of_account->account_code. ' - ' .$chart_of_account->account_desc }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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

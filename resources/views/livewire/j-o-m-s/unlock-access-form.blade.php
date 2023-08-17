<div>
    <div class="modal-content">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title">Unlock Access</h4>
                <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>

            @if (session('incorrectPassword'))
                <div id="alertRefill" class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ session('incorrectPassword') }}</strong>
                </div>
            @endif

            <div class=" modal-body">
                <div class="form-group">
                    <label>Reasons</label>
                    <textarea wire:model="reasons" name="reasons" class="form-control" required></textarea>
                    @if ($errors->has('reasons'))
                        <p style="color:red">{{ $errors->first('reasons') }}</p>
                    @endif
                    <br>
                    <label for="fordescription">Password</label>
                    <input type="password" wire:model="password" name="password" class="form-control" required>
                    @if ($errors->has('password'))
                        <p style="color:red">{{ $errors->first('password') }}</p>
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
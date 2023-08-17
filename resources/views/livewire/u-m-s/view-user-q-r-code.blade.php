<div>
    <div wire:ignore.self class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            {{-- <h4 class="modal-title">Job Order</h4> --}}
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            {{-- <a type="button" class="close" data-dismiss="modal" wire:click="closemodal">&times;</a> --}}
        </div>

        <!-- Modal body -->
        <div class=" modal-body d-flex justify-content-between">
            <div class="panel">
                <div class="row">
                    <div class="col-xs-12">

                        <?php
                            $result = strval($userID);
                        ?>
                        {{-- Edited By Tremblor --}}
                        @if (!is_null($userID))
                            <div class="center" style="width:200px;margin: auto;">
                                {!! QrCode::size(200)->backgroundColor(255,255,255)->generate($result) !!}
                                {{-- <p>{{ $result }}</p> --}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
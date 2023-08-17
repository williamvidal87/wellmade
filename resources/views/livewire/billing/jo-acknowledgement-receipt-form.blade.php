<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">JO Acknowledgement Receipt</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input  type="text" wire:model="date" name="date" class="form-control" required readonly>
                                    @if($errors->has('date'))
                                        <p style="color:red">{{$errors->first('date')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <input  type="text" wire:model="customer" name="customer" class="form-control" required readonly>
                                    @if($errors->has('customer'))
                                    <p style="color:red">{{$errors->first('customer')}}</p>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Terms</label>
                                    <input  type="number" value="0" wire:model="term" name="term" class="form-control" required>
                                    @if($errors->has('term'))
                                    <p style="color:red">{{$errors->first('term')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>CSA</label>
                                    <input  type="text" wire:model="csa" name="csa" class="form-control" required readonly>
                                    @if($errors->has('csa'))
                                    <p style="color:red">{{$errors->first('csa')}}</p>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Vehicle Description/Model</label>
                                    <input  type="text" wire:model="model" name="model" class="form-control" required readonly>
                                    @if($errors->has('model'))
                                    <p style="color:red">{{$errors->first('model')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Engine Make</label>
                                    <input  type="text" wire:model="engine_make" name="engine_make" class="form-control" required readonly>
                                    @if($errors->has('engine_make'))
                                    <p style="color:red">{{$errors->first('engine_make')}}</p>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Serial No.</label>
                                    <input  type="text" wire:model="serial_no" name="serial_no" class="form-control" required readonly>
                                    @if($errors->has('serial_no'))
                                    <p style="color:red">{{$errors->first('serial_no')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea wire:model="remarks" name="remarks" class="form-control" required readonly></textarea>
                                    @if($errors->has('remarks'))
                                    <p style="color:red">{{$errors->first('remarks')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 p-3" style="background-color: #f5f5f5;">
                        <div>
                            <h5 style="text-align:center;">SUMMARY OF CHARGES</h5>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 bold">
                                ER:
                            </div>
                            <div class="col-lg-4 pull-right" >
                                <input type="text" wire:model.lazy="er_disp" name="er_total" class="form-control" style="text-align: right !important;" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 bold">
                                MF:
                            </div>
                            <div class="col-lg-4 pull-right">
                                <input type="text" wire:model.lazy="mf_disp" name="mf_total" class="form-control" style="text-align: right !important;" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 bold">
                                CALIB:
                            </div>
                            <div class="col-lg-4 pull-right">
                                <input type="text" wire:model.lazy="calib_disp" name="calib_total" class="form-control" style="text-align: right !important;" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 bold">
                                PARTS:
                            </div>
                            <div class="col-lg-4 pull-right">
                                <input type="text" wire:model.lazy="part_total" name="part_total" class="form-control" style="text-align: right !important;" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 bold">
                                SUB-TOTAL:
                            </div>
                            <div class="col-lg-4 pull-right">
                                <input type="text" wire:model="overall_disp" name="sub_total" class="form-control" style="text-align: right !important;" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 bold">
                                DISCOUNT:
                            </div>
                            <div class="col-lg-4 pull-right" style="text-align: right !important;">
                                <div>
                                    <input type="text" wire:model.lazy="discount" name="discount" class="form-control" style="text-align: right !important;" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 bold">
                                TOTAL
                            </div>
                            <div class="col-lg-4 pull-right">
                                <input type="text" wire:model="overall_total" name="overall_total" class="form-control" style="text-align: right !important;" readonly>
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

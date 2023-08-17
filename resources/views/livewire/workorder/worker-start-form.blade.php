<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Set New Datetime Start</h4>
            <button type="button" class="close" data-dismiss="modal" wire:click='closeAddFormStartWorker'><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="form-group">
                    <label class="col-sm-7 control-label text-right" for="scope_input"></label>
                    <label class="col-sm-2 control-label text-left" for="scope_input">Hours</label>
                    <label class="col-sm-3 control-label text-left" for="scope_input">Minutes</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="start_date_worker">DateTime START:</label>
                    <div class="col-sm-4">
                        <input type="date" wire:model="start_date_worker" name="allot_hours" class="form-control" id="start_date_worker" required>
                    </div>
                    <div class="col-sm-1">
                        <select wire:model="start_hour_worker" id="start_hour_worker" class="form-control select_design" required style="width: 5rem">
                            <option>  </option>
                            {{-- <option value="00"> 00 </option>
                            <option value="01"> 01 </option>
                            <option value="02"> 02 </option>
                            <option value="03"> 03 </option>
                            <option value="04"> 04 </option>
                            <option value="05"> 05 </option>
                            <option value="06"> 06 </option>
                            <option value="07"> 07 </option> --}}
                            <option value="08"> 08 </option>
                            <option value="09"> 09 </option>
                            <option value="10"> 10 </option>
                            <option value="11"> 11 </option>
                            <option value="12"> 12 </option>
                            <option value="13"> 13 </option>
                            <option value="14"> 14 </option>
                            <option value="15"> 15 </option>
                            <option value="16"> 16 </option>
                            <option value="17"> 17 </option>
                            <option value="18"> 18 </option>
                            <option value="19"> 19 </option>
                            <option value="20"> 20 </option>
                            <option value="21"> 21 </option>
                            <option value="22"> 22 </option>
                            <option value="23"> 23 </option>
                          </select>
                    </div>
                    <div class="col-sm-1">
                    <div><p style="text-align:right">:</p></div>
                    </div>
                    <div class="col-sm-2">
                        <select wire:model="start_minute_worker" id="start_minute_worker" class="form-control select_design" required style="width: 5rem">
                            <option>  </option>
                            <option value="00"> 00 </option>
                            <option value="01"> 01 </option>
                            <option value="02"> 02 </option>
                            <option value="03"> 03 </option>
                            <option value="04"> 04 </option>
                            <option value="05"> 05 </option>
                            <option value="06"> 06 </option>
                            <option value="07"> 07 </option>
                            <option value="08"> 08 </option>
                            <option value="09"> 09 </option>
                            <option value="10"> 10 </option>
                            <option value="11"> 11 </option>
                            <option value="12"> 12 </option>
                            <option value="13"> 13 </option>
                            <option value="14"> 14 </option>
                            <option value="15"> 15 </option>
                            <option value="16"> 16 </option>
                            <option value="17"> 17 </option>
                            <option value="18"> 18 </option>
                            <option value="19"> 19 </option>
                            <option value="20"> 20 </option>
                            <option value="21"> 21 </option>
                            <option value="22"> 22 </option>
                            <option value="23"> 23 </option>
                            <option value="24"> 24 </option>
                            <option value="25"> 25 </option>
                            <option value="26"> 26 </option>
                            <option value="27"> 27 </option>
                            <option value="28"> 28 </option>
                            <option value="29"> 29 </option>
                            <option value="30"> 30 </option>
                            <option value="31"> 31 </option>
                            <option value="32"> 32 </option>
                            <option value="33"> 33 </option>
                            <option value="34"> 34 </option>
                            <option value="35"> 35 </option>
                            <option value="36"> 36 </option>
                            <option value="37"> 37 </option>
                            <option value="38"> 38 </option>
                            <option value="39"> 39 </option>
                            <option value="40"> 40 </option>
                            <option value="41"> 41 </option>
                            <option value="42"> 42 </option>
                            <option value="43"> 43 </option>
                            <option value="44"> 44 </option>
                            <option value="45"> 45 </option>
                            <option value="46"> 46 </option>
                            <option value="47"> 47 </option>
                            <option value="48"> 48 </option>
                            <option value="49"> 49 </option>
                            <option value="50"> 50 </option>
                            <option value="51"> 51 </option>
                            <option value="52"> 52 </option>
                            <option value="53"> 53 </option>
                            <option value="54"> 54 </option>
                            <option value="55"> 55 </option>
                            <option value="56"> 56 </option>
                            <option value="57"> 57 </option>
                            <option value="58"> 58 </option>
                            <option value="10"> 59 </option>
                          </select>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-sm-7">
                        @if($errors->has('start_date_worker'))
                        <p style="color:red">{{$errors->first('start_date_worker')}}</p>
                        @endif        </div>
                    <div class="col-sm-4">
                        @if($errors->has('start_hour_worker'))
                        <p style="color:red">{{$errors->first('start_hour_worker')}}</p>
                        @endif                  </div>
                    @if($errors->has('start_minute_worker'))
                    <p style="color:red">{{$errors->first('start_minute_worker')}}</p>
                    @endif
                </div>  
                <br><br><br><br>
                <div class="form-group">
                    <label class="col-sm-3 control-label text-right" for="reason_start">Reason</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="reason_start" name="reason_start" class="form-control" id="reason_start" required>
                    </div>
                    @if($errors->has('reason_start'))
                    <p style="color:red">{{$errors->first('reason_start')}}</p>
                    @endif
                </div>  
                <br><br>
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

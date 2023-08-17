<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Check Voucher</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input  type="date" wire:model="date" name="date" class="form-control" required >
                                @if($errors->has('date'))
                                <p style="color:red">{{$errors->first('date')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Type</label>
                                <select name="voucher_type_id" wire:model="voucher_type_id" class="form-control" required >
                                    <option value=''>Select a type</option>
                                    @foreach($voucher_type as $data)
                                        <option value="{{ $data->id }}">{{ $data->type ?? '' }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('voucher_type_id'))
                                <p style="color:red">{{$errors->first('voucher_type_id')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Bank</label>
                                <select name="bank_id" wire:model="bank_id" class="form-control" required >
                                    <option value=''>Select a bank</option>
                                    @foreach($banks as $data)
                                    <option value="{{ $data->id }}">{{ $data->bank_name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('bank_id'))
                                <p style="color:red">{{$errors->first('bank_id')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>For</label>
                                <select name="for_id" wire:model="for_id" class="form-control" required >
                                    <option value=''>Select a for type</option>
                                    @foreach($fors as $data)
                                    <option value="{{ $data->id }}">{{ $data->type ?? '' }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('for_id'))
                                <p style="color:red">{{$errors->first('for_id')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-inline">
                                <label>Supplier</label>
                                <div class="row">
                                    <div class="col-lg-11">
                                        <select wire:model="supplier_id" id="contactId" name="supplier_id"
                                            class="form-control" style="width: 360px" >
                                            <option value="">-- Select a supplier --</option>
                                            @foreach($suppliers as $data)
                                                <option value="{{ $data->id }}">{{ $data->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('supplier_id'))
                                            <p style="color:red">{{ $errors->first('supplier_id') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="pull-right ">
                                            <button type="button" class="btn btn-purple" wire:click.prevent="addSupplier" {{ ($viewCheckVoucherId != null) ? "disabled='disabled'" : '' }}><i class="fa fa-plus-circle"></i> Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>GL Account for Bank</label>
                                <input type="text" wire:model="gl_account" name="gl_account" class="form-control" required readonly >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Check No</label>
                                <input type="text" wire:model="check_no" name="check_no" class="form-control" >
                                @if($errors->has('check_no'))
                                <p style="color:red">{{$errors->first('check_no')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Check Date</label>
                                <input type="date" wire:model="check_date" name="check_date" class="form-control" required readonly >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 pull-right">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" wire:model.lazy="amount" name="amount" class="form-control text-right" required {{ ($supplier_id == null ) ? "disabled='disabled'" : '' }}>
                                @if($errors->has('amount'))
                                <p style="color:red">{{$errors->first('amount')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Summary Explanation</label>
                                <textarea wire:model.lazy="summary_explanation" name="summary_explanation" class="form-control" required ></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- start sample --}}
                    <div class="panel">

                        <!--Panel heading-->
                        <div class="panel-heading">
                            <div class="panel-control">
                                <ul class="nav nav-tabs">
                                    <li class="active" wire:ignore><a href="#particulars" data-toggle="tab" aria-expanded="false">Particulars</a></li>
                                    <li class="" wire:ignore><a href="#journalize" data-toggle="tab" aria-expanded="true">Journalize</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--Panel body-->
                        <div class="panel-body">
                            <div class="tab-content">
                                <div wire:ignore.self class="tab-pane fade active in" id="particulars">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Particulars</label>
                                                <textarea wire:model.lazy="particulars" name="particulars" class="form-control" required ></textarea>
                                            </div>
                                        </div>  
                                    </div> 
                                </div>
                                
                                <div wire:ignore.self class="tab-pane fade" id="journalize">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <label>Summary of Explanation</label>
                                            <br><br> --}}
                                            <button class="btn btn-info pull-right" wire:click.prevent="addItem"><i class="fa fa-plus fa-sm" style="font-size:10px;"></i>&nbsp;&nbsp;Add</button>
                                            <br><br>
                                            <table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px;"></th>
                                                        <th style="width: 160px;">ACCOUNT NUMBER</th>
                                                        <th style="width: 240px;">ACCOUNT TITLE</th>
                                                        <th style="width: 150px;">DEBITS</th>
                                                        <th style="width: 150px;">CREDITS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listItems as $index => $item)
                                                    <tr>
                                                        <td style="width: 50px;">
                                                            <button wire:click.prevent="deleteItem({{ $index }})" class="btn btn-info delete-header btn-sm"  title="Delete Item" ><i class="fa fa-times" aria-hidden="true"></i></button>
                                                        </td>
                                                        <td style="width: 160px;">
                                                            <div wire:ignore>
                                                                <select wire.ignore.self wire:model="listItems.{{ $index }}.accnt_no" style="width: 100%;" name="listItems[{{ $index }}][accnt_no]" class="form-control voucher_id" required >
                                                                    <option value="">-- Choose a Accnt. No. --</option>
                                                                    @foreach ($accout_numbers as $account_number)
                                                                        <option
                                                                        <?php
                                                                        for ($i=0; $i < sizeof($listItems); $i++) {
                                                                            if(!empty($listItems[$i]['accnt_no'])){
                                                                                if($account_number->id == $listItems[$i]['accnt_no']){
                                                                                    if($listItems[$index]['accnt_no']==$listItems[$i]['accnt_no']){
                                                                                    // echo "";
                                                                                    }else{
                                                                                    echo "disabled";
                                                                                    }   
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        value="{{ $account_number->id }}">
                                                                            {{ $account_number->account_code . ' = ' . $account_number->account_desc }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td style="width: 240px;" wire:model="listItems.{{ $index }}.account_title" name="listItems[{{ $index }}][account_title]">
                                                            <div>
                                                                <input type="text" wire:model="listItems.{{ $index }}.account_title" name="listItems[{{ $index }}][account_title]" class="form-control" readonly >
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model.lazy="listItems.{{ $index }}.debits" name="listItems[{{ $index }}][debits]" min="0" class="form-control" style="text-align: right;" >
                                                            </div>
                                                        </td>
                                                        <td style="width: 150px;">
                                                            <div>
                                                                <input type="text" wire:model.lazy="listItems.{{ $index }}.credits" name="listItems[{{ $index }}][credits]" min="0" class="form-control" style="text-align: right;" >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td style="text-align:center" colspan="2"></td>
                                                        <td style="text-align:right"><b>Total:</b></td>
                                                        <td>
                                                            <input  type="text" wire:model="all_total_debits" name="all_total_debits" class="form-control" readonly style="text-align: right;" >
                                                            @if($errors->has('all_total_debits'))
                                                            <p style="color:red">{{$errors->first('all_total_debits')}}</p>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input  type="text" wire:model="all_total_credits" name="all_total_credits" class="form-control" readonly style="text-align: right;" >
                                                            @if($errors->has('all_total_credits'))
                                                            <p style="color:red">{{$errors->first('all_total_credits')}}</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>  
                                    </div> 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    {{-- end sample --}}

                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group pull-left">
                    @if ($transaction_status_id == 1 && $checkVoucherId != null)
                        <button wire:click.prevent="postConfirmCheckVoucher({{ $checkVoucherId }})" class="btn btn-success delete-header m-1 btn-sm pull-left"  title="Post"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Post</button>
                    @endif
                    @if ($transaction_status_id == 2 && $viewCheckVoucherId != null)
                        <button wire:click.prevent="reverseConfirmCheckVoucher({{ $viewCheckVoucherId }})" class="btn btn-danger delete-header m-1 btn-sm pull-left"  title="Reverse"><i class="fa fa-history" aria-hidden="true"></i>&nbsp; Reverse</button>
                        <button wire:click.prevent="printCheckVoucher({{ $viewCheckVoucherId }})" class="btn btn-primary delete-header m-1 btn-sm"  title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                    @endif
                    @if ($transaction_status_id == 3 && $viewCheckVoucherId != null)
                        <button wire:click.prevent="printCheckVoucher({{ $viewCheckVoucherId }})" class="btn btn-primary delete-header m-1 btn-sm"  title="Print"><i class="fa fa-print" aria-hidden="true"></i></button>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary  pull-right" {{ ($viewCheckVoucherId != null) ? "disabled='disabled'" : '' }}>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

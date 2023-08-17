<div>
    <div class="modal-content">
        <form wire:submit.prevent="render" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Generate </h4>
                <a type="button" class="close" data-dismiss="modal">&times;</a>
            </div>

            <!-- Modal body -->
            <div class=" modal-body">

                <div class="form-group mt-5">
                    <!---->
                    <label for="filterFrom_id"> from :</label>
                    <input type="date" id="filterForm_id" wire:model.defer="start_date" name="start_date"
                        value="{{ isset($start_d) ? $start_d : date('Y-m-d') }}" class="p-5 form-control">
                    <label for="filterTo_id"> to :</label>
                    <input type="date" id="filterTo_id" wire:model.defer="end_date" name="end_date"
                        value="{{ isset($end_d) ? $end_d : date('Y-m-d') }}" class="p-5 form-control">
                    {{-- <select name="consume_status" wire:model.defer="consume_status"
                    class="form-control mt-5 col-md-12">
                    <option value="">Select Loan Consume Status</option>
                    @foreach ($loanConsumable as $data)
                        <option value="{{ $data->id }}">
                            {{ $data->name, isset($currentConsumeStatus) ? $currentConsumeStatus : null }}</option>
                    @endforeach
                    </select> --}}
                    {{-- <div class="form-group p-5" >
                        <label class="text-bold">Loan-Consume Status</label>
                        <div style="height: 150px; overflow-y: scroll;">
                          
                            @foreach ($loanConsumable as $data)
                                <div class="form-check mb-2">
                                    <input id="{{ $data->id }}"type="checkbox" wire:model.defer="consume_status" class="form-check-input" value="{{$data->id}}" id="{{ $data->name }}">
                                    <label class="form-check-label" for="{{ $data->name }}">{{$data->name}}</label> 
                                </div>
                            @endforeach
                        
                        </div>
                    </div> --}}
                    <select name="inventory_type_id" wire:model.defer="inventory_type_id"
                        class="form-control mt-5 col-md-12">
                        <option value="">Select Inventory Type</option>
                        @foreach ($inventory_type as $data)
                            <option value="{{ $data->id }}">
                                {{ $data->type, isset($current_types) ? $current_types : null }}</option>
                        @endforeach
                    </select>
                    <div class="form-inline">
                        <select name="filter_quantity" wire:model.defer="filter_quantity"
                            class="form-control mt-5 col-md-4" style="width: 133px">
                            <option value=""> Select Type</option>
                            <option value="1">Less Than</option>
                            <option value="2">Greater Than</option>
                            <option value="3">Equal to</option>
                        </select>
                        <input type="number" name="qty" wire:model.defer="qty" class=" mt-5"
                            style="padding: 8px; border-radius: 2px;">
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')"
                        class="btn btn-primary btn-sm pull-right"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

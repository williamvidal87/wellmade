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
                <div class="form-group">
                <label for="filterFrom_id"> from :</label>
                <input type="date" id="filterFrom_id" wire:model.defer="start_date"  name="start_date" value="{{isset($start_d) ? $start_d : date('Y-m-d')}}" class="p-5 form-control">
                <label for="filterTo_id" style="padding-top: 5px"> to :</label>
                <input type="date" wire:model.defer="end_date" id="filterTo_id" name="end_date"  value="{{isset($end_d) ? $end_d : date('Y-m-d')}}" class="p-5 form-control">              
                <select name="client_type" wire:model.defer="client_type" class="form-control mt-5 col-md-12">
                <option value="">Select Client Type</option>
                    @foreach($client as $client_types)
                    <option value="{{$client_types->id}}">{{$client_types->client_type, isset($current_client_type) ? $current_client_type : null}}</option>
                    @endforeach 
                </select>                 
                <select name="csa_id" wire:model.defer="csa_id" class="form-control mt-5 col-md-12">               
                <option value="">Select CSA Type</option>
                 @foreach($csa as $csa_types)
                    <option value="{{$csa_types->id}}">{{$csa_types->csa_type, isset($current_csa_type) ? $current_csa_type : null}}</option>
                    @endforeach
                </select>                   
                </div>
            </div>
            <br><br><br><br>          
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" wire:click="$emit('closeModal')" class="btn btn-primary btn-sm pull-right" ><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>        
    </div>
</div>

<div>
    <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Work Item Assigned Worker(s)</h4>
            <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
            </div>
            <!-- Modal body -->
            <div class="panel-body">
                    <div class="pad-btm form-inline">
                        {{-- <livewire:flash-message.flash-message-modal2 /> --}}
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple btn-labeled" wire:click="createWorkers"><i class="btn-label demo-pli-add icon-fw"></i>Add Worker</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <h4>Work Order No: {{ $this->work_order_id }}</h4>
                        <table id="addworkerTable" class="table table-striped table-bordered table-hover " cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>Assigned Worker</th>
                                    <th>Percent(%)</th>
                                    <th>Parts (%)</th>
                                    <th>Allot Hrs</th>
                                    <th>Extension</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workers as $data)
                                    <tr>
                                        {{-- <td>{{$data->getJobType->description ?? " "}}</td>
                                        <td>{{$data->id}}</td>

                                        @foreach($name as $names)
                                            @if($data->getJobOrder->customer_id == $names->id)
                                                <td>{{$names->name}}</td>
                                            @endif
                                        @endforeach --}}
                                        <td>{{$data->getWorker->name ?? " "}}</td>
                                        <td>{{$data->getPercent->percent_name ?? " "}}</td>
                                        <td>{{$data->getPartsPercent->percent_name ?? " "}}</td>
                                        <td>{{ $data->allot_hours ?? "none"}}</td>
                                        <td>{{ $data->extension ?? "none" }}</td>
                                        <td><u><a href="javascript:void(0)" wire:click="AddStartWorker({{ $data->id }})">{{ $data->start ?? "none" }}</a></u></td>
                                        <td>
                                        @if(!empty($data->start))
                                        <u><a href="javascript:void(0)" wire:click="AddEndWorker({{ $data->id }})">{{ $data->end ?? "none" }}</a></u>
                                        @else
                                        {{ $data->end ?? "none" }}
                                        @endif
                                        
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button wire:click="deleteConfirmWorker({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm" title="Delete" 
                                                <?php 
                                                if (!empty($data->start)&&!empty($data->end)) {
                                                    echo "disabled";
                                                }
                                                ?>
                                                ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                <button wire:click="edit({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                @if(!empty($data->start)&&empty($data->end))
                                                <button wire:click="StopWorker({{ $data->id }})" class="btn btn-warning delete-header m-1 btn-sm">Stop</button>
                                                @endif
                                            </div>                
                                        </td>
                                    </tr>                                     
                                          
                                @endforeach  
                            </tbody>
                        </table>
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-group">
                   
            </div>
    </div>
</div>

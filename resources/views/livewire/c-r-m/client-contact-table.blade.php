<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Client Contact</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-purple" wire:click="createClientContact"><i class="demo-pli-add icon-fw"></i>Add</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="clientContactTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>ADDRESS</th>
                                    <th>CONTACT NO.</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientContact as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$data->contact_no}}</td>
                                    <td>
                                        @if ($data->getStatus->id == 14)
                                            <span class="badge badge-success">{{$data->getStatus->status ?? ''}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$data->getStatus->status ?? ''}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            {{-- <button wire:click="paymentClientContact({{ $data->id }})" class="btn btn-warning delete-header m-1 btn-sm"  title="Transaction"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;Payment Info</button> --}}
                                            <button wire:click="transactionClientContact({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm"  title="Transaction"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Transaction</button>
                                            <button wire:click="editClientContact({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            
                                            @if ($data->status_id == 14)
                                                <button wire:click="changeToInactive({{ $data->id }})" class="btn btn-success delete-header m-1 btn-sm"  title="Change to Inactive"><i class="fa fa-circle" aria-hidden="true"></i></button>
                                            @elseif ($data->status_id == 15)
                                                <button wire:click="changeToActive({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Change to Active"><i class="fa fa-circle" aria-hidden="true"></i></button>
                                            @endif

                                        </div>                
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="clientContactModal" tabindex="-1" role="dialog" aria-labelledby="clientContactModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" style="overflow-y: initial" role="document">
                    <livewire:c-r-m.client-contact-form />
                </div>
            </div>

            <!-- The Contact Modal -->
            <div wire.ignore.self class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)" role="document">
                    <livewire:c-r-m.contact-form />
                </div>
            </div>

            <!-- The Contact Modal -->
            <div wire.ignore.self class="modal fade" id="transactionClientContactModal" tabindex="-1" role="dialog" aria-labelledby="transactionClientContactModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:c-r-m.transaction-client-contact />
                </div>
            </div>

            <!-- The Counter Receipt Contact Modal -->
            <div wire.ignore.self class="modal fade" id="counterReceiptClientContactModal" tabindex="-1" role="dialog" aria-labelledby="counterReceiptClientContactModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" style="box-shadow: 0 0 300px 200px rgb(22, 22, 22, 0.185)" role="document">
                    <livewire:c-r-m.contact-person-counter-receipt />
                </div>
            </div>

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.client-contact-scripts'); 
@endsection

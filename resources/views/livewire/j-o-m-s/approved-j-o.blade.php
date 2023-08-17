<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Approved Job Orders</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="approvedjoborderTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>JO NO.</th>
                                    <th class="text-left">CUSTOMER NAME</th>
                                    <th class="text-center">ENGINE MODEL</th>
                                    <th class="text-center">SERIAL NO.</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approved_jo as $key=>$data)
                                    <tr>
                                        <td>{{ $data->jo_no ?? ""}}</td>
                                        {{-- <td class="text-center">{{ $data->jobTypes->abbriv_code ?? ""}}</td> --}}
                                        <td class="text-left">
                                            <i class="fa fa-user-circle"></i>&nbsp;&nbsp;
                                            {{ $data->clientProfile->name ?? "" }}
                                        </td>
                                        <td class="text-center">
                                            
                                            {{ $data->engineModel->model ?? ""}}
                                        </td>
                                        <td class="text-center">
                                            
                                            {{ $data->serial_no }}
                                        </td>
                                        <td class="text-center text-success">
                                            <i class="fa fa-check-circle"></i>&nbsp;&nbsp;
                                            {{ $data->statusess->status ?? "" }}
                                        </td>
    
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                {{-- <button wire:click="journalize({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm btn-labeled" title="Journalize" {{ $data->payment_status_id == 12 || App\Models\TransactionSummary::where('jo_no', $data->id)->where('transaction_type_id', 2)->whereIn('transaction_status_id', [1,2])->get()->count() >= 1 ? 'disabled' : '' }}><i class="btn-label fa fa-clipboard"></i>Journalize</button> --}}
                                                <button wire:click="editRecord({{ $data->id }})"
                                                    class="btn btn-info delete-header m-1 btn-sm" title="Edit"><i
                                                    class="fa fa-pencil"></i></button>
                                                <button wire:click="deleteConfirmJobOrder({{ $data->id }})"
                                                    class="btn btn-danger delete-header m-1 btn-sm" title="Delete"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></button>

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
            <div  wire.ignore.self class="modal fade" id="approvedjoModal" tabindex="-1" role="dialog"
                aria-labelledby="approvedjoModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:j-o-m-s.approved-j-o-form-edit />
                </div>
            </div>

            <div wire.ignore.self class="modal fade" id="serviceInvoiceModal" role="dialog" aria-labelledby="serviceInvoiceModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:billing.service-invoice-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.approved-jo-scripts');
@endsection
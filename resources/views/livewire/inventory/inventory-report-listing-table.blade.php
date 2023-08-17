<div>
    <div>
        <div>
            <div>
                <div class="row">
                    <livewire:flash-message.flash-messages />
                    <div class="col-xs-12">
                        <div class="panel">

                            <div class="panel-heading">
                                <h3 class="panel-title text-bold">Stocks Inventory Reports</h3>
                            </div>

                            <!--Data Table-->
                            <!--===================================================-->
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="form-inline pull-left">
                                        {{-- @can('addGenerate','printExcel','printPdf') --}}
                                        <button class="btn btn-primary btn-md" wire:click="addGenerate" style="padding: 4px; border-radius: 3px; margin-right: 5px"> <i class="fa fa-plus-circle"></i> Generate</button>
                                        <button class="btn-md" wire:click="printExcel" style="padding: 4px; border-radius: 3px; color: green" title="download"> <i class="fa fa-download"></i> Excel</button> |
                                        <button class="btn-md" wire:click="printPdf" style="padding: 4px; border-radius: 3px; color: red" title="download"> <i class="fa fa-download"></i> Pdf</button>
                                        {{-- @endcan --}}
                                    </div>                                   
                                </div>
                                <br><br><br>
                                <div class="table-responsive">
                                    <table id="inventoryReportTable" class="table table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="bg-trans-dark">
                                                <th>Date</th>
                                                <th>Loan-Consume Status </th>
                                                <th>Departmet</th>
                                                <th>Supplier</th>
                                                <th>Name</th>
                                                <th>Unit type</th>
                                                <th>Item code</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inventory_report as $data)
                                                <tr>

                                                    <td>{{ $data->created_at->format('Y/m/d') }}</td>
                                                    <td>
                                                        @foreach (unserialize($data->loan_consume_ids) as $loan)
                                                            @foreach ($loanConsumable as $loan_consumable)
                                                                @if ($loan_consumable->id == $loan)
                                                                    <span class="badge badge-success">{{ $loan_consumable->name ?? ''}}</span>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $data->getDepartment->name }}</td>
                                                    <td>
                                                        @php($supplier = $data->suppliers()->first())
                                                        @if (!is_null($supplier))
                                                            {{ $supplier->name }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $data->name }}
                                                    </td>
                                                    <td>{{ $data->unitTypes->longdescription }}</td>
                                                    <td>{{ $data->item_code }}</td>
                                                    <td>
                                                        {{ $data->qty }}
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
                        <div wire.ignore.self class="modal fade" id="inventoryReportModal" tabindex="-1"
                            role="dialog" aria-labelledby="inventoryReportModal" aria-hidden="true"
                            data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" style="width: 450px" role="document">
                                @include('livewire.inventory.inventory-report-listing-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @section('custom_script')
                @include('layouts.scripts.inventory-report-listing-scripts');
            @endsection
        </div>

    </div>

</div>

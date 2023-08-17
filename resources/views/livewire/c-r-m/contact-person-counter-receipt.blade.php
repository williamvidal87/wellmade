<div>
    <div class="modal-content"> 
        <form wire:submit.prevent="store">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Counter Receipt</h4>
            <a type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></a>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <div>
                        <table id="counterReceiptClientContactTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">INVOICE NO</th>
                                        <th style="width: 100px;">REF. DATE</th>
                                        <th style="width: 100px;">CSA</th>
                                        <th style="width: 100px;">NET AMOUNT</th>
                                        <th style="width: 100px;">PAYMENT</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach ($listItems as $data)
                                    <tr>
                                        <td style="width: 100px;">{{ $data['invoice_no'] }}</td>
                                        <td style="width: 100px;">{{ $data['date'] }}</td>
                                        <td style="width: 100px;">{{ $data['csa'] }}</td>
                                        <td style="width: 100px; text-align:right;">{{ $data['net_amount'] }}</td>
                                        <td style="width: 100px;">{{ $data['payment'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right"><b>Total:</b></td>
                                    <td style="text-align: right;">{{ $total }}</td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
{{-- @section('custom_script')
    @include('layouts.scripts.client-contact-scripts'); 
@endsection --}}
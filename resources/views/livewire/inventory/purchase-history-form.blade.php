<div>
    <div class="modal-content">

        @foreach ($report_data as $data)
        <form>
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Purchase History</h4>
            <button type="button" class="close" data-dismiss="modal" onClick="document.location.reload(true)"><i class="pci-cross pci-circle"></i></button>
            </div>
            
            <!-- Modal body -->
            <div class=" modal-body">
                <div class="row">
                    <div class="col-lg-2">
                         <div class="form-group">
                            <label>Date</label>
                            <input  type="text" class="form-control" value="{{ $data->date }}" required readonly>
                        </div> 
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>PR NO:</label>
                            <input  type="text" class="form-control" value="{{ $data->pr_no }}" required readonly>
                        </div>  
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Supplier</label>
                            <input  type="text" class="form-control" value="{{ $data->suppliers->name }}" required readonly>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="tools" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th class="col-lg-2">PRODUCT</th>
                                    <th class="col-lg-2">QTY</th>
                                    <th class="col-lg-2">UNIT</th>
                                    <th>PRICE</th>
                                    <th>TOTAL PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        @foreach ($item->stockManagement as $stock)
                                            <td class="col-lg-2">
                                                <input  type="text" class="form-control" value="{{ $stock->name ?? '' }}" required readonly></td>
                                            </td>
                                        @endforeach
                                        <td class="col-lg-2">
                                            <input  type="number" value="{{ $item->qty ?? '' }}" class="form-control" required readonly></td>
                                        <td class="col-lg-2">
                                            <input  type="text" value="{{ $item->unit ?? '' }}" class="form-control" required readonly></td>
                                        </td>
                                        <td>
                                            <input style="text-align:right;"  type="text" value="{{ number_format($item->price, 2) ?? '' }}" class="form-control" required readonly></td>
                                        </td>
                                        <td>
                                            <input style="text-align:right;"  type="text" value="{{ number_format($item->total_price, 2) ?? '' }}" class="form-control" readonly></td>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align:center" colspan="3"></td>
                                    <td style="text-align:right"><b>Total:</b></td>
                                    <td><input style="text-align:right;"  type="text" value="{{ number_format($data->all_total_price, 2) }}" class="form-control" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control"  rows="5" readonly>{{$data->remarks}}</textarea>
                        </div>
                    </div>  
                </div>
            </div>

        </form>    
        @endforeach
        
    </div>
</div>

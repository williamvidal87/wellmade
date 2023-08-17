<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      font-size: 12px;
    }
</style>
<h3>Stock Management Reports</h3>

<table  width="100%"> 
    <thead>
        <tr>          
            
            <th>Date</th>
            <th>Consumable Status </th>
            <th>Department</th>  
            <th>Supplier</th>                                             
            <th>Name</th> 
            <th>Unit type</th>
            <th>Item code</th>
            <th>Qty</th>           
        </tr>
    </thead>
    <tbody>
        @foreach ($report_data as $data)
            <tr>  
                                                                    
                <td>{{$data->created_at->format('Y/m/d')}}</td>  
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
                        @if(!is_null($supplier))
                        {{$supplier->name}}
                    @endif
                </td>         
                <td>
                    {{$data->name}}                                    
                </td> 
                <td>{{$data->unitTypes->longdescription}}</td> 
                <td>{{$data->item_code}}</td>   
                <td>
                    {{$data->qty}}
                </td>                                                 
            </tr>    
        @endforeach  
    </tbody>
</table>

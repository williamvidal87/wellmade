<table> 
    <thead>
        <tr>           
            
            <th>Date</th>
            <th>Name</th>
            <th>Client Type</th>
            <th>Csa Type</th>                                               
            <th>Branch</th>
            <th>Contact no.</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($client_report_list as $data)
        <tr>  
            <td>{{$data->created_at->format('d/m/Y')}}</td>
            <td>{{$data->name}}</td> 
            <td>{{$data->clientTypes->industry_id}} - {{$data->clientTypes->client_type}}</td>
            <td>{{$data->forCSA->csa_type}}</td>
            <td>{{$data->forBranch->branch_name}}</td>
            <td>{{$data->contact_no}}</td>
                        
        </tr>    
        @endforeach  
    </tbody>
</table>
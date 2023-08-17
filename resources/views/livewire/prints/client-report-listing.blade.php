<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
</style>
<h3>Client Report Listing</h3> 
<table width="100%"> 
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
        @foreach ($report_data as $data)
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

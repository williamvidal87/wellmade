<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
</style>
<h3>Payment Logs</h3>
<table width="100%"> 
    <thead>
        <tr> 
            <th>Date</th>                                 
            <th>Description</th>
            <th>User</th>
            <th>Url</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report_data as $data)
        <tr>
            <td>{{$data->created_at}}</td>
            <td>{{$data->description}}</td>
            <td>{{$data->log_name}}</td>
            <td>{{$data->subject_type}}</td>
        </tr>
    
        @endforeach   
    </tbody>
</table>
<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
</style>
<h3>User Report Listing</h3> 
<table width="100%"> 
    <thead>
        <tr class="bg-trans-dark">                                             
            <th>Name</th>
            <th>Roles</th>
            <th>Email</th>
            <th>Contact no.</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user_report as $data)
        <tr>                                                
           <td><i class="fa fa-user-circle"></i>&nbsp;&nbsp;{{$data->name}}</td> 
           <td>
            @foreach ($data->roles as $role)
                <span class="badge badge-success">{{ $role->name }}</span>
            @endforeach
            </td>
           <td>{{$data->email}}</td>                                              
           <td>{{$data->contact_no}}</td>                                                            
        </tr>    
        @endforeach  
    </tbody>
</table>
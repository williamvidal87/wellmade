<table> 
    <thead>
        <tr>                                             
            <th>Name</th>
            <th>Roles</th>
            <th>Email</th>
            <th>Contact no.</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user_roles as $data)
        <tr>                                                
           <td>{{$data->name}}</td> 
           <td>
            @foreach ($data->roles as $role)
                {{ $role->name }}
            @endforeach
            </td>
           <td>{{$data->email}}</td>                                              
           <td>{{$data->contact_no}}</td>                                                            
        </tr>    
        @endforeach  
    </tbody>
</table>
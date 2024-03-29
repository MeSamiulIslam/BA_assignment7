<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Datatable Example</title>

        <link type="text/css" href="{{asset('css/jquery.dataTables.css')}}" rel="stylesheet">
        <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery.dataTables.js')}}"></script>
    </head>
    <body>

    <div>
        <h3>Laravel Datatable and Server side Ajax</h3>
        <table id="datatable" class="display">
            <thead>
                <tr align="left">
                <th>ID</th>    
                <th data-sortable="true">Name</th>
                <th data-sortable="false">Email</th>
                <th data-sortable="false">Created at</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    </body>
<script>
   $(document).ready(function(){
      $('#datatable').DataTable({
         processing: true,
         serverSide: true,
         order: [[ 0, "desc" ]],
         ajax: "{{ url('users-data') }}",
         columns: [
               { data: 'id' },
               { data: 'name' },
               { data: 'email' },
               { data: 'created_at' }       
         ]
      });
   }); 
</script>


</html>
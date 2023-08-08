@extends('admin.layout')

@section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('main')
<div class="row">
    <div class="col-12">

            <a href="{{route('client_create')}}" class="btn btn-primary mb-2">Créer un nouveau</a>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Liste des clients</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>N°</th>
                <th>Code</th>
                <th>nom</th>
                <th>Affaire MI</th>
                <th>Affaire GMS</th>
                <th>Affaire MG</th>
                <th>logo</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->code}}</td>
                        <td>{{$client->nom}}</td>
                        <td>{{$client->mi_affaire_id}}</td>
                        <td> {{$client->gms_affaire_id}} </td>
                        <td>{{$client->mg_affaire_id}}</td>
                        <td><img class="img-circle"  style="height: 70px; width: 70px"
                            src="{{asset(env('PUBLIC_URL').'fichiers/clients/'.$client->logo)}}" alt="logo du client">
                        </td>
                        <td class="d-flex align-items-center">
                          <a href="{{route('client_show',$client->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                          <a class="btn btn-outline-dark btn-sm m-1" href="{{route('client_edit',$client->id)}}">
                            <i class="fas fa-edit"></i> 
                          </a>
                          <form action="{{route('client_delete',$client->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm clientSupp" >
                              <i class="fas fa-trash"></i> 
                            </button>
                          </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>N°</th>
                    <th>Code</th>
                    <th>nom</th>
                    <th>Affaire MI</th>
                    <th>Affaire GMS</th>
                    <th>Affaire MG</th>
                    <th>logo</th>
                    <th></th>
                </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
@endsection

@section('js')

 <!-- DataTables  & Plugins -->
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/jszip/jszip.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
 <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
 

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    });
  </script>
  <script src="{{asset(env('PUBLIC_URL').'js/admin/client.js')}}"></script>
@endsection
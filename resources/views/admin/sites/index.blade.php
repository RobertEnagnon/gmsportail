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

            @can('create', App\Models\Site::class)
              <a href="{{route('site_create')}}" class="btn btn-primary mb-2">Créer un nouveau</a>
            @endcan
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Liste des sites</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>N°</th>
                <th>nom</th>
                @if (Auth::user()->is_admin) <th>Client </th> @endif
                <th>Entité </th>
                <th></th>
            </tr>
            </thead>

            <tbody>
                @foreach ($sites as $site)
                    <tr>
                        <td>{{$site->id}}</td>
                        <td>{{$site->libelle}}</td>
                        @if (Auth::user()->is_admin)<td>{{$site->client->nom}}</td> @endif
                        <td>{{$site->societe->libelle}}</td>
                        <td class="d-flex align-items-center">
                          <a href="{{route('site_show',$site->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                          @can('update', $site)
                          <a class="btn btn-outline-dark btn-sm m-1" href="{{route('site_edit',$site->id)}}">
                            <i class="fas fa-edit"></i> 
                          </a>
                          @endcan
                          @can('delete', $site)
                          <form action="{{route('site_delete',$site->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm siteSupp"  >
                              <i class="fas fa-trash"></i> 
                            </button>
                          </form>
                          @endcan
                        </td>
                    </tr>
                @endforeach

            </tbody>
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
  <script src="{{asset(env('PUBLIC_URL').'js/admin/site.js')}}" defer></script>
@endsection
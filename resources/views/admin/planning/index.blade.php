@extends('admin.layout')

@section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <style>
    .is-done{
      color: gray;
      text-decoration: line-through ;
    }
  </style>
@endsection

@section('main')
<div class="row">
    <div class="col-12">

            <a href="{{route('planning.create')}}" class="btn btn-primary mb-2">Voir l'agenda ou Créer une nouvelle Tâche </a>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Liste des Tâches</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>N°</th>
              <th>Date</th>
              <th>Titre</th>
              @if (Auth::user()->is_admin)<th>Client</th> @endif
              <th>Entité</th>
              <th></th>
            </tr>
            </thead>

            <tbody>
                @foreach ($taches as $tache)
                    <tr @class(['is-done' => $tache->is_done==1]) >
                        <td>{{$tache->id}}</td>
                        <td>{{date('d/m/Y',strtotime($tache->date))}}</td>
                        <td>{{$tache->libelle}}</td>
                        @if (Auth::user()->is_admin)<td>{{$tache->client->nom}} </td> @endif
                        <td>{{$tache->societe->libelle}}</td>
                        
                        <td class="d-flex align-items-center">
                          {{-- <a href="{{route('planning.show', $tache->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a> --}}
                          @can('update', $tache)
                          <a class="btn btn-outline-dark btn-sm m-1" href="{{route('planning.edit',$tache->id)}}">
                            <i class="fas fa-edit"></i> 
                          </a>
                          @endcan
                          @can('delete', $tache)
                          <form action="{{route('planning.destroy',$tache->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"  class="btn btn-danger btn-sm planSupp" >
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
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
    });

    
  </script>
  <script src="{{asset(env('PUBLIC_URL').'js/admin/planning.js')}}"></script>
@endsection
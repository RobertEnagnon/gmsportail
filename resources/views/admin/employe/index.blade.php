@extends('admin.layout')

@section('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('main')
<div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Liste des employes</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <table id="example1" class="table table-bordered table-striped">
            <a href="{{route('employe_create')}}" class="btn btn-primary">Créer un nouveau</a>
            <thead>
            <tr>
              <th>N°</th>
              <th>Matricule</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>CIN</th>
              <th>CNSS</th>
              <th>Site</th>
              <th>Client</th>
              <th>Entité</th>
              <th>Date</th>
              <th></th>
            </tr>
            </thead>

            <tbody>
                @foreach ($employes as $employe)
                    <tr>
                        <td>{{$employe->id}}</td>
                        <td>{{$employe->matricule}}</td>
                        <td>{{$employe->nom}}</td>
                        <td>{{$employe->prenom}}</td>
                        <td>{{$employe->cin}}</td>
                        <td>{{$employe->cnss}}</td>
                        <td>{{$employe->site->libelle}}</td>
                        <td> {{$employe->client->nom}} </td>
                        <td>{{$employe->societe->libelle}}</td>
                        <td>{{date('d/m/Y',strtotime($employe->date))}}</td>
                        <td class="d-flex">
                          <a href="{{route('employe_show',$employe->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <a class="btn btn-outline-dark btn-sm m-1" href="{{route('employe_edit',$employe->id)}}">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <form action="{{route('employe_delete',$employe->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"  class="btn btn-danger btn-sm emplSupp" >
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
              <th>Matricule</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>CIN</th>
              <th>CNSS</th>
              <th>Site</th>
              <th>Client</th>
              <th>Entité</th>
              <th>Date</th>
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
 <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
 <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
 
 
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
    });

    
  </script>
  <script src="{{asset('js/admin/employe.js')}}"></script>
@endsection
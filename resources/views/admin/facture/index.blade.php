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
          <h3 class="card-title">Liste des factures</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            @can('create', App\Models\Facture::class)
            <a href="{{route('facture_create')}}" class="btn btn-primary">Créer un nouveau</a>
            @endcan
            <thead>
            <tr>
              <th>Numero</th>
              <th>Libelle</th>
              <th>document</th>
              <th>Client</th>
              <th>Entité</th>
              <th>Date</th>
              <td></td>
            </tr>
            </thead>

            <tbody>
                @foreach ($factures as $facture)
                    <tr>
                        <td>{{$facture->id}}</td>
                        <td>{{$facture->libelle}}</td>
                        <td>{{$facture->nom_fichier}}</td>
                        <td> {{$facture->client->nom}} </td>
                        <td>{{$facture->societe->libelle}}</td>
                        <td>{{date('d/m/Y',strtotime($facture->date))}}</td>
                        <td class="d-flex align-items-center">
                          <a href="{{route('facture_show',$facture->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          @can('update', $facture)
                          <a class="btn btn-outline-dark btn-sm m-1" href="{{route('facture_edit',$facture->id)}}">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          @endcan
                          @can('delete', $facture)
                          <form action="{{route('facture_delete',$facture->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm factSupp" >
                              <i class="fas fa-trash"></i> 
                            </button>
                          </form>
                          @endcan
                        </td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Numero</th>
                <th>Libelle</th>
                <th>document</th>
                <th>Client</th>
                <th>Entité</th>
                <th>Date</th>
                <td></td>
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
    //   $('#example2').DataTable({
    //     "paging": true,
    //     "lengthChange": false,
    //     "searching": false,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    //     "responsive": true,
    //   });
    });
  </script>
  <script src="{{asset('js/admin/facture.js')}}"></script>
@endsection
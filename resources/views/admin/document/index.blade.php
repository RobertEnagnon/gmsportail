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
          <h3 class="card-title">Liste des documents</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <table id="example1" class="table table-bordered table-striped">
            <a href="{{route('document_create')}}" class="btn btn-primary">Créer un nouveau</a>
            <thead>
            <tr>
              <th>N°</th>
              <th>Libelle</th>
              <th>document</th>
              <th>Type du document</th>
              <th>Client</th>
              <th>Entité</th>
              <th>Date</th>
              <th></th>
            </tr>
            </thead>

            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{$document->id}}</td>
                        <td>{{$document->libelle}}</td>
                        <td>{{$document->nom_fichier}}</td>
                        <td>{{$document->type_doc->libelle}}</td>
                        <td> {{$document->client->nom}} </td>
                        <td>{{$document->societe->libelle}}</td>
                        <td>{{date('d/m/Y',strtotime($document->date))}}</td>
                        <td class="d-flex">
                          <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <a class="btn btn-outline-dark btn-sm m-1" href="{{route('document_edit',$document->id)}}">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <form action="{{route('document_delete',$document->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"  class="btn btn-danger btn-sm docuSupp" >
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
              <th>Libelle</th>
              <th>Fichier</th>
              <th>Type du document</th>
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
  <script src="{{asset('js/admin/document.js')}}"></script>
@endsection
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

            @can('create', App\Models\Ticket::class)
            <a href="{{route('ticket_create')}}" class="btn btn-primary mb-2">Créer un ticket</a>
            @endcan
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Liste des tickets</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>N°</th>
              <th>Service</th>
              <th>Objet</th>
              @if (Auth::user()->is_admin)<th>Client</th>@endif
              <th>Etat</th>
              <th>Priorite</th>
              <th>Entité</th>
              {{-- <th>Date du début</th> --}}
              <th>Dernière modification</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->service->libelle}}</td>
                        
                        <td class="text-info">{{$ticket->titre}}</td>
                        @if (Auth::user()->is_admin)<td> {{$ticket->client->nom}} </td>@endif
                        <td class="text-center">
                          @if ($ticket->status =="Ouvert")
                            <a class="btn btn-success btn-xs w-100">{{ $ticket->status }}</a>
                          @elseif($ticket->status =="Répondu" && Auth::user()->client && Auth::user()->client->id == $ticket->client_id)
                            <a class="btn btn-info btn-xs w-100">En attente de votre response</a>
                          @elseif($ticket->status =="Répondu" && !Auth::user()->client)
                          <a class="btn btn-info btn-xs w-100"> {{ $ticket->status }}</a>
                          @elseif($ticket->status =="Réponse du client" && !Auth::user()->client )
                            <a class="btn btn-warning btn-xs w-100">{{ $ticket->status }}</a>
                          @elseif($ticket->status =="Réponse du client" && Auth::user()->client && Auth::user()->client->id == $ticket->client_id )
                          <a class="btn btn-warning btn-xs w-100"> Répondu</a> 
                          @elseif($ticket->status =="Fermé")
                            <a class="btn btn-dark btn-xs  w-100">{{ $ticket->status }}</a>
                          @endif
                        </td>
                        
                        <td>{{$ticket->priorite->libelle }}</td>
                        <td>{{$ticket->societe->libelle}}</td>
                        {{-- <td class="muted">{{date('d/m/Y(H:i)',strtotime($ticket->date))}}</td> --}}
                        <td class="muted">{{date('d/m/Y(H:i)',strtotime(count($ticket->messages) > 0 ? $ticket->messages[count($ticket->messages)-1]->updated_at : Carbon\Carbon::now()))}}</td>
                        <td class="d-flex align-items-center">
                          <a href="{{route('ticket_show',$ticket->id)}}" class="btn btn-sm btn-info mr-1"><i class="fas fa-eye"></i></a>
                          @can('update', $ticket)
                          @if ($ticket->status == "Ouvert")
                            <a class="btn btn-outline-dark btn-sm mr-1" href="{{route('ticket_edit',$ticket->id)}}">
                              <i class="fas fa-edit"></i> 
                            </a>
                          @endif
                          @endcan
                          <form action="{{route('ticket_delete',$ticket->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"  class="btn btn-danger btn-sm tickSupp" >
                              <i class="fas fa-trash"></i> 
                            </button>
                          </form>
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
  <script src="{{asset(env('PUBLIC_URL').'js/admin/ticket.js')}}"></script>
@endsection
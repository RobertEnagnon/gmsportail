@extends('admin.layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/planning.css')}}">
   
    <style>
  
        a{
            color: inherit;
            text-decoration: none;
        }
         header.modal-title{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-right: 10px;
        }
        .modal-title nav a{
            border: none;
            height: 30px;
            line-height: 30px;
            text-align: center;
            width: 30px;
            border-radius: 50%;
            background: #fff;
            margin: 0 2px;
            color: gray
        }
        .pointTitle{
            width: 15px;
            height: 15px;
            border-radius: 5px;
            background: rgb(13, 117, 236);
           
        }
        #calendarModal .modal-body div i{
            margin-right: 15px;
        }
    </style>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-2">
            <a href="{{route('planning.create')}}" class="btn btn-primary">Créer une nouvelle Tâche</a>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agenda</div>

                <div class="card-body">
                    <div id="calendar"></div>
                </div>

                {{-- Modal of detail showning --}}
                <div class="modal fade " id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content"> 
                        <div class="modal-header">
                          {{-- <h5 class="modal-title" id="modalTitle"></h5> --}}
                            <header class="modal-title">
                                <nav class="d-flex align-items-center">
                                    <a  id="edit" class="text-info" title="Modifier" >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                  
                                    <form  method="post" id="delete" title="Supprimer">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"  class="text-danger btn"  >
                                          <i class="fas fa-trash"></i> 
                                        </button>
                                      </form>
                                    <button type="button" title="fermer" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </nav>
                            </header>
                        </div>
                        <div class="modal-body" >
                            <div class="d-flex align-items-center mb-4">
                               <i class="pointTitle"></i>  <h3 id="modalTitle"></h3> 
                            </div>
                            <div id="program" class="mb-2">
                                <i class="fas fa-clock text-muted"></i>
                                <span  class="h6">Début: <span id="start">Jeudi 22,Juin</span></span> <br>
                                <span class="text-muted ml-5">Fin: <span id="end" > Vendredi 23, Juin</span></span><br>
                            </div>

                            <div id="detail">
                                <i class="fas fa-bars text-muted"></i>
                                <span id="desc"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>

                    </div>
                  </div>
                    
            
            </div>

        </div>



                 {{-- Modal of add showning --}}
                 <div class="modal fade " id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content "> 
                        <div class="modal-header">
                          {{-- <h5 class="modal-title" id="modalTitle"></h5> --}}
                            <button style="height: 40px" class="btn text-info mx-auto">
                                <div class="card-header">Créer une tâche</div>
                            </button>
                            <button type="button" title="fermer" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body" >
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <form action="{{ route('planning.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="client">Client <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="client" name="client_id">
                                                        @foreach ($clients as $client)
                                                            <option value="{{$client->id}}">{{$client->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="entite">Entité <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="entite" name="societe_id">
                                                        @foreach ($entites as $entite)
                                                            <option value="{{$entite->id}}">{{$entite->libelle}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="libelle">Titre <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="libelle" name="libelle" >
                                            </div>
                                            <div class="form-group">
                                                <label for="detail">Description</label>
                                                <textarea class="form-control" id="detail" name="detail" rows="3" ></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date">Date <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="date" name="date" >
                                                </div>
                                                <div class="col">
                                                    <label for="couleur">Couleur</label>
                                                    <input type="color" class="form-control" id="couleur" name="couleur" value="#006eff">
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="repete" value="1" name="repete" >
                                                <label for="repete" class="form-check-label">Répète</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="periodicite">Périodicité</label>
                                                <input type="text" class="form-control" id="periodicite" name="periodicite" >
                                            </div>
                                            
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" name="reteption" id="reteption1" >
                                                <label for="reteption1">Se termine le</label>
                                                <input type="date" class="form-control" id="se_termine_le" name="se_termine_le" >
                                            </div>
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input" name="reteption" id="reteption2">
                                                <label for="reteption2">Se termine après</label>
                                                <div class="d-flex justify-content-between">
                                                    <input type="number" class="form-control" value="5" id="se_termine_apres" name="se_termine_apres" >
                                                    <input type="text" class="form-control" value="Occurences" disabled>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Créer un nouveau</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>

                    </div>
                  </div>
                    
            
                </div>
    </div>

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: true,
                events: '{{ route('planning.getEvents') }}',
                eventClick:  function(eventInfo) {
                    const event = eventInfo.event;
                    const info = event._def;
                    console.log(event)
                    document.querySelector('#modalTitle').innerHTML = info.title;
                    document.querySelector('#start').innerHTML = event.startStr;
                    document.querySelector('#end').innerHTML = event.endStr;
                    document.querySelector('#desc').innerHTML = info.extendedProps.description;
                    // $('#eventUrl').attr('href',info.url);
                    document.querySelector('.modal-title #edit').setAttribute('href',`/admin/plannings/edit/${event.id}`);
                    document.querySelector('.modal-title #delete').setAttribute('action',`/admin/plannings/destroy/${event.id}`);
               
                    $('#calendarModal').modal();
                },
                dateClick: function(info) {
                    
                    info.dayEl.style.background = 'lightblue';
                    document.querySelector('#date').value = info.dateStr;
                    console.log(info.dateStr)
                        $('#addModal').modal('show');
                }
            });
            
            calendar.render();
        });
    </script>
@endsection

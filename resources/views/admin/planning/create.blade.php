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
        #repeateContainer{
            visibility: hidden;
            height: 0;
            transition: all 0.4s ease;
        }
    </style>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-2">
            <a href="{{route('planning.index')}}">Voir la liste des Tâches</a>
        </div>
        <div class="col-md-8 mx-auto">
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
        @can('create', App\Models\Planning::class)
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
                                                    @error('client_id')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                                </div>
                                                <div class="col">
                                                    <label for="entite">Entité <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="entite" name="societe_id">
                                                        @foreach ($entites as $entite)
                                                            <option value="{{$entite->id}}">{{$entite->libelle}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('societe_id')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="libelle">Titre <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="libelle" name="libelle" >
                                                @error('libelle')
                                                    <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="detail">Description</label>
                                                <textarea class="form-control" id="detail" name="detail" rows="1" ></textarea>
                                                @error('detail')
                                                    <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date">Date <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="date" name="date" >
                                                    @error('date')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label for="couleur">Couleur</label>
                                                    <input type="color" class="form-control" id="couleur" name="couleur" value="#006eff">
                                                    @error('couleur')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="checkbox" class="form-check-input" id="repete" value="1" name="repete" >
                                                <label for="repete" class="form-check-label">Répéter</label>
                                                @error('repete')
                                                    <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div id="repeateContainer" class="my-4">
                                                
                                                <div class="form-group">
                                                    <label for="periodicite">Périodicité</label>
                                                    <div class="form-control">
                                                        <span class="col-2">1 </span>
                                                        <select name="periodicite" id="periodicite" class="col-10" style="border: none; outline: none" >
                                                            <option value="jour">jour</option>
                                                            <option value="semaine">semaine</option>
                                                            <option value="mois">mois</option>
                                                            <option value="an">an</option>
                                                        </select>
                                                    </div>
                                                    @error('periodicite')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="reteption" id="reteption1" >
                                                    <label for="reteption1">Se termine le</label>
                                                    <input type="date" class="form-control" id="se_termine_le" name="se_termine_le" disabled >
                                                    @error('se_termine_le')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                                    </div>
                                                <div class="form-check mb-2">
                                                    <input type="radio" class="form-check-input" name="reteption" id="reteption2">
                                                    <label for="reteption2">Se termine après</label>
                                                    <div class="d-flex justify-content-between">
                                                        <input type="number" class="form-control" value="5" id="se_termine_apres" name="se_termine_apres" disabled >
                                                        <input type="text" class="form-control" value="Occurences" disabled>
                                                    </div>
                                                    @error('se_termine_apres')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
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
        @endcan
        
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
                        $('#addModal').modal('show');
                }
            });
            
            calendar.render();
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/ix8b72cwx40l8ynsz2d4t2hra6pq2tlsaiodp7b8uhowd28x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
       tinymce.init({
         selector: 'textarea#detail', // Replace this CSS selector to match the placeholder element for TinyMCE
         plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
       });
    </script>
    <script src="{{asset('js/admin/planning.js')}}"></script>
@endsection


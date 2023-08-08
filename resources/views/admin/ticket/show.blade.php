@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-success mb-3 " style="background: rgb(245, 244, 244)" >
                <div class="card-header bg-transparent border-success">Détail sur le Ticket</div>
                <div class="card-body ">
                    <h2 class="text-success mb-3 text-center">{{$ticket->titre}}</h2>
                    <h5><span class="font-italic d-inline-block w-25">Auteur:</span> <small>{{$ticket->user ? $ticket->user->prenom.' - '. $ticket->user->nom : ""}}</small> <br> 
                        {{-- <small class="ml-5">{{$ticket->user->email}}</small> --}}
                    </h5>
                    <h5><span class="font-italic d-inline-block w-25">Date du début:</span> <small>{{$ticket->date}}</small></h5>
                    <h5><span class="font-italic d-inline-block w-25">Assigner à: </span><small>{{$ticket->service->libelle}}</small></h5>
                    <h5><span class="font-italic d-inline-block w-25">Entité: </span><small>{{$ticket->societe->libelle}}</small></h5>
                    {{-- <h5><span class="font-italic d-inline-block w-25">Client:</span> <small>{{$ticket->client ? $ticket->client->nom : ""}}</small></h5> --}}
                    <h5><span class="font-italic d-inline-block w-25">Priorité: </span><small>{{$ticket->priorite->libelle}}</small></h5>
                    <h5><span class="font-italic d-inline-block w-25">Etat: </span>
                       
                
                        @if ($ticket->status =="Ouvert")
                            <a class="btn btn-success btn-xs">{{ $ticket->status }}</a>
                          @elseif($ticket->status =="Répondu" && Auth::user()->client && Auth::user()->client->id == $ticket->client_id)
                            <a class="btn btn-info btn-xs">En attente de votre response</a>
                          @elseif($ticket->status =="Répondu" && !Auth::user()->client)
                          <a class="btn btn-info btn-xs"> {{ $ticket->status }}</a>
                          @elseif($ticket->status =="Réponse du client" && !Auth::user()->client )
                            <a class="btn btn-warning btn-xs">{{ $ticket->status }}</a>
                          @elseif($ticket->status =="Réponse du client" && Auth::user()->client && Auth::user()->client->id == $ticket->client_id )
                          <a class="btn btn-warning btn-xs"> Répondu</a> 
                          @elseif($ticket->status =="Fermé")
                            <a class="btn btn-dark btn-xs ">{{ $ticket->status }}</a>
                          @endif
                    </h5> <br>
                    {{-- Historique des Messages --}}
                    <h2 class="font-italic text-center text-muted h5">L'historique de conversation: </h2>
                    <div class="messages col-lg-9 col-md-10 col-sm-10  mx-auto  shadow p-4" style="background: rgb(255, 255, 255); border-radius:20px; max-height: 70vh; overflow:auto">
                        @foreach ($ticket->messages as $message)
                        <p @class(['w-75', 'ml-auto text-right' => Auth::user()->id != $message->sender->id])> 
                            <span class=" text-secondary font-italic h5">
                                {{Auth::user()->id == $message->sender->id ? "Vous" :($message->sender->is_admin ? "Service GMS Portail" : $message->sender->prenom ." ".$message->sender->nom)}}  : 
                            </span> 
                            <br><em>{{ date('d/m/Y à H\h:i\m\i\n',strtotime($message->updated_at) )}}</em>
                            <div @class(['text-white p-3   ', 
                            'ml-auto text-right' => Auth::user()->id != $message->sender->id]) 
                            style="background: rgb(136, 136, 136); border-radius:20px; width:55%;"
                            >{!! $message->content!!}</div>
                        </p>
                    @endforeach
                    </div>
                    
                </div>
                <div class="card-footer bg-transparent border-success">
                    
                    <?php $fichiers = explode(";", trim($ticket->fichiers, ';')) ?>
                    @if ($fichiers[0])
                        <h4 class="text-info" style="text-decoration: underline" >Liste des fichiers : </h4>
                        @foreach ($fichiers as $key=>$fichier)
                            <a class="h5 text-primary " href="{{asset(env('PUBLIC_URL').'fichiers/tickets/'.$fichier)}}" target="_blank">Lire fichier {{$key+1}}</a> <span style="width: 20px; display: inline-block">  </span>
                        @endforeach
                    @endif
                    @if (Auth::user()->client && Auth::user()->client->id == $ticket->client_id)
                        @if ($ticket->status =="Répondu")
                            <a href="{{route('ticket_replyForm',$ticket->id)}}" class="h5 btn btn-outline-warning ml-5">Répondre</a>
                        @endif
                    @else
                        @if ($ticket->status =="Réponse du client" || $ticket->status =="Ouvert")
                            <a href="{{route('ticket_replyForm',$ticket->id)}}" class="h5 btn btn-outline-info ml-5">Répondre</a>
                        @endif
                    @endif
                    <a href="{{route('tickets')}}" class="h5 btn text-success ml-5">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
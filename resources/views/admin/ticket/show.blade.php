@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-success mb-3" >
                <div class="card-header bg-transparent border-success">Détail sur la Facture</div>
                <div class="card-body ">
                    <h2 class="text-success mb-3 text-center">{{$ticket->titre}}</h2>
                    <h5><span class="font-italic">Auteur:</span> <small>{{$ticket->user->prenom.' - '. $ticket->user->nom}}</small> <br> 
                        <small class="ml-5">{{$ticket->user->email}}</small>
                    </h5>
                    <h5><span class="font-italic ">Date:</span> <small>{{$ticket->date}}</small></h5>
                    <h5><span class="font-italic ">Assigner à: </span><small>{{$ticket->service->libelle}}</small></h5>
                    <h5><span class="font-italic ">Entité: </span><small>{{$ticket->societe->libelle}}</small></h5>
                    <h5><span class="font-italic ">Client:</span> <small>{{$ticket->client->nom}}</small></h5>
                    <h5><span class="font-italic ">Priorité: </span><small>{{$ticket->priorite->libelle}}</small></h5>
                    <h5 class="font-italic mx-auto text-center">Message: </h5>
                    <p class="text-center mx-auto"> {!! $ticket->message!!}</p>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a class="h5 text-primary" href="{{asset('/fichiers/tickets/'.$ticket->nom_fichier)}}" target="_blank">Lire le ticket</a>
                    <a href="{{route('tickets')}}" class="h5 btn btn-outline-info ml-5">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
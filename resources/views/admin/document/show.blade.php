
@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-success mb-3" >
                <div class="card-header bg-transparent border-success">Détail sur le document</div>
                <div class="card-body ">
                    <h2 class="text-success mb-3 text-center">{{$document->libelle}}</h2>
                    <h5><span class="font-italic ">Type document:</span> <small>{{$document->type_doc->libelle}}</small></h5>
                    <h5><span class="font-italic ">Date:</span> <small>{{$document->date}}</small></h5>
                    <h5><span class="font-italic ">Entité: </span><small>{{$document->societe->libelle}}</small></h5>
                    <h5><span class="font-italic ">Client:</span> <small>{{$document->client->nom}}</small></h5>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a class="h5 text-primary" href="{{asset(env('PUBLIC_URL').'fichiers/documents/'.$document->nom_fichier)}}" target="_blank">Lire le document</a>
                    <a href="{{route('documents')}}" class="h5 btn btn-outline-info ml-5">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
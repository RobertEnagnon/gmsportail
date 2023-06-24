@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-success mb-3" >
                <div class="card-header bg-transparent border-success">Détail sur la Facture</div>
                <div class="card-body ">
                    <h2 class="text-success mb-3 text-center">{{$facture->libelle}}</h2>
                    <h5><span class="font-italic ">Date:</span> <small>{{$facture->date}}</small></h5>
                    <h5><span class="font-italic ">Entité: </span><small>{{$facture->societe->libelle}}</small></h5>
                    <h5><span class="font-italic ">Client:</span> <small>{{$facture->client->nom}}</small></h5>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a class="h5 text-primary" href="{{asset('/fichiers/factures/'.$facture->nom_fichier)}}" target="_blank">Lire la facture</a>
                    <a href="{{route('factures')}}" class="h5 btn btn-outline-info ml-5">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
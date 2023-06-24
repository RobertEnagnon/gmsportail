@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-success mb-3" >
                <div class="card-header bg-transparent border-success h4">Détail sur le site</div>
                <div class="card-body ">
                    <h2 class="text-success mb-3 text-center">{{$site->libelle}}</h2>
                    <h5><span class="font-italic">Client:</span> <small>{{$site->client->nom." ".$site->client->prenom}}</small> </h5>
                    <h5><span class="font-italic ">Entité: </span> <small>{{$site->societe->libelle}}</small></h5>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a href="{{route('sites')}}" class="h5 btn btn-outline-info ml-5">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
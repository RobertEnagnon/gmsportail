@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-success mb-3" >
                <div class="card-header bg-transparent border-success">Détail sur l'employé <em class="text-warning">{{$employe->matricule}}</em></div>
                <div class="card-body ">
                    <h2 class="text-success mb-3 text-center">{{$employe->nom." ".$employe->nom}}</h2>
                    <h5><span class="font-italic ">CIN:</span> <small>{{$employe->cin}}</small></h5>
                    <h5><span class="font-italic ">CNSS:</span> <small>{{$employe->cnss}}</small></h5>
                    <h5><span class="font-italic ">Site:</span> <a href="{{$employe->site->libelle}}">{{$employe->site->libelle}}</a></h5>
                    <h5><span class="font-italic ">Entité: </span><small>{{$employe->societe->libelle}}</small></h5>
                    <h5><span class="font-italic ">Client:</span> <small>{{$employe->client->nom}}</small></h5>
                    <h5><span class="font-italic ">Date:</span> <small>{{$employe->date}}</small></h5>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a class="h5 text-primary" href="{{$employe->site->libelle}}" target="_blank">Visiter le site </a>
                    <a href="{{route('employes')}}" class="h5 btn btn-outline-info ml-5">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
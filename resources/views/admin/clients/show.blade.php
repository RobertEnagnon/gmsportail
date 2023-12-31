@extends('admin.layout')

@section('main')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-success mb-3" >
                <div class="card-header bg-transparent border-success h4">Détail sur le Client</div>
                <img src="{{asset(env('PUBLIC_URL').'fichiers/clients/'.$client->logo)}}" class="card-img-top w-25 h-25 mx-auto" alt="Logo du client">
                <div class="card-body ">
                    <h2 class="text-success mb-3 text-center">{{$client->nom}}</h2>
                    <h5><span class="font-italic">Code:</span> <small>{{$client->code}}</small> </h5>
                    @if ($client->mi_affaire_id)
                        <h5><span class="font-italic ">Numéro Affaire (MI): </span> <small>{{$client->mi_affaire_id}}</small></h5>
                        
                    @elseif($client->gms_affaire_id)
                        <h5><span class="font-italic ">Numéro Affaire (GMS): </span><small>{{$client->gms_affaire_id}}</small></h5>
                    @elseif($client->mg_affaire_id)    
                        <h5><span class="font-italic ">Numéro Affaire (MG): </span><small>{{$client->mg_affaire_id}}</small></h5>
                    @endif
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a class="h5 text-primary" href="{{asset(env('PUBLIC_URL').'fichiers/clients/'.$client->logo)}}" target="_blank">Afficher le logo</a>
                    <a href="{{route('clients')}}" class="h5 btn btn-outline-info ml-5">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
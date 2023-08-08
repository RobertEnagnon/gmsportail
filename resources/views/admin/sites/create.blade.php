@extends('admin.layout')

 

@section('main')
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Nouveau Site</h3>
                </div>

                <form method="POST" action="{{route('site_store')}}"  >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="numero">Numero</label>
                            <input type="Number" class="form-control" value="{{($latest) ? $latest->id+1 : 1}}" id="numero" name="id" disabled>
                        </div>
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Libelle">
                            @error('libelle')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="client">Client</label>
                            <select class="form-control" id="client" name="client_id">
                                <option value="">--client--</option>
                                @foreach ($clients as $client)
                                
                                    <option value="{{$client->id}}">{{$client->nom}}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="entite">Entité</label>
                            <select class="form-control" id="entite" name="societe_id">
                                <option value="">--entité--</option>
                                @foreach ($entites as $entite)
                                    <option value="{{$entite->id}}">{{$entite->libelle}}</option>
                                @endforeach
                            </select>
                            @error('societe_id')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Enregister</button>
                        <a href="{{route('sites')}}" class="btn btn-info">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



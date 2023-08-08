@extends('admin.layout')

@section('css')
    <style>
        #repeateContainer{
            visibility: hidden;
            height: 0;
            transition: all 0.4s ease;
        }
    </style>
@endsection

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editer la tâche</div>

                    <div class="card-body">
                        <form action="{{ route('planning.update') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <input type="number" value="{{$planning->id}}" class="form-control" id="numero" name="id" hidden  >
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="client">Client <span class="text-danger">*</span></label>
                                    <select class="form-control" id="client" name="client_id">
                                        <option value="{{$planning->client_id}}">{{$planning->client->nom}}</option>
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
                                        <option value="{{$planning->societe_id}}">{{$planning->societe->libelle}}</option>
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
                                <input type="text" class="form-control" id="libelle" name="libelle" value="{{$planning->libelle}}" >
                                @error('libelle')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="detail">Description</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3" >{{$planning->detail}}</textarea>
                                @error('detail')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="date">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date" value="{{$planning->date}}">
                                    @error('date')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="date_fin">Date Fin <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_fin" name="date_fin"  value="{{$planning->date_fin}}" >
                            
                                </div>
                                <div class="col">
                                    <label for="couleur">Couleur</label>
                                    <input type="color" class="form-control" id="couleur" name="couleur" value="{{$planning->couleur}}">
                                    @error('couleur')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="repete" value="{{$planning->repete}}" name="repete" {{$planning->repete ? 'checked' : ''}} >
                                <label for="repete" class="form-check-label">Répète</label>
                            </div>
                           <div id="repeateContainer" class="my-4">
                                <div class="form-group">
                                    <label for="periodicite">Périodicité</label>
                                    <div class="form-control">
                                        <span class="col-2">1 </span>
                                        <select name="periodicite" id="periodicite" class="col-10" style="border: none; outline: none" >
                                            <option value="{{$planning->periodicite}}">{{$planning->periodicite}}</option>
                                            <option value="jour">jour</option>
                                            <option value="semaine">semaine</option>
                                            <option value="mois">mois</option>
                                            <option value="an">an</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="reteption" id="reteption1"  {{$planning->se_termine_le ? 'checked' : ''}}>
                                    <label for="reteption1">Se termine le</label>
                                    <input type="date" class="form-control" id="se_termine_le" value="{{$planning->se_termine_le}}" name="se_termine_le" 
                                          {{$planning->se_termine_le ? '' : 'disabled'}} >
                                </div>
                                <div class="form-check mb-2">
                                    <input type="radio" class="form-check-input" name="reteption" id="reteption2" >
                                    <label for="reteption2">Se termine après</label>
                                    <div class="d-flex justify-content-between">
                                        <input type="number" class="form-control"value="{{$planning->se_termine_apres}}" id="se_termine_apres" name="se_termine_apres" 
                                        {{$planning->se_termine_apres ? '' : 'disabled'}}   >
                                        <input type="text" class="form-control" value="Occurences" disabled>
                                    </div>
                                </div>
                           </div>
                            
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{route('planning.index')}}" class="btn btn-info">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.tiny.cloud/1/ix8b72cwx40l8ynsz2d4t2hra6pq2tlsaiodp7b8uhowd28x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
     selector: 'textarea#detail', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
   });
</script>
<script src="{{asset(env('PUBLIC_URL').'js/admin/planning.js')}}"></script>
<script>
    
</script>
@endsection

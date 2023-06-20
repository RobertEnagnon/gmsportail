@extends('admin.layout')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Créer une tâche</div>

                    <div class="card-body">
                        <form action="{{ route('planning.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="client">Client <span class="text-danger">*</span></label>
                                <select class="form-control" id="client" name="client_id">
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="entite">Entité <span class="text-danger">*</span></label>
                                <select class="form-control" id="entite" name="societe_id">
                                    @foreach ($entites as $entite)
                                        <option value="{{$entite->id}}">{{$entite->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="libelle">Titre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="libelle" name="libelle" >
                            </div>
                            <div class="form-group">
                                <label for="detail">Description</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date" name="date" >
                            </div>
                            <div class="form-group">
                                <label for="couleur">Couleur</label>
                                <input type="color" class="form-control" id="couleur" name="couleur" value="#006eff">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="repete" value="1" name="repete" >
                                <label for="repete" class="form-check-label">Répète</label>
                            </div>
                            <div class="form-group">
                                <label for="periodicite">Périodicité</label>
                                <input type="text" class="form-control" id="periodicite" name="periodicite" >
                            </div>
                            
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="reteption" id="reteption1" >
                                <label for="reteption1">Se termine le</label>
                                <input type="date" class="form-control" id="se_termine_le" name="se_termine_le" >
                            </div>
                            <div class="form-check mb-2">
                                <input type="radio" class="form-check-input" name="reteption" id="reteption2">
                                <label for="reteption2">Se termine après</label>
                                <div class="d-flex justify-content-between">
                                    <input type="number" class="form-control" value="5" id="se_termine_apres" name="se_termine_apres" >
                                    <input type="text" class="form-control" value="Occurences" disabled>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Créer</button>
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
@endsection
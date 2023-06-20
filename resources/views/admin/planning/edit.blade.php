@extends('admin.layout')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Éditer le planning</div>

                    <div class="card-body">
                        <form action="{{ route('planning.update', $planning->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="libelle">Libellé</label>
                                <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $planning->libelle }}" required>
                            </div>
                            <div class="form-group">
                                <label for="detail">Détail</label>
                                <textarea class="form-control" id="detail" name="detail" rows="3" required>{{ $planning->detail }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="periodicite">Périodicité</label>
                                <input type="text" class="form-control" id="periodicite" name="periodicite" value="{{ $planning->periodicite }}" required>
                            </div>
                            <div class="form-group">
                                <label for="repete">Répète</label>
                                <input type="text" class="form-control" id="repete" name="repete" value="{{ $planning->repete }}" required>
                            </div>
                            <div class="form-group">
                                <label for="se_termine_le">Se termine le</label>
                                <input type="date" class="form-control" id="se_termine_le" name="se_termine_le" value="{{ $planning->se_termine_le }}" required>
                            </div>
                            <div class="form-group">
                                <label for="se_termine_apres">Se termine après</label>
                                <input type="text" class="form-control" id="se_termine_apres" name="se_termine_apres" value="{{ $planning->se_termine_apres }}" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $planning->date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="couleur">Couleur</label>
                                <input type="color" class="form-control" id="couleur" name="couleur" value="{{ $planning->couleur }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

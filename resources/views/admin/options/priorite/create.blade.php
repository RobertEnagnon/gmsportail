@extends('admin.layout')

 

@section('main')
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Nouveau Priorité</h3>
                </div>

                <form method="POST" action="{{route('priorite_store')}}"  >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="numero">Numero</label>
                            <input type="Number" class="form-control" value="{{$latest ? $latest->id+1 : 1}}" id="numero"  disabled>
                        </div>
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Libelle">
                            @error('libelle')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Enregister</button>
                        <a href="{{route('options')}}" class="btn btn-info">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



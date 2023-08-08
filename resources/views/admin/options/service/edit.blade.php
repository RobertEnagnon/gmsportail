@extends('admin.layout')

 

@section('main')
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Modifier le Service</h3>
                </div>

                <form method="POST" action="{{route('service_update')}}"  >
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <input type="Number" class="form-control" value="{{$service->id}}" id="numero" name="id" hidden>
                        </div>
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" value="{{$service->libelle}}" class="form-control" id="libelle" name="libelle" >
                            @error('libelle')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="{{$service->email}}"  id="email" name="email" >
                            @error('email')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{route('options')}}" class="btn btn-info">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



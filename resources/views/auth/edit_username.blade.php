@extends('admin.layout')

@section('css')
     
@endsection

@section('main')
    <div class="row">

        <div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
    
                <h1 class="text-center"></h1>
                @if ($errors->any())
                    <div class="text-center">
                        <div>
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{$error}}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
    
                <div class="card mb-3 ">
                    <h4 class="login-box-msg text-center text-success mt-3">Mettre à jour votre nom d'utilisateur </h4><hr>
                    <div class="card-body login-card-body">
                        <form action="/update_username" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Saissisez votre mot de passe " name="password" >
                            </div>
                            <hr>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{old('nom')}}" placeholder="Nouveau nom" name="nom" >
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{old('prenom')}}" placeholder="Nouveau prenom" name="prenom" >
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block" >Modifier le nom d'utilisateur</button>
                                </div>
                            <!-- /.col -->
                            </div>
                        </form>
                
                        <p >
                            <a href="{{route('profile')}}" class="mt-3 mb-1 btn btn-info">Annuler</a>
                        </p>
                    {{-- <p class="mt-3 mb-1">
                        <a  href="/login">Connexion</a>
                      </p> --}}
                    </div>
                    <!-- /.login-card-body -->
                </div>
            
        </div>
        <!-- /.login-box -->
    </div>
  
  
@endsection
@section('js')
    
@endsection
      
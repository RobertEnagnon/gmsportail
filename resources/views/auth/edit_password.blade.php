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
                    <h4 class="login-box-msg text-center text-success mt-3">Mettre à jour votre mot de passe </h4><hr>
                    <div class="card-body login-card-body">
                        {{-- <div class="alert alert-danger" role="alert" >
                            <span >{{error.error}}</span>
                        </div> --}}
                        <form action="/update_password" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Saissisez le mot de passe actuel" name="password_old" >
                            </div>
                            <hr>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Nouvel mot de passe" name="password" >
                            </div>
                            <div class="input-group mb-3">
                                <input type="password_confirmation" class="form-control" placeholder="Confirmez le nouvel mot de passe" name="password_confirmation"  >
                            {{-- <p class="text-danger pl-1" *ngIf="error.password" >
                                <span >{{error.password}}</span>
                            </p> --}}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block" >Modifier le mot de passe</button>
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
                <p class="login-box-msg text-center text-info">Vous êtes seul à avoir accès à  votre nouveau mot de passe. Recouvrez votre mot de passe maintenant</p>
            
        </div>
        <!-- /.login-box -->
    </div>
  
  
@endsection
@section('js')
    
@endsection
      
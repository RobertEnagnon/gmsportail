<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mot de passe oublié</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid col-sm-8 col-md-6 col-lg-4 mt-5">
        <div class="login-box">
       
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
            <div class="card">
                <div class="card-body login-card-body">
                <p class="login-box-msg text-center">Vous avez oublié votre mot de passe? Ici vous pouvez facilement recuperer un nouveau mot de passe.</p>
                {{-- <div class="alert alert-info" role="alert" >
                {{message}}
                </div> --}}
                <form action="/forgot" method="POST" >
                    @csrf
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email" name="email" >
                    
                    {{-- <div class="text-danger" >{{error.email}}</div> --}}
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" >Nouveau mot de passe</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>
        
                <p class="mt-3 mb-1">
                    <a href="/login">Connexion</a>
                </p>
                {{-- <p class="m-auto">
                    <a href="/register" class="text-center m-auto">Vous n'avez pas de compte? Enregistrez-vous</a>
                </p> --}}
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
  
  
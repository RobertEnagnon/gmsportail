<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Se connecter</h1>
        @if ($errors->any())
            <div class="text-center">
                <div>
                    @foreach ($errors->all() as $error)
                    <p class="text-danger">{{$error}}</p>
                @endforeach
                </div>
            </div>
        @endif

        <form action="/connect" method="POST" class="col-md-6 mx-auto">
            @csrf

            <div class="form-group mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" value="{{old('password')}}" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <input type="checkbox" id="remember" name="remember" value="{{1}}" class="form-check-input" >
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>
            <p> <a href="/recorvery">Mot de passe oublié ?</a></p>
            {{-- <p>Vous n'avez pas encore un compte? <a href="/register">inscrivez-vous</a></p> --}}
            <button type="submit" class="btn btn-primary mt-3">Se connecter</button>
            <a class="btn btn-info mt-3" href="/">Accueil</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
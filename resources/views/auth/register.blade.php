<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enregistrement</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">S'inscrire</h1>
        @if ($errors->any())
            <div class="text-center">
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{$error}}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="/register" method="POST" class="col-md-6 mx-auto">
            @csrf

            <div class="form-group mb-3">
                <label class="form-label" for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="{{old('nom')}}" class="form-control" autofocus>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="prenom">Prenom</label>
                <input type="text" id="prenom" name="prenom" value="{{old('prenom')}}" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" value="{{old('password')}}" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="password_confirmation">Confirmez Password</label>
                <input type="password_confirmation" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" >
            </div>
            <div class="form-group mb-3">
                <input type="checkbox" id="is_client" name="is_client" value="{{1}}" class="form-check-input" >
                <label class="form-check-label" for="is_client">Client</label>
            </div>

            <div class="form-group mb-3">
                <label for="client_id" class="form-label">Selectionez le client</label>
                <select name="client_id" class="form-select">
                    <option>Client</option>
                  @foreach ($clients as $client)
                      <option value="{{$client->id}}">{{$client->nom}}</option>
                  @endforeach
                </select>
            </div>
            <p>Vous-avez déjà un compte? <a href="/login">connectez-vous</a></p>
            <button type="submit" class="btn btn-primary mt-3">S'inscrire</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
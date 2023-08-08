<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Modifier l'utilisateur</h1>

        <form action="{{route('user_update')}}" method="POST" class="col-md-6 mx-auto">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="number" class="form-control" id="numero" value="{{$user->id}}" name="id"  hidden>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="{{$user->nom}}" class="form-control" autofocus>
                @error('nom')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="prenom">Prenom</label>
                <input type="text" id="prenom" name="prenom" value="{{$user->prenom}}" class="form-control" >
                @error('prenom')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control" >
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input type="checkbox" id="is_client" name="is_client" value="{{1}}" {{$user->is_client?'checked':''}} class="form-check-input" >
                <label class="form-check-label" for="is_client">Client</label>
            </div>
            <div class="form-group mb-3">
                <label for="client_id" class="form-label">Selectionez le client</label>
                <select name="client_id" class="form-select">
                    {{-- <option value="{{$user->client_id}}">{{$user->client->nom}}</option> --}}
                  @foreach ($clients as $client)
                      <option value="{{$client->id}}">{{$client->nom}}</option>
                  @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Modifier</button>
            <a href="/users" class="btn btn-info mt-3">Retour</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
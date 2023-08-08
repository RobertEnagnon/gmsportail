<p style="width: 100%; text-align: center ;padding: 10px ; ">
    Salut {{$prenom}}; <br>
    <div>Nous venons de vous attribuer un compte utilisateur chez nous.</div>
    <h5 style="padding-bottom: 5px; text-decoration: underline">Voici les informations de votre compte utilisateur:</h5>
   
    <span>utilisateur: <strong>{{$email}}</strong> </span> <br>
    
     <span>Votre Mot de passe: <strong style="color: blue">n'a pas été touché.</strong>Vous pouvez le réinitialiser au bésoin </span> <br> <br>
    
</p>
<p>
    Merci de cliquer ici pour se sonnecter <a href="{{env("APP_URL")}}{{$lien}}">{{env("APP_URL")}}{{$lien}}</a>
</p>

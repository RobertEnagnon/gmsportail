<p style="text-align: center">

    Salut  <br>
    <h6>----------------------------------</h6>
    Vous avez demandé de renouveller votre mot de passe.Si vous voulez changer le mot de passe
    <a style="text-decoration:none;padding: 5px;margin: 10px; border:1px solid lightblue; border-radius:5px; color: blue; font-size: 18px" href="{{env("APP_URL")}}reset_form/{{$token}}"> cliquez-ici</a>
</p>
ou,copiez et coller l'URL ci-dessous dans votre navigateur: {{env("APP_URL")}}reset_form/{{$token}}

<p>Si vous n'êtes pas à l'origine de cette action veuillez ne rien faire et de nous faire signaler. <br>
    Merci
</p>

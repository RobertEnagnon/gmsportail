<p style="width: 100%; text-align: center ;padding: 10px ; ">
    Salut {{$prenom}}. <br>
    Merci pour votre confiance.Un ticket à été ouvert pour vous.
    <h5 style="padding-bottom: 5px; text-decoration: underline">Voici c-dessous les details de votre ticket:</h5>
    <p>-------------------------------</p>
    <span>- Ticket Num : <strong style="color: blue">{{$ticket->id}}</strong> </span> <br> <br> 
    <span>- <strong>Titre : </strong> {{$ticket->titre}} </span> <br> <br>
    <span>- <strong>Message : </strong> {!! $ticket->message !!} </span> <br> <br>
    <span>- <strong>Priorité : </strong> {{$ticket->priorite->libelle}} </span> <br>
    <span>- <strong>Etat : </strong class="text-success" > {{$ticket->status}} </span> <br>
    
</p>
<p>
    Merci de cliquer ici pour consulter votre ticket <a href="{{env("APP_URL")}}{{$lien}}">{{env("APP_URL")}}{{$lien}}</a>
</p>

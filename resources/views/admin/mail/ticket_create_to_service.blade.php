<p style="width: 100%; text-align: center ;padding: 10px ; ">
    Un Ticket a été par le client {{$ticket->client->nom}} et il attend une réponse de vous.
    <h5 style="padding-bottom: 5px; text-decoration: underline">Voici c-dessous les details du ticket:</h5>
    <p>-------------------------------</p>
    <span>- Ticket Num : <strong style="color: blue">{{$ticket->id}}</strong> </span> <br> <br> 
    <span>- <strong>Titre : </strong> {{$ticket->titre}} </span> <br> <br>
    <span>- <strong>Message : </strong> {!! $ticket->message !!} </span> <br> <br>
    <span>- <strong>Priorité : </strong> {{$ticket->priorite->libelle}} </span> <br>
    <span>- <strong>Etat : </strong class="text-success" > {{$ticket->status}} </span> <br>
    
</p>
<p>
    Merci de cliquer ici pour consulter ce ticket <a href="{{env("APP_URL")}}{{$lien}}">{{env("APP_URL")}}{{$lien}}</a>
</p>
<p style="width: 100%; text-align: center ;padding: 10px ; ">
    Le Ticket numéro # {{$ticket->id}} a été cloturé par {{$name}}
    <h5 style="padding-bottom: 5px; text-decoration: underline">Voici ci-dessous les details du ticket:</h5>
    <p>-------------------------------</p>
    <span>- <strong>Titre : </strong> {{$ticket->titre}} </span> <br> <br>
    <span>- <strong>Message : </strong> {!! $ticket->message !!} </span> <br> <br>
    <span>- <strong>Priorité : </strong> {{$ticket->priorite->libelle}} </span> <br>
    <span>- <strong>Etat : </strong class="text-success" > {{$ticket->status}} </span> <br>
    
</p>
<p>
    Merci de cliquer ici pour consulter <a href="{{env("APP_URL")}}{{$lien}}">{{env("APP_URL")}}{{$lien}}</a>
</p>
<?php

namespace App\Http\Controllers;

use App\Mail\TicketReply;
use App\Models\Client;
use App\Models\Priorite;
use App\Models\Service;
use App\Models\Societe;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    
    public function index(){
        $tickets = null;

        if (Auth::user()->is_admin) {

            $tickets = Ticket::all();

        } else {
            $tickets = Ticket::where('client_id',Auth::user()->client_id)->get();
        }
        
        return view('admin.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket){
        // $this->authorize('view',$ticket);
        // $messages = TicketMessage::where('ticket_id',$ticket->id);
        return view('admin.ticket.show', compact('ticket'));
    }

    public function create(){
        // $this->authorize('create', Ticket::class);
        $services = Service::all(['id','libelle']);
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $priorites = Priorite::all(['id','libelle']);
        $user = User::findOrFail(Auth::user()->id,['id','nom','prenom','email','client_id']);

        return view('admin.ticket.create', compact('user','services','clients','entites','priorites'));
    
    }

    public function store(Request $request){
       

        $this->validate($request,[
            'titre'=>'required',
            'message'=>'required',
            // 'date'=>'required|date',
            'client_id'=>'required',
            'societe_id'=>'required',
            'service_id'=>'required',
            'priorite_id'=>'required',
            // 'user_id'=>'required',
        ],[
            'titre'=>'Ce champ est obligatoire',
            'message'=>'Ce champ est obligatoire',
            'client_id'=>'Ce champ est obligatoire',
            'societe_id'=>'Ce champ est obligatoire',
            'service_id'=>'Ce champ est obligatoire',
            'priorite_id'=>'Ce champ est obligatoire',
        ]);
        

        $compFic = '';
          
        if ($request->hasFile('fichiers')) {
            $fichiers = $request->file('fichiers');

            foreach ($fichiers as $file) {
                // Obtenir le nom complet du fichier
                $completeFileName = $file->getClientOriginalName();
                // obtenir uniquement le nom du fichhier
                $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
                // Obtenir l'extension du fichier
                $extension = $file->getClientOriginalExtension();
                // Le dossier oû garder les fichiers du document
                $upload_path= public_path().'/fichiers/tickets/';
        
                // Réecriture du nom du fichier
                $rewriteFile = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;
                $compFic .= $rewriteFile.";";
        
                // Déplacer le fichier dans le dossier du stockage
                $file->move($upload_path,$rewriteFile);
            }
        }
        
        try {
            $ticket = Ticket::create([
                'titre'=>$request->titre,
                // 'message'=>$request->message,
                // 'status' => $request->status,
                'fichiers'=> !empty($compFic) ? $compFic : null,
                'client_id'=>$request->client_id,
                'societe_id'=>$request->societe_id,
                'service_id'=>$request->service_id,
                'priorite_id'=>$request->priorite_id,
                'user_id'=>$request->user_id,
                'date'=>Carbon::now(),
            ]);
    
            $message = TicketMessage::create([
                'sender_id'=>$request->user_id,
                'ticket_id'=>$ticket->id,
                'content' => $request->message
            ]);
    
            // Envoyer une notification par e-mail au service de prestation
            //$this->sendNotificationEmail($ticket);
    
            if ($ticket && $message) {
    
                $email = $ticket->client->user->email ;
    
    
                //Envoyer une notification par e-mail au client
                Mail::send('admin.mail.ticket_create', ['ticket'=>$ticket,'prenom'=>$request->prenom,'email'=>$email,'lien'=>"admin/tickets/show/".$ticket->id], 
                function ($message) use($email,$ticket) {
                    $message->to($email);
                    $message->subject("GmsPortail: [Ticket ID: ".$ticket->id."]");
                });
    
                // Envoyer une notification par e-mail au service de prestation
                $serviceEmail = $ticket->service->email;
    
                Mail::send('admin.mail.ticket_create_to_service', ['ticket'=>$ticket,'lien'=>"admin/tickets/show/".$ticket->id], 
                function ($message) use($ticket,$serviceEmail) {
                    $message->to($serviceEmail);
                    $message->subject("GmsPortail:Nouveau ticket pour service de ".$ticket->service->libelle);
                });
    
                flash()->addSuccess("Ticket créé avec sucèss");
                return to_route('tickets');
            } else {
                flash()->addError('Erreur! Echec de création du ticket');
                return to_route('ticket_create');
            }
        } catch (\Throwable $th) {
            flash()->addError('Erreur! Echec de création du ticket: '.$th->getMessage());
            return to_route('ticket_create');
        }
    }

    public function edit(Ticket $ticket){
        // $this->authorize('update',$ticket);
        
        $services = Service::all(['id','libelle']);
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $priorites = Priorite::all(['id','libelle']);
        $users = User::all(['id','nom','prenom','email']);

        return view("admin.ticket.edit",compact('ticket','services','clients','entites','priorites','users'));
    }

    public function update(Request $request){
       

        $this->validate($request,[
            'id'=> 'required',
            'titre'=>'required',
            'message'=>'required',
            'client_id'=>'required',
            'societe_id'=>'required',
            'service_id'=>'required',
            'priorite_id'=>'required',
        ],[
            'titre'=>'Ce champ est obligatoire',
            'message'=>'Ce champ est obligatoire',
            'client_id'=>'Ce champ est obligatoire',
            'societe_id'=>'Ce champ est obligatoire',
            'service_id'=>'Ce champ est obligatoire',
            'priorite_id'=>'Ce champ est obligatoire',
        ]);
        $compFic = "";

        if ($request->hasFile('fichiers')) {
            $fichiers = $request->file('fichiers');

            foreach ($fichiers as $file) {
                // Obtenir le nom complet du fichier
                $completeFileName = $file->getClientOriginalName();
                // obtenir uniquement le nom du fichhier
                $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
                // Obtenir l'extension du fichier
                $extension = $file->getClientOriginalExtension();
                // Le dossier oû garder les fichiers du document
                $upload_path= public_path().'/fichiers/tickets/';
        
                // Réecriture du nom du fichier
                $rewriteFile = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;
                $compFic .= $rewriteFile.";";
        
                // Déplacer le fichier dans le dossier du stockage
                $file->move($upload_path,$rewriteFile);
            }
        }
        // à modifier
        try {
            
            $ticket = Ticket::where('id',$request->id)->update([
                'titre'=>$request->titre,
                'fichiers'=> !empty($compFic) ? $compFic : null,
                'client_id'=>$request->client_id,
                'societe_id'=>$request->societe_id,
                'service_id'=>$request->service_id,
                'priorite_id'=>$request->priorite_id,
                'user_id'=>$request->user_id,
                'date'=>Carbon::now(),
            ]);
            
            $message = TicketMessage::where('ticket_id',$request->id)->update([
                'sender_id'=>$request->user_id,
                'ticket_id'=>$request->id,
                'content' => $request->message
            ]);
            
    
            if ($ticket && $message) {
                $ticket = Ticket::find($request->id);
                $message = TicketMessage::where('ticket_id',$ticket->id);

                $email = $ticket->client->user->email ;
    
    
                //Envoyer une notification par e-mail au client
                Mail::send('admin.mail.ticket_create', ['ticket'=>$ticket,'prenom'=>$request->prenom,'email'=>$email,'lien'=>"admin/tickets/show/".$ticket->id], 
                function ($message) use($email,$ticket) {
                    $message->to($email);
                    $message->subject("GmsPortail: [Ticket ID: ".$ticket->id."]");
                });
    
                // Envoyer une notification par e-mail au service de prestation
                $serviceEmail = $ticket->service->email;
    
                Mail::send('admin.mail.ticket_create_to_service', ['ticket'=>$ticket,'lien'=>"admin/tickets/show/".$ticket->id], 
                function ($message) use($ticket,$serviceEmail) {
                    $message->to($serviceEmail);
                    $message->subject("GmsPortail:Modification du ticket pour service de ".$ticket->service->libelle);
                });
    
                flash()->addSuccess('Sucèss! Ticket modifié avec sucèss');
                return to_route('tickets');
            } else {
                flash()->addError('Oops! Erreur de modifications');
                return to_route('ticket_edit',$request->id);
            }
        } catch (\Throwable $th) {
            flash()->addError('Erreur! Echec de modifications du ticket: '.$th->getMessage());
            return to_route('ticket_edit',$request->id);
        }
    }

    public function delete(Ticket $ticket){
        // $this->authorize('delete',$ticket);
        try {
            // Ticket::destroy($id);
            $ticket->delete();
            flash()->addSuccess('Sucèss! Ticket supprimé avec sucèss');
            return to_route('tickets');

        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer ce ticket
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de ce ticket avant de le supprimer');
            
            return to_route('tickets');
        }
    }

    public function replyForm(Ticket $ticket){
        // $this->authorize('update',$ticket);
        
        // $services = Service::all(['id','libelle']);
        // $clients = Client::all(['id','nom']);
        // $entites = Societe::all(['id','libelle']);
        // $priorites = Priorite::all(['id','libelle']);
        // $users = User::all(['id','nom','prenom','email']);


        return view("admin.ticket.reply",compact('ticket'));
    }

    public function reply(Request $request){
       

        $this->validate($request,[
            'id'=>'required',
            'message'=>'required',
            'sender_id'=>'required',
            // 'date'=>'required|date',
            // 'client_id'=>'required',
            // 'societe_id'=>'required',
            // 'service_id'=>'required',
            // 'priorite_id'=>'required',
            // 'user_id'=>'required',
        ]);
        $compFic = "";

        if ($request->hasFile('fichiers')) {
            $fichiers = $request->file('fichiers');

            foreach ($fichiers as $file) {
                // Obtenir le nom complet du fichier
                $completeFileName = $file->getClientOriginalName();
                // obtenir uniquement le nom du fichhier
                $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
                // Obtenir l'extension du fichier
                $extension = $file->getClientOriginalExtension();
                // Le dossier oû garder les fichiers du document
                $upload_path= public_path().'/fichiers/tickets/';
        
                // Réecriture du nom du fichier
                $rewriteFile = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;
                $compFic .= $rewriteFile.";";
        
                // Déplacer le fichier dans le dossier du stockage
                $file->move($upload_path,$rewriteFile);
            }
        }


        $status = "Ouvert";
        //Si 1 alors vers le client si 0 alors vers le service
        $mailto = 1;

        if (Auth::user()->client && Auth::user()->client->id == $request->client_id) {
            $mailto = 0;
            //C'est le client qui répond
            if ($request->close) {
                $status = "Fermé";
             }
            elseif ($request->status == "Répondu") {
                $status = "Réponse du client";
            }
        }else{
            $mailto = 1;
            //C'est le service qui répond
            if ($request->close) {
                $status = "Fermé";
             }
            elseif ($request->status == "Ouvert" || $request->status == "Réponse du client") {
                $status = "Répondu";
            }
        }

        

        $ticket = Ticket::where('id',$request->id)->update([
            // 'message'=>$request->message,
            'status' => $status,
        ]);
        $message = TicketMessage::create([
            'sender_id'=>$request->sender_id,
            'ticket_id'=>$request->id,
            'content' => $request->message,
            'fichiers'=> !empty($compFic) ? $compFic : null,
        ]);

        if($ticket && $message) {

            $ticket = Ticket::findOrFail($request->id);
            // Envoyer une notification par e-mail au client si le ticket est mis à jour

            if ($mailto==1) {
                $email = $ticket->client->user->email ;
                if ($ticket->status == "Fermé") {
                    Mail::send('admin.mail.ticket_close', ['ticket'=>$ticket,'name'=>'le service','lien'=>"admin/tickets/show/".$ticket->id], 
                    function ($message) use($email,$ticket) {
                        $message->to($email);
                        $message->subject('GmsPortail: Nouvelle réponse au ticket #'.$ticket->id);
                    });
                } else {
                    Mail::send('admin.mail.ticket_reply', ['ticket'=>$ticket,'lien'=>"admin/tickets/show/".$ticket->id], 
                    function ($message) use($email,$ticket) {
                        $message->to($email);
                        $message->subject('GmsPortail: Nouvelle réponse au ticket #'.$ticket->id);
                    });
                }
                

            } elseif($mailto==0) {
                //Envoyer une notification par e-mail au service si le client met à jour le ticket
                $serviceEmail = $ticket->service->email;
                if ($ticket->status == "Fermé") {
                    Mail::send('admin.mail.ticket_close', ['ticket'=>$ticket,'name'=>$ticket->client->nom,'lien'=>"admin/tickets/show/".$ticket->id], 
                    function ($message) use($ticket,$serviceEmail) {
                        $message->to($serviceEmail);
                        $message->subject("GmsPortail: Nouvelle réponse au ticket #".$ticket->id);
                    });
                } else {

                    Mail::send('admin.mail.ticket_reply', ['ticket'=>$ticket,'lien'=>"admin/tickets/show/".$ticket->id], 
                    function ($message) use($ticket,$serviceEmail) {
                        $message->to($serviceEmail);
                        $message->subject("GmsPortail: Nouvelle réponse au ticket #".$ticket->id);
                    });
                }
            }
            

            flash()->addSuccess('Sucèss! Ticket modifié avec sucèss');
            return to_route('tickets');
        } else {
            flash()->addError('Oops! Erreur de modifications');
            return to_route('ticket_edit',$request->id);
        }
    }


    protected function sendNotificationEmail($ticket)
    {
        // Récupérer l'adresse e-mail du service de prestation
        $serviceEmail = $ticket->service->email;

        // Envoyer une notification par e-mail au service de prestation
        Mail::to($serviceEmail)->send(new TicketReply($ticket));
    } 

    protected function sendReplyEmail($ticket)
    {
        // Récupérer l'adresse e-mail du client
        $clientEmail = $ticket->client->email;

        // Envoyer une réponse par e-mail au client
        Mail::to($clientEmail)->send(new TicketReply($ticket));
    }

}

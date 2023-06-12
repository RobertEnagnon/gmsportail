<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Priorite;
use App\Models\Service;
use App\Models\Societe;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    
    public function index(){
        $tickets = Ticket::all();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket){

    }

    public function create(){
        $services = Service::all(['id','libelle']);
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $priorites = Priorite::all(['id','libelle']);
        $user = User::findOrFail(1,['id','nom','prenom','email']);

        return view('admin.ticket.create', compact('user','services','clients','entites','priorites'));
    }

    public function store(Request $request){
       

        $this->validate($request,[
            'titre'=>'required',
            'message'=>'required',
            'date'=>'required|date',
            'client_id'=>'required',
            'societe_id'=>'required',
            'service_id'=>'required',
            'priorite_id'=>'required',
            'user_id'=>'required',
        ]);
        

        $compFic = '';
          
        if ($request->hasFile('fichier')) {
            // Obtenir le nom complet du fichier
            $completeFileName = $request->file('fichier')->getClientOriginalName();
            // obtenir uniquement le nom du fichhier
            $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
            // Obtenir l'extension du fichier
            $extension = $request->file('fichier')->getClientOriginalExtension();
            // Le dossier oû garder les fichiers du document
            $upload_path= public_path().'/fichiers/tickets/';
    
            // Réecriture du nom du fichier
            $compFic = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;
    
            // Obtenir url du fichier
            $fichier_url = $upload_path.$compFic;
            // Déplacer le fichier dans le dossier du stockage
            $request->file('fichier')->move($upload_path,$compFic);
        }


        if (Ticket::create([
            'titre'=>$request->titre,
            'message'=>$request->message,
            'date'=>Carbon::parse($request->date),
            'fichier'=>$compFic,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'service_id'=>$request->service_id,
            'priorite_id'=>$request->priorite_id,
            'user_id'=>$request->user_id
        ])) {
            return to_route('tickets');
        } else {
            return to_route('ticket_create');
        }
        

    }

    public function edit(Ticket $ticket){
        
        $services = Service::all(['id','libelle']);
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $priorites = Priorite::all(['id','libelle']);
        $users = User::all(['id','nom','prenom','email']);

        return view("admin.ticket.edit",compact('ticket','services','clients','entites','priorites','users'));
    }

    public function update(Request $request){
       

        $this->validate($request,[
            'id'=>'required',
            'titre'=>'required',
            'message'=>'required',
            'date'=>'required|date',
            'client_id'=>'required',
            'societe_id'=>'required',
            'service_id'=>'required',
            'priorite_id'=>'required',
            'user_id'=>'required',
        ]);
        $compFic = "";
          
        if ($request->hasFile('fichier')) {
            // Obtenir le nom complet du fichier
            $completeFileName = $request->file('fichier')->getClientOriginalName();
            // obtenir uniquement le nom du fichhier
            $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
            // Obtenir l'extension du fichier
            $extension = $request->file('fichier')->getClientOriginalExtension();
            // Le dossier oû garder les fichiers du document
            $upload_path= public_path().'/fichiers/tickets/';
    
            // Réecriture du nom du fichier
            $compFic = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;
    
            // Obtenir url du fichier
            $fichier_url = $upload_path.$compFic;
            // Déplacer le fichier dans le dossier du stockage
            $request->file('fichier')->move($upload_path,$compFic);
        }


        if(Ticket::where('id',$request->id)->update([
            'titre'=>$request->titre,
            'message'=>$request->message,
            'date'=>Carbon::parse($request->date),
            'fichier'=>$compFic,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'service_id'=>$request->service_id,
            'priorite_id'=>$request->priorite_id,
            'user_id'=>$request->user_id
        ])) {
            return to_route('tickets');
        } else {
            return to_route('ticket_edit');
        }
    }

    public function delete(int $id){
        Ticket::destroy($id);

        return to_route('tickets');
    }

}

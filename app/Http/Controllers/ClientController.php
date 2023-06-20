<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function index(){
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function show(Client $client){

        

    }

    public function create(){
        $latest = Client::latest()->first(['id']);

        return view('admin.clients.create',compact('latest'));

    }

    public function store(Request $request){

        $validate = $this->validate($request,[
            'nom'=>'required',
            'code'=>'required',
            'logo'=>'required',
            'mi_affaire_id'=>'required',
            'gms_affaire_id'=>'required',
            'mg_affaire_id'=>'required'
        ]);


        // Obtenir le nom complet du fichier logo
        $completeFileName = $request->file('logo')->getClientOriginalName();
        // obtenir uniquement le nom du fichhier
        $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
        // Obtenir l'extension du logo
        $extension = $request->file('logo')->getClientOriginalExtension();
        // Le dossier oû garder les logos du document
        $upload_path= public_path().'/fichiers/clients/';

        // Réecriture du nom du logo
        $compLogo = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;

        // Obtenir url du logo
        $logo_url = $upload_path.$compLogo;
        // Déplacer le logo dans le dossier du stockage
        $request->file('logo')->move($upload_path,$compLogo);

        if (Client::create([
            'nom' => $request->nom,
            'code' => $request->code,
            'logo' => $compLogo,
            'mi_affaire_id' => $request->mi_affaire_id,
            'gms_affaire_id' => $request->gms_affaire_id,
            'mg_affaire_id' => $request->mg_affaire_id
        ])) {
            flash()->addSuccess('Sucèss! Client enrégistré avec sucèss');
            return to_route('clients');
        } else {
            flash()->addError('Oops! Erreur d\'enregistrement');
            return to_route('client_create');
        }
        

    }

    public function edit(Client $client){

       

        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request){
        // dd($request->all());

        $this->validate($request,[
            'id'=>'required',
            'nom'=>'required',
            'code'=>'required',
            'logo'=>'required',
            'mi_affaire_id'=>'required',
            'gms_affaire_id'=>'required',
            'mg_affaire_id'=>'required'
        ]);

        // Obtenir le nom complet du fichier logo
        $completeFileName = $request->file('logo')->getClientOriginalName();
        // obtenir uniquement le nom du fichhier
        $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
        // Obtenir l'extension du logo
        $extension = $request->file('logo')->getClientOriginalExtension();
        // Le dossier oû garder les logos du document
        $upload_path= public_path().'/fichiers/clients/';

        // Réecriture du nom du logo
        $compLogo = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;

        // Obtenir url du logo
        $logo_url = $upload_path.$compLogo;
        // Déplacer le logo dans le dossier du stockage
        $request->file('logo')->move($upload_path,$compLogo);

        if(Client::where('id',$request->id)->update([
            'nom' => $request->nom,
            'code' => $request->code,
            'logo' => $compLogo,
            'mi_affaire_id' => $request->mi_affaire_id,
            'gms_affaire_id' => $request->gms_affaire_id,
            'mg_affaire_id' => $request->mg_affaire_id
        ]))
        {
            flash()->addSuccess('Sucèss! Client modifié avec sucèss');   
            return to_route('clients');
        } else {
            flash()->addError('Oops! Erreur lors de modification');
            return to_route('client_edit',$request->id);
        }
    }

    public function delete(int $id){
    
        try {
            Client::destroy($id);
            flash()->addSuccess('Sucèss! Client Supprimé');
            return to_route('clients');
        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer ce client
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de ce client avant de le supprimer');
            
                         return to_route('clients');
        }
        
    }


}



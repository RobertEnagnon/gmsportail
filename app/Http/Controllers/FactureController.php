<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Societe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index(){
        $factures = Facture::all();
        // dd($clients);
        return view('admin.facture.index', compact('factures'));
    }

    public function show(Facture $facture){

    }

    public function create(){
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $latest = Facture::latest('id')->first(['id']);

        return view('admin.facture.create',compact('clients','entites','latest'));
    }

    public function store(Request $request){
   
        $this->validate($request,[
            'libelle'=>'required|string',
            'fichier'=>'required',
            'client_id'=>'required',
            'societe_id'=>'required',
            'date'=>'required|date',
        ]);

        // Obtenir le nom complet du fichier
        $completeFileName = $request->file('fichier')->getClientOriginalName();
        // obtenir uniquement le nom du fichhier
        $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
        // Obtenir l'extension du fichier
        $extension = $request->file('fichier')->getClientOriginalExtension();
        // Le dossier oû garder les fichiers du document
        $upload_path= public_path().'/fichiers/factures/';

        // Réecriture du nom du fichier
        $compFic = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;

        // Obtenir url du fichier
        $fichier_url = $upload_path.$compFic;
        // Déplacer le fichier dans le dossier du stockage
        $request->file('fichier')->move($upload_path,$compFic);
        

        if (Facture::create([
            'libelle'=>$request->libelle,
            'nom_fichier'=>$compFic,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'date'=>Carbon::parse($request->date)
        ])) {
            return to_route('factures');
        } else {
            return to_route('facture_create');
        }
        
    }

    public function edit(Facture $facture){

        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);

        return view("admin.facture.edit",compact('facture','clients','entites'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'libelle'=>'required|string',
            'fichier'=>'required',
            'client_id'=>'required',
            'societe_id'=>'required',
            'date'=>'required|date',
        ]);

        // Obtenir le nom complet du fichier
        $completeFileName = $request->file('fichier')->getClientOriginalName();
        // obtenir uniquement le nom du fichhier
        $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
        // Obtenir l'extension du fichier
        $extension = $request->file('fichier')->getClientOriginalExtension();
        // Le dossier oû garder les fichiers du document
        $upload_path= public_path().'/fichiers/factures/';

        // Réecriture du nom du fichier
        $compFic = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;

        // Obtenir url du fichier
        $fichier_url = $upload_path.$compFic;
        // Déplacer le fichier dans le dossier du stockage
        $request->file('fichier')->move($upload_path,$compFic);

        if (Facture::where('id',$request->id)->update([
            'libelle'=>$request->libelle,
            'nom_fichier'=>$compFic,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'date'=>Carbon::parse($request->date)
        ])) {
            
            return to_route('factures',[],201);
        } else {
            return to_route('facture_edit',$request->id);
        }
        
    }

    public function delete(int $id){
        Facture::destroy($id);
        return to_route('factures');
    }

}

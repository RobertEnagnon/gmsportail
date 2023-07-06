<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Societe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactureController extends Controller
{
    public function index(){
        $factures = null;

        if (Auth::user()->is_admin) {

            $factures = Facture::all();

        } else {
            $factures = Facture::where('client_id',Auth::user()->client_id)->get();
        }
        
        return view('admin.facture.index', compact('factures'));
    }

    public function show(Facture $facture){
        $this->authorize('view', $facture);
        return view('admin.facture.show', compact('facture'));
    }

    public function create(){
        $this->authorize('create', Facture::class);
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
            flash()->addSuccess("Facture créée avec sucèss");
            return to_route('factures');
        } else {
            flash()->addError('Erreur! Echec de création de la Facture');
            return to_route('facture_create');
        }
        
    }

    public function edit(Facture $facture){

        $this->authorize('update', $facture);

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
            flash()->addSuccess('Sucèss! Facture modifiée avec sucèss');
            return to_route('factures',[],201);
        } else {
            flash()->addError('Oops! Erreur de modifications');
            return to_route('facture_edit',$request->id);
        }
        
    }

    public function delete(Facture $facture){
        $this->authorize('create', Facture::class);
        try {
            // Facture::destroy($id);
            $facture->delete();
            flash()->addSuccess('Sucèss! Facture supprimé avec sucèss');
            return to_route('factures');
        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer cette Facture
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de cette Facture avant de le supprimer');
            
            return to_route('factures');
        }
    }

}

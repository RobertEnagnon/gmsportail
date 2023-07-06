<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Document;
use App\Models\Societe;
use App\Models\TypeDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(){
        $documents = null ;

            if (Auth::user()->is_admin) {
                $documents = Document::all();
            } else {
                $documents = Document::where('client_id',Auth::user()->client_id)->get();
            }
        
        
        return view('admin.document.index',compact('documents'));
    }

    public function show(Document $document){
        $this->authorize('view', $document);
        return view('admin.document.show', compact('document'));
    }

    public function create(){
        // $this->authorize('create', Document::class);
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $types = TypeDocument::all(['id','libelle']);
        $latest = Document::latest('id')->first(['id']);


        return view('admin.document.create', compact('clients','entites','types','latest'));
    }
    public function store(Request $request){

        $this->authorize('create', Document::class);

        $validate = $this->validate($request,[
            'libelle'=>'required|string',
            'fichier'=>'required',
            'type_id'=>'required',
            'client_id'=>'required',
            'societe_id'=>'required',
            'date'=>'required|date',
        ],[
            'libelle'=>'Le champs du libellé est requis',
            'fichier'=>'Le champs du fichier est requis',
            'type_id'=>'Le champs du type est requis',
            'client_id'=>'Le champs du client est requis',
            'societe_id'=>'Le champs de l\'entité est requis',
            'date'=>'Le champs du date est requis',]);
        // Obtenir le nom complet du fichier
        $completeFileName = $request->file('fichier')->getClientOriginalName();
        // obtenir uniquement le nom du fichhier
        $fileNameOnly = pathinfo($completeFileName,PATHINFO_FILENAME);
        // Obtenir l'extension du fichier
        $extension = $request->file('fichier')->getClientOriginalExtension();
        // Le dossier oû garder les fichiers du document
        $upload_path= public_path().'/fichiers/documents/';

        // Réecriture du nom du fichier
        $compFic = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;

        // Obtenir url du fichier
        $fichier_url = $upload_path.$compFic;
        // Déplacer le fichier dans le dossier du stockage
        $request->file('fichier')->move($upload_path,$compFic);



        if (Document::create([
            'type_id'=>$request->type_id,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'libelle'=>$request->libelle,
            'nom_fichier'=>$compFic,
            'date'=>Carbon::parse($request->date),
        ])) {
            
            flash()->addSuccess("Document créé avec sucèss");
            return redirect()->route('documents');
        } else {
            flash()->addError('Erreur! Echec de création du document');
            return redirect()->route('document_create');
        }  

    }

    public function edit(Document $document){
        
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $types = TypeDocument::all(['id','libelle']);

        return view("admin.document.edit",compact('document','clients','entites','types'));
    }

    public function update(Request $request){


        $this->validate($request,[
            'id'=>'required',
            'libelle'=>'required|string',
            'fichier'=>'required',
            'type_id'=>'required',
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
        $upload_path= public_path().'/fichiers/documents/';

        // Réecriture du nom du fichier
        $compFic = str_replace(' ','_',$fileNameOnly).'-'.rand().time().'.'.$extension;

        // Obtenir url du fichier
        $fichier_url = $upload_path.$compFic;
        // Déplacer le fichier dans le dossier du stockage
        $request->file('fichier')->move($upload_path,$compFic);

        if (Document::where('id',$request->id)->update([
            'type_id'=>$request->type_id,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'libelle'=>$request->libelle,
            'nom_fichier'=>$compFic,
            'date'=>Carbon::parse($request->date),
        ])) {
            
            flash()->addSuccess('Sucèss! Document modifié avec sucèss');
            return to_route('documents');
        } else {
            flash()->addError('Oops! Erreur de modifications');
            return to_route('document_edit',$request->id);
        }
    }

    public function delete(Document $document){
       
        $this->authorize('update',$document);
       try {
        // Document::destroy($id);
        $document->delete();
        flash()->addSuccess('Sucèss! Document supprimé avec sucèss');
        return to_route('documents');
       } catch (\Throwable $th) {
        flash()->options([
            'timeout' => 10000, // 3 seconds
            'position' => 'top-center',
            ])->addError('Erreur! Vous ne pouvez pas supprimer ce Document
                     car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                     les entités qui dépendent de ce Document avant de le supprimer');
        
            return redirect()->route('documents');
       }

        
    }
}

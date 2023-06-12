<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Document;
use App\Models\Societe;
use App\Models\TypeDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        $documents = Document::all();
        return view('admin.document.index',compact('documents'));
    }

    public function show(Document $document){
        dd($document);
        return $document;
    }

    public function create(){
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $types = TypeDocument::all(['id','libelle']);
        $latest = Document::latest('id')->first(['id']);


        return view('admin.document.create', compact('clients','entites','types','latest'));
    }
    public function store(Request $request){

        $validate = $this->validate($request,[
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



        if (Document::create([
            'type_id'=>$request->type_id,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'libelle'=>$request->libelle,
            'nom_fichier'=>$compFic,
            'date'=>Carbon::parse($request->date),
        ])) {
            
            return to_route('documents',[],201);
        } else {
            return to_route('document_create');
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
            
            return to_route('documents',[],201);
        } else {
            return to_route('document_edit',$request->id);
        }
    }

    public function delete(int $id){
       
        Document::destroy($id);

        return to_route('documents');
    }
}

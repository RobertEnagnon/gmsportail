<?php

namespace App\Http\Controllers;

use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    
    public function create(){
        $latest = TypeDocument::latest()->first();
        return view('admin.options.type_document.create', compact('latest'));
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'libelle'=>'required|string',
        ]);
        

        if(TypeDocument::create([
            'libelle'=>$request->libelle
        ])){
            flash()->addSuccess("Type du Document créé avec sucèss");
            return to_route('options');
        } else {
            flash()->addError('Erreur! Echec de création du type document');
            return to_route('type_document_store',$request->id);
        }

    }

    public function edit(TypeDocument $typeDoc){


        return view("admin.options.type_document.edit",compact('typeDoc'));
    }


    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'libelle'=>'required|string',
        ]);


        if(TypeDocument::where('id',$request->id)->update([
            'libelle'=>$request->libelle,
        ])){
            flash()->addSuccess('Sucèss! Type du Document modifié avec sucèss');
            return redirect()->route('options',[],201);
        } else {
            flash()->addError('Oops! Erreur de modifications');
            return redirect()->route('type_document_edit',$request->id);
        }
    }

    public function delete(int $id){
        try {
            TypeDocument::destroy($id);
            flash()->addSuccess('Sucèss! Type du Document supprimé avec sucèss');
            return to_route('options');
        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer ce Type du Document
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de ce Type du Document avant de le supprimer');
            
                return redirect()->route('options');
        }
    }
    
}

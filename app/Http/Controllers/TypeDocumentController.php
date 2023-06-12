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
            
            return to_route('options',[],201);
        } else {
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
            
            return to_route('options',[],201);
        } else {
            return to_route('type_document_edit',$request->id);
        }
    }

    public function delete(int $id){
        TypeDocument::destroy($id);
        return to_route('options');
    }
    
}

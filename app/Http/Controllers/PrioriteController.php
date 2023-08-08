<?php

namespace App\Http\Controllers;

use App\Models\Priorite;
use Illuminate\Http\Request;

class PrioriteController extends Controller
{
    public function create(){
        $latest = Priorite::latest()->first();
        return view('admin.options.priorite.create', compact('latest'));
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'libelle'=>'required|string',
        ],[
            'libelle'=>'Ce champs est obligatoire',
        ]);
        
        try {
            Priorite::create([
                'libelle'=>$request->libelle
            ]);
            flash()->addSuccess("Priorité créée avec sucèss");
            return to_route('options');
        } catch (\Throwable $th) {
            flash()->addError('Erreur! Echec de création de Priorité: '.$th->getMessage());
            return to_route('priorite_create');
        }

    }

     public function edit(Priorite $priorite){


        return view("admin.options.priorite.edit",compact('priorite'));
    }


    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'libelle'=>'required|string',
        ],[
            'libelle'=>'Ce champs est obligatoire',
        ]);


        try{
            Priorite::where('id',$request->id)->update([
            'libelle'=>$request->libelle,
            ]);
            flash()->addSuccess('Sucèss! Priorité modifiée avec sucèss');
            return to_route('options');
        } catch (\Throwable $th) {
            flash()->addError('Oops! Erreur de modifications: '.$th->getMessage());
            return to_route('priorite_edit',$request->id);
        }
    }

    public function delete(int $id){
        try {
            Priorite::destroy($id);
            flash()->addSuccess('Sucèss! Priorité supprimée avec sucèss');
            return to_route('options');
        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer cette Priotité
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de cette Priotité avant de le supprimer');
            
                return redirect()->route('options');
        }
    }
    
}

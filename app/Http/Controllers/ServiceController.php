<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
   

    public function create(){
        $latest = Service::latest()->first();
        return view('admin.options.service.create', compact('latest'));
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'libelle'=>'required|string',
            'email'=>'required|email',
        ],[
            'libelle'=>'Ce champ est obligatoire',
            'email'=>'Ce champ est obligatoire',
        ]);
        
        try {
            Service::create([
                'libelle'=>$request->libelle,
                'email'=>$request->email,
            ]);
            flash()->addSuccess("Service créé avec sucèss");
            return to_route('options');
        } catch (\Throwable $th) {
            flash()->addError('Erreur! Echec de création du service: '.$th->getMessage());
            return to_route('service_create',$request->id);
        }

    }

    public function edit(Service $service){


        return view("admin.options.service.edit",compact('service'));
    }


    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'libelle'=>'required|string',
            'email'=>'required|email',
        ],[
            'libelle'=>'Ce champ est obligatoire',
            'email'=>'Ce champ est obligatoire',
        ]);


        try {
            Service::where('id',$request->id)->update([
                'libelle'=>$request->libelle,
                'email'=>$request->email,
            ]);
            flash()->addSuccess('Sucèss! Service modifié avec sucèss');
            return redirect()->route('options');

        } catch (\Throwable $th) {
            flash()->addError('Oops! Erreur de modifications: '.$th->getMessage());
            return redirect()->route('service_edit',$request->id);
        }
    }

    public function delete(int $id){
        try {
            Service::destroy($id);
            flash()->addSuccess('Sucèss! Service supprimé avec sucèss');
            return to_route('options');
        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer ce Service
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de ce Service avant de le supprimer');
            return redirect()->route('options');
        }
    }

}

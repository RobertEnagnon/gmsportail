<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Site;
use App\Models\Societe;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $sites = Site::all();
        
        return view('admin.sites.index', compact('sites'));
    }

    public function show(Site $site){

    }

    public function create(){
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $latest = Site::latest()->first(['id']);
        return view('admin.sites.create',compact('latest','clients','entites'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'libelle'=>'required|string',
            'societe_id'=>'required',
            'client_id'=>'required',
        ]);
        

        if(Site::create([
            'libelle'=>$request->libelle,
            'societe_id'=>$request->societe_id,
            'client_id'=>$request->client_id,
        ])){
            flash()->addSuccess("Site créé avec sucèss");
            return to_route('sites');
        } else {
            flash()->addError('Erreur! Echec de création du site');
            return to_route('site_create',$request->id);
        }

    }

    public function edit(Site $site){

        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);

        return view("admin.sites.edit",compact('site','clients','entites'));
    }


    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'libelle'=>'required|string',
            'societe_id'=>'required',
            'client_id'=>'required',
        ]);


        if(Site::where('id',$request->id)->update([
            'libelle'=>$request->libelle,
            'societe_id'=>$request->societe_id,
            'client_id'=>$request->client_id,
        ])){
            flash()->addSuccess('Sucèss! Site modifié avec sucèss');
            return to_route('sites');
        } else {
            flash()->addError('Oops! Erreur de modifications');
            return to_route('site_edit',$request->id);
        }
    }

    public function delete(int $id){
        try {
            Site::destroy($id);
            flash()->addSuccess('Sucèss! Site supprimé avec sucèss');
            return to_route('sites');
        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer ce Site
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de ce Site avant de le supprimer');
            
            return to_route('sites');
        }
    }
}

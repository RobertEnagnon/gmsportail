<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Site;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index(){
        $sites = null;
        
        //http://178.238.238.52:8083/api/gms/sites/GMS/1205

        if (Auth::user()->is_admin) {
            $sites = Site::all();
        } else {
            $sites = Site::where('client_id',Auth::user()->client_id)->get();
        }
        
        return view('admin.sites.index', compact('sites'));
    }

    public function show(Site $site){
        return view('admin.sites.show',compact('site'));
    }

    public function create(){
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $latest = Site::latest()->first(['id']);
        return view('admin.sites.create',compact('latest','clients','entites'));
    }

    public function store(Request $request){
        $this->authorize('create', Site::class);
        $this->validate($request,[
            'libelle'=>'required|string',
            'societe_id'=>'required',
            'client_id'=>'required',
        ],[
            'libelle'=>'Ce champ est obligatoire',
            'societe_id'=>'Ce champ est obligatoire',
            'client_id'=>'Ce champ est obligatoire',
        ]);
        

        try {
            Site::create([
                'libelle'=>$request->libelle,
                'societe_id'=>$request->societe_id,
                'client_id'=>$request->client_id,
            ]);
            flash()->addSuccess("Site créé avec sucèss");
            return to_route('sites');
        } catch (\Throwable $th) {
            flash()->addError('Erreur! Echec de création du site: '.$th->getMessage());
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
        ],[
            'libelle'=>'Ce champ est obligatoire',
            'societe_id'=>'Ce champ est obligatoire',
            'client_id'=>'Ce champ est obligatoire',
        ]);

        try {
            Site::where('id',$request->id)->update([
                'libelle'=>$request->libelle,
                'societe_id'=>$request->societe_id,
                'client_id'=>$request->client_id,
            ]);
            flash()->addSuccess('Sucèss! Site modifié avec sucèss');
            return to_route('sites');
        } catch (\Throwable $th) {
            flash()->addError('Oops! Erreur de modifications: '.$th->getMessage());
            return to_route('site_edit',$request->id);
        }
    }

    public function delete(Site $site){
        $this->authorize('update',$site);
        try {
            // Site::destroy($id);
            $site->delete();
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

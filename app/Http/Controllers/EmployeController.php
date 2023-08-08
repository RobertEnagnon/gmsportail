<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employe;
use App\Models\Site;
use App\Models\Societe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class EmployeController extends Controller
{
    
    public function index(){
        $employes =null;
       //http://178.238.238.52:8083/api/gms/employes/GMS/1205

        if (Auth::user()->is_admin) {
            $employes = Employe::all();
        } else {
            $employes = Employe::where('client_id',Auth::user()->client_id)->get();
        }
        return view('admin.employe.index', compact('employes'));
    }

    public function show(Employe $employe){

        return view('admin.employe.show', compact('employe'));
    }

    public function create(){
        $sites = Site::all(['id','libelle']);
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $latest = Employe::latest('id')->first(['id']);

        return view('admin.employe.create', compact('sites','clients','entites','latest'));
    }

    public function store(Request $request){
        $this->authorize('create', Employe::class);
       
        $this->validate($request,[
            'matricule'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'cin'=>'required',
            'cnss'=>'required',
            'site_id'=>'required',
            'client_id'=>'required',
            'societe_id'=>'required',
        ],[
            'matricule'=>'Ce champs est obligatoire',
            'nom'=>'Ce champs est obligatoire',
            'prenom'=>'Ce champs est obligatoire',
            'cin'=>'Ce champs est obligatoire',
            'cnss'=>'Ce champs est obligatoire',
            'site_id'=>'Ce champs est obligatoire',
            'client_id'=>'Ce champs est obligatoire',
            'societe_id'=>'Ce champs est obligatoire',
        ]);
        

        try {
             Employe::create([
            'matricule'=>$request->matricule,
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'cin'=>$request->cin,
            'cnss'=>$request->cnss,
            'site_id'=>$request->site_id,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
             ]);
            flash()->addSuccess("Employé créé avec sucèss");
            return to_route('employes');
        } catch (\Throwable $th) {
            flash()->addError('Erreur! Echec de création de l\'Employé: '.$th->getMessage());
            return to_route('employe_create');
        } 

    }

    public function edit(Employe $employe){
        
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $sites = Site::all(['id','libelle']);

        return view("admin.employe.edit",compact('employe','clients','entites','sites'));
    }

    public function update(Request $request){
       
        $this->validate($request,[
            'matricule'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'cin'=>'required',
            'cnss'=>'required',
            'site_id'=>'required',
            'client_id'=>'required',
            'societe_id'=>'required',
        ],[
            'matricule'=>'Ce champs est obligatoire',
            'nom'=>'Ce champs est obligatoire',
            'prenom'=>'Ce champs est obligatoire',
            'cin'=>'Ce champs est obligatoire',
            'cnss'=>'Ce champs est obligatoire',
            'site_id'=>'Ce champs est obligatoire',
            'client_id'=>'Ce champs est obligatoire',
            'societe_id'=>'Ce champs est obligatoire',
        ]);


        try{
            Employe::where('id',$request->id)->update([
                'matricule'=>$request->matricule,
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'cin'=>$request->cin,
                'cnss'=>$request->cnss,
                'site_id'=>$request->site_id,
                'client_id'=>$request->client_id,
                'societe_id'=>$request->societe_id,
            ]);
            flash()->addSuccess('Sucèss! Employé modifié avec sucèss');
            return to_route('employes');
        } catch(\Throwable $th) {
            flash()->addError('Oops! Erreur de modifications: '.$th->getMessage());
            return to_route('employe_edit',$request->id);
        }
    }

    public function delete(Employe $employe){
        // $this->authorize('update',$employe);
        try {
            // Employe::destroy($id);
            $employe->delete();
            flash()->addSuccess('Sucèss! Employé supprimé avec sucèss');
            return to_route('employes');
        } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Vous ne pouvez pas supprimer cet Employé
                         car d\'autre entités dépendent de lui. Vous devez supprimez toutes 
                         les entités qui dépendent de ce Employé avant de le supprimer');
            
                         return to_route('employes');
        }
    }
}

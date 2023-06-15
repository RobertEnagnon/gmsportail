<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employe;
use App\Models\Site;
use App\Models\Societe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    
    public function index(){
        $employes = Employe::all();
        return view('admin.employe.index', compact('employes'));
    }

    public function show(Employe $employe){

    }

    public function create(){
        $sites = Site::all(['id','libelle']);
        $clients = Client::all(['id','nom']);
        $entites = Societe::all(['id','libelle']);
        $latest = Employe::latest('id')->first(['id']);

        return view('admin.employe.create', compact('sites','clients','entites','latest'));
    }

    public function store(Request $request){
       
        $this->validate($request,[
            'matricule'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'cin'=>'required',
            'cnss'=>'required',
            'site_id'=>'required',
            'client_id'=>'required',
            'societe_id'=>'required',
            'date'=>'required'
        ]);
        

        if (Employe::create([
            'matricule'=>$request->matricule,
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'cin'=>$request->cin,
            'cnss'=>$request->cnss,
            'site_id'=>$request->site_id,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
            'date'=>Carbon::parse($request->date)
        ])) {
            return to_route('employes');
        } else {
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
            'date'=>'required'
        ]);


        if(Employe::where('id',$request->id)->update([
            'matricule'=>$request->matricule,
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'cin'=>$request->cin,
            'cnss'=>$request->cnss,
            'site_id'=>$request->site_id,
            'client_id'=>$request->client_id,
            'societe_id'=>$request->societe_id,
        ])) {
            return to_route('employes');
        } else {
            return to_route('employe_edit');
        }
    }

    public function delete(int $id){
        Employe::destroy($id);

        return to_route('employes');
    }
}

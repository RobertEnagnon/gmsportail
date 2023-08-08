<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Societe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    public function index()
    {
        $taches= null;

        if (Auth::user()->is_admin) {

            $taches= Planning::all();

        } else {
            $taches= Planning::where('client_id',Auth::user()->client_id)->get();
        }

        return view('admin.planning.index', compact('taches'));
    }

    public function getEvents()
    {
        $plannings= null;

        if (Auth::user()->is_admin) {

            $plannings= Planning::all();

        } else {
            $plannings= Planning::where('client_id',Auth::user()->client_id)->get();
        }

        $events = [];

        foreach ($plannings as $planning) {
            $events[] = [
                'id' => $planning->id,
                'title' => $planning->libelle,
                'start' => $planning->date,
                'end' => $planning->date_fin, 
                'color' => $planning->couleur, 
                'description'=> $planning->detail,
                'is_done' => $planning->is_done,
                'client_id'=>$planning->client_id,
                'societe_id'=>$planning->societe_id,
               
                    
            ];
        }

        return response()->json($events);
    }

    public function markAsDone(int $id)  {

        try {
            Planning::where('id',$id)->update([
                'is_done'=> 1,
            ]);
            flash()->addSuccess('Tâche terminée avec sucèss');   
            return to_route('planning.create');
        } catch (\Throwable $th) {
            flash()->addError('Oops! Erreur lors de Terminaison de la tâche: '.$th->getMessage());
            return to_route('planning.create');
        }
    }

    public function markAsUndone(int $id)  {

        try {
            Planning::where('id',$id)->update([
                'is_done'=> 0,
            ]);
            flash()->addWarning('Tâche non terminée ');   
            return to_route('planning.create');
        } catch (\Throwable $th) {
            flash()->addError('Oops! Erreur lors de non Terminaison de la tâche: '.$th->getMessage());
            return to_route('planning.create');
        }
    }

    public function create()
    {
        
        $clients = Client::all();
        $entites = Societe::all();

        $plannings= null;

        if (Auth::user()->is_admin) {

            $plannings= Planning::all();

        } else {
            $plannings= Planning::where('client_id',Auth::user()->client_id)->get();
        }


        return view('admin.planning.create', compact('plannings','clients','entites'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Planning::class);
        $request->validate([
            'libelle' => 'required',
            'date' => 'required',
            'couleur' => 'required',
            'client_id' => 'required',
            'societe_id' => 'required',
        ],[
            'libelle' => 'Ce champ est obligatoire',
            'date' => 'Ce champ est obligatoire',
            'couleur' => 'Ce champ est obligatoire',
            'client_id' => 'Ce champ est obligatoire',
            'societe_id' => 'Ce champ est obligatoire',
        ]);

        try {
            Planning::create([
                'libelle' => $request->libelle,
                'detail'=>($request->detail) ? $request->detail : null,
                'date' => Carbon::parse($request->date),
                'date_fin' => ($request->date_fin) ? Carbon::parse($request->date_fin) : null,
                'couleur' => $request->couleur,
                'client_id' => $request->client_id,
                'societe_id' => $request->societe_id,
                'repete'=> ($request->repete) ? $request->repete : 0,
                'se_termine_le'=> ($request->se_termine_le) ? $request->se_termine_le : null,
                'se_termine_apres'=> ($request->se_termine_apres) ? $request->se_termine_apres : null,
                'periodicite' =>  ($request->periodicite) ? $request->periodicite : null,
            ]);
    
            flash()->addSuccess('Tâche créé avec succès.');  
            return redirect()->route('planning.create');
        } catch (\Throwable $th) {
            flash()->addError('Oops! Erreur lors de modification: '/$th->getMessage());
            return redirect()->route('planning.create');
        }
    }

    public function edit(Planning $planning)
    {
        $this->authorize('update', $planning);
        $clients = Client::all();
        $entites = Societe::all();

        return view('admin.planning.edit', compact('planning','clients','entites'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'date' => 'required',
            'couleur' => 'required',
            'client_id' => 'required',
            'societe_id' => 'required',
        ],[
            'libelle' => 'Ce champ est obligatoire',
            'date' => 'Ce champ est obligatoire',
            'couleur' => 'Ce champ est obligatoire',
            'client_id' => 'Ce champ est obligatoire',
            'societe_id' => 'Ce champ est obligatoire',
        ]);


        try {
            Planning::where('id',$request->id)->update([
                'libelle' => $request->libelle,
                'detail'=>($request->detail) ? $request->detail : null,
                'date' => Carbon::parse($request->date),
                'date_fin' => Carbon::parse($request->date_fin),
                'couleur' => $request->couleur,
                'client_id' => $request->client_id,
                'societe_id' => $request->societe_id,
                'repete'=> ($request->repete) ? $request->repete : 0,
                'se_termine_le'=> ($request->se_termine_le) ? $request->se_termine_le : $request->date,
                'se_termine_apres'=> ($request->se_termine_apres) ? $request->se_termine_apres : null,
            ]);
            flash()->addSuccess('Sucèss! Client modifié avec sucèss');   
            return to_route('planning.create');

        } catch (\Throwable $th) {
            flash()->addError('Oops! Erreur lors de modification: '.$th->getMessage());
            return to_route('planning.edit',$request->id);
        }
    }

    public function destroy(Planning $planning)
    {
        $this->authorize('delete', $planning);
        try{
            $planning->delete();
            flash()->addSuccess( 'Tâche supprimé avec succès.');

            return redirect()->route('planning.index');

        }catch (\Throwable $th) {

        flash()->options([
            'timeout' => 10000, // 3 seconds
            'position' => 'top-center',
            ])->addError('Erreur! Vous ne pouvez pas supprimer cette tâche
                        car d\'autre entités dépendent d\'elle. Vous devez supprimez toutes 
                        les entités qui dépendent de cette tâche avant de le supprimer');
        
                        return to_route('planning.index');
        }
    }
}

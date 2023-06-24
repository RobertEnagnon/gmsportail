<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Societe;
use Carbon\Carbon;

class PlanningController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $entites = Societe::all();

        return view('admin.planning.index', compact('clients','entites'));
    }

    public function getEvents()
    {
        $plannings = Planning::all();

        $events = [];

        foreach ($plannings as $planning) {
            $events[] = [
                'id' => $planning->id,
                'title' => $planning->libelle,
                'start' => $planning->date,
                'end' => $planning->se_termine_le,
                'color' => $planning->couleur, 
                'description'=> $planning->detail,
                'client_id'=>$planning->client_id,
                'societe_id'=>$planning->societe_id,
            ];
        }

        return response()->json($events);
    }

    public function create()
    {
        $clients = Client::all();
        $entites = Societe::all();
        return view('admin.planning.create', compact('clients','entites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'date' => 'required',
            'couleur' => 'required',
            'client_id' => 'required',
            'societe_id' => 'required',
        ]);

        Planning::create([
            'libelle' => $request->libelle,
            'detail'=>($request->detail) ? $request->detail : null,
            'date' => Carbon::parse($request->date),
            'couleur' => $request->couleur,
            'client_id' => $request->client_id,
            'societe_id' => $request->societe_id,
            'repete'=> ($request->repete) ? $request->repete : 0,
            'se_termine_le'=> ($request->se_termine_le) ? $request->se_termine_le : $request->date,
            'se_termine_apres'=> ($request->se_termine_apres) ? $request->se_termine_apres : null,
        ]);

        flash()->addSuccess('Tâche créé avec succès.');  
        return redirect()->route('planning.index');
    }

    public function edit(Planning $planning)
    {
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
        ]);


        if(Planning::where('id',$request->id)->update([
            'libelle' => $request->libelle,
            'detail'=>($request->detail) ? $request->detail : null,
            'date' => Carbon::parse($request->date),
            'couleur' => $request->couleur,
            'client_id' => $request->client_id,
            'societe_id' => $request->societe_id,
            'repete'=> ($request->repete) ? $request->repete : 0,
            'se_termine_le'=> ($request->se_termine_le) ? $request->se_termine_le : $request->date,
            'se_termine_apres'=> ($request->se_termine_apres) ? $request->se_termine_apres : null,
        ]))
        {
            flash()->addSuccess('Sucèss! Client modifié avec sucèss');   
            return to_route('planning.index');
        } else {
            flash()->addError('Oops! Erreur lors de modification');
            return to_route('planning.edit',$request->id);
        }
    }

    public function destroy(Planning $planning)
    {
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

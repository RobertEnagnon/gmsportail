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
        return view('admin.planning.index');
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
                'client_id'=>$planning->cliend_id,
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
            'date' => Carbon::parse($request->date),
            'couleur' => $request->couleur,
            'client_id' => $request->client_id,
            'societe_id' => $request->societe_id,
            'repete'=> ($request->repete) ? $request->repete : 0,
            'se_termine_le'=> ($request->se_termine_le) ? $request->se_termine_le : $request->date,
            'se_termine_apres'=> ($request->se_termine_apres) ? $request->se_termine_apres : null,
        ]);

        return redirect()->route('planning.index')
            ->with('success', 'Tâche créé avec succès.');
    }

    public function edit(Planning $planning)
    {
        return view('admin.planning.edit', compact('planning'));
    }

    public function update(Request $request, Planning $planning)
    {
        $request->validate([
            'libelle' => 'required',
            'detail' => 'required',
            'periodicite' => 'required',
            'repete' => 'required',
            'se_termine_le' => 'required',
            'se_termine_apres' => 'required',
            'date' => 'required',
            'couleur' => 'required',
        ]);

        $planning->update($request->all());

        return redirect()->route('planning.index')
            ->with('success', 'Tâche mis à jour avec succès.');
    }

    public function destroy(Planning $planning)
    {
        $planning->delete();

        return redirect()->route('planning.index')
            ->with('success', 'Tâche supprimé avec succès.');
    }
}

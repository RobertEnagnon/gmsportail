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
        ]);
        

        if(Priorite::create([
            'libelle'=>$request->libelle
        ])){
            
            return to_route('options',[],201);
        } else {
            return to_route('priorite_create',$request->id);
        }

    }

     public function edit(Priorite $priorite){


        return view("admin.options.priorite.edit",compact('priorite'));
    }


    public function update(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'libelle'=>'required|string',
        ]);


        if(Priorite::where('id',$request->id)->update([
            'libelle'=>$request->libelle,
        ])){
            
            return to_route('options',[],201);
        } else {
            return to_route('priorite_edit',$request->id);
        }
    }

    public function delete(int $id){
        Priorite::destroy($id);
        return to_route('options');
    }
    
}

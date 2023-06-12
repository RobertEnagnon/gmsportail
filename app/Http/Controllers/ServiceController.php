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
        ]);
        

        if(Service::create([
            'libelle'=>$request->libelle,
            'email'=>$request->email,
        ])){
            
            return to_route('options',[],201);
        } else {
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
        ]);


        if(Service::where('id',$request->id)->update([
            'libelle'=>$request->libelle,
            'email'=>$request->email,
        ])){
            
            return to_route('options',[],201);
        } else {
            return to_route('service_edit',$request->id);
        }
    }

    public function delete(int $id){
        Service::destroy($id);
        return to_route('options');
    }

}

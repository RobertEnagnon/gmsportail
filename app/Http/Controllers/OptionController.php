<?php

namespace App\Http\Controllers;

use App\Models\Priorite;
use App\Models\Service;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    

    public function options(){
        $services = Service::all();
        $priorites = Priorite::all();
        $typesDoc = TypeDocument::all();


        return view('admin.options.index', compact('services','priorites','typesDoc'));
    }
}

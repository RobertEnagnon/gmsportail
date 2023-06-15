<?php

namespace App\Http\Controllers;

use App\Models\Priorite;
use App\Models\Service;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index(){
        return view('admin.home');
    }

    
}

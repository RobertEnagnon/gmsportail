<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('auth.index',compact('users'));
    }

    public function login(){
        return view('auth.login');
    }

    public function connect(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);

    }

    public function logout(Request $request){
         Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
 
        
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all(['id','nom']);
        return view('auth.register',compact('clients'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'client_id' => 'required'
        ]);

        // Insertion
        $user = User::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'client_id' => $request->client_id,
            'is_client'=>$request->is_admin,
            'derniere_con'=>Carbon::now(),
        ]);

        if ($user) {
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id)
    {
        User::destroy($id);
        
        return redirect('/users');
    }
}

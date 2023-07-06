<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',User::class);
        $users = User::all();
        
        return view('auth.index',compact('users'));
    }

    public function user(Request $request){

        $this->authorize('view',$request->user());

        $user = $request->user();
        return view('auth.profile');
    }

    public function login(){
        return view('auth.login');
    }

    public function connect(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            flash()->addSuccess("Vous êtes connecté avec sucèss");
            return redirect()->intended('/admin');
        }

        return redirect('login')->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);

    }

    public function logout(Request $request){
         Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
 
        flash()->addSuccess("Vous êtes déconnecté avec sucèss");
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',User::class);

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

        // Creation
        $user = User::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'client_id' => $request->client_id,
            'is_client'=>$request->is_client,
            'derniere_con'=>Carbon::now(),
        ]);

        if ($user) {
            // Auth::login($user);
            $email = $request->email;
             //Send mail
        Mail::send('auth.mail.register_user', ['prenom'=>$request->prenom,'password'=>$request->password,'email'=>$email], function ($message) use($email) {
            $message->to($email);
            $message->subject('Informations du compte utilisateur');
        });
            flash()->addSuccess("compte enrégistré avec sucèss");
            // return redirect(RouteServiceProvider::HOME);
            return redirect("/users");
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);

        $clients = Client::all(['id','nom']);

        return view("auth.edit",compact('user','clients'));

    }

    public function update(Request $request){

        $this->validate($request,[
            'id'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'client_id' => 'required',
        ]);

        $id = $request->id;

        $user = User::find($id);
        if (!$user) {
            flash()->addError('Cet utilisateur n\'existe pas !');
            return to_route('user_edit',$request->id);
        }

        if (User::where('id',$request->id)->update([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'client_id' => $request->client_id,
            'is_client'=>$request->is_client,
            'derniere_con'=>Carbon::now(),
        ])) {
          
    
            $email = $request->email;
                 //Send mail
            Mail::send('auth.mail.register_user', ['prenom'=>$request->prenom,'password'=>$request->password,'email'=>$email], function ($message) use($email) {
                $message->to($email);
                $message->subject('Modification des Informations du compte utilisateur');
            });

            flash()->addSuccess(' L\utilisateur a été mise à jours avec sucèss!');

            return redirect('/users');

            
        }else{
            flash()->addError('Oops! Erreur de modifications');
            return to_route('user_edit',$request->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user)
    {
        $this->authorize('delete',$user);

        try {
            $user->delete();
            flash()->addSuccess('Sucèss! utilisateur supprimé avec sucèss');
            return to_route('users');
           } catch (\Throwable $th) {
            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
                ])->addError('Erreur! Impossible de supprimer l\'utilisateur');
            
                return redirect()->route('users');
           }
    }

    public function recorveryPassword()  {
        return view('auth.recorvery');
    }
    public function forgotPassword(Request $request){

        $this->validate($request, [
            "email"=> 'required|email'
        ]);

        $email = $request->email;

        if (User::where('email', $email)->doesntExist()) {
            return redirect('/recorvery')->withErrors("L'adresse email n'existe pas");
        }

        $token = Str::random(10);

        DB::table('password_reset_tokens')->insert([
            'email'=>$email,
            'token'=>$token,
            'created_at'=>now()->addHours(2)
        ]);

        //Send mail
        Mail::send('auth.mail.password_reset', ['token'=>$token], function ($message) use($email) {
            $message->to($email);
            $message->subject('Renouvellement du mot de passe');
        });

        flash()->options([
            'timeout' => 10000, // 3 seconds
            'position' => 'top-center',
            ])->addSuccess("Un message vous est envoyé dans la boite mail.Vérifiez votre Email pour changer le mot de passe");
        // return redirect(RouteServiceProvider::HOME);
        return redirect("/login");
    }

    function resetForm(string $token)  {

            return view('auth.reset_password', compact('token'));  
    }

    public function resetPassword(Request $request){
        $this->validate($request, [
            'token'=>'required|string',
            'password'=>'required|string|confirmed',
        ]);

        $token = $request->token;
        $passwordRest =DB::table('password_reset_tokens')->where('token', $token)->first();

        //verify token
        if (!$passwordRest) {
           return back()->withErrors('Token non trouvé.');
        }

        //validate expire time
        if (!$passwordRest->created_at >= now()) {
            return back()->withErrors('Token déjà expiré.');
        }

        $user = User::where('email',$passwordRest->email)->first();

        if (!$user) {
           return back()->withErrors('Cet Utilisateur n\'existe pas.');
        }

        $user->password =Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('token', $token)->delete();

        flash()->addSuccess("Mot de passe mise à jour avec sucèss");
        return redirect("/login");

    }

    function editUsername()  {
        return view('auth.edit_username');
    }

    public function update_username(Request $request){
        $this->validate($request, [
            'password'=>'required',
            'prenom'=>'required|string',
            'nom'=>'required|string',
        ],[
            'password'=>'Le champs du mot de passe est requis',
            'prenom'=>'Le champs de prenom est requis',
            'nom'=>'Le champs de nom est requis',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors("Votre mot de passe est incorrect");
        }

        $user = User::where("id",$user->id)->first();

        if ($user) {
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->save();
            flash()->addSuccess("Votre nom d'utilisateur a été modifié avec sucess");
             return redirect('/user');
        } else {
            flash()->addError("La modification de nom d'utilisateur a echoué");
             return redirect('/user');
        }


    }

    function editEmail()  {
        return view('auth.edit_email');
    }

    public function update_email(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|string',
        ],[
            'password'=>'Le champs du nouveau mot de passe est requis',
            'email'=>'Le champs de Email est requis',]);
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect('/edit_email')->withErrors("Votre mot de passe est incorrect");
        }

        $user = User::where("id",$user->id)->first();

        if ($user) {
            $user->email = $request->email;
            $user->save();
            flash()->addSuccess("Votre email a été modifié avec sucess");
             return redirect('/user');
        } else {
            flash()->addError("La modification de l'email a echoué");
             return redirect('/user');
        }


    }

    function editPassword()  {
        return view('auth.edit_password');
    }
    public function update_password(Request $request){
        $this->validate($request, [
            'password_old'=>'required',
            'password'=>'required|confirmed',
        ],[
            'password_old'=>'Le champs du mot de passe actuel est requis',
            'password'=>'Le champs du nouveau mot de passe est requis',
            'password_confirmation'=>'Le champs du de confirmation mot de passe ne correspond pas',]);
        $user = Auth::user();
        if (!Hash::check($request->password_old, $user->password)) {
            return redirect('/edit_Password')->withErrors("L'ancien mot de passe est incorrect");
        }

        $user = User::where("id",$user->id)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            flash()->addSuccess("Mot de passe mise à jour avec sucèss");
             return redirect('/user');
        } else {
            flash()->addError("La mise à jour du mot de passe a echoué");
             return redirect('/user');
        }


    }


}

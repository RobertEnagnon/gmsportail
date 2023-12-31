<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\PrioriteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\UserController;
use App\Models\Document;
use App\Models\Employe;
use App\Models\Site;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------#
|
| Here is where you can register web routes for your application. These  
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});



Route::get('/login', [UserController::class,'login'])->name('login');
Route::post('/connect', [UserController::class,'connect']);

Route::get('/recorvery',[UserController::class,'recorveryPassword']);
Route::post('/forgot',[UserController::class,'forgotPassword']);

Route::get('/reset_form/{token}',[UserController::class,'resetForm']);

Route::put('/reset',[UserController::class,'resetPassword']);

Route::middleware('auth')->group(function () {

    Route::get('/register', [UserController::class,'create'])->name('user.register');
    Route::post('/register', [UserController::class,'store'])->name('user.store');

    Route::get('/user', [UserController::class,'user'])->name('profile');

    Route::get('/edit_username',[UserController::class,'editUsername']);
    Route::put('/update_username', [UserController::class,'update_username']);

    Route::get('/edit_email',[UserController::class,'editEmail']);
    Route::put('/update_email', [UserController::class,'update_email']);

    Route::get('/edit_Password',[UserController::class,'editPassword']);
    Route::put('/update_password', [UserController::class,'update_password']);

    Route::put('/user_reset',  [UserController::class,'update']);
    Route::post('/user/photo',  [UserController::class,'storeFile']);

    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/users', [UserController::class,'index'])->name('users');

    Route::get('/users/edit/{user}',[UserController::class,'edit'])->name('user_edit');
    Route::put('/users/update',[UserController::class,'update'])->name('user_update');

    Route::delete('/users/delete/{user}',[UserController::class,'delete'])->name('user_delete') ;  

});

 


Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/',[AdminController::class, 'index'])->name('dashboard');

    // Les routes pour gérer les documents
    Route::prefix('documents')->group(function(){
        Route::get('/',[DocumentController::class,'index'])->name('documents');
        Route::get('/show/{document}',[DocumentController::class,'show'])->name('document_show');
        Route::get('/create',[DocumentController::class, 'create'])->name('document_create')->middleware('can:create,'.Document::class);
        Route::post('/store',[DocumentController::class,'store'])->name('document_store');
        Route::get('/edit/{document}',[DocumentController::class,'edit'])->name('document_edit')->middleware('can:update,document');
        Route::put('/update',[DocumentController::class,'update'])->name('document_update');
        Route::delete('/delete/{document}',[DocumentController::class,'delete'])->name('document_delete');

    });

    Route::prefix('factures')->group(function(){
        Route::get('/',[FactureController::class,'index'])->name('factures');
        Route::get('/show/{facture}',[FactureController::class,'show'])->name('facture_show');
        Route::get('/create',[FactureController::class,'create'])->name('facture_create');
        Route::post('/store',[FactureController::class,'store'])->name('facture_store');
        Route::get('/edit/{facture}',[FactureController::class,'edit'])->name('facture_edit');
        Route::put('/update',[FactureController::class,'update'])->name('facture_update');
        Route::delete('/delete/{facture}',[FactureController::class,'delete'])->name('facture_delete');
    });

    Route::prefix('plannings')->group(function(){
        Route::get('/', [PlanningController::class,'index'])->name('planning.index');
        Route::get('/events', [PlanningController::class,'getEvents'])->name('planning.getEvents');
        Route::get('/create', [PlanningController::class,'create'])->name('planning.create');
        Route::post('/store', [PlanningController::class,'store'])->name('planning.store');
        Route::get('/edit/{planning}', [PlanningController::class,'edit'])->name('planning.edit');
        Route::put('/update', [PlanningController::class,'update'])->name('planning.update');
        Route::delete('/destroy/{planning}', [PlanningController::class,'destroy'])->name('planning.destroy');
        Route::get("/done/{id}",[PlanningController::class,'markAsDone'])->name('planning.done');
        Route::get("/undone/{id}",[PlanningController::class,'markAsUndone'])->name('planning.undone');

    });

    Route::prefix('tickets')->group(function(){
        Route::get('/',[TicketController::class,'index'])->name('tickets');
        Route::get('/show/{ticket}',[TicketController::class,'show'])->name('ticket_show');
        Route::get('/create',[TicketController::class,'create'])->name('ticket_create');
        Route::post('/store',[TicketController::class,'store'])->name('ticket_store');
        Route::get('/edit/{ticket}',[TicketController::class,'edit'])->name('ticket_edit');
        Route::put('/update',[TicketController::class,'update'])->name('ticket_update');
        Route::delete('/delete/{ticket}',[TicketController::class,'delete'])->name('ticket_delete');

        Route::get('/replyForm/{ticket}',[TicketController::class,'replyForm'])->name('ticket_replyForm');
        Route::put('/reply',[TicketController::class,'reply'])->name('ticket_reply');
    });


    Route::prefix('clients')->group(function(){
        Route::get('/',[ClientController::class, 'index'])->name('clients');
        Route::get('/create',[ClientController::class, 'create'])->name('client_create');
        Route::get('/show/{client}',[ClientController::class,'show'])->name('client_show');
        Route::post('/store',[ClientController::class, 'store'])->name('client_store');
        Route::get('/edit/{client}',[ClientController::class,'edit'])->name('client_edit');
        Route::put('/update',[ClientController::class,'update'])->name('client_update');
        Route::delete('/delete/{id}',[ClientController::class,'delete'])->name('client_delete');
    });


    Route::prefix('sites')->group(function(){
        Route::get('/',[SiteController::class,'index'])->name('sites');
        Route::get('/show/{site}',[SiteController::class,'show'])->name('site_show');
        Route::get('/create',[SiteController::class,'create'])->name('site_create')->middleware('can:create,'.Site::class);
        Route::post('/store',[SiteController::class,'store'])->name('site_store');
        Route::get('/edit/{site}',[SiteController::class,'edit'])->name('site_edit')->middleware('can:update,site');
        Route::put('/update',[SiteController::class,'update'])->name('site_update');
        Route::delete('/delete/{site}',[SiteController::class,'delete'])->name('site_delete');
    });

    Route::prefix('employes')->group(function(){
        Route::get('/',[EmployeController::class,'index'])->name('employes');
        Route::get('/show/{employe}',[EmployeController::class,'show'])->name('employe_show');
        Route::get('/create',[EmployeController::class,'create'])->name('employe_create')->middleware('can:create,'.Employe::class);
        Route::post('/store',[EmployeController::class,'store'])->name('employe_store');
        Route::get('/edit/{employe}',[EmployeController::class,'edit'])->name('employe_edit')->middleware('can:create,employe');
        Route::put('/update',[EmployeController::class,'update'])->name('employe_update');
        Route::delete('/delete/{employe}',[EmployeController::class,'delete'])->name('employe_delete');
    });



    Route::prefix('options')->group(function(){
        Route::get('/',[OptionController::class,'options'])->name('options');

        Route::prefix('/services')->group(function(){
            Route::get('/create',[ServiceController::class,'create'])->name('service_create');
            Route::get('/show/{service}',[ServiceController::class,'show'])->name('service_show');
            Route::post('/store',[ServiceController::class,'store'])->name('service_store');
            Route::get('/edit/{service}',[ServiceController::class,'edit'])->name('service_edit');
            Route::put('/update',[ServiceController::class,'update'])->name('service_update');
            Route::delete('/delete/{id}',[ServiceController::class,'delete'])->name('service_delete');
        });

        Route::prefix('priorites')->group(function(){
            Route::get('/create',[PrioriteController::class,'create'])->name('priorite_create');
            Route::get('/show/{priorite}',[PrioriteController::class,'show'])->name('priorite_show');
            Route::post('/store',[PrioriteController::class,'store'])->name('priorite_store');
            Route::get('/edit/{priorite}',[PrioriteController::class,'edit'])->name('priorite_edit');
            Route::put('/update',[PrioriteController::class,'update'])->name('priorite_update');
            Route::delete('/delete/{id}',[PrioriteController::class,'delete'])->name('priorite_delete');
        });

        Route::prefix('type_documents')->group(function(){
            Route::get('/create',[TypeDocumentController::class,'create'])->name('type_document_create');
            Route::get('/show/{typeDoc}',[TypeDocumentController::class,'show'])->name('type_document_show');
            Route::post('/store',[TypeDocumentController::class,'store'])->name('type_document_store');
            Route::get('/edit/{typeDoc}',[TypeDocumentController::class,'edit'])->name('type_document_edit');
            Route::put('/update',[TypeDocumentController::class,'update'])->name('type_document_update');
            Route::delete('/delete/{id}',[TypeDocumentController::class,'delete'])->name('type_document_delete');
        });
        
    });
});

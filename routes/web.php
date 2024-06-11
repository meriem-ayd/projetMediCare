<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DciController;
use App\Http\Controllers\DashboardMedecinController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PharmacienController;



# Admin Auth
Route::get('/', '\App\Http\Controllers\DashboardController@acceuil')->name('acceuil');

Route::get('/admin-auth', '\App\Http\Controllers\AuthController@getAdminAuth')->name('getAdminAuth');
Route::post('/admin-auth', '\App\Http\Controllers\AuthController@postAdminAuth')->name('postAdminAuth');

Route::middleware(['userMiddleware'])->group(function () {
    # Admin Logout


    Route::get('/logout', '\App\Http\Controllers\AuthController@getAdminLogout')->name('getAdminLogout');
    # Admin Dashboard
    Route::get('/dashboard', '\App\Http\Controllers\DashboardController@getDashboard')->name('getDashboard');

    Route::middleware(['adminMiddleware'])->group(function () {
        Route::get('/users', '\App\Http\Controllers\UserController@getUsers')->name('getUsers');
        Route::get('/add-user', '\App\Http\Controllers\UserController@getAddUser')->name('getAddUser');
        Route::post('/add-user', '\App\Http\Controllers\UserController@postAddUser')->name('postAddUser');


        Route::get('/medecins', '\App\Http\Controllers\UserController@getMed')->name('getMed');
        Route::put('/medecins/{id}','\App\Http\Controllers\UserController@updateMED')->name('updateMED');

        Route::get('/addmedecin', '\App\Http\Controllers\UserController@getaddmedecin')->name('getaddmedecin');
        Route::post('/addmedecin', '\App\Http\Controllers\UserController@postAddMed')->name('postAddMed');


        Route::get('/liste_dci', '\App\Http\Controllers\DciController@listeDCI')->name('listeDCI');
        // Route::get('/liste_dci', [DciController::class, 'listeDCI'])->name('liste_dci');
        Route::put('/medecin/dcis/{id}','\App\Http\Controllers\DciController@updateDCI')->name('updateDCI');
        Route::get('/ajouter-dci', '\App\Http\Controllers\DciController@getDCI')->name('getDCI');
        Route::post('/ajouter-dci', '\App\Http\Controllers\DciController@postDCI')->name('ajouter_dci');

        Route::get('/listeService','\App\Http\Controllers\serviceController@listeServices')->name('listeServices');
        Route::put('/listeService/{id}','\App\Http\Controllers\serviceController@updateService')->name('updateService');
    Route::get('/ajouterService','\App\Http\Controllers\serviceController@getService')->name('getService');
    Route::post('/ajouterService', '\App\Http\Controllers\serviceController@store')->name('store');


    Route::delete('/listeService/{id}','\App\Http\Controllers\serviceController@destroy')->name('destroy');
    });

    // Route::get('medecin/dashboardMedecin', [DashboardMedecinController::class, 'getDashboardMedecin'])->name('getDashboardMedecin');

    Route::middleware(['doctor'])->group(function () {
        Route::get('/bondecommande', [MedecinController::class, 'bondecommande'])->name('bondecommande');
        Route::post('/bon_commande_service', [MedecinController::class, 'storeBonDeCommande'])->name('bon_commande_service.store');
        Route::get('/bons-de-commande', [MedecinController::class, 'listeBonsDeCommandeMedecin'])->name('bons-de-commande.medecin');
        Route::put('/bonDeCommande/{id}', [MedecinController::class, 'update'])->name('updateBonDeCommande');

        Route::get('/ordonnance', [MedecinController::class, 'create'])->name('ordonnance.create');
        Route::post('/ordonnance', [MedecinController::class, 'store'])->name('ordonnance.store');
        Route::get('/listeordonnance', [MedecinController::class, 'listeOrdonnancesMedecin'])->name('ordonnances.index');
    });

    Route::middleware(['pharmacist'])->group(function () {
        Route::get('/AjouterBCF', [PharmacienController::class, 'bonCF'])->name('bonCF');
        Route::post('/AjouterBCF',[PharmacienController::class,'createBonCommandeFournisseur'])->name('createBonCommandeFournisseur');

        Route::get('/listeBCF',[PharmacienController::class,'listeBonsDeCommandeFournisseur' ])->name('listeBonsDeCommandeFournisseur');
        Route::get('/DetailsBCF',[PharmacienController::class,'details' ])->name('details');

       // Route::post('/creer-bon-cf', [PharmacienController::class, 'createBonCommandeFournisseur'])->name('creerBonCF');

        Route::get('/bonlivraison', [PharmacienController::class, 'showBonLivraison'])->name('bonlivraison.show');
        Route::get('/liste-bons-de-commande', [PharmacienController::class, 'listeTousBonsDeCommande'])->name('pharmacien.listeBonsDeCommande');
        Route::get('/bondecommande/{id}', [PharmacienController::class, 'showBonDeCommande'])->name('bondecommande.show');

    });
    // Route::middleware(['chiefPharmacistMiddleware'])->group(function () {
    //     Route::get('/AjouterBCF', [PharmacienController::class, 'bonCF'])->name('bonCF');
    //     Route::post('/AjouterBCF',[PharmacienController::class,'createBonCommandeFournisseur'])->name('createBonCommandeFournisseur');


    // });
});

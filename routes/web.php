<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DciController;
use App\Http\Controllers\DashboardMedecinController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PharmacienController;


# Admin Auth
Route::get('/admin-auth', '\App\Http\Controllers\AuthController@getAdminAuth')->name('getAdminAuth');
Route::post('/admin-auth', '\App\Http\Controllers\AuthController@postAdminAuth')->name('postAdminAuth');

Route::middleware(['adminMiddleware'])->group(function () {
    # Admin Logout
    Route::get('/logout', '\App\Http\Controllers\AuthController@getAdminLogout')->name('getAdminLogout');
    # Admin Dashboard
    Route::get('/dashboard', '\App\Http\Controllers\DashboardController@getDashboard')->name('getDashboard');

    Route::middleware(['adminMiddleware'])->group(function () {
        Route::get('/users', '\App\Http\Controllers\UserController@getUsers')->name('getUsers');
        Route::get('/add-user', '\App\Http\Controllers\UserController@getAddUser')->name('getAddUser');
        Route::post('/add-user', '\App\Http\Controllers\UserController@postAddUser')->name('postAddUser');

        Route::get('/liste_dci', [DciController::class, 'listeDCI'])->name('liste_dci');
        Route::put('/medecin/dcis/{id}', [DciController::class, 'updateDCI'])->name('updateDCI');
        Route::get('/ajouter-dci', [DciController::class, 'getDCI'])->name('getDCI');
        Route::post('/ajouter-dci', [DciController::class, 'postDCI'])->name('ajouter_dci');
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



    });
});

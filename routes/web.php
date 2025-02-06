<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;

Route::get('/test-auth', function () {
    $email = 'youssef@youssef';
    $password = 'ssss'; // Plain text version of your password

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        return 'Login successful!';
    } else {
        return 'Login failed!';
    }
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', function () {
    return view('Auth');
});

// formulaire d'authentification
Route::post('/auth', [App\Http\Controllers\UtilisateurController::class, 'auth'])->name("Auth");

// Route pour afficher la page de connexion
Route::get('/connect', [App\Http\Controllers\UtilisateurController::class, 'index'])->name('index.connect');

// Route pour traiter la soumission du formulaire de connexion
Route::post('/connect', [App\Http\Controllers\UtilisateurController::class, 'login'])->name('ajouter.login');

// Route pour afficher les détails de réservation
Route::get('/Detailsreservation', [App\Http\Controllers\DetailReservationController::class, 'index'])->name("index");

// Route pour traiter la création d'une réservation
Route::post('/Detailsreservation', [App\Http\Controllers\DetailReservationController::class, 'FaireReservation'])->name("FaireReservation");

// Route pour afficher la table des réservations
Route::get('/Table', [App\Http\Controllers\DetailReservationController::class, 'table'])->name("table");

// Route pour afficher le formulaire de mise à jour d'une réservation
Route::get('/updatedetail/{id}', [App\Http\Controllers\DetailReservationController::class, 'updatedetail'])->name("updatedetail");

// Route pour traiter la mise à jour d'une réservation
Route::post('/update', [App\Http\Controllers\DetailReservationController::class, 'update'])->name("update");

// Route pour supprimer une réservation
Route::get('/deletedetail/{id}', [App\Http\Controllers\DetailReservationController::class, 'deletedetail'])->name("deletedetail");

// Route pour créer une réservation
Route::post('/Table', [App\Http\Controllers\DetailReservationController::class, 'cree_reservation'])->name("cree_reservation");

// Route pour valider le panier
Route::post('/Table', [App\Http\Controllers\DetailReservationController::class, 'validerPanier'])->name("valider.panier");

// Route pour afficher la facture
Route::get('/facture', [App\Http\Controllers\DetailReservationController::class, 'facture'])->name("facture");

Route::get('/contact', [ContactController::class, 'index'])->name('contact');


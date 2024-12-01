<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/test-auth', function () {
    $email = 'youssef@youssef';
    $password = 'ssss'; // Plain text version of your password

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        return 'Login successful!';
    } else {
        return 'Login failed!';
    }
});



Route::get('/auth', function () {
    return view('Auth');
});

Route::post('/auth',[App\Http\Controllers\UtilisateurController::class, 'auth'])->name("Auth");

Route::get ('/connect',[App\Http\Controllers\UtilisateurController::class, 'index'])->name('index.connect');
Route::post('/connect',[App\Http\Controllers\UtilisateurController::class, 'login'])->name('ajouter.login');

Route::post('/Detailsreservation',[App\Http\Controllers\DetailReservationController::class, 'FaireReservation'])->name("FaireReservation");
Route::get('/Detailsreservation',[App\Http\Controllers\DetailReservationController::class, 'index'])->name("index");

Route::get('/Table',[App\Http\Controllers\DetailReservationController::class, 'table'])->name("table");

Route::get('/updatedetail/{id}',[App\Http\Controllers\DetailReservationController::class, 'updatedetail'])->name("updatedetail");

Route::post('/update',[App\Http\Controllers\DetailReservationController::class, 'update'])->name("update");

Route::get('/deletedetail/{id}',[App\Http\Controllers\DetailReservationController::class, 'deletedetail'])->name("deletedetail");
Route::post('/Table',[App\Http\Controllers\DetailReservationController::class, 'cree_reservation'])->name("cree_reservation");

Route::post('/Table',[App\Http\Controllers\DetailReservationController::class, 'validerPanier'])->name("valider.panier");
Route::get('/facture',[App\Http\Controllers\DetailReservationController::class, 'facture'])->name("facture");

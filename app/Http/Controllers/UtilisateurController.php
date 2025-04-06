<?php

namespace App\Http\Controllers;

use session;
use App\Models\Reservation;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\detail_reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UtilisateurController extends Controller
{
    public function index(){
        if(!Auth::user())
        return view('connect');
        else
        return view('welcome');
    }

    
    /**
     * Méthode pour gérer la connexion d'un utilisateur.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('CIN', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
                return back()->with('success', 'Connexion aves success!');
            
        }

        return back()->withErrors(['CIN' => 'CIN ou mot de passe incorrect.'])->withInput();
    }

    /**
     * Méthode pour enregistrer un nouvel utilisateur.
     */
    public function auth(Request $request)
    {
       
        $user = new Utilisateur();
        $user->CIN = $request->input('CIN');
        $user->nom = $request->input('nom');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->password = $request->input('password');
        $user->ADMIN = $request->input('ADMIN', false); // Par défaut non admin
        $user->save();

        return redirect('/connect')->with('success', 'Utilisateur enregistré avec succès.');
    }

    public function disconnect(Request $request){
        
        session()->invalidate();
        auth::logout();
        //session()->regenerateToken();
        return redirect('/');
    }
    
    public function show()
    {   
        // Get the currently authenticated user
        $user = Auth::user();
        // Fetch user's reservations (with details) for the reservations history
        $reservations = DB::table('detail_reservations')
            ->join('reservations', 'detail_reservations.reservation_id', '=', 'reservations.id')
            ->join('factures', 'reservations.facture', '=', 'factures.id')
            ->join('produits', 'detail_reservations.produit_id', '=', 'produits.id')
            ->where('reservations.utilisateur_id', $user->id)
            ->orderBy('reservations.created_at', 'desc')
            ->get();
       
        return view('profil', compact('user', 'reservations'));
    }
}

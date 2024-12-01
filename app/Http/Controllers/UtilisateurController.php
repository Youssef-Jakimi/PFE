<?php

namespace App\Http\Controllers;

use App\Models\utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UtilisateurController extends Controller
{
    /**
     * Méthode pour gérer la connexion d'un utilisateur.
     */
    public function connect(Request $request)
    {
        // Validation des champs
        $validator = Validator::make($request->all(), [
            'CIN' => 'required|string|max:10',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Récupération des données
        $credentials = $request->only('CIN', 'password');

        // Authentification
        if (Auth::attempt($credentials)) {
            // Authentification réussie
            $request->session()->regenerate();

            // Vérification du rôle (par exemple, admin ou utilisateur standard)
            $user = Auth::user();
            if ($user->ADMIN) {
                return redirect('/admin')->with('success', 'Connexion réussie en tant qu\'administrateur.');
            } else {
                return redirect('/dashboard')->with('success', 'Connexion réussie.');
            }
        }

        // Échec de l'authentification
        return back()->withErrors(['CIN' => 'CIN ou mot de passe incorrect.'])->withInput();
    }

    /**
     * Méthode pour enregistrer un nouvel utilisateur.
     */
    public function auth(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'CIN' => 'required|string|max:10|unique:utilisateurs,CIN',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'telephone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Création de l'utilisateur
        $user = new utilisateur();
        $user->CIN = $request->input('CIN');
        $user->nom = $request->input('nom');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->password = Hash::make($request->input('password'));
        $user->ADMIN = $request->input('ADMIN', false); // Par défaut non admin
        $user->save();

        return redirect('/conn')->with('success', 'Utilisateur enregistré avec succès.');
    }
}
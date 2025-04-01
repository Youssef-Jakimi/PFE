<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        

        if(auth()->user()->ADMIN != TRUE) {
            return redirect()->route('welcome');
        }
        // Données principales
        $reservations = DB::table('reservations')->count();
        $produits = DB::table('produits')->count();
        $utilisateurs = DB::table('utilisateurs')->count();
        $factures = DB::table('factures')->sum('Montant_Total');

        // Répartition des produits par catégorie
        $produitsParCategorie = DB::table('produits')
            ->join('categories', 'produits.PR_CATEGORIE', '=', 'categories.id')
            ->select('categories.nom', DB::raw('count(produits.id) as total'))
            ->groupBy('categories.nom')
            ->get();

        // Données pour le graphique linéaire (réservations mensuelles)
        $reservationsMensuelles = DB::table('reservations')
            ->select(DB::raw('MONTH(Date) as mois, COUNT(*) as total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Dernières réservations
        $dernieresReservations = DB::table('reservations')
            ->join('utilisateurs', 'reservations.utilisateur_id', '=', 'utilisateurs.id')
            ->select('reservations.id', 'utilisateurs.nom', 'reservations.Date')
            ->orderBy('reservations.Date', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'reservations',
            'produits',
            'utilisateurs',
            'factures',
            'produitsParCategorie',
            'reservationsMensuelles',
            'dernieresReservations'
        ));
    }
}

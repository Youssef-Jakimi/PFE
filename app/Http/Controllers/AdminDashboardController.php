<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $reservations = DB::table('reservations')->count();
        $produits = DB::table('produits')->count();
        $utilisateurs = DB::table('utilisateurs')->count();
        $factures = DB::table('factures')->sum('Montant_Total');

        return view('admin.dashboard', compact('reservations', 'produits', 'utilisateurs', 'factures'));
    }
}

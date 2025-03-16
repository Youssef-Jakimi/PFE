<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;  // Exemple de modèle, remplacez-le par votre propre modèle
use App\Models\User;        // Exemple de modèle, remplacez-le par votre propre modèle

class AdminController extends Controller
{
    public function index()
    {
        // Exemple de récupération des données depuis la base de données
        $reservationsCount = Reservation::count();
        $usersCount = User::count();

        // Exemple de données pour les graphiques
        $reservationsByMonth = Reservation::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Passer les données à la vue
        return view('admin.dashboard', compact('reservationsCount', 'usersCount', 'reservationsByMonth'));
    }
}

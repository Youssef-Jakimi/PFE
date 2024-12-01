<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{public function store(Request $request)
    {
        $reservation = new Reservation();
        $reservation->produit_id = $request->produit;
        $reservation->id_reserv = $request->id_reserv;
        $reservation->prix = $request->prix;
        $reservation->date_debut = $request->DD;
        $reservation->date_fin = $request->DF;
        $reservation->type = $request->type;
        $reservation->save();
    
        return response()->json(['success' => true]);
    }
    
    public function loadTable($type)
    {
        $details = Reservation::where('type', $type)->get();
        return view('partials.table', compact('details'));
    }
    
}

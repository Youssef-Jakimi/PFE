<?php

namespace App\Http\Controllers;

use App\Models\facture;
use App\Models\produit;
use App\Models\reservation;
use Illuminate\Http\Request;
use App\Models\detail_reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    public function confirmerCommande(request $request){
        $facture = new facture();
        $facture->utilisateur_id = Auth::user()->id;
        $facture->save();

        $total=0;


        $reservation = new reservation();
        $reservation->utilisateur_id=Auth::id();
        $reservation->facture=$facture->id;
        $reservation->save();

        $paniers = DB::table('paniers')->where("utilisateur_id",Auth::id())->get();
        foreach ($paniers as $panier){
            $detail_reservation = new detail_reservation();
            $detail_reservation->reservation_id=$reservation->id;
            $detail_reservation->produit_id=$panier->produit_id;
            $detail_reservation->Prix_Total=$panier->Prix_Total;
            $detail_reservation->Date_D=$panier->Date_D;
            $detail_reservation->Date_F=$panier->Date_F;
            $detail_reservation->save();
            $total = $total + $panier->Prix_Total;
        }
       
        $maxId = DB::table('factures')->where("utilisateur_id", Auth::id())->max('id');
            DB::table('factures')->where('id', $maxId)->update(['Montant_Total' => $total]);
            
            $delete = DB::table('paniers')->where("utilisateur_id",Auth::id())->delete();;
        return redirect("/facture");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $panier = DB::table('paniers')->where("utilisateur_id",Auth::id())->get();
        return view('panier')->with("paniers", $panier);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produit $produit)
    {
        //
    }
}

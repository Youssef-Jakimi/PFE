<?php

namespace App\Http\Controllers;

use App\Models\detail_reservation;
use App\Models\panier;
use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

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
    public function show(detail_reservation $detail_reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detail_reservation $detail_reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $detail_reservation = detail_reservation::find($request->input("id"));
        $detail_reservation->reservation_id=$request->input("id_reserv");
            $detail_reservation->produit_id=$request->input("produit");
            $detail_reservation->prix_Total=$request->input("prix");
            $detail_reservation->Date_D=$request->input("DD");
            $detail_reservation->Date_F=$request->input("DF");

            $detail_reservation->update();
            return redirect("/Table");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletedetail($id)
    {
        $detail= detail_reservation::find($id);
        $detail->delete();
        return redirect("/Table");

    }
    public function FaireReservation(Request $request)
    {
        
            
    
            $panier = new panier();
            $panier->reservation_id=$request->input("id_reserv");
            $panier->produit_id=$request->input("produit");
            $panier->Prix_Total= $request->input("prix");
            $panier->Date_D= $request->input("DD");
            $panier->Date_F=$request->input("DF");
            $panier->save();
        
            // Rediriger vers la page précédente avec les données mises à jour
        
        
            return redirect("/Table");
    }
  
    public function table()
    {
        $panier = DB::table('paniers')
        ->join('produits', 'paniers.produit_id', '=', 'produits.id')
        ->join('categories', 'produits.PR_CATEGORIE', '=', 'categories.id')
        ->select('paniers.id', 'paniers.reservation_id', 'categories.nom', 'paniers.produit_id', 'Prix_Total', 'Date_D', 'Date_F')
        ->get();
        $chambre = $panier->where('nom', '=', 'Chambre');
        $table = $panier->where('nom', '=', 'Table');
        $produit = DB::table('produits')->get();
        //$reservation= DB::table('paniers')->value('reservation_id');

 
        
        return view("tabledetails")->with(['chambres' => $chambre])->with(['tables' => $table])->with(['produits' => $produit]);
    }
    public function updatedetail($id){
        $detail = detail_reservation::find($id);
        return view("update", compact('detail'));
    }
    public function cree_reservation(Request $request){
        $reservation = new reservation();
        $reservation->utilisateur_id=$request->input("user");
        $reservation->save();
        return view("tabledetails");
        
    }
    
    public function validerPanier(Request $request){
        $reservation=$request->input("reservation");
        $paniers = DB::table('paniers')->where("reservation_id",$reservation)->get();
        foreach ($paniers as $panier){
            $detail_reservation = new detail_reservation();
            $detail_reservation->reservation_id=$panier->reservation_id;
            $detail_reservation->produit_id=$panier->produit_id;
            $detail_reservation->Prix_Total=$panier->Prix_Total;
            $detail_reservation->Date_D=$panier->Date_D;
            $detail_reservation->Date_F=$panier->Date_F;
            $detail_reservation->save();
        }
       

        $delete=DB::table('paniers')->where("reservation_id",$reservation)->delete();
        return redirect("/facture"); 
    }

    public function facture()
    {
        $detail_reservation = DB::table('detail_reservations')->get();
 
        return view("facture")->with(['details' => $detail_reservation]);
    }
}

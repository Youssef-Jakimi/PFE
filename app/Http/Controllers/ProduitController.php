<?php

namespace App\Http\Controllers;

use id;
use App\Models\panier;
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
            
            $delete = DB::table('paniers')->where("utilisateur_id",Auth::id())->delete();
        return redirect("/facture");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $panier = DB::table('paniers')
        ->join('produits', 'paniers.produit_id', '=', 'produits.id')
        ->join('categories', 'produits.PR_CATEGORIE', '=', 'categories.id')
        ->select('paniers.id as id', 'categories.nom as name', 'produits.PR_CODE as ref', 'Prix_Total', 'Date_D', 'Date_F')
        ->where("paniers.utilisateur_id","=",Auth::id())
        ->get();


        //$panier = panier::where('utilisateur_id', auth()->id())->get();  // Or whatever your query is

        $total = $panier->sum('Prix_Total');  // Example of calculating the total price
        return view('panier', compact('panier', 'total'));
        }

        public function deleteProduct(Request $request)
        {
            $id = $request->input('produit_id'); // Assuming you're sending the product ID in the request
            $userID = Auth::id();
            $panier = panier::where('utilisateur_id', $userID)->where('id', $id)->first();

            if ($panier) {
                $panier->delete();
                return redirect('/panier')->with('success', 'Product removed from cart successfully.');
            }

            return response()->json(['success' => false, 'message' => 'Product not found or not in your cart.']);
        }


    
}

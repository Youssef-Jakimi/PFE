<?php
namespace App\Http\Controllers;

use App\Models\panier;
use App\Models\produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChambreController extends Controller
{
    public function index()
    {           
        
       $chambre = DB::table('produits')->where('PR_CATEGORIE','=',1)->get();
        return view('chambre')->with('chambres', $chambre);

    }
    public function chambrePanier(request $request){

        $request->validate([
            'dateD' => ['required', 'date', 'after:today'],
            'dateF' => ['required', 'date', 'after:dateD'],
        ]);
        if(Auth::id()!=NULL){
        $userID = Auth::user()->id;
        $panier = new panier();
        $panier->utilisateur_id=$userID;
        $panier->produit_id=$request->input("produit");
        $panier->Prix_Total = produit::where('id', $request->input('produit'))->value('PR_PRIX');
        $panier->Date_D=$request->input("dateD");
        $panier->Date_F=$request->input("dateF");
        $panier->save();
        return redirect("/panier");
        }
        else
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

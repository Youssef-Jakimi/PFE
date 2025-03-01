<?php

namespace App\Http\Controllers;

use App\Models\panier;
use App\Models\produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TablController extends Controller
{
    public function index()
    {           
        
       $table = DB::table('produits')->where('PR_CATEGORIE','=',2)->get();
        return view('tabl')->with('tables', $table);
    }
    public function tablePanier(request $request){
        $request->validate([
            'date' => ['required', 'date', 'after:today'],
        ]);
        if(Auth::id()!=NULL){
        $userID = Auth::user()->id;
        $panier = new panier();
        $panier->utilisateur_id=$userID;
        $panier->produit_id=$request->input("tableSPAProduit");
        $panier->Prix_Total = produit::where('id', $request->input('tableSPAProduit'))->value('PR_PRIX');
        $panier->Date_D=$request->input("date");
        $panier->save();
        return redirect("/panier");
        }
        else
        return redirect()->route('index.connect')->with('not_connected', 'Veuiller se connecter !');
    }
}

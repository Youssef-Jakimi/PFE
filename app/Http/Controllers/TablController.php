<?php

namespace App\Http\Controllers;

use App\Models\panier;
use App\Models\produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TablController extends Controller
{
    public function index()
    {
       
        if(Auth::id()!=NULL)
        return view('tabl')->with('userID', Auth::user()->id);
        else
        return view('tabl');
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
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

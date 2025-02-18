<?php

namespace App\Http\Controllers;

use App\Models\panier;
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

        $userID = Auth::user()->id;
        if($userID!=NULL){
        $panier = new panier();
        $panier->utilisateur_id=$userID;
        $panier->produit_id=$request->input("produit");
        $panier->Date_D=$request->input("date");
        $panier->save();
        return redirect("/Table");
        }
        else
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

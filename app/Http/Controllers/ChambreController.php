<?php
namespace App\Http\Controllers;

use App\Models\panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChambreController extends Controller
{
    public function index()
    {
       
        if(Auth::id()!=NULL)
        return view('chambre')->with('userID', Auth::user()->id);
        else
        return view('chambre');
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
        $panier->Date_D=$request->input("dateD");
        $panier->Date_F=$request->input("dateF");
        $panier->save();
        return redirect("/Table");
        }
        else
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

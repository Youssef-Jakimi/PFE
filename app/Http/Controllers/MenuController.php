<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu');
    }
    
    public function recherche(request $request){
        //if he enters from product pages
        if(!$request->input("dateD")){
        $start = today()->addDay();
        $end = today()->addDay();
        $personne = 1;
        }else{
        //if he searchs
        $start = $request->input("dateD");
        $end = $request->input("dateF");
        $personne = $request->input("adulte") + $request->input("enfant");
        $request->validate([
            'dateD' => ['required', 'date', 'after:today'],
        ]);
        }
    
    // Fetch available products (products that are not booked in the given period)
    $availableProducts = DB::table('produits')
        ->leftJoin('detail_reservations', function($join) use ($start, $end) {
            $join->on('produits.id', '=', 'detail_reservations.produit_id')
                 ->where(function($query) use ($start, $end) {
                     $query->whereBetween('detail_reservations.Date_D', [$start, $end])
                           ->orWhereBetween('detail_reservations.Date_F', [$start, $end])
                           ->orWhere(function($query) use ($start, $end) {
                               $query->where('detail_reservations.Date_D', '<=', $start)
                                     ->where('detail_reservations.Date_F', '>=', $end);
                           });
                 });
        })
        ->whereNull('detail_reservations.produit_id') // Ensures that the product is not booked
        ->where("PR_PERSONNE",">=",$personne)
        ->get('*'); // Return relevant product fields
        return view('recherche', compact('availableProducts'));


    }
}

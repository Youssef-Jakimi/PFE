<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpaController extends Controller
{
    public function index()
    {
        $spa = DB::table('produits')->where('PR_CATEGORIE','=',3)->get();
        return view('spa')->with('spas', $spa);
    }
}

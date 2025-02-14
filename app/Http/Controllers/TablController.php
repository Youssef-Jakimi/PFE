<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablController extends Controller
{
    public function index()
    {
        return view('tabl');
    }
}

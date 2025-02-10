<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index()
    {
        return view('chambre');
    }
}

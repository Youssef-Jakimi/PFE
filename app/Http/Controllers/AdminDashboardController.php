<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\produit;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        

        if(auth()->user()->ADMIN != TRUE) {
            return redirect()->route('welcome');
        }
        // Données principales
        $reservations = DB::table('reservations')->count();
        $produits = DB::table('produits')->count();
        $utilisateurs = DB::table('utilisateurs')->count();
        $factures = DB::table('factures')->sum('Montant_Total');

        // Répartition des produits par catégorie
        $produitsParCategorie = DB::table('produits')
            ->join('categories', 'produits.PR_CATEGORIE', '=', 'categories.id')
            ->select('categories.nom', DB::raw('count(produits.id) as total'))
            ->groupBy('categories.nom')
            ->get();

        // Données pour le graphique linéaire (réservations mensuelles)
        $reservationsMensuelles = DB::table('reservations')
            ->select(DB::raw('MONTH(Date) as mois, COUNT(*) as total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Dernières réservations
        $dernieresReservations = DB::table('reservations')
            ->join('utilisateurs', 'reservations.utilisateur_id', '=', 'utilisateurs.id')
            ->select('reservations.id', 'utilisateurs.nom', 'reservations.Date')
            ->orderBy('reservations.Date', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'reservations',
            'produits',
            'utilisateurs',
            'factures',
            'produitsParCategorie',
            'reservationsMensuelles',
            'dernieresReservations'
        ));
    }


    public function reservations()
{
    if(auth()->user()->ADMIN != TRUE) {
        return redirect()->route('welcome');
    }

    // Reservations data, joining all necessary tables to get full reservation details
    $reservations = DB::table('detail_reservations')
        ->join('reservations', 'detail_reservations.reservation_id', '=', 'reservations.id')
        ->join('produits', 'detail_reservations.produit_id', '=', 'produits.id')
        ->join('factures', 'reservations.facture', '=', 'factures.id')
        ->join('utilisateurs', 'reservations.utilisateur_id', '=', 'utilisateurs.id')
        ->select('reservations.id', 'utilisateurs.nom', 'produits.PR_CODE', 'detail_reservations.Date_D', 'detail_reservations.Date_F', 'produits.PR_PRIX', 'factures.Montant_Total as prix_total')
        ->orderBy('reservations.Date', 'desc') // Order by reservation date in descending order
        ->get();

    // Loop through reservations and calculate total price for each product in the reservation
    foreach ($reservations as $reservation) {
        // Fetch associated products for each reservation (already done by the main query)
        $reservation->products = DB::table('detail_reservations')
            ->join('produits', 'detail_reservations.produit_id', '=', 'produits.id')
            ->where('detail_reservations.reservation_id', '=', $reservation->id)
            ->select('produits.PR_CODE', 'detail_reservations.Date_D', 'detail_reservations.Date_F', 'produits.PR_PRIX')
            ->get();

        // Calculate total price for each product based on the dates
        foreach ($reservation->products as $product) {
            $start_date = \Carbon\Carbon::parse($product->Date_D);
            $end_date = \Carbon\Carbon::parse($product->Date_F);
            $days = $start_date->diffInDays($end_date);
            if (str_starts_with($product->PR_CODE, 'CH') && $days ==0) {
                $product->total_price = $product->PR_PRIX;
            }
            elseif(str_starts_with($product->PR_CODE, 'CH')) {
                $product->total_price = $product->PR_PRIX * $days;
            } 
            else {
                $product->total_price = $product->PR_PRIX;
            }          
        }
    }

    // Fetch data for monthly reservations (as needed for your charts)
    $reservationsMensuelles = DB::table('reservations')
        ->select(DB::raw('MONTH(Date) as mois, COUNT(*) as total'))
        ->whereYear('Date', '=', 2025) // Filter for the year 2025
        ->groupBy(DB::raw('MONTH(Date)'))
        ->orderBy(DB::raw('MONTH(Date)')) // Ensure months are ordered from 1 (January) to 12 (December)
        ->get();

    // Fetch reservations per month period (for the period-based chart)
    $reservationsPerMonthPeriod = DB::table('detail_reservations')
        ->select(DB::raw('MONTH(Date_D) as month, COUNT(*) as total'))
        ->whereYear('Date_D', '=', 2025) // Filter for the year 2025
        ->groupBy(DB::raw('MONTH(Date_D)'))
        ->orderBy(DB::raw('MONTH(Date_D)'), 'desc') // Order by month in descending order
        ->get();

    // Pass all the data to the view
    return view('admin.reservations', compact('reservations', 'reservationsPerMonthPeriod', 'reservationsMensuelles'));
}

    
//********************************************************************************************************** */
public function indexproduit()
{
    if(auth()->user()->ADMIN != TRUE) {
        return redirect()->route('welcome');
    }
    // Fetch all products along with their categories
    $products = DB::table('produits')
        ->join('categories', 'produits.PR_CATEGORIE', '=', 'categories.id')
        ->select('produits.*', 'categories.nom as category_name')
        ->get();

    // Fetch all reservations for products and format dates
    $reservations = DB::table('detail_reservations')
        ->join('produits', 'detail_reservations.produit_id', '=', 'produits.id')
        ->select('produits.id as product_id', 'detail_reservations.Date_D', 'detail_reservations.Date_F')
        ->get()
        ->groupBy('product_id');  // Group reservations by product ID
    // Format dates to YYYY-MM-DD (ISO 8601)
    foreach ($reservations as $productId => $productReservations) {
        foreach ($productReservations as $reservation) {
            $reservation->Date_D = \Carbon\Carbon::parse($reservation->Date_D)->toDateString();
            $reservation->Date_F = \Carbon\Carbon::parse($reservation->Date_F)->toDateString();
        }
    }

    // Fetch product categories for the chart
    $productCategories = DB::table('produits')
        ->join('categories', 'produits.PR_CATEGORIE', '=', 'categories.id')
        ->select('categories.nom', DB::raw('count(produits.id) as total'))
        ->groupBy('categories.nom')
        ->get();

    // Fetch product categories for the form
    $categories = DB::table('categories')->get();

    // Return the view with product, category data, and product categories for the chart
    return view('admin.produits', compact('products', 'categories', 'productCategories', 'reservations'));
}




        // Store a new product
        public function store(Request $request)
        {
            if(auth()->user()->ADMIN != TRUE) {
                return redirect()->route('welcome');
            }

            // Create the new product
            DB::table('produits')->insert([
                'PR_CODE' => strtoupper($request->product_code),  // Product code like 'CH-101'
                'PR_PERSONNE' => $request->capacity,              // Number of people
                'PR_CATEGORIE' => $request->category,             // Category ID
                'PR_PRIX' => $request->price,                     // Product price
            ]);

            // Redirect to the products page with a success message
            return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
        }

        public function deleteProduct(Request $request)
        {
            if(auth()->user()->ADMIN != TRUE) {
                return redirect()->route('welcome');
            }
            $id = $request->input('id'); // Assuming you're sending the product ID in the request
            $produit = produit::where('id', $id)->first();

            if ($produit) {
                $produit->delete();
                return redirect('/admin/products')->with('success', 'Product removed successfully.');
            }

            return response()->json(['success' => false, 'message' => 'Product not found or not in your cart.']);
        }

        public function getProductReservations($productId)
            {
                if(auth()->user()->ADMIN != TRUE) {
                    return redirect()->route('welcome');
                }
                // Fetch reservation details for the given product
                $reservations = DB::table('detail_reservations')
                    ->join('produits', 'detail_reservations.produit_id', '=', 'produits.id')
                    ->where('produits.id', $productId)
                    ->select('detail_reservations.Date_D', 'detail_reservations.Date_F')
                    ->get();

                return response()->json($reservations);
            }

        

//********************************************************************************************************** */
public function indexutilisateur()
    {   
        if(auth()->user()->ADMIN != TRUE) {
            return redirect()->route('welcome');
        }
        // Get all users
        $utilisateurs = Utilisateur::all();

        // Get the number of users registered per month for the chart
        $usersByMonth = Utilisateur::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get()
                            ->pluck('count', 'month')
                            ->toArray();

        return view('admin.utilisateurs', [
            'utilisateurs' => $utilisateurs,
            'usersByMonth' => $usersByMonth
        ]);
    }

    /**
     * Store a new user in the database.
     */
    public function storeutilisateur(Request $request)
    {        

        if(auth()->user()->ADMIN != TRUE) {
            return redirect()->route('welcome');
        }
        if($request->input('admin')== 'on'){
            $admin=1;
        }
        else{
            $admin=0;
        }
        // Validate the incoming data
        $request->validate([
            'nom' => 'required|string|max:255',
            'CIN' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'telephone' => 'nullable|string|max:255',
        ]);
        $user = new Utilisateur();
        $user->CIN = $request->input('CIN');
        $user->nom = $request->input('nom');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->password = $request->input('password');
        $user->ADMIN = $admin;  // Check if user is admin
        $user->save();

        return redirect('/admin/utilisateurs')->with('success', 'Utilisateur enregistré avec succès.');

    }
    



}

<?php
namespace App\Http\Controllers;

use App\Models\panier;
use App\Models\produit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChambreController extends Controller
{
    public function index()
    {           
        
       $chambre = DB::table('produits')->where('PR_CATEGORIE','=',1)->get();
        return view('chambre')->with('chambres', $chambre);

    }
    public function chambrePanier(Request $request)
    {
    if (Auth::id() != NULL) {

        $product = produit::where('PR_CODE', $request->input('product_ID'))->first();
        $userID = Auth::user()->id;

        // Check for overlapping date ranges with the same product
        $existingProduct = panier::where('utilisateur_id', $userID)
            ->where('produit_id', $product->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('Date_D', [$request->input('dateD'), $request->input('dateF')])
                      ->orWhereBetween('Date_F', [$request->input('dateD'), $request->input('dateF')])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('Date_D', '<=', $request->input('dateD'))
                                ->where('Date_F', '>=', $request->input('dateF'));
                      });
            })
            ->first();

        // If a product with overlapping dates exists in the cart, prevent adding the new product
        if ($existingProduct) {
            // Flash message to notify the user
            return redirect('/panier')->with('alert', 'Produit Déja ajouté au panier.');
        }
        

        // Proceed with adding the product to the cart
        $panier = new panier();
        $panier->utilisateur_id = $userID;
        $panier->produit_id = $product->id;

        $stayduration=$request->input('stayDuration');

        if($stayduration==0){
            $stayduration = 1;
        }
        // If it's a "CH" product, calculate total price based on the stay duration
        if (str_starts_with($product->PR_CODE, 'CH')) {
            $panier->Prix_Total = $stayduration * $product->PR_PRIX;
            $panier->Date_D = $request->input('dateD');
            $panier->Date_F = $request->input('dateF');
        } else {
            // For non-"CH" products, use the standard price
            $panier->Prix_Total = $product->PR_PRIX;
            $panier->Date_D = $request->input('dateD');
        }

        // Save the new cart item to the database
        $panier->save();

        return redirect('/panier');
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}


}

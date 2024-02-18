<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    public function addOffre(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'id_produit' => 'required|exists:produits,id',
            'nprix' => 'required|numeric',
        ]);
        $produitId = $request->input('id_produit');
        $prix = $request->input('nprix');

        $offre = new Offre();
        $offre->id_produit = $produitId;
        $offre->prix = $prix;
        $offre->save();

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Offre ajoutée avec succès!');
    }
    public function deleteOffre($id)
    {
        $offre = Offre::find($id);
        if ($offre) {
            $offre->delete();
        }
        return redirect()->back()->with('success', 'Offre supprimée avec succès!');
    }
}

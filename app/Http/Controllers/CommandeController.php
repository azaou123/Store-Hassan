<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function addCommande(Request $request)
    {
        // Validation rules can be adjusted as needed
        $request->validate([
            'listeProduits' => 'required',
            'nomComplet' => 'required',
            'telephone' => 'required',
        ]);
        // Create a new order
        $commande = Commande::create($request->all());
        // Additional logic if needed
        return back()->with('success', 'Order added successfully');
    }

    public function validateCommande(Commande $commande)
    {
        // Validate the command (you can add your own validation logic)
        $commande->statut = 'Validée';
        $commande->save();
        return redirect()->route('commandes')->with('success', 'Commande validated successfully');
    }

    public function deleteCommande(Commande $commande)
    {
        // Validate the command (you can add your own validation logic)
        $commande->statut = 'Supprimée';
        $commande->save();
        return redirect()->route('commandes')->with('success', 'Commande deleted successfully');
    }

    public function discardCommande(Commande $commande)
    {
        /// Validate the command (you can add your own validation logic)
        $commande->statut = 'Archivée';
        $commande->save();
        return redirect()->route('commandes')->with('success', 'Commande validated successfully');
    }
}
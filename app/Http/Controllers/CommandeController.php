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
        return back()->with('successCommande', true);
    }

    public function filterCommands(Request $request)
    {
        if ($request->ajax()) {
            $statut = $request->input('statut');

            // Filter commands based on the selected status
            if ($statut === 'all') {
                $commands = Commande::orderBy('created_at', 'desc')->get();
            } else {
                $commands = Commande::where('statut', $statut)->orderBy('created_at', 'desc')->get();
            }

            // Return the filtered commands as a JSON response
            return response()->json([
                'commands' => $commands
            ]);
        }
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
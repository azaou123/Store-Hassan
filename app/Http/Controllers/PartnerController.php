<?php

// app/Http/Controllers/PartnerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partenaire;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{

    // Function to add a new partner 
    public function addPartner(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/partners/'.time(), 'public');
        }

        // Create a new opinion
        Partenaire::create([
            'label' => $request->input('name'),
            'logo' => $photoPath,
        ]);

        return back()->with('success', 'Partenaire ajouté ave succés!');
    }

    // Function to delete an existion partner 
    public function destroy($id)
    {
        $partenaire = Partenaire::find($id);

        if (!$partenaire) {
            return back()->with('error', "Parteanire n'est pas trouvé !");
        }

        // Delete associated photo file
        if (!empty($partenaire->logo)) {
            Storage::delete($partenaire->logo);
        }

        $partenaire->delete();

        return back()->with('success', 'Partenaire est supprimé avec succès.');
    }
}

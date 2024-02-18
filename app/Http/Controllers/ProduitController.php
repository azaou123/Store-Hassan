<?php

// In ProduitController.php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Parametre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;


class ProduitController extends Controller
{
    public function index()
    {
        // Your index logic here
    }



    public function create()
    {
        $categories = Categorie::all();
        $nbr = Commande::where('statut', '=', 'Envoyée')->count();
        return view('dashboard.produits.create', compact('categories', 'nbr'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'oldPrice' => 'required',
            'price' => 'required',
            'description' => 'required',
            'id_categorie' => 'required|exists:categories,id', // Ensure the selected category exists
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif',
            'fiche_tech' => 'file|mimes:pdf,doc,docx|max:2048', // Adjust allowed file types as needed
        ]);

        // Create the product
        $product = Produit::create([
            'label' => $request->label,
            'oldPrice' => $request->oldPrice,
            'price' => $request->price,
            'description' => $request->description,
            'id_categorie' => $request->id_categorie,
            'repPhotos' => '',
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            $productPhotosPath = 'uploads/produits/' . $product->id;
            foreach ($request->file('photos') as $photo) {
                $path = $photo->storeAs($productPhotosPath, $photo->getClientOriginalName(), 'public');
            }
            // Update the product's repPhotos field with the directory name
            $product->repPhotos = $productPhotosPath;
            $product->save();
        }

        // Handle fiche_tech
        if ($request->hasFile('fiche_tech')) {
            $ficheTechPath = $productPhotosPath; // Save in the same directory as photos
            $ficheTechName = uniqid('fiche_') . '.' . $request->file('fiche_tech')->getClientOriginalExtension();
            $request->file('fiche_tech')->storeAs($ficheTechPath, $ficheTechName, 'public');
            $product->fiche_tech = $ficheTechPath . '/' . $ficheTechName;
            $product->save();
        }

        return redirect()->route('produits')->with('success', 'Product created successfully');
    }




    public function search(Request $request)
    {
        $searchResults = Produit::where('label', 'like', '%' . $request->searchInput . '%')
            ->where('id_categorie', '=', $request->cat)
            ->get();

        foreach ($searchResults as $result) {
            // Get the folder path for repPhotos
            $folderPath = public_path('storage/' . $result->repPhotos);

            // Get all image files in the folder
            $imageFiles = File::allFiles($folderPath);

            // Set the first image path in a new column
            $result->firstImage = count($imageFiles) > 0 ? asset('storage/' . $result->repPhotos . '/' . $imageFiles[0]->getFilename()) : null;
        }

        $searchResultsPrime = Produit::where('label', 'like', '%' . $request->searchInput . '%')
            ->where('id_categorie', '!=', $request->cat)
            ->get();

        foreach ($searchResultsPrime as $result) {
            // Get the folder path for repPhotos
            $folderPath = public_path('storage/' . $result->repPhotos);

            // Get all image files in the folder
            $imageFiles = File::allFiles($folderPath);

            // Set the first image path in a new column
            $result->firstImage = count($imageFiles) > 0 ? asset('storage/' . $result->repPhotos . '/' . $imageFiles[0]->getFilename()) : null;
        }

        // Return both sets of results as JSON
        return response()->json([
            'searchResults' => $searchResults,
            'searchResultsPrime' => $searchResultsPrime
        ]);
    }


    public function filter(Request $request)
    {
        $category = $request->filterCategorie;

        if ($category == 'all') {
            // Handle case when no specific category is selected
            $filteredResults = Produit::all();

            // Add firstImage attribute to each result
            foreach ($filteredResults as $result) {
                $this->addFirstImageAttribute($result);
            }
        } else {
            // Handle case when a specific category is selected
            $filteredResults = Produit::where('id_categorie', $category)->get();

            // Add firstImage attribute to each result
            foreach ($filteredResults as $result) {
                $this->addFirstImageAttribute($result);
            }
        }

        return response()->json(['filteredResults' => $filteredResults]);
    }

    private function addFirstImageAttribute($result)
    {
        // Get the folder path for repPhotos
        $folderPath = public_path('storage/' . $result->repPhotos);

        // Get all image files in the folder
        $imageFiles = File::allFiles($folderPath);

        // Set the first image path in a new column
        $result->firstImage = count($imageFiles) > 0 ? asset('storage/' . $result->repPhotos . '/' . $imageFiles[0]->getFilename()) : null;
    }



    public function show(Produit $produit)
    {
        // Get products from the same category
        $categoryProducts = [];
        $categoryProducts = Produit::where('id_categorie', $produit->id_categorie)
            ->where('id', '!=', $produit->id) // Exclude the current product
            ->get();
        // Get 4 products with names similar to the given product
        $similarNameProducts = [];
        $similarNameProducts = Produit::where('label', 'like', '%' . $produit->label . '%')
            ->where('id', '!=', $produit->id) // Exclude the current product
            ->limit(4)
            ->get();
        $categories = Categorie::all();
        $nbr = Commande::where('statut', '=', 'Envoyée')->count();
        return view('dashboard.produits.show', compact('produit', 'categories', 'categoryProducts', 'similarNameProducts', 'nbr'));
    }

    public function produitDetails(Produit $produit)
    {
        $categoryProducts = [];
        $categoryProducts = Produit::where('id_categorie', $produit->id_categorie)
            ->where('id', '!=', $produit->id) // Exclude the current product
            ->get();
        // Get 4 products with names similar to the given product
        $similarNameProducts = [];
        $similarNameProducts = Produit::where('label', 'like', '%' . $produit->label . '%')
            ->where('id', '!=', $produit->id) // Exclude the current product
            ->limit(4)
            ->get();
        $parametres = Parametre::first();
        return view('produit', compact('produit', 'parametres', 'categoryProducts', 'similarNameProducts'));
    }



    public function destroy(Produit $produit)
    {
        // Get the path to the product's photos directory
        $productPhotosPath = 'uploads/produits/' . $produit->id;
        // Delete the directory and its contents
        Storage::disk('public')->deleteDirectory($productPhotosPath);
        // Delete the product
        $produit->delete();
        return redirect()->route('produits')->with('success', 'Product deleted successfully');
    }

    public function update(Request $request)
    {

        // Validate the incoming request data
        $request->validate([
            'label' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'oldPrice' => 'nullable|numeric',
            'nbrAchats' => 'required|numeric',
            'id_categorie' => 'required|exists:categories,id',
            'productPhotos.*' => 'nullable',
        ]);
        $produit = Produit::where('id', '=', $request->id)->first();

        // Update the product information
        $produit->label = $request->input('label');
        $produit->description = $request->input('description');
        $produit->price = $request->input('price');
        $produit->oldPrice = $request->input('oldPrice');
        $produit->nbrAchats = $request->input('nbrAchats');
        $produit->id_categorie = $request->input('id_categorie');

        // Check if new fiche_tech is provided
        if ($request->hasFile('fiche_tech')) {
            // Store the new fiche_tech and delete the old one if it exists
            $fichePath = $request->file('fiche_tech')->store('fiches', 'public');

            // If the existing fiche_tech exists, delete it
            if ($produit->fiche_tech) {
                Storage::disk('public')->delete($produit->fiche_tech);
            }

            // Update the produit's fiche_tech field with the new path
            $produit->fiche_tech = $fichePath;
        } elseif (!$request->hasFile('productPhotos') && $produit->fiche_tech) {
            // If no new fiche_tech is provided, and no new productPhotos are provided, keep the existing fiche_tech
            $fichePath = $produit->fiche_tech;
        }

        // Check if new photos are provided
        if ($request->hasFile('productPhotos')) {
            // Delete old photos if they exist
            $folderPath = public_path('storage/' . $produit->repPhotos);

            // Check if the directory exists before attempting deletion
            if (File::exists($folderPath)) {
                // Get all files in the directory
                $imageFiles = File::allFiles($folderPath);

                // Delete each file
                foreach ($imageFiles as $photo) {
                    File::delete($photo->getPathname());
                }
            }

            // Store the new photos
            $newPhotos = $request->file('productPhotos');
            $produitPhotosPath = 'uploads/produits/' . $produit->id;
            foreach ($newPhotos as $photo) {
                $photoPath = $photo->storeAs($produitPhotosPath, $photo->getClientOriginalName(), 'public');
            }

            // Update the produit's repPhotos field with the directory name
            $produit->repPhotos = $produitPhotosPath;
        }

        // Save the changes
        $produit->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product updated successfully');
    }


    public function deletePhoto(Request $request)
    {
        $produit = Produit::findOrFail($request->idProd); // Use findOrFail to handle model not found
        $folderPath = public_path('storage/' . $produit->repPhotos);

        // Check if the directory exists before attempting deletion
        if (File::exists($folderPath)) {
            // Get all files in the directory
            $imageFiles = File::allFiles($folderPath);

            // Delete the specified file
            $orderPhoto = $request->orderPhoto - 1; // Adjust order to array index
            if (isset($imageFiles[$orderPhoto])) {
                File::delete($imageFiles[$orderPhoto]->getPathname());
            }
        }

        return redirect()->back()->with('success', 'Photo deleted successfully');
    }

    public function deleteFicheTechnique(Request $request)
    {
        $produit = Produit::findOrFail($request->idp); // Use findOrFail to handle model not found
        $folderPath = public_path('storage/' . $produit->repPhotos);
        // Check if the directory exists before attempting deletion
        if (File::exists($folderPath)) {
            // Get all PDF files in the directory
            $pdfFiles = File::glob($folderPath . '/*.pdf');
            // Delete all PDF files
            foreach ($pdfFiles as $pdfFile) {
                File::delete($pdfFile);
            }
        }
        $produit->fiche_tech = "";
        $produit->save();
        return redirect()->back()->with('success', 'Fiche Technique est Supprimé Avec Succès .');
    }

}

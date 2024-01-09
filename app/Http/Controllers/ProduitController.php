<?php

// In ProduitController.php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function index()
    {
        // Your index logic here
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('dashboard.produits.create',['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'description' => 'required',
            'id_categorie' => 'required|exists:categories,id', // Ensure the selected category exists
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the product
        $product = Produit::create([
            'label' => $request->label,
            'description' => $request->description,
            'id_categorie' => $request->id_categorie,
            'oldPrice' => 0, // Add your logic for oldPrice and price
            'price' => 0,
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

        return redirect()->route('produits')->with('success', 'Product created successfully');
    }

    public function show(Produit $produit)
    {
        return view('dashboard.produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        // Your edit logic here
    }

    public function update(Request $request, Produit $produit)
    {
        // Your update logic here
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
}

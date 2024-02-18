<?php

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{


    public function create()
    {
        $nbr = Commande::where('statut', '=', 'Envoyée')->count();
        return view('dashboard.categories.create', compact('nbr'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'description' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the category
        $category = Categorie::create([
            'label' => $request->label,
            'description' => $request->description,
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            $categoryPhotosPath = 'uploads/categories/' . $category->id;
            foreach ($request->file('photos') as $photo) {
                $path = $photo->storeAs($categoryPhotosPath, $photo->getClientOriginalName(), 'public');
            }

            // Update the category's repPhotos field with the directory name
            $category->repPhotos = $categoryPhotosPath;
            $category->save();
        }

        return redirect()->route('categories')->with('success', 'Category created successfully');
    }


    public function update(Request $request, Categorie $category)
    {
        // Validate the incoming request data
        $request->validate([
            'label' => 'required|string',
            'description' => 'required|string',
            'categoryPhotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the category information
        $category->label = $request->input('label');
        $category->description = $request->input('description');

        // Check if new photos are provided
        if ($request->hasFile('categoryPhotos')) {
            // Delete old photos if they exist
            $folderPath = public_path('storage/' . $category->repPhotos);

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
            $newPhotos = $request->file('categoryPhotos');
            $categoryPhotosPath = 'uploads/categories/' . $category->id;
            foreach ($newPhotos as $photo) {
                $photoPath = $photo->storeAs($categoryPhotosPath, $photo->getClientOriginalName(), 'public');
            }

            // Update the category's repPhotos field with the directory name
            $category->repPhotos = $categoryPhotosPath;
        }

        // Save the changes
        $category->save();

        // Redirect back with a success message
        return redirect()->route('categories.show', $category->id)->with('success', 'Category updated successfully');
    }


    public function destroy(Categorie $category)
    {
        $category->delete();
        File::deleteDirectory('storage/' . $category->repPhotos);
        $produits = Produit::where('id_categorie', '=', $category->id)->get();
        foreach ($produits as $produit) {
            echo '<script> alert("ok") </script>';
        }
        return back()->with('success', 'Category deleted successfully');
    }

    public function show(Categorie $category)
    {
        $nbr = Commande::where('statut', '=', 'Envoyée')->count();
        return view('dashboard.categories.show', compact('category', 'nbr'));
    }


}


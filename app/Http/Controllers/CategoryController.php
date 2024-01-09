<?php

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    

    public function create()
    {
        return view('dashboard.categories.create');
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


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Validate the request
        $request->validate([
            'label' => 'required',
            // Add other validation rules as needed
        ]);

        // Update the category
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        // Get the path to the category's photos directory
        $categoryPhotosPath = 'uploads/categories/' . $category->id;

        // Delete the directory and its contents
        Storage::disk('public')->deleteDirectory($categoryPhotosPath);

        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

    public function show(Categorie $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }
}


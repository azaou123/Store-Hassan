<?php
// app/Http/Controllers/OpinionController.php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpinionController extends Controller
{
   

    public function create()
    {
        return view('opinions.create');
    }

    public function addOpinion(Request $request)
    {
        // Validate the request
        $request->validate([
            'opinion' => 'required',
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/opinions/'.time(), 'public');
        }

        // Create a new opinion
        Opinion::create([
            'opinion' => $request->input('opinion'),
            'name' => $request->input('name'),
            'photo' => $photoPath,
        ]);

        return back()->with('success', 'Opinion added successfully!');
    }


    public function destroy($id)
    {
        $opinion = Opinion::find($id);

        if (!$opinion) {
            return back()->with('error', 'Opinion not found.');
        }

        // Delete associated photo file
        if (!empty($opinion->photo)) {
            Storage::delete($opinion->photo);
        }

        $opinion->delete();

        return back()->with('success', 'Opinion deleted successfully.');
    }
}

<?php

// app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YourModel; // Replace YourModel with the actual model you want to search

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchInput');

        // Perform your search logic here
        $results = YourModel::where('column_name', 'like', '%' . $searchTerm . '%')->get();

        return view('search.results', ['results' => $results]);
    }
}


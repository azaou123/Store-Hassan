<?php

// app/Http/Controllers/ManagerController.php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Message;
use App\Models\Opinion;
use App\Models\Partenaire;
use App\Models\Parametre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{

    public function index()
    {
        $perPage = 8;
        $produits = Produit::paginate($perPage);
        $categories = Categorie::all();
        $opinions = Opinion::all();
        $partenaires = Partenaire::all();
        $parametres = Parametre::first();
        return view('index', compact('produits', 'categories', 'opinions', 'partenaires', 'parametres'));
    }
    public function about()
    {
        $perPage = 8;
        $produits = Produit::paginate($perPage);
        $categories = Categorie::all();
        $opinions = Opinion::all();
        $partenaires = Partenaire::all();
        $parametres = Parametre::first();
        return view('about', compact('produits', 'categories', 'opinions', 'partenaires', 'parametres'));
    }



    public function dashboord(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $manager = Manager::where('email', $request->email)->where('password', $request->password)->first();
        if ($manager) {
            Session::put('manager', $manager);
            return $this->profile();
        } else {
            return back()->with('failLogin', 'Les Coordonnées Entrées Sont Invalides !');
        }
    }

    public function profile()
    {
        if (Session::has('manager')) {
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            $tables = DB::select('SHOW TABLES');
            // Extract the table names from the result
            $tableNames = array_map('current', json_decode(json_encode($tables), true));

            // Fetch the content of each table
            $tableData = [];
            foreach ($tableNames as $tableName) {
                $tableData[$tableName] = DB::table($tableName)->get();
            }
            return view('dashboard.index', compact('nbr', 'tableData'));
        }

        return back();
    }
    public function logout()
    {
        Session::forget('manager');
        return redirect('/')->with('success', 'Logout successful');
    }

    public function commandes()
    {
        if (Session::has('manager')) {
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            $commands = Commande::orderBy('created_at', 'desc')->get();
            $produits = Produit::all();
            return view('dashboard.commandes', compact('commands', 'produits', 'nbr'));
        }
        return back();
    }
    public function getFilteredCommands(Request $request)
    {
        $selectedStatut = $request->input('statut');
        $commands = Commande::where('statut', 'Envoyée')->orderBy('created_at', 'desc')->get();
        return response()->json(['filteredData' => $commands]);
    }
    public function categories()
    {
        if (Session::has('manager')) {
            $categories = Categorie::all();
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            return view('dashboard.categories', compact('categories', 'nbr'));
        }
        return back();
    }
    public function produits()
    {
        if (Session::has('manager')) {
            $produits = Produit::all();
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            return view('dashboard.produits', compact('produits', 'nbr'));
        }
        return back();
    }
    public function opinions()
    {
        if (Session::has('manager')) {
            $opinions = Opinion::all();
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            return view('dashboard.opinions', compact('opinions', 'nbr'));
        }
        return back();
    }
    public function partenaires()
    {
        if (Session::has('manager')) {
            $partenaires = Partenaire::all();
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            return view('dashboard.partenaires', compact('partenaires', 'nbr'));
        }
        return back();
    }
    public function parametres()
    {
        if (Session::has('manager')) {
            $parametres = Parametre::first();
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            return view('dashboard.parametres', compact('parametres', 'nbr'));
        }
        return back();
    }

    public function messages()
    {
        if (Session::has('manager')) {
            $messages = Message::orderBy('created_at', 'desc')->get();
            $nbr = Commande::where('statut', '=', 'Envoyée')->count();
            return view('dashboard.messages', compact('messages', 'nbr'));
        }
        return back();
    }



    public function update(Request $request)
    {
        $parametre = Parametre::first();

        // Validate the request data
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'facebook' => 'required|string|max:255',
            'twitter' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'insta' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'googlemaps' => 'required|string|max:255',
            // Add more validation rules for other fields as needed
        ]);

        // Handle file upload for logo
        if ($request->hasFile('logo')) {
            // Delete existing logo
            if ($parametre->logo) {
                Storage::disk('public')->delete($parametre->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $parametre->logo = $logoPath;
        }

        // Update other fields
        $parametre->facebook = $request->input('facebook');
        $parametre->twitter = $request->input('twitter');
        $parametre->email = $request->input('email');
        $parametre->insta = $request->input('insta');
        $parametre->whatsapp = $request->input('whatsapp');
        $parametre->googlemaps = $request->input('googlemaps');
        $parametre->address = $request->input('address');
        // Add more fields as needed

        $parametre->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }


    public function contact(Request $request)
    {
        $request->validate([
            'nomComplet' => 'required|string|max:255',
            'telephone' => 'required|max:255',
            'message' => 'required|string',
        ]);
        $message = new Message();
        $message->nomComplet = $request->nomComplet;
        $message->telephone = $request->telephone;
        $message->message = $request->message;
        $message->save();
        return back()->with('success', 'Your message has been sent!');
    }
}


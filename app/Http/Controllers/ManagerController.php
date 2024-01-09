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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManagerController extends Controller
{

    public function index(){
        $produits = Produit::all();
        $categories = Categorie::all();
        $opinions = Opinion::all();
        $partenaires = Partenaire::all();
        return view('index',compact('produits','categories','opinions','partenaires'));
    }

    public function dashboord(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $manager = Manager::where('email', $request->email)->where('password', $request->password)->first();
        if ($manager){
            Session::put('manager',$manager);
            return $this->profile();
        }  
        else {
            return back()->with('failLogin','Les Coordonnées Entrées Sont Invalides !');
        }
    }

    public function profile(){
        if (Session::has('manager')){
            return view('dashboard.index');
        }
        else {
            return back();  
        }
        return back(); 
    }
    public function commandes(){
        if (Session::has('manager')){
            $commands = Commande::all();
            $produits = Produit::all();
            return view('dashboard.commandes' , compact('commands','produits'));
        }
        else {
            return back();  
        }
        return back(); 
    }
    public function categories(){
        if (Session::has('manager')){
            $categories = Categorie::all();
            return view('dashboard.categories',compact('categories'));
        }
        else {
            return back();  
        }
        return back(); 
    }
    public function produits(){
        if (Session::has('manager')){
            $produits = Produit::all();
            return view('dashboard.produits',compact('produits'));
        }
        else {
            return back();  
        }
        return back(); 
    }
    public function opinions(){
        if (Session::has('manager')){
            $opinions = Opinion::all();
            return view('dashboard.opinions',compact('opinions'));
        }
        else {
            return back();  
        }
        return back(); 
    }
    public function partenaires(){
        if (Session::has('manager')){
            $partenaires = Partenaire::all();
            return view('dashboard.partenaires',compact('partenaires'));
        }
        else {
            return back();  
        }
        return back(); 
    }
    public function parametres(){
        if (Session::has('manager')){
            return view('dashboard.parametres');
        }
        else {
            return back();  
        }
        return back(); 
    }


    public function contact(Request $request)
    {
        $request->validate([
            'nomComplet' => 'required|string|max:255',
            'telephone' => 'required|max:255',
            'message' => 'required|string',
        ]);
        $message = new Message();
        $message->nomComplet = $request->nomComplet ;
        $message->telephone = $request->telephone ;
        $message->message = $request->message ;
        $message->save();
        return back()->with('success', 'Your message has been sent!');
    }
}


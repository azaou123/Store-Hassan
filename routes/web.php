<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ParametreController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ManagerController::class, 'index'])->name('index');
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/search', [ProduitController::class, 'search'])->name('search');
Route::get('/filter', [ProduitController::class, 'filter'])->name('filter');
Route::get('/about', [ManagerController::class, 'about'])->name('about');
Route::get('/contactpage', [ManagerController::class, 'contactpage'])->name('contactpage');
Route::get('/lesoffres', [ManagerController::class, 'lesoffres'])->name('lesoffres');
Route::get('/prodCat/{id}', [ManagerController::class, 'prodCat'])->name('prodCat');
Route::post('/contact', [ManagerController::class, 'contact'])->name('contact');
Route::get('/produit-details/{produit}', [ProduitController::class, 'produitDetails'])->name('produitdetails');
Route::post('/dashboord', [ManagerController::class, 'dashboord'])->name('dashboord');
Route::post('addCommande', [CommandeController::class, 'addCommande'])->name('addCommande');





Route::group(['middleware' => 'manager'], function () {

    // Manager Auth Routes 

    Route::get('/profile', [ManagerController::class, 'profile'])->name('profile');
    Route::get('/logout', [ManagerController::class, 'logout'])->name('logout');
    Route::get('/messages', [ManagerController::class, 'messages'])->name('messages');
    //************************************* Categories ****************************************************************
    Route::get('/categories', [ManagerController::class, 'categories'])->name('categories');
    // View a specific category
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::patch('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    // Create a new category (show create form)
    Route::get('/categories.create', [CategoryController::class, 'create'])->name('categories.create');
    // Store a new category
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories.destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    //************************************* Produits ****************************************************************//
    Route::get('/produits', [ManagerController::class, 'produits'])->name('produits');
    Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
    Route::post('/produits/search', [ProduitController::class, 'search'])->name('produits.search');
    Route::get('/produits.create', [ProduitController::class, 'create'])->name('produits.create');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::post('/produits/{category}', [ProduitController::class, 'update'])->name('produits.update');
    Route::post('/deletePhoto/', [ProduitController::class, 'deletePhoto'])->name('deletePhoto');
    Route::post('/delete.ficheTechnique/', [ProduitController::class, 'deleteFicheTechnique'])->name('delete.ficheTechnique');
    Route::get('produits.destroy/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');
    // ************************************************ Commandes **********************************************************
    Route::get('/commandes', [ManagerController::class, 'commandes'])->name('commandes');
    Route::get('commande.validate/{commande}', [CommandeController::class, 'validateCommande'])->name('commande.validate');
    Route::get('commande.delete/{commande}', [CommandeController::class, 'deleteCommande'])->name('commande.delete');
    Route::get('commande.discard/{commande}', [CommandeController::class, 'discardCommande'])->name('commande.discard');
    Route::get('/filter-commands', [CommandeController::class, 'filterCommands'])->name('filter.commands');
    // **************************************** Opinions *******************************************
    Route::get('/opinions', [ManagerController::class, 'opinions'])->name('opinions');
    Route::post('addOpinion', [OpinionController::class, 'addOpinion'])->name('addOpinion');
    Route::delete('/opinions/{id}', [OpinionController::class, 'destroy'])->name('opinions.destroy');
    // **************************************** Partenaire *************************************
    Route::get('/partenaires', [ManagerController::class, 'partenaires'])->name('partenaires');
    Route::post('addPartner', [PartnerController::class, 'addPartner'])->name('addPartner');
    Route::delete('/partenaires/{id}', [PartnerController::class, 'destroy'])->name('partenaires.destroy');
    // ****************************** Les Paramètres **********************************
    Route::get('/parametres', [ManagerController::class, 'parametres'])->name('parametres');
    Route::post('parametres/update', [ManagerController::class, 'update'])->name('parametres.update');
    Route::put('/managers/{id}', [ManagerController::class, 'updateinfo'])->name('manager.update');
    // ***************************** Offres ********************************************
    Route::get('/offres', [ManagerController::class, 'offres'])->name('offres');
    Route::post('addOffre', [OffreController::class, 'addOffre'])->name('addOffre');
    Route::delete('/delete-offre/{id}', [OffreController::class, 'deleteOffre'])->name('deleteOffre');

});





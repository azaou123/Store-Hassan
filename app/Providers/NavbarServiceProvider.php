<?php

namespace App\Providers;

// app/Providers/NavbarServiceProvider.php

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Parametre;

class NavbarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Use view composer to share data with the navbar view
        View::composer('*', function ($view) {
            $parametres = Parametre::first(); // Adjust based on your model
            $view->with('parametres', $parametres);
        });
    }

    public function register()
    {
        //
    }
}


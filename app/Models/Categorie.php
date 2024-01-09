<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'description', 'repPhotos'];

    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_categorie');
    }
}

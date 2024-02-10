<?php
// In Produit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'description', 'repPhotos', 'oldPrice', 'price', 'id_categorie', 'fech_tech'];
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }
    public function getLabel()
    {
        return $this->label;
    }
}

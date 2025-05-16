<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduit extends Model
{
    use SoftDeletes;

    protected $fillable = ['nom','description']; // Make sure the 'nom' field is fillable

    // Relationship with Produit (one-to-many)
    public function produits()
    {
        return $this->hasMany(Produit::class); // A category can have many products
    }
}

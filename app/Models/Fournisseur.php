<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;  // <-- This import is important!
use Illuminate\Database\Eloquent\SoftDeletes;
class Fournisseur extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nom', 'telephone', 'mobile', 'email'];
    protected $dates = ['deleted_at'];

    // Define the relationship with the Produit model (assuming multiple products per fournisseur)
    // Fournisseur.php model
public function produits()
{
    return $this->hasMany(Produit::class);
}
// In Fournisseur.php Model
public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

public function purchaseLines()
{
    return $this->hasManyThrough(PurchaseLine::class, Purchase::class, 'fournisseur_id', 'purchase_id');
}


}

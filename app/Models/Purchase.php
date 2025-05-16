<?php
    namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Adding fields to fillable to allow mass assignment
    protected $fillable = ['fournisseur_id', 'purchase_date', 'total_price'];

    // Automatically cast date fields to Carbon instances
    protected $dates = ['purchase_date'];

    /**
     * A purchase has many purchase lines.
     * Define the relationship with PurchaseLine.
     */
    public function purchaseLines()
    {
        return $this->hasMany(PurchaseLine::class);
    }

    /**
     * A purchase belongs to a fournisseur.
     * Define the relationship with Fournisseur.
     */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    /**
     * A purchase has many facture purchases.
     * Define the relationship with FacturePurchase.
     */
    public function facturePurchases()
    {
        return $this->hasMany(FacturePurchase::class);
    }

    /**
     * A purchase has many taxes.
     * Define the relationship with Tax.
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * Override the save method to ensure the purchase is saved properly.
     * (Optional: if you want to modify saving behavior)
     */
    public static function boot()
    {
        parent::boot();

        // You can define some actions that occur before saving or after saving.
        static::creating(function ($purchase) {
            // Add logic for when creating a new purchase, if necessary.
        });
    }
    

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'purchase_lines')
                    ->withPivot('quantity', 'unit_price', 'total_price')
                    ->withTimestamps();
    }
}

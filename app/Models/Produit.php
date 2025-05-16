<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Produit extends Model
{    use SoftDeletes;

    protected $fillable = [
        'nom',
        'type',
        'prix',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(CategoryProduit::class, 'category_id');
    }
    public function salles()
    {
        return $this->belongsToMany(Salle::class, 'salle_produit');
    }
    public function demandeReservationServices()
    {
        return $this->hasMany(DemandeReservationService::class);
    }
    public function purchaseLines()
    {
        return $this->hasMany(PurchaseLine::class, 'produit_id');
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_lines')
                    ->withPivot('quantity', 'unit_price', 'total_price')
                    ->withTimestamps();
    }
    
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseLine extends Model
{
    protected $fillable = ['purchase_id', 'produit_id', 'quantity', 'unit_price', 'total_price'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'produit_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}

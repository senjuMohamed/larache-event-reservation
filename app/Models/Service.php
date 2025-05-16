<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['produit_id', 'salle_id', 'description', 'prix'];

    // Inverse One-to-many relationship with Produit (A service belongs to one produit)
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    // One-to-many inverse relationship with Salle
    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id'); // A service belongs to one salle
    }
}

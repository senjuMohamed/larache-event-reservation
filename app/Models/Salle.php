<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'capacite',
        'prix',
        'produit_id',
    ];

    protected $dates = ['deleted_at'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'salle_produit');
    }
    public function DemandeReservation()
    {
        return $this->hasMany(DemandeReservation::class);
    }
    public function getSallesJson()
    {
        return response()->json(Salle::all());
    }
}
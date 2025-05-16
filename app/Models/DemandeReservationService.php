<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeReservationService extends Model
{
    protected $fillable = ['demande_reservation_id', 'produit_id'];

    public function demandeReservation()
    {
        return $this->belongsTo(DemandeReservation::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}

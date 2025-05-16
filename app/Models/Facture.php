<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = ['demande_id', 'paiement_id', 'montant_total', 'date_emission', 'statut'];

    public function demandeReservation()
    {
        return $this->belongsTo(DemandeReservation::class);
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
}


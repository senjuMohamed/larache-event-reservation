<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $table = 'paiements';

    // Specify fillable fields
    protected $fillable = ['montant', 'date_paiement', 'origine'];

    protected $casts = [
        'date_paiement' => 'datetime',
    ];

    public static $origines = ['reservation', 'purchase'];

    /**
     * A payment is associated with a single FactureReservation (if applicable)
     */
    public function factureReservation()
    {
        return $this->hasOne(FactureReservation::class, 'paiement_id');
    }

    /**
     * A payment is associated with a single FacturePurchase (if applicable)
     */
    public function facturePurchase()
    {
        return $this->hasOne(FacturePurchase::class, 'paiement_id');
    }
    public static function getNextMontant()
    {
        // Get the last Paiement record ordered by the most recent
        $lastPaiement = self::orderBy('id', 'desc')->first();
        
        // If there is a last paiement, increment its montant
        if ($lastPaiement) {
            return $lastPaiement->montant + 1;  // Incrementing the last montant by 1
        }

        // If no paiements exist, return 1 as the first montant
        return 1;
    }
    /**
     * Get the associated facture dynamically (either reservation or purchase).
     */
    public function facture()
    {
        return $this->factureReservation ?? $this->facturePurchase;
    }
}

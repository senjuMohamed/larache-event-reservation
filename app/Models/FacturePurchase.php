<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturePurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant_total',
        'montant_paye',
        'reste',
        'statut',
        'purchase_id',
        'paiement_id',  // Add paiement_id to fillable to store the reference to the paiement
        // Add purchase_id to fillable to store the reference to the purchase
    ];

    protected $casts = [
        'date_emission' => 'datetime',  // Automatically cast to Carbon instance
    ];

    // Relationship with Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    // Relationship with Paiement
    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'paiement_id');
    }

    // Optionally, calculate remaining amount
    public function calculateRemainingAmount()
    {
        return $this->montant_total - $this->montant_paye;
    }

    // Method to create FacturePurchase with Paiement
    public static function createWithPaiement(array $data, $purchaseId)
{
    // Ensure montant_paye is valid
    $montant = $data['montant_paye'] ?? 0;  

    // Find the Purchase record (or reservation if purchase does not exist)
    $purchase = Purchase::find($purchaseId);
    if (!$purchase) {
        // You might need to handle creating or retrieving a reservation here if needed
        // Example: $purchase = Reservation::find($purchaseId); 
    }

    // Determine the source of the payment
    $origine = ($purchase) ? 'purchase' : 'reservation';  // Adjust logic for reservation if necessary

    // Create Paiement first
    $paiement = Paiement::create([
        'montant' => $montant,
        'date_paiement' => now(),
        'origine' => $origine,  // Add the origine here
    ]);

    // Ensure paiement_id is not NULL
    if (!$paiement->id) {
        throw new \Exception("Failed to create Paiement. paiement_id is NULL.");
    }

    // Create FacturePurchase
    return self::create([
        'paiement_id' => $paiement->id,
        'purchase_id' => $purchaseId,
        'montant_total' => $purchase ? $purchase->total_price : 0,  // Handle for reservation if needed
        'montant_paye' => $montant,
        'reste' => ($purchase ? $purchase->total_price : 0) - $montant,
        'statut' => ($montant == ($purchase ? $purchase->total_price : 0)) ? 'payé' : 'partiellement payé',
    ]);
}

    
    

}


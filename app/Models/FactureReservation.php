<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'demande_id',  // Foreign key to the DemandeReservation model
        'montant_total',
        'montant_paye',
        'reste',
        'statut',
    ];

    // Relationship with DemandeReservation
    public function demandeReservation()
{
    return $this->belongsTo(DemandeReservation::class, 'demande_id'); // Make sure to use the correct foreign key if needed
}
public function paiement()
{
    return $this->belongsTo(Paiement::class, 'paiement_id');
}



    // Optionally, you can ensure timestamps are automatically handled
    public $timestamps = true;
    public static function createWithPaiement($data,$demande_id)
{
    // Get next montant based on the last paiement's montant
    $montant = Paiement::getNextMontant();

    // Create the Paiement record first
    $paiement = Paiement::create([
        'demande_id' => $demande_id,  // Ensure the demande_id is set
        'montant' => $montant,
        'date_paiement' => now(),
    ]);

    // Create the FactureReservation record with the paiement_id
    $data['paiement_id'] = $paiement->id;
    return self::create($data);
}

}

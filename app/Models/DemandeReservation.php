<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeReservation extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'demande_reservations'; // Explicitly define the table if needed

    protected $fillable = ['client_id', 'event_id', 'salle_id', 'status', 'date_reservation'];

    protected $casts = [
        'date_reservation' => 'datetime',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class)->withoutTrashed();
    }

    public function event()
    {
        return $this->belongsTo(Event::class)->withoutTrashed();
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class)->withoutTrashed();
    }

    public function factureReservations()
    {
        return $this->hasMany(FactureReservation::class, 'demande_id');
    }

    // If 'paiement' is no longer relevant, remove this method
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
    public function demandeReservationServices()
    {
        return $this->hasMany(DemandeReservationService::class);
    }
}


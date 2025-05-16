<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalleServices extends Model
{
    use SoftDeletes;

    protected $table = 'salle_services'; // Only needed if the table name doesn't follow Laravel's convention
    protected $fillable = ['salle_id', 'service_id', 'prix'];

    // Relationship to Salle
    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function demandeReservation()
    {
        return $this->belongsTo(DemandeReservation::class);
    }

    // Automatically calculate 'prix' on create
    protected static function booted()
    {
        static::creating(function ($salleService) {
            // Fetch the salle and the service
            $salle = $salleService->salle;
            $service = $salleService->service;

            // Ensure both salle and service are present
            if ($salle && $service) {
                // Calculate the price as the sum of the salle's price and the service's price
                $salleService->prix = $salle->prix + $service->prix;
            }
        });
    }
}


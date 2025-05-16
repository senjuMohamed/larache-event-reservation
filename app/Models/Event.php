<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'start_date', 'end_date'];
    protected $dates = ['deleted_at']; // Optional, but ensures 'deleted_at' is treated as a date
    public function DemandeReservation()
{
    return $this->hasMany(DemandeReservation::class);
}
public function getEventsJson()
    {
        return response()->json(Event::all());
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SalleProduit extends Pivot
{
    protected $table = 'salle_produit';

    protected $fillable = [
        'salle_id',
        'produit_id',
    ];
}
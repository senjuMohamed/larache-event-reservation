<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caise extends Model {
    use HasFactory;

    protected $fillable = ['montant', 'type', 'date_operation'];

    protected $dates = ['date_operation'];
}


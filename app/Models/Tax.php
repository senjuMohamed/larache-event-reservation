<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['amount'];

    /**
     * A tax can be applied to multiple purchases.
     */
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_tax')
                    ->withPivot('amount')
                    ->withTimestamps();
    }
}

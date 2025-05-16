<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('clients', function (Blueprint $table) {
        $table->id(); // PK
        $table->string('nom_complet');
        $table->string('email')->unique();
        $table->string('telephone');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
class Client extends Model
{
    use HasFactory;

    protected $fillable = ['nom_complet', 'email', 'telephone'];

    public function demandesReservation()
    {
        return $this->hasMany(DemandeReservation::class);
    }
}

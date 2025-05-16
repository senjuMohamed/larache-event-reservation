<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeReservationServiceTable extends Migration
{
    public function up()
    {
        Schema::create('demande_reservation_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_reservation_id')->constrained('demande_reservations')->onDelete('cascade');
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demande_reservation_service');
    }
}

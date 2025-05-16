<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('facture_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained('demande_reservations')->onDelete('cascade'); 
            $table->decimal('montant_total', 10, 2);
            $table->decimal('montant_paye', 10, 2);
            $table->decimal('reste', 10, 2);
            $table->enum('statut', ['payé', 'non payé', 'partiellement payé']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facture_reservations');
    }
};

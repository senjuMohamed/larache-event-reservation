<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->enum('origine', ['reservation', 'purchase']);
            $table->decimal('montant', 10, 2);
            $table->string('statut'); // Example values: 'payé', 'non payé', 'partially payé'
            $table->timestamp('date_paiement')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiements');
    }
};

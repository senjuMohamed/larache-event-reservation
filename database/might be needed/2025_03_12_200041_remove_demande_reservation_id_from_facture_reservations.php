<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('facture_reservations', function (Blueprint $table) {
            // Drop the incorrect column
            $table->dropColumn('demande_reservation_id');
        });
    }

    public function down()
    {
        Schema::table('facture_reservations', function (Blueprint $table) {
            // Optionally, add the column back (if needed)
            $table->unsignedBigInteger('demande_reservation_id')->nullable();
        });
    }
};

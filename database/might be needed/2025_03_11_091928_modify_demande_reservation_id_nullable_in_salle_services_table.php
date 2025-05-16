<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDemandeReservationIdNullableInSalleServicesTable extends Migration
{
    public function up()
    {
        Schema::table('salle_services', function (Blueprint $table) {
            // Make the 'demande_reservation_id' column nullable
            $table->unsignedBigInteger('demande_reservation_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('salle_services', function (Blueprint $table) {
            // Rollback the change if necessary (set it back to non-nullable)
            $table->unsignedBigInteger('demande_reservation_id')->nullable(false)->change();
        });
    }
}

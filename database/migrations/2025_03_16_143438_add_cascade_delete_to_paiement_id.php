<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeDeleteToPaiementId extends Migration
{
    public function up()
    {
        // Update facture_reservations table
        Schema::table('facture_reservations', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['paiement_id']);
            // Add the foreign key constraint with cascade delete
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade');
        });

        // Update facture_purchases table
        Schema::table('facture_purchases', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['paiement_id']);
            // Add the foreign key constraint with cascade delete
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Rollback the changes if needed (remove cascade)
        Schema::table('facture_reservations', function (Blueprint $table) {
            $table->dropForeign(['paiement_id']);
            $table->foreign('paiement_id')->references('id')->on('paiements');
        });

        Schema::table('facture_purchases', function (Blueprint $table) {
            $table->dropForeign(['paiement_id']);
            $table->foreign('paiement_id')->references('id')->on('paiements');
        });
    }
}

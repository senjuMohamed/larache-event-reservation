<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaiementIdToFacturePurchasesAndFactureReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add 'paiement_id' to 'facture_purchases'
        Schema::table('facture_purchases', function (Blueprint $table) {
            $table->foreignId('paiement_id')->nullable()->constrained('paiements')->onDelete('set null');
        });

        // Add 'paiement_id' to 'facture_reservations'
        Schema::table('facture_reservations', function (Blueprint $table) {
            $table->foreignId('paiement_id')->nullable()->constrained('paiements')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop 'paiement_id' from 'facture_purchases'
        Schema::table('facture_purchases', function (Blueprint $table) {
            $table->dropForeign(['paiement_id']);
            $table->dropColumn('paiement_id');
        });

        // Drop 'paiement_id' from 'facture_reservations'
        Schema::table('facture_reservations', function (Blueprint $table) {
            $table->dropForeign(['paiement_id']);
            $table->dropColumn('paiement_id');
        });
    }
}

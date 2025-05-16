<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('facture_reservations', function (Blueprint $table) {
            $table->foreignId('demande_reservation_id')->constrained('demande_reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facture_reservations', function (Blueprint $table) {
            $table->dropForeign(['demande_reservation_id']);
            $table->dropColumn('demande_reservation_id');
        });
    }
};

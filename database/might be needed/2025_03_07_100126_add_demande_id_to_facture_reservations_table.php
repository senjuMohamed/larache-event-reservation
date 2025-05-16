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
    Schema::table('facture_reservations', function (Blueprint $table) {
        $table->unsignedBigInteger('demande_id')->nullable(); // Add the foreign key column
        $table->foreign('demande_id')->references('id')->on('demande_reservations')->onDelete('cascade'); // Create foreign key
    });
}

public function down()
{
    Schema::table('facture_reservations', function (Blueprint $table) {
        $table->dropForeign(['demande_id']);
        $table->dropColumn('demande_id');
    });
}

};

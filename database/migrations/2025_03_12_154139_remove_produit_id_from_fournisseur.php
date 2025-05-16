<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProduitIdFromFournisseur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['produit_id']); // Make sure the correct column is passed

            // Drop the produit_id column
            $table->dropColumn('produit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            // Add the produit_id column back
            $table->unsignedBigInteger('produit_id')->nullable();

            // Re-add the foreign key constraint
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        });
    }
}

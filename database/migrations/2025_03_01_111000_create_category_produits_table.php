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
        // Create category_produits table
        Schema::create('category_produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();  // Category name (French)
            $table->timestamps();
        });

        // Add category_id to produits table
        Schema::table('produits', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            $table->foreign('category_id')->references('id')->on('category_produits')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Remove the foreign key first
        Schema::table('produits', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        // Drop category_produits table
        Schema::dropIfExists('category_produits');
    }
};

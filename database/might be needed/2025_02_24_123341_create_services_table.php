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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produit_id');
            $table->unsignedBigInteger('salle_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('salle_id')->references('id')->on('salles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

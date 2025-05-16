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
    Schema::dropIfExists('services');
}

public function down()
{
    // Optionally, you can recreate the table if needed
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('produit_id');
        $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
        $table->text('description');
        $table->decimal('prix', 10, 2);
        $table->softDeletes();
        $table->timestamps();
    });
}

};

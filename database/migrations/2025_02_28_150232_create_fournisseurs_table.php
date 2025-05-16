<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->string('contact');
            $table->string('telephone');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('fournisseurs');
    }
};

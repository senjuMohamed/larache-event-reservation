<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('demande_reservations', function (Blueprint $table) {
            $table->enum('status', ['demande', 'confirme', 'annulee'])->default('demande')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demande_reservations', function (Blueprint $table) {
            $table->string('status')->change(); // Revert to the previous data type if needed
        });
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('facture_purchases', function (Blueprint $table) {
            $table->dropColumn('taxe'); // Removes the 'taxe' column
        });
    }

    public function down()
    {
        Schema::table('facture_purchases', function (Blueprint $table) {
            $table->decimal('taxe', 10, 2)->nullable(); // Re-add the column if needed
        });
    }
};

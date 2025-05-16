<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('facture_purchases', function (Blueprint $table) {
            $table->dropColumn('date_emission'); // Removes the 'date_emission' column
        });
    }

    public function down()
    {
        Schema::table('facture_purchases', function (Blueprint $table) {
            $table->timestamp('date_emission')->nullable(); // Re-add the column if needed
        });
    }
};

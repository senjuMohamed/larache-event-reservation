<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn('statut');
        });
    }

    public function down()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->string('statut')->nullable(); // Re-add the column if rolled back
        });
    }
};

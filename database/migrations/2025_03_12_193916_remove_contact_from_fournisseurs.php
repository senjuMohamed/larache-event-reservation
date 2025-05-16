<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->dropColumn('contact'); // Removes the 'contact' column
        });
    }

    public function down()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->string('contact')->nullable(); // Re-add the column if needed
        });
    }
};

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
    Schema::table('salle_services', function (Blueprint $table) {
        $table->softDeletes();  // Adds the 'deleted_at' column
    });
}

public function down()
{
    Schema::table('salle_services', function (Blueprint $table) {
        $table->dropSoftDeletes();  // Drops the 'deleted_at' column
    });
}

};

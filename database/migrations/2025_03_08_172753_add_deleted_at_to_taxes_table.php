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
    Schema::table('taxes', function (Blueprint $table) {
        $table->softDeletes(); // Adds the 'deleted_at' column for soft deletes
    });
}

public function down()
{
    Schema::table('taxes', function (Blueprint $table) {
        $table->dropSoftDeletes(); // Drops the 'deleted_at' column if rolled back
    });
}
};

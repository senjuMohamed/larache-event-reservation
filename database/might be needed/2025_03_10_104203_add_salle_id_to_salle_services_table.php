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
        $table->unsignedBigInteger('salle_id')->after('id'); // Add salle_id
        $table->unsignedBigInteger('service_id')->after('salle_id'); // Add service_id
        
        // Add foreign keys
        $table->foreign('salle_id')->references('id')->on('salles')->onDelete('cascade');
        $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('salle_services', function (Blueprint $table) {
        $table->dropForeign(['salle_id']);
        $table->dropForeign(['service_id']);
        
        $table->dropColumn('salle_id');
        $table->dropColumn('service_id');
    });
}

    };

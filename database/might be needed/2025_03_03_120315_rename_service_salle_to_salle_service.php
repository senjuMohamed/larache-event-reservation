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
    Schema::rename('service_salle', 'salle_service');
}

public function down()
{
    Schema::rename('salle_service', 'service_salle');
}

};

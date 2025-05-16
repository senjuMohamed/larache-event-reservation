<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrixToSalleServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salle_services', function (Blueprint $table) {
            $table->decimal('prix', 8, 2)->after('service_id');  // Add the 'prix' column after 'service_id' column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salle_services', function (Blueprint $table) {
            $table->dropColumn('prix');
        });
    }
}

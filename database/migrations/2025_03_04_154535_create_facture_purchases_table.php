<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('facture_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->onDelete('cascade'); // Foreign key for the purchase
            $table->decimal('montant_total', 10, 2);  // Total amount of the facture
            $table->decimal('montant_paye', 10, 2);   // Paid amount
            $table->decimal('reste', 10, 2);  // Remaining amount
            $table->decimal('taxe', 5, 2);  // Tax value (between 20 and 100)
            $table->enum('statut', ['payé', 'non payé', 'partiellement payé']);  // Status of the payment
            $table->date('date_emission');  // Date of issuance of the facture
            $table->timestamps();  // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('facture_purchases');
    }
}

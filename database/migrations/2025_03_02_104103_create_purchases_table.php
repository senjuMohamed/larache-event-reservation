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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('fournisseur_id')
                ->constrained() // Automatically refers to 'fournisseurs' table
                ->onDelete('cascade') // Ensures that deleting a fournisseur deletes related purchases
                ->onUpdate('cascade'); // Ensures that updates to fournisseur_id cascade
            $table->date('purchase_date'); // Nullable if you need it
            $table->decimal('total_price', 10, 2)->default(0); // Default value for total_price
            $table->timestamps(); // Created and Updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

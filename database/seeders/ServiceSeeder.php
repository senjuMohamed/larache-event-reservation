<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Service;
use App\Models\Salle;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $produits = Produit::where('type', 'Service')->get();

        if ($produits->isEmpty()) {
            echo "No products of type 'Service' found. Please add some before seeding.\n";
            return;
        }

        $salle = Salle::first(); // Get any salle

        foreach ($produits as $produit) {
            Service::create([
                'produit_id' => $produit->id,
                'salle_id' => $salle ? $salle->id : null, // Avoid accessing null salle
                'description' => "Service for " . ($produit->nom ?? 'Unknown'),
            ]);
        }
    }
}

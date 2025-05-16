<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\DemandeReservation;
use App\Models\SalleService;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Create a reservation
        $reservation = DemandeReservation::create([
            'client_id' =>2 ,  // Replace with actual client ID
            'event_id' => 1,   // Replace with actual event ID
            'salle_id' =>2 ,   // Replace with actual salle ID
            'status' => 'pending',
            'date_reservation' => now(),
        ]);

        // Link salle services to the reservation
        SalleService::create([
            'salle_id' => 3,  
            'service_id' => 4, 
            'prix' => 100.00,  
            'demande_id' => $reservation->id, // Important!
        ]);

        SalleService::create([
            'salle_id' => 2,  
            'service_id' => 5, 
            'prix' => 1500.00,  
            'demande_id' => $reservation->id, // Important!
        ]);

        echo "Seeding completed successfully!";
    }
}

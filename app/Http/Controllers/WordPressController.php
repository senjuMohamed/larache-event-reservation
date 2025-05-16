<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Salle;
use App\Models\Produit;
use App\Models\Client;
use Carbon\Carbon;
use App\Models\DemandeReservation;

class WordPressController extends Controller
{
    // Method to fetch events, salles, and salle_produit (services)
    public function fetchData()
    {
        // Fetch events, salles, and the associated produits (services) via the pivot table
        $events = Event::all();  // Fetch all events
        $salles = Salle::with('produits')->get();  // Eager load associated products (services)
        $csrfToken = csrf_token();  // Get CSRF token from Laravel

        // Return the data as a JSON response
        return response()->json([
            'events' => $events,
            'salles' => $salles->map(function ($salle) {
                return [
                    'id' => $salle->id,
                    'nom' => $salle->nom,
                    'produits' => $salle->produits->map(function ($produit) {
                        return [
                            'id' => $produit->id,
                            'name' => $produit->nom,  // Assuming 'name' is the product name
                            'price' => $produit->prix, // Assuming 'price' is the product price
                        ];
                    })
                ];
            }),
            'csrfToken' => $csrfToken,  // Include CSRF token in the response
        ]);
    }

    // Method to store client data
    public function storeClientData(Request $request)
    {
        // Uncomment and adjust validation if needed
        $validatedData = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string',
            'mobile' => 'nullable|string',
            'event' => 'nullable|exists:events,id',
            'salle' => 'nullable|exists:salles,id',
            'service' => 'nullable|exists:produits,id', // Change to 'produits,id' if needed
        ]);
        
        // $validatedData['status'] = $validatedData['status'] ?? 'pending'; // Default status: 'pending'
        // $validatedData['date_reservation'] = $validatedData['date_reservation'] ?? now();
        // Store client data logic (if validation is uncommented)
        $client = Client::create([
            'nom_complet' => $validatedData['nom_complet'],
            'email' => $validatedData['email'] ?? null,
            'telephone' => $validatedData['telephone'] ?? null,
            'mobile' => $validatedData['mobile'] ?? null,
        ]);
            DemandeReservation::create([
                'client_id'        => $client->id,
                'event_id'         => $request->event,
                'salle_id'         => $request->salle,
                'status'           => 'demande',
                'date_reservation' =>$request->date_reservation
            ]);

        // Response for successful data saving
        return response()->json(['message' => 'Client data saved successfully!'])
              ->header('Access-Control-Allow-Origin', '*')  // Adjust to your frontend's URL
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    }
    // Laravel controller snippet to send booked dates
public function getUnavailableDates(Request $request)
{
    $salleId = $request->input('salle_id');
    $bookedDates = DemandeReservation::where('salle_id', $salleId)
                               ->pluck('date_reservation')
                               ->toArray(); // Example of fetching booked dates

    return response()->json([
        'status' => 'success',
        'booked_dates' => $bookedDates
    ]);
}

}

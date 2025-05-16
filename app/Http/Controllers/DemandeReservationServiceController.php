<?php

namespace App\Http\Controllers;

use App\Models\DemandeReservationService;
use App\Models\DemandeReservation;
use App\Models\Produit;
use Illuminate\Http\Request;

class DemandeReservationServiceController extends Controller
{
    /**
     * Display a listing of the reservation services based on each produit.
     */
    public function index()
    {
        // Get all reservation services with their associated reservation and produit
        $reservationServices = DemandeReservationService::with(['demandeReservation', 'produit'])->get();

        return view('demande_reservation_services.index', compact('reservationServices'));
    }

    /**
     * Show the form for creating a new reservation service.
     */
    public function create()
    {
        // Fetch all products to display in a dropdown
        $produits = Produit::all();

        return view('demande_reservation_services.create', compact('produits'));
    }

    /**
     * Store a newly created reservation service in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'client_id'        => 'required|exists:clients,id',
        'event_id'         => 'required|exists:events,id',
        'salle_id'         => 'required|exists:salles,id',
        'status'           => 'required|string',
        'date_reservation' => 'required|date',
        'produits'         => 'required|array', // Validate that at least one produit is selected
    ]);

    $demandeReservation = DemandeReservation::create([
        'client_id'        => $request->client_id,
        'event_id'         => $request->event_id,
        'salle_id'         => $request->salle_id,
        'status'           => $request->status,
        'date_reservation' => $request->date_reservation,
    ]);

    // Attach selected produits to the new reservation
    foreach ($request->produits as $produitId) {
        DemandeReservationService::create([
            'demande_reservation_id' => $demandeReservation->id,
            'produit_id'             => $produitId,
        ]);
    }

    return redirect()->route('demandereservation.index')
        ->with('success', 'Demande de réservation créée avec succès.');
}


    /**
     * Show the form for editing the specified reservation service.
     */
    public function edit(DemandeReservationService $demandeReservationService)
    {
        // Fetch all products to display in a dropdown
        $produits = Produit::all();

        return view('demande_reservation_services.edit', compact('demandeReservationService', 'produits'));
    }

    /**
     * Update the specified reservation service in storage.
     */
    public function update(Request $request, DemandeReservationService $demandeReservationService)
    {
        $request->validate([
            'demande_reservation_id' => 'required|exists:demande_reservations,id',
            'produit_id' => 'required|exists:produits,id',
        ]);

        // Update the reservation service
        $demandeReservationService->update([
            'demande_reservation_id' => $request->demande_reservation_id,
            'produit_id' => $request->produit_id,
        ]);

        return redirect()->route('demande_reservation_services.index')->with('success', 'Reservation Service updated successfully.');
    }

    /**
     * Remove the specified reservation service from storage.
     */
    public function destroy(DemandeReservationService $demandeReservationService)
    {
        $demandeReservationService->delete();

        return redirect()->route('demande_reservation_services.index')->with('success', 'Reservation Service deleted successfully.');
    }
}

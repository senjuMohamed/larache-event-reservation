<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeReservation;
use App\Models\Client;
use App\Models\Event;
use App\Models\Salle;
use App\Models\Produit;
use App\Models\FactureReservation;

class DemandeReservationController extends Controller
{
    // Display a list of all demandes
    public function index()
    {
        $demandes = DemandeReservation::with(['client', 'event', 'salle'])->get();
        return view('demandereservation.index', compact('demandes'));
    }

    // Show a specific demande
    public function show($id)
    {
        $demandeReservation = DemandeReservation::with([
            'client', 
            'event', 
            'salle.produits', 
            'factureReservations'
        ])->findOrFail($id);
    
        // Calculate the total price:
        $prixTotal = 0;
        if ($demandeReservation->salle) {
            $prixSalle    = $demandeReservation->salle->prix;
            $prixProduits = $demandeReservation->salle->produits->sum('prix');
            $prixTotal    = $prixSalle + $prixProduits;
        }
    
        return view('demandereservation.show', compact('demandeReservation', 'prixTotal'));
    }

    // Create a new demande
    public function create()
{
    $clients = Client::all();
    $events  = Event::all();
    $salles  = Salle::all();
    $produits = []; // Default, empty products array

    return view('demandereservation.create', compact('clients', 'events', 'salles', 'produits'));
}

public function store(Request $request)
{
    $request->validate([
        'client_id'        => 'required|exists:clients,id',
        'event_id'         => 'required|exists:events,id',
        'salle_id'         => 'required|exists:salles,id',
        'status'           => 'required|string',
        'date_reservation' => 'required|date',
    ]);

    // Get the salle and its associated products
    $salle = Salle::with('produits')->findOrFail($request->salle_id);
    $produits = $salle->produits; // Get products for selected salle

    // Create the demande reservation
    DemandeReservation::create([
        'client_id'        => $request->client_id,
        'event_id'         => $request->event_id,
        'salle_id'         => $request->salle_id,
        'status'           => $request->status,
        'date_reservation' => $request->date_reservation,
    ]);

    return redirect()->route('demandereservation.index')
        ->with('success', 'Demande de réservation créée avec succès.');
}


    // Edit an existing demande
    public function edit(DemandeReservation $demandereservation)
    {
        $clients = Client::all();
        $events  = Event::all();
        $salles  = Salle::all();
        $produits = $demandereservation->salle ? $demandereservation->salle->produits : [];

        return view('demandereservation.edit', compact('demandereservation', 'clients', 'events', 'salles', 'produits'));
    }

    // Update an existing demande
    public function update(Request $request, DemandeReservation $demandereservation)
    {
        $request->validate([
            'event_id'         => 'required|exists:events,id',
            'salle_id'         => 'required|exists:salles,id',
            'status'           => 'required|string',
            'date_reservation' => 'required|date',
        ]);

        $demandereservation->update([
            'event_id'         => $request->event_id,
            'salle_id'         => $request->salle_id,
            'status'           => $request->status,
            'date_reservation' => $request->date_reservation,
        ]);

        return redirect()->route('demandereservation.index')
            ->with('success', 'Demande mise à jour avec succès.');
    }

    // Delete an existing demande
    public function destroy(DemandeReservation $demandereservation)
    {
        $demandereservation->delete();

        return redirect()->route('demandereservation.index')
            ->with('success', 'Demande supprimée avec succès.');
    }

    // Soft delete (archive) demandes
    public function archive()
    {
        $demandes = DemandeReservation::onlyTrashed()->get();
        return view('demandereservation.archive', compact('demandes'));
    }

    // Restore a soft-deleted demande
    public function restore($id)
    {
        $demande = DemandeReservation::withTrashed()->findOrFail($id);
        $demande->restore();

        return redirect()->route('demandereservation.archive')
            ->with('success', 'Demande restaurée avec succès.');
    }

    // Permanently delete a soft-deleted demande
    public function forceDelete($id)
    {
        $demande = DemandeReservation::withTrashed()->findOrFail($id);
        $demande->forceDelete();

        return redirect()->route('demandereservation.archive')
            ->with('success', 'Demande supprimée définitivement.');
    }

    // Display only soft-deleted demandes (trashed)
    public function trashed()
    {
        $demandes = DemandeReservation::onlyTrashed()->get();
        return view('demandereservation.trashed', compact('demandes'));
    }

    // Fetch products by Salle ID (No JS, handled in view)
    public function getProduitsBySalle($salleId)
    {
        $salle = Salle::with('produits')->findOrFail($salleId);
        $produits = $salle->produits->map(function ($produit) {
            return [
                'id' => $produit->id,
                'nom' => $produit->nom,
            ];
        });

        return response()->json(['produits' => $produits]);
    }
}

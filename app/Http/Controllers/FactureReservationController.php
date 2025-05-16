<?php
namespace App\Http\Controllers;

use App\Models\FactureReservation;
use App\Models\DemandeReservation;
use Illuminate\Http\Request;

class FactureReservationController extends Controller
{
    public function create(DemandeReservation $demande, Request $request)
    {
        // Calculate the total price from the demande
        $prixTotal = 0;
        // Use first() to get the first matching Salle instead of get()
        $demande = DemandeReservation::where('id', '=', $request->demande)->first();

        // Check if a salle is found
        if ($demande) {
            $prixSalle = $demande->salle->prix;
            $prixProduits = $demande->salle->produits->sum('prix');
            $prixTotal = $prixSalle + $prixProduits;
        }
        return view('facture_reservations.create', compact('demande', 'prixTotal'));
    }

    public function index()
    {
        return redirect()->route('demandereservation.index');
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'montant_paye' => 'required|numeric|min:0|max:' . $request->total,
            'total' => 'required|numeric|min:0',
            'demande_id' => 'required|exists:demande_reservations,id',  // Validate demande_id exists
        ]);
    
        // Get values from the form
        $montantPaye = $request->montant_paye;
        $total = $request->total;
        $demandeId = $request->demande_id;  // Ensure you are passing the correct demande_id
    
        // Determine payment status
        $statut = 'non payé';
        if ($montantPaye == $total) {
            $statut = 'payé';
        } elseif ($montantPaye > 0 && $montantPaye < $total) {
            $statut = 'partiellement payé';
        }
    
        // Calculate remaining balance (reste)
        $reste = $total - $montantPaye;
    
        // Create the facture using the `createWithPaiement` method or directly
        $facture = FactureReservation::create([
            'demande_id' => $demandeId,  // Ensure demande_id is correctly passed
            'montant_total' => $total,
            'montant_paye' => $montantPaye,
            'reste' => $reste,
            'statut' => $statut,
        ]);
    
        // Check if facture creation was successful
        if ($facture) {
            return redirect()->route('demandereservation.index')->with('success', 'Facture created successfully!');
        } else {
            return back()->with('error', 'Failed to create the facture.');
        }
    }
    

    public function show($id)
    {
        $factures_reservation = FactureReservation::findOrFail($id); // Fetch the facture reservation
        return view('facture_reservations.show', compact('factures_reservation')); // Pass the variable to the view
    }
}

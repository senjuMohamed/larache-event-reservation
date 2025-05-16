<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\FactureReservation;
use App\Models\FacturePurchase;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Afficher la liste des factures groupées par origine.
     */
    public function index(Request $request)
{
    $origine = $request->input('origine');  // Get the selected origine
    
    // Filter factures based on the selected origine
    $facturesReservation = FactureReservation::whereNotNull('paiement_id')
        ->when($origine === 'reservation', function ($query) {
            return $query->with('paiement');
        })
        ->get();
        
    $facturesPurchase = FacturePurchase::whereNotNull('paiement_id')
        ->when($origine === 'purchase', function ($query) {
            return $query->with('paiement');
        })
        ->get();

    $factures = [
        'reservation' => $facturesReservation,
        'purchase' => $facturesPurchase
    ];

    return view('paiements.index', compact('factures', 'origine'));
}


    /**
     * Afficher le formulaire de création d'un paiement.
     */
    public function create()
    {
        return view('paiements.create');
    }

    /**
     * Enregistrer un nouveau paiement dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'origine' => 'required|in:reservation,purchase',
            'facture_id' => 'required|integer',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        // Créer le paiement
        $paiement = Paiement::create([
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement
        ]);

        // Associer le paiement à la bonne facture
        if ($request->origine === 'reservation') {
            $facture = FactureReservation::find($request->facture_id);
            if ($facture) {
                $facture->update(['paiement_id' => $paiement->id]);
            } else {
                return back()->with('error', 'La facture de réservation spécifiée est introuvable.');
            }
        } else {
            $facture = FacturePurchase::find($request->facture_id);
            if ($facture) {
                $facture->update(['paiement_id' => $paiement->id]);
            } else {
                return back()->with('error', 'La facture d\'achat spécifiée est introuvable.');
            }
        }

        return redirect()->route('paiements.index')->with('success', 'Paiement ajouté avec succès.');
    }

    /**
     * Afficher le formulaire d'édition d'un paiement existant.
     */
    public function edit(Paiement $paiement)
    {
        return view('paiements.edit', compact('paiement'));
    }

    /**
     * Mettre à jour un paiement existant.
     */
    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
        ]);

        $paiement->update($request->all());

        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy($id)
{
    $paiement = Paiement::findOrFail($id);
    
    // Manually nullify associated facture if it exists
    if ($paiement->factureReservation) {
        // Nullify the paiement_id instead of deleting the entire FactureReservation
        $paiement->factureReservation->update(['paiement_id' => null]);
    }
    
    if ($paiement->facturePurchase) {
        $paiement->facturePurchase->update(['paiement_id' => null]);
    }
    
    // Now delete the paiement
    $paiement->delete();
    
    return redirect()->route('purchases.index')->with('success', 'Paiement deleted successfully!');
}   
}

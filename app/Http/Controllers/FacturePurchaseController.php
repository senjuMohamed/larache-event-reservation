<?php
namespace App\Http\Controllers;

use App\Models\FacturePurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;

class FacturePurchaseController extends Controller
{
    // Show the form to create a facture for a specific purchase
    public function create(Purchase $purchase)
    {
        return view('facture_purchases.create', compact('purchase'));
    }

    // Display the list of facture purchases (if needed)
    public function index()
    {
        $factures = FacturePurchase::all(); // Or any specific query for listing
        return view('facture_purchases.index', compact('factures'));
    }

    // Store a new facture for a specific purchase
    public function store(Request $request)
{
    // Validate the input fields
    $request->validate([
        'montant_paye' => 'required|numeric|min:0|max:' . $request->total,
        'total' => 'required|numeric|min:0',
    ]);

    // Get values from the form
    $montantPaye = $request->montant_paye;
    $total = $request->total;

    // Determine payment status
    $statut = 'non payé';
    if ($montantPaye == $total) {
        $statut = 'payé';
    } elseif ($montantPaye > 0 && $montantPaye < $total) {
        $statut = 'partiellement payé';
    }

    // Calculate remaining balance
    $reste = $total - $montantPaye;

    // Instantiate FacturePurchase and use createWithPaiement instance method
    $facture = new FacturePurchase();
    $facture = $facture->createWithPaiement($request->all(), $request->purchase_id);

    // Check if facture creation was successful
    if ($facture) {
        return redirect()->route('purchases.index')->with('success', 'Facture created successfully!');
    } else {
        return back()->with('error', 'Failed to create the facture.');
    }
}


    // Show a specific facture by ID
    public function show($id)
{
    // Retrieve the purchase using the given ID
    $purchase = Purchase::findOrFail($id);

    // Pass the purchase to the 'purchases.show' view
    return view('purchases.show', compact('purchase'));
}
public function destroy($id)
{
    // Find the Paiement by ID
    $paiement = Paiement::findOrFail($id);

    // Check if there's a related facture and delete it
    if ($paiement->facturePurchase) {
        $paiement->facturePurchase->delete();
    }

    // Now delete the paiement
    $paiement->delete();

    return redirect()->route('purchases.index')->with('success', 'Paiement deleted successfully!');
}

}

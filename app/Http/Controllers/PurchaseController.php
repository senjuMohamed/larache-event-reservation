<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseLine;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Tax;

class PurchaseController extends Controller
{
    public function showPurchaseLines($id)
    {
        $purchase = Purchase::with('purchaseLines.produit')->findOrFail($id);
        return view('purchases.lines', compact('purchase'));
    }

    public function index()
    {
        $purchases = Purchase::with('fournisseur')->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
{
    $fournisseurs = Fournisseur::all();
    $produits = Produit::all();
    $taxes = Tax::all(); // Fetch taxes from the database

    return view('purchases.create', compact('fournisseurs', 'produits', 'taxes'));
}

    public function store(Request $request)
{
    $request->validate([
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'purchase_date' => 'date',
        'quantites' => 'required|array',
        'unit_prices' => 'required|array',
        'taxes' => 'required|array',
    ]);

    // Create the purchase record first
    $purchase = Purchase::create([
        'fournisseur_id' => $request->fournisseur_id,
        'purchase_date' => $request->purchase_date,
        'total_price' => 0, // Initialize with 0, we will update it later
    ]);

    // Loop through each product
    $totalPrice = 0;
    foreach ($request->quantites as $key => $quantity) {
        $unitPrice = $request->unit_prices[$key];
        $taxPercentage = $request->taxes[$key];

        // Calculate the total price and tax for this product
        $totalLinePrice = $quantity * $unitPrice;
        $taxAmount = ($totalLinePrice * $taxPercentage) / 100;
        $totalAfterTax = $totalLinePrice + $taxAmount;

        // Create purchase line entry
        PurchaseLine::create([
            'purchase_id' => $purchase->id,
            'produit_id' => $request->produits[$key], // Assuming you have the product ID
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalLinePrice,
            'total_after_tax' => $totalAfterTax, // Store total after tax for each line
        ]);

        // Add the total after tax to the overall purchase total
        $totalPrice += $totalAfterTax;
    }

    // Update the total price of the purchase
    $purchase->update(['total_price' => $totalPrice]);

    // Redirect with success message
    return redirect()->route('purchases.index')->with('success', 'Purchase added successfully.');
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'purchase_date' => 'required|date',
            'produits' => 'required|array',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantity' => 'required|integer|min:1',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update([
            'fournisseur_id' => $request->fournisseur_id,
            'purchase_date' => $request->purchase_date,
        ]);

        // Delete old purchase lines before updating
        $purchase->purchaseLines()->delete();

        // Initialize total price for the purchase
        $totalPrice = 0;

        // Create new purchase lines
        foreach ($request->produits as $produit) {
            $unitPrice = Produit::find($produit['produit_id'])->prix;
            $totalLinePrice = $unitPrice * $produit['quantity'];

            // Create new purchase line entry
            PurchaseLine::create([
                'purchase_id' => $purchase->id,
                'produit_id' => $produit['produit_id'],
                'quantity' => $produit['quantity'],
                'unit_price' => $unitPrice,
                'total_price' => $totalLinePrice,
            ]);

            $totalPrice += $totalLinePrice;
        }

        // Update the total price of the purchase
        $purchase->update(['total_price' => $totalPrice]);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    public function show($id)
    {
        $purchase = Purchase::with(['fournisseur', 'purchaseLines.produit'])->findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }

    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $fournisseurs = Fournisseur::all();
        $produits = Produit::all();
        return view('purchases.edit', compact('purchase', 'fournisseurs', 'produits'));
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->purchaseLines()->delete(); // Remove associated purchase lines
        $purchase->delete(); // Delete the purchase
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
    public function archive()
    {
        $purchases= purchase::onlyTrashed()->get(); // Fetch soft-deleted purchases
        return view('purchases.archive', compact('purchases'));
    }
    
    
    
        // Restore a soft-deleted purchase
        public function restore($id)
        {
            $purchase = purchase::withTrashed()->findOrFail($id);  // Retrieve soft-deleted purchase
            $purchase->restore();  // Restore the purchase
            return redirect()->route('purchases.archive')->with('success', 'Catégorie restaurée avec succès.');
        }
    
        // Permanently delete a purchase
        public function forceDelete($id)
        {
            $purchase = purchase::withTrashed()->findOrFail($id);  // Retrieve soft-deleted purchase
            $purchase->forceDelete();  // Permanently delete the purchase
            return redirect()->route('purchases.archive')->with('success', 'Catégorie supprimée définitivement.');
        }
    
        // Display only soft-deleted purchases (trashed)
        public function trashed()
        {
            $purchases = purchase::onlyTrashed()->get();  // Fetch only soft-deleted purchases
            return view('purchases.trashed', compact('purchases'));
        }
    }


<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\CategoryProduit;
use App\Models\Purchase;
use App\Models\PurchaseLine;
use App\Enums\ProductType;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Get JSON list of services.
     */
    public function getServicesJson()
    {
        return response()->json(Produit::where('type', 'service')->get());
    }
    
    /**
     * Display all products (including soft-deleted ones).
     */
    public function index()
    {
        $produits = Produit::withTrashed()->get();
        return view('produits.index', compact('produits'));
    }

    /**
     * Show form to create a new product.
     */
    public function create()
    {
        $categories = CategoryProduit::all();
        return view('produits.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', ProductType::getValues()),
            'prix' => 'required|numeric',
            'category_id' => 'nullable|exists:category_produits,id',
        ]);

        Produit::create($validated);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Show details of a specific product including purchase history.
     */
    public function show(Produit $produit)
{
    $produit->load('purchaseLines.purchase.fournisseur');

    return view('produits.show', compact('produit'));
}



    /**
     * Show form to edit a product.
     */
    public function edit(Produit $produit)
    {
        $categories = CategoryProduit::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    /**
     * Update an existing product.
     */
    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', ProductType::getValues()),
            'prix' => 'required|numeric',
            'category_id' => 'nullable|exists:category_produits,id',
        ]);

        $produit->update($validated);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès!');
    }

    /**
     * Soft delete a product.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès!');
    }

    /**
     * Show soft-deleted products.
     */
    public function archive(Request $request)
    {
        $search = $request->get('search');

        $produitsSupprimes = Produit::onlyTrashed()
            ->when($search, fn($query) => $query->where('nom', 'like', "%{$search}%"))
            ->get();

        return view('produits.archive', compact('produitsSupprimes'));
    }

    /**
     * Restore a soft-deleted product.
     */
    public function restore($id)
    {
        $produit = Produit::withTrashed()->findOrFail($id);
        $produit->restore();
        return redirect()->route('produits.archive')->with('success', 'Produit restauré avec succès.');
    }

    /**
     * Permanently delete a product.
     */
    public function forceDelete($id)
    {
        $produit = Produit::withTrashed()->findOrFail($id);
        $produit->forceDelete();
        return redirect()->route('produits.archive')->with('success', 'Produit supprimé définitivement.');
    }

    /**
     * Display only soft-deleted products.
     */
    public function trashed()
    {
        $produits = Produit::onlyTrashed()->get();
        return view('produits.trashed', compact('produits'));
    }
}

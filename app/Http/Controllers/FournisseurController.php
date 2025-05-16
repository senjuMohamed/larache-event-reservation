<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\produit;
use App\Models\Purchase;
use App\Models\PurchaseLine;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    // Display a list of all Fournisseurs
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    // Show the form for creating a new Fournisseur
    public function create()
    {
        return view('fournisseurs.create');
    }

    // Store a new Fournisseur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Fournisseur::create($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur créé avec succès.');
    }

    // Show the details of a specific Fournisseur
    public function show(Fournisseur $fournisseur)
    {
        // Check if purchases have purchase lines with valid produits
        $fournisseur->load('purchases.purchaseLines.produit');
        
        foreach ($fournisseur->purchases as $purchase) {
            foreach ($purchase->purchaseLines as $purchaseLine) {
                if (!$purchaseLine->produit) {
                    dd("Missing produit for purchaseLine ID: {$purchaseLine->id}");
                }
            }
        }
    
        return view('fournisseurs.show', compact('fournisseur'));
    }
    



    // Show the form for editing a specific Fournisseur
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    // Update the details of a specific Fournisseur
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $fournisseur->update($request->all());

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès.');
    }

    // Soft delete a specific Fournisseur
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
    }

    // Display archived (soft deleted) Fournisseurs
    public function archive()
    {
        $fournisseurs = Fournisseur::onlyTrashed()->get();
        return view('fournisseurs.archive', compact('fournisseurs'));
    }

    // Restore a soft-deleted Fournisseur
    public function restore($id)
    {
        $fournisseur = Fournisseur::withTrashed()->findOrFail($id);
        $fournisseur->restore();

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur restauré avec succès.');
    }

    // Permanently delete a Fournisseur
    public function forceDelete($id)
    {
        $fournisseur = Fournisseur::withTrashed()->findOrFail($id);
        $fournisseur->forceDelete();

        return redirect()->route('fournisseurs.archive')->with('success', 'Fournisseur supprimé définitivement.');
    }
}

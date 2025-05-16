<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\SalleProduit;

class SalleController extends Controller
{
    public function getSallesJson()
{
    return response()->json(Salle::all());
}
    // Display a list of all Salles
    public function index()
    {
        $salles = Salle::with('produits')->get(); // Eager load produits (services) for each salle
        return view('salles.index', compact('salles'));
    }

    // Show the form for creating a new Salle
    public function create()
    {
        $produits = Produit::where('type', 'service')->get(); // Get only products of type 'service'
        return view('salles.create', compact('produits'));
    }

    // Store a newly created Salle
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|integer',
            'prix' => 'required|numeric',
            'produits' => 'nullable|array', // Validate produits if provided
            'produits.*' => 'exists:produits,id', // Ensure each produit ID exists
        ]);

        // Create the salle
        $salle = Salle::create([
            'nom' => $request->nom,
            'capacite' => $request->capacite,
            'prix' => $request->prix,
        ]);

        // Attach selected produits (services) to the salle
        if ($request->has('produits')) {
            $salle->produits()->attach($request->produits);
        }

        return redirect()->route('salles.index')->with('success', 'Salle created successfully.');
    }

    // Show the details of a specific Salle
    public function show(Salle $salle)
    {
        $salle->load('produits'); // Load the related produits
        return view('salles.show', compact('salle'));
    }

    // Show the form for editing a specific Salle
    public function edit(Salle $salle)
    {
        $produits = Produit::where('type', 'service')->get();
        $salle->load('produits'); // Load the related produits
        return view('salles.edit', compact('salle', 'produits'));
    }

    // Update a specific Salle
    public function update(Request $request, Salle $salle)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|integer',
            'prix' => 'required|numeric',
            'produits' => 'nullable|array', // Validate produits if provided
            'produits.*' => 'exists:produits,id', // Ensure each produit ID exists
        ]);

        // Update the salle
        $salle->update([
            'nom' => $request->nom,
            'capacite' => $request->capacite,
            'prix' => $request->prix,
        ]);

        // Sync the selected produits (services) with the salle
        if ($request->has('produits')) {
            $salle->produits()->sync($request->produits);
        } else {
            $salle->produits()->detach(); // Remove all produits if none are selected
        }

        return redirect()->route('salles.index')->with('success', 'Salle updated successfully.');
    }

    // Delete a specific Salle
    public function destroy(Salle $salle)
    {
        $salle->delete();
        return redirect()->route('salles.index')->with('success', 'Salle deleted successfully.');
    }

    // Display archived (soft-deleted) Salles
    public function archive()
    {
        $salles = Salle::onlyTrashed()->get();
        return view('salles.archive', compact('salles'));
    }

    // Restore a soft-deleted Salle
    public function restore($id)
    {
        $salle = Salle::withTrashed()->findOrFail($id);
        $salle->restore();
        return redirect()->route('salles.archive')->with('success', 'Salle restaurée avec succès.');
    }

    // Permanently delete a Salle
    public function forceDelete($id)
    {
        $salle = Salle::withTrashed()->findOrFail($id);
        $salle->forceDelete();
        return redirect()->route('salles.archive')->with('success', 'Salle supprimée définitivement.');
    }

    // Display trashed (soft-deleted) Salles
    public function trashed()
    {
        $salles = Salle::onlyTrashed()->get();
        return view('salles.trashed', compact('salles'));
    }
}
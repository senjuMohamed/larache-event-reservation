<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::all();
        return view('taxes.index', compact('taxes'));
    }

    public function create()
    {
        return view('taxes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        Tax::create($request->all());

        return redirect()->route('taxes.index')->with('success', 'Tax added successfully.');
    }

    public function edit(Tax $tax)
    {
        return view('taxes.edit', compact('tax'));
    }

    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $tax->update($request->all());

        return redirect()->route('taxes.index')->with('success', 'Tax updated successfully.');
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();

        return redirect()->route('taxes.index')->with('success', 'Tax deleted successfully.');
    }
    public function archive()
    {
        $taxes= tax::onlyTrashed()->get(); // Fetch soft-deleted taxes
        return view('taxes.archive', compact('taxes'));
    }
    
    
    
        // Restore a soft-deleted tax
        public function restore($id)
        {
            $tax = tax::withTrashed()->findOrFail($id);  // Retrieve soft-deleted tax
            $tax->restore();  // Restore the tax
            return redirect()->route('taxes.archive')->with('success', 'Catégorie restaurée avec succès.');
        }
    
        // Permanently delete a tax
        public function forceDelete($id)
        {
            $tax = tax::withTrashed()->findOrFail($id);  // Retrieve soft-deleted tax
            $tax->forceDelete();  // Permanently delete the tax
            return redirect()->route('taxes.archive')->with('success', 'Catégorie supprimée définitivement.');
        }
    
        // Display only soft-deleted taxes (trashed)
        public function trashed()
        {
            $taxes = tax::onlyTrashed()->get();  // Fetch only soft-deleted taxes
            return view('taxes.trashed', compact('taxes'));
        }
    }



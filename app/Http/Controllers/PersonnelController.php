<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnels = Personnel::all();
        return view('personnels.index', compact('personnels'));
    }

    public function create()
    {
        return view('personnels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string',
            'role' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'poste' => 'nullable|string|max:255', // Added validation for poste
        ]);

        Personnel::create($request->all());

        return redirect()->route('personnels.index')->with('success', 'Personnel ajouté avec succès.');
    }

    public function show(Personnel $personnel)
    {
        return view('personnels.show', compact('personnel'));
    }

    public function edit(Personnel $personnel)
    {
        return view('personnels.edit', compact('personnel'));
    }

    public function update(Request $request, Personnel $personnel)
    {
        $request->validate([
            'nom' => 'nullable|string|max:255',
            'telephone' => 'nullable|string',
            'role' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'poste' => 'nullable|string|max:255', // Added validation for poste
        ]);

        $personnel->update($request->all());

        return redirect()->route('personnels.index')->with('success', 'Personnel mis à jour avec succès.');
    }

    public function destroy(Personnel $personnel)
    {
        $personnel->delete();

        return redirect()->route('personnels.index')->with('success', 'Personnel supprimé avec succès.');
    }
    public function archive()
    {
        $personnels= personnel::onlyTrashed()->get(); // Fetch soft-deleted personnels
        return view('personnels.archive', compact('personnels'));
    }
    
    
    
        // Restore a soft-deleted personnel
        public function restore($id)
        {
            $personnel = personnel::withTrashed()->findOrFail($id);  // Retrieve soft-deleted personnel
            $personnel->restore();  // Restore the personnel
            return redirect()->route('personnels.archive')->with('success', 'Catégorie restaurée avec succès.');
        }
    
        // Permanently delete a personnel
        public function forceDelete($id)
        {
            $personnel = personnel::withTrashed()->findOrFail($id);  // Retrieve soft-deleted personnel
            $personnel->forceDelete();  // Permanently delete the personnel
            return redirect()->route('personnels.archive')->with('success', 'Catégorie supprimée définitivement.');
        }
    
        // Display only soft-deleted personnels (trashed)
        public function trashed()
        {
            $personnels = personnel::onlyTrashed()->get();  // Fetch only soft-deleted personnels
            return view('personnels.trashed', compact('personnels'));
        }
    }

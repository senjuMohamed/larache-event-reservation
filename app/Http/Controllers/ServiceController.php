<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Produit;
use App\Models\Salle;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getServicesJson()
{
    return response()->json(Service::all());
}
    public function create()
    {
        // Fetch only products of type 'service'
        $produits = Produit::where('type', 'service')->get();
        $salles = Salle::all();

        return view('services.create', compact('produits', 'salles'));
    }

    // Store the newly created service
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'salle_id' => 'required|exists:salles,id',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0'
        ]);

        Service::create([
            'produit_id' => $request->produit_id,
            'salle_id' => $request->salle_id,
            'description' => $request->description,
            'prix' => $request->prix,
        ]);

        return redirect()->route('services.index')->with('success', 'Service ajouté avec succès.');
    }

    // Display a listing of the services
    public function index()
    {
        $services = Service::withTrashed()->get(); 

        return view('services.index', compact('services'));
    }

    // Show the details of a specific service
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    // Delete a specific service (Soft Delete)
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }

    // Show the form for editing a specific service
    public function edit(Service $service)
    {
        $produits = Produit::where('type', 'service')->get();
        $salles = Salle::all();

        return view('services.edit', compact('service', 'produits', 'salles'));
    }

    // Update the details of a specific service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'salle_id' => 'required|exists:salles,id',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0'
        ]);

        $service->update([
            'produit_id' => $request->produit_id,
            'salle_id' => $request->salle_id,
            'description' => $request->description,
            'prix' => $request->prix,
        ]);

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    // Show archived (soft-deleted) services
    public function archive()
    {
        $services = Service::onlyTrashed()->get();
        return view('services.archive', compact('services'));
    }

    // Restore a soft-deleted service
    public function restore($id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        $service->restore();
        return redirect()->route('services.archive')->with('success', 'Service restauré avec succès.');
    }

    // Permanently delete a service
    public function forceDelete($id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        $service->forceDelete();
        return redirect()->route('services.archive')->with('success', 'Service supprimé définitivement.');
    }

    // Display only soft-deleted services (trashed)
    public function trashed()
    {
        $services = Service::onlyTrashed()->get();
        return view('services.trashed', compact('services'));
    }
}

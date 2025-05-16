<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Display all clients
    public function index()
    {
        $clients = Client::all();  // Fetch all clients
        return view('clients.index', compact('clients'));
    }

    // Show the form to create a new client
    public function create()
    {
        return view('clients.create');
    }

    // Store a new client
    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'email|unique:clients,email',
            'telephone' => 'string',
            'mobile' => 'string',

        ]);

        // Create the client
        Client::create([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile,

        ]);

        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }

    // Show the form to edit an existing client
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Delete a client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    // Update an existing client
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'email|unique:clients,email,' . $client->id,
            'telephone' => 'string',
            'mobile' => 'string',

        ]);

        // Update the client
        $client->update([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile,

        ]);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    // Show a specific client's details
    public function show(Client $client)
{

    $historique = $client->historique; // Retrieve historique for this client
    return view('clients.show', compact('client', 'historique'));
}
public function archive()
    {
        $clients = client::onlyTrashed()->get();
        return view('clients.archive', compact('clients'));
    }

    // Restore a soft-deleted client
    public function restore($id)
    {
        $client = client::withTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('clients.index')->with('success', 'client restauré avec succès.');
    }

    // Permanently delete a client
    public function forceDelete($id)
    {
        $client = client::withTrashed()->findOrFail($id);
        $client->forceDelete();

        return redirect()->route('clients.archive')->with('success', 'client supprimé définitivement.');
    }
}

?>

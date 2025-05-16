@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Client Details</h2>
        <p><strong>Nom:</strong> {{ $client->nom_complet }}</p>
        <p><strong>Email:</strong> {{ $client->email }}</p>
        <p><strong>Téléphone:</strong> {{ $client->telephone }}</p>

        <h3>Historique des Demandes</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Événement</th>
                    <th>Salle</th>
                    <th>Status</th>
                    <th>Date Réservation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($client->DemandeReservation as $demande)
                    <tr>
                        <td>{{ $demande->id }}</td>
                        <td>{{ $demande->event->name }}</td>
                        <td>{{ $demande->salle->nom }}</td>
                        <td>{{ $demande->status }}</td>
                        <td>{{ $demande->date_reservation }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

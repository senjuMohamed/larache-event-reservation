@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Demande de Réservation - Détails</h1>

    <p><strong>Client:</strong> {{ $demandeReservation->client->nom_complet ?? 'N/A' }}</p>
    <p><strong>Événement:</strong> {{ $demandeReservation->event->name ?? 'N/A' }}</p>
    <p><strong>Salle:</strong> {{ $demandeReservation->salle->nom ?? 'N/A' }}</p>
    <p><strong>Statut:</strong> {{ $demandeReservation->status }}</p>
    <p><strong>Date de Réservation:</strong> {{ $demandeReservation->date_reservation->format('d-m-Y') }}</p>

    <h4>Prix Total: {{ number_format($prixTotal, 2) }} EUR</h4>

    @if($demandeReservation->factureReservations->isEmpty())
        <a href="{{ route('facture_resevations.create', $demandeReservation->id) }}" class="btn btn-primary">Créer Facture</a>
    @endif
</div>
@endsection

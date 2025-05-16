@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la Facture #{{ $factures_reservation->id }}</h2>
    <form action="{{ route('facture_reservations.update', $factures_reservation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Demande</label>
            <select name="demande_id" class="form-control">
                @foreach($demandes as $demande)
                <option value="{{ $demande->id }}" {{ $factures_reservation->demande_id == $demande->id ? 'selected' : '' }}>
                    {{ $demande->id }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Paiement</label>
            <select name="paiement_id" class="form-control">
                @foreach($paiements as $paiement)
                <option value="{{ $paiement->id }}" {{ $factures_reservation->paiement_id == $paiement->id ? 'selected' : '' }}>
                    {{ $paiement->id }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Montant Total</label>
            <input type="number" step="0.01" name="montant_total" class="form-control" value="{{ $factures_reservation->montant_total }}" required>
        </div>

        <div class="mb-3">
            <label>Date d'Émission</label>
            <input type="date" name="date_emission" class="form-control" value="{{ $factures_reservation->date_emission }}" required>
        </div>

        <div class="mb-3">
            <label>Statut</label>
            <select name="statut" class="form-control">
                <option value="payé" {{ $factures_reservation->statut == 'payé' ? 'selected' : '' }}>Payé</option>
                <option value="en attente" {{ $factures_reservation->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                <option value="annulé" {{ $factures_reservation->statut == 'annulé' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('facture_reservations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

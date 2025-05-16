@extends('layouts.app')

@section('content')
    <h1>Modifier le Paiement</h1>
    <form action="{{ route('paiements.update', $paiement->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Montant (MAD) :</label>
            <input type="number" name="montant" value="{{ $paiement->montant }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Type :</label>
            <select name="type" class="form-control">
                <option value="Espèce" {{ $paiement->type == 'Espèce' ? 'selected' : '' }}>Espèce</option>
                <option value="Carte Bancaire" {{ $paiement->type == 'Carte Bancaire' ? 'selected' : '' }}>Carte Bancaire</option>
                <option value="Virement" {{ $paiement->type == 'Virement' ? 'selected' : '' }}>Virement</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date :</label>
            <input type="date" name="date" value="{{ $paiement->date }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection

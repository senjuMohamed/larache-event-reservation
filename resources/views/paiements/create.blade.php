@extends('layouts.app')

@section('content')
    <h1>Ajouter un Paiement</h1>
    <form action="{{ route('paiements.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Montant (MAD) :</label>
            <input type="number" name="montant" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Type :</label>
            <select name="type" class="form-control">
                <option value="Espèce">Espèce</option>
                <option value="Carte Bancaire">Carte Bancaire</option>
                <option value="Virement">Virement</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date :</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
@endsection

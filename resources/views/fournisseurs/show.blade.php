@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du Fournisseur</h1>
    <p><strong>Nom :</strong> {{ $fournisseur->nom }}</p>
    <p><strong>Téléphone :</strong> {{ $fournisseur->telephone }}</p>
    <p><strong>Mobile :</strong> {{ $fournisseur->mobile }}</p>
    <p><strong>Email :</strong> {{ $fournisseur->email }}</p>

    <h2>Liste des Achats du Fournisseur</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fournisseur->purchases as $purchase)
                @foreach ($purchase->purchaseLines as $purchaseLine)
                    <tr>
                        <td>{{ $purchaseLine->produit ? $purchaseLine->produit->nom : 'Produit non disponible' }}</td>
                        <td>{{ $purchaseLine->quantity }}</td>
                        <td>{{ number_format($purchaseLine->total_price, 2) }} €</td>
                        <td>
                            <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-info">Voir Détails</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection

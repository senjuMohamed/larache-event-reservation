@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du Produit</h1>

    <p><strong>Nom :</strong> {{ $produit->nom }}</p>
    <p><strong>Prix :</strong> {{ number_format($produit->prix, 2) }} €</p>
    <p><strong>Type :</strong> {{ $produit->type }}</p> 

    <p><strong>Catégorie :</strong>
        @if($produit->category)
            {{ $produit->category->nom }}
        @else
            Aucune Catégorie
        @endif
    </p>

    <h3>Historique des Achats</h3>
    @if($produit->purchases->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fournisseur</th>
                    <th>Date</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Prix Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($produit->purchaseLines as $line)
                <tr>
                    <td>{{ $line->purchase->fournisseur->nom }}</td>
                    <td>{{ $line->purchase->purchase_date }}</td>
                    <td>{{ $line->quantity }}</td> 
                    <td>{{ number_format($line->unit_price, 2) }} MAD</td>
                    <td>{{ number_format($line->total_price, 2) }} MAD</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @else
        <p>Aucun achat enregistré pour ce produit.</p>
    @endif

    <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection

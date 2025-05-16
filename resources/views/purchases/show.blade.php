@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Purchase Details</h2>
    
    <p><strong>Fournisseur:</strong> {{ $purchase->fournisseur->nom }}</p>
    <p><strong>Date:</strong> {{ $purchase->purchase_date }}</p>
    <p><strong>Total Amount:</strong> {{ $purchase->total_price }} MAD</p>

    <h3>Purchase Lines</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase->purchaseLines as $line)
                <tr>
                    <td>{{ $line->produit->nom }}</td>
                    <td>{{ $line->quantity }}</td>
                    <td>{{ $line->unit_price }} MAD</td>
                    <td>{{ $line->total_price }} MAD</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Facture Details</h3>
    @if($purchase->facturePurchases->isNotEmpty())
        @php $facture = $purchase->facturePurchases->first(); @endphp
        <p><strong>Facture #{{ $facture->id }}</strong></p>
        <p><strong>Montant Total:</strong> {{ $facture->montant_total }} MAD</p>
        <p><strong>Montant Payé:</strong> {{ $facture->montant_paye }} MAD</p>
        <p><strong>Reste à Payer:</strong> {{ $facture->reste }} MAD</p>
        <p><strong>Status:</strong> {{ $facture->statut }}</p>
        <span class="text-success">Facture is created</span>
    @else
        <a href="{{ route('facture_purchases.create', $purchase->id) }}" class="btn btn-primary">Create Facture</a>
    @endif
@endsection

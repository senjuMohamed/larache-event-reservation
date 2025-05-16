@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Facture Details for Purchase #{{ $facture->purchase_id }}</h2>

    <table class="table">
        <tr>
            <th>Montant Total</th>
            <td>{{ $facture->montant_total }}</td>
        </tr>
        <tr>
            <th>Montant Payé</th>
            <td>{{ $facture->montant_paye }}</td>
        </tr>
        <tr>
            <th>Reste à Payer</th>
            <td>{{ $facture->reste }}</td>
        </tr>
        <tr>
            <th>Statut</th>
            <td>{{ $facture->statut }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $facture->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $facture->updated_at }}</td>
        </tr>
    </table>

    <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Back to Factures</a>
</div>
@endsection
    
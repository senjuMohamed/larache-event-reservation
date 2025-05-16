@extends('layouts.app')

@section('content')
<div class="container">
    <h2>factures_reservation Details for Purchase #{{ $factures_reservation->purchase_id }}</h2>

    <table class="table">
        <tr>
            <th>Montant Total</th>
            <td>{{ $factures_reservation->montant_total }}</td>
        </tr>
        <tr>
            <th>Montant Payé</th>
            <td>{{ $factures_reservation->montant_paye }}</td>
        </tr>
        <tr>
            <th>Reste à Payer</th>
            <td>{{ $factures_reservation->reste }}</td>
        </tr>
        <tr>
            <th>Statut</th>
            <td>{{ $factures_reservation->statut }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $factures_reservation->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $factures_reservation->updated_at }}</td>
        </tr>
    </table>

    <a href="{{ route('demandereservation.index') }}" class="btn btn-secondary">Back to factures_reservations</a>
</div>
@endsection
    
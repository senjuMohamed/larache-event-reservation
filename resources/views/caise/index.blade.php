@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Caise</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('caise.index') }}" class="d-flex mb-4">
        <!-- Date Filter -->
        <input type="date" name="date" class="form-control mr-2" value="{{ request('date') }}">

        <!-- Month Filter -->
        <select name="month" class="form-control mr-2">
            <option value="">Select Month</option>
            @foreach(range(1, 12) as $month)
                <option value="{{ $month }}" @if(request('month') == $month) selected @endif>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
            @endforeach
        </select>

        <!-- Origine Filter -->
        <select name="origine" class="form-control mr-2">
            <option value="">Select Origine</option>
            <option value="reservation" @if(request('origine') == 'reservation') selected @endif>Réservation</option>
            <option value="purchase" @if(request('origine') == 'purchase') selected @endif>Achat</option>
        </select>

        <button type="submit" class="btn btn-primary ml-2">Filter</button>
    </form>

    <!-- Summary Section -->
    <div class="mb-4">
        <p><strong>Total Entrée:</strong> {{ $totalEntree }} MAD</p>
        <p><strong>Total Sortie:</strong> {{ $totalSortie }} MAD</p>
    </div>

    <!-- Payments Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date Paiement</th>
                <th>Montant</th>
                <th>Origine</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ $paiement->date_paiement->format('Y-m-d') }}</td>
                    <td>{{ $paiement->montant }} MAD</td>
                    <td>{{ ucfirst($paiement->origine) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

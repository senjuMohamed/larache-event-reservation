@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Factures</h1>

    <!-- Flash messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabs for filtering by origin -->
    <ul class="nav nav-tabs" id="factureTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#reservation">Factures de Réservation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#purchase">Factures d'Achat</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- Factures de Réservation -->
        <div class="tab-pane fade show active" id="reservation">
            @if(!empty($factures['reservation']) && count($factures['reservation']) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Montant</th>
                            <th>Date Paiement</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($factures['reservation'] as $facture)
    @if($facture->paiement)
        <tr>
            <td>{{ $facture->paiement->montant }} €</td>
            <td>{{ \Carbon\Carbon::parse($facture->paiement->date_paiement)->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('paiements.edit', $facture->paiement->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('paiements.destroy', $facture->paiement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    @endif
@endforeach

                    </tbody>
                </table>
            @else
                <p>Aucune facture de réservation trouvée.</p>
            @endif
        </div>

        <!-- Factures d'Achat -->
        <div class="tab-pane fade" id="purchase">
            @if(!empty($factures['purchase']) && count($factures['purchase']) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Montant</th>
                            <th>Date Paiement</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($factures['purchase'] as $facture)
    @if($facture->paiement)
        <tr>
            <td>{{ $facture->paiement->montant }} €</td>
            <td>{{ \Carbon\Carbon::parse($facture->paiement->date_paiement)->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('paiements.edit', $facture->paiement->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('paiements.destroy', $facture->paiement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    @endif
@endforeach

                    </tbody>
                </table>
            @else
                <p>Aucune facture d'achat trouvée.</p>
            @endif
        </div>
    </div>

    <!-- Add New Facture Button -->
    <a href="{{ route('facture_reservations.create') }}" class="btn btn-primary mt-3">Ajouter une Facture de Réservation</a>
    <a href="{{ route('facture_purchases.create') }}" class="btn btn-primary mt-3">Ajouter une Facture d'Achat</a>
    </div>
@endsection

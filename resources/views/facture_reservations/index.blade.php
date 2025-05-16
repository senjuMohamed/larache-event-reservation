@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des Factures de Réservation</h2>

    <!-- Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('facture_reservations.create') }}" class="btn btn-primary">Créer une Facture</a>
        <a href="{{ route('facture_reservations.index') }}" class="btn btn-secondary">Toutes les Factures</a>
    </div>

    <!-- Empty State -->
    @if($factures->isEmpty())
        <div class="alert alert-warning">Aucune facture disponible.</div>
    @else
        <!-- Active Invoices Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Factures Actives</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="activeInvoicesTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Demande</th>
                                <th>Paiement</th>
                                <th>Montant Total</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factures as $facture)
                                @if(is_null($facture->deleted_at))  <!-- Active invoices -->
                                    <tr>
                                        <td>{{ $facture->id }}</td>
                                        <td>{{ $facture->demande->id ?? 'N/A' }}</td>
                                        <td>{{ $facture->paiement->id ?? 'N/A' }}</td>
                                        <td>{{ $facture->montant_total }} MAD</td>
                                        <td>{{ $facture->date_emission }}</td>
                                        <td>{{ $facture->statut }}</td>
                                        <td>
                                            <a href="{{ route('facture_reservations.show', $facture) }}" class="btn btn-info btn-sm">Voir</a>
                                            <a href="{{ route('facture_reservations.edit', $facture) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('facture_reservations.destroy', $facture) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  

        <!-- Archived Invoices Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Factures Archivées</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="archivedInvoicesTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Demande</th>
                                <th>Paiement</th>
                                <th>Montant Total</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factures as $facture)
                                @if($facture->deleted_at)  <!-- Soft-deleted invoices -->
                                    <tr>
                                        <td>{{ $facture->id }}</td>
                                        <td>{{ $facture->demande->id ?? 'N/A' }}</td>
                                        <td>{{ $facture->paiement->id ?? 'N/A' }}</td>
                                        <td>{{ $facture->montant_total }} MAD</td>
                                        <td>{{ $facture->date_emission }}</td>
                                        <td>{{ $facture->statut }}</td>
                                        <td>
                                            <!-- Restore soft-deleted invoice -->
                                            <form action="{{ route('facture_reservations.restore', $facture) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm">Restaurer</button>
                                            </form>
                                            
                                            <!-- Permanently delete the soft-deleted invoice -->
                                            <form action="{{ route('facture_reservations.forceDelete', $facture) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer définitivement cette facture ?')">Supprimer définitivement</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#activeInvoicesTable, #archivedInvoicesTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "Rechercher:",
                lengthMenu: "Afficher _MENU_ entrées",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                infoEmpty: "Aucune entrée disponible",
                infoFiltered: "(filtrée de _MAX_ entrées au total)",
                paginate: {
                    previous: "Précédent",
                    next: "Suivant"
                }
            },
            dom: 'lfrtip',  // Adds search and pagination
        });
    });
</script>
@endsection

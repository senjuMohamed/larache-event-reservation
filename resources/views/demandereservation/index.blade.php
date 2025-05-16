@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Afficher les demandes de réservation</h1>

    <!-- Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('demandereservation.create') }}" class="btn btn-primary">Créer une nouvelle demande</a>
    </div>

    <!-- Empty State -->
    @if($demandes->isEmpty())
        <div class="alert alert-warning">Aucune demande de réservation trouvée.</div>
    @else
        <!-- Table Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Demandes de Réservation</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Événement</th>
                                <th>Salle</th>
                                <th>Statut</th>
                                <th>Date de Réservation</th>
                                <th>Facture</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($demandes as $demande)
                                <tr>
                                    <td>{{ $demande->client->nom_complet }}</td>
                                    <td>{{ $demande->event->name }}</td>
                                    <td>{{ $demande->salle->nom }}</td>
                                    <td>{{ $demande->status }}</td>
                                    <td>{{ $demande->date_reservation }}</td>
                                    <td>
                                        @if(optional($demande->factureReservations)->isNotEmpty())
                                            <a href="{{ route('facture_reservations.show', $demande->factureReservations->first()->id) }}" class="btn btn-success btn-sm">View Facture Reservation</a>
                                        @else
                                        <a href="{{ route('facture_reservations.create', ['demande' => $demande]) }}" class="btn btn-primary btn-sm">Create Facture Reservation</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('demandereservation.show', $demande) }}" class="btn btn-info btn-sm">Voir</a>
                                        <a href="{{ route('demandereservation.edit', $demande) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('demandereservation.destroy', $demande) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
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
        $('#dataTable').DataTable({
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
            }
        });
    });
</script>
@endsection

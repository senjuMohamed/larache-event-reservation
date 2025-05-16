@extends('layouts.app')

@section('content')
<style>
    .dataTables_filter {
        float: right;
        margin-top: 10px;
    }
</style>

<div class="container">
    <h1 class="mb-4">Liste des Événements</h1>

    <!-- Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mb-3">
    <a href="{{ route('events.archive') }}" class="btn btn-secondary">Archives</a>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Ajouter un Événement</a>
    </div>

    <!-- Empty State -->
    @if($events->isEmpty())
        <div class="alert alert-warning">Aucun événement disponible.</div>
    @else
        <!-- Active Events Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Événements Actifs</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="activeEventsTable" width="100%" cellspacing="0">
                <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                @if(is_null($event->deleted_at))  <!-- Active events -->
                                    <tr>
                                        <td><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></td>
                                        <td>{{ $event->description }}</td>
                                        <td>{{ $event->start_date }}</td>
                                        <td>{{ $event->end_date }}</td>
                                        <td>
                                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cet événement ?')">Supprimer</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is loaded first -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
    $('#activeEventsTable, #archivedEventsTable').DataTable({
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
        dom: 'lfrtip',  // Ajoute le champ de recherche et de pagination
    });
    // Forcer l'affichage de la barre de recherche si elle est masquée
    $('.dataTables_filter').show();
});

</script>
@endsection

@extends('layouts.app')

@section('content')
<style>
    /* Adjust search box position to the right */
    .dataTables_filter {
        float: right; /* Moves the search box to the right */
        margin-top: 10px; /* Adjust the top margin to align better */
    }
</style>

<div class="container">
    <h2>services Supprimées</h2>

    <!-- Button to go back to the index page -->
    <div class="mb-3">
        <a href="{{ route('services.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">services</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->produit->nom }}</td>
                                <td>
                                    <!-- Restore service -->
                                    <form action="{{ route('services.restore', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Restaurer</button>
                                    </form>

                                    <!-- Force Delete service -->
                                    <form action="{{ route('services.forceDelete', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression définitive ?')">Supprimer Définitivement</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 10, // Show 10 entries by default
                "lengthMenu": [10, 25, 50, 100], // Option to show 10, 25, 50, or 100 entries
                "language": {
                    "search": "Search:", // Custom label for search box
                    "lengthMenu": "Show _MENU_ entries", // Show entries label
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries", // Info text
                    "infoEmpty": "No entries available", // When no entries are available
                    "infoFiltered": "(filtered from _MAX_ total entries)", // Filter info
                    "paginate": {
                        "previous": "Previous", // Previous page text
                        "next": "Next" // Next page text
                    }
                }
            });
        });
    </script>
@endsection

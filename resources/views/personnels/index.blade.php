@extends('layouts.app')

@section('content')
<style>
    /* Adjust search box position to the right */
    .dataTables_filter {
        float: right; /* Moves the search box to the right */
        margin-top: 10px; /* Adjust the top margin to align better */
    }

    /* Style for clickable table rows */
    .clickable-row {
        cursor: pointer;
    }

    .clickable-row td {
        transition: background-color 0.3s ease;
    }

    .clickable-row:hover {
        background-color: #f5f5f5; /* Light background on hover */
    }
</style>

<div class="container">
    <h1 class="mb-4">Liste du Personnel</h1>
    <div class="d-flex justify-content-between mb-3">
    <!-- Button to add new employee -->
    <a href="{{ route('personnels.archive') }}" class="btn btn-secondary">Archives</a>
    <a href="{{ route('personnels.create') }}" class="btn btn-primary mb-3">Ajouter un Employé</a>
    </div>
    @if($personnels->isEmpty())
        <div class="alert alert-info">Aucun employé trouvé.</div>
    @else
        <!-- DataTable Integration -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste des Employés</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th> 
                                <th>Mobile</th>
                                <th>Rôle</th> 
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personnels as $personnel)
                                <tr class="clickable-row" data-href="{{ route('personnels.show', $personnel->id) }}">
                                    <td>{{ $personnel->nom }}</td>
                                    <td>{{ $personnel->email ?? 'N/A' }}</td>
                                    <td>{{ $personnel->telephone ?? 'N/A' }}</td>
                                    <td>{{ $personnel->mobile ?? 'N/A' }}</td>
                                    <td>{{ $personnel->role ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('personnels.edit', $personnel->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('personnels.destroy', $personnel->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cet employé ?')">Supprimer</button>
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

        // Make rows clickable but prevent click on actions (edit/delete)
        $(".clickable-row").click(function(e) {
            // Check if the click target is inside the 'Actions' button area
            if (!$(e.target).closest('a, button').length) {
                window.location = $(this).data("href");
            }
        });
    });
</script>
@endsection

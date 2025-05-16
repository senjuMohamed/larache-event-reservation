@extends('layouts.app')

@section('content')
<style>
    /* Adjust pagination to the right */
    .dataTables_paginate {
        float: right; /* Align pagination to the right */
    }

    /* Optional: Align the search box and pagination if needed */
    .dataTables_filter, .dataTables_paginate {
        display: inline-block;
    }

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
    <h1 class="mb-4">Liste des Services</h1>

    <!-- Button to Add New Service -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('services.archive') }}" class="btn btn-secondary">Archives</a>
        <a href="{{ route('services.create') }}" class="btn btn-primary">Ajouter un Service</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($services->isEmpty())
        <div class="alert alert-warning" role="alert">
            Aucune donnée disponible.
        </div>
    @else
        <h2>Services Actifs</h2>
        <!-- DataTable Integration -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Services</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Salle</th>
                                <th>Prix</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                            @if(is_null($service->deleted_at))
                            <tr onclick="window.location='{{ route('services.show', $service->id) }}'" class="clickable-row">
                                <td>{{ $service->produit ? $service->produit->nom : 'Unknown Produit' }}</td>
                                <td>{{ $service->salle ? $service->salle->nom : 'Unknown Salle' }}</td>
                                <td>{{ $service->prix ?? 'No Prix' }}</td>
                                <td>{{ $service->description ?? 'No Description' }}</td>
                                <td>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer ce service ?')">Supprimer</button>
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

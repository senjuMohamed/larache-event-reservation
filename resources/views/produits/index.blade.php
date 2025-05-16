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
    <h1 class="mb-4">Liste des Produits</h1>
    
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('produits.archive') }}" class="btn btn-secondary">Archive</a>
        <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un Produit</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($produits->isEmpty())
        <div class="alert alert-warning" role="alert">
            Aucune donnée disponible.
        </div>
    @else
        <h2>Produits Actifs</h2>
        <!-- DataTable Integration -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Produits</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Prix</th>
                                <th>Catégorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($produits as $produit)
                            @if(is_null($produit->deleted_at))
                            <tr onclick="window.location='{{ route('produits.show', $produit->id) }}'" >
                            <td>{{ $produit->nom }}</td>
                                    <td>
                                    {{$produit->type}}
                                    </td>
                                    <td>{{ number_format($produit->prix, 2) }} €</td>
                                    <td>
    @if($produit->category)
        {{ $produit->category->nom }}
    @else
        Aucune Catégorie
    @endif
</td>

                                    </td>
                                    <td>
                                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer ce produit ?')">Supprimer</button>
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

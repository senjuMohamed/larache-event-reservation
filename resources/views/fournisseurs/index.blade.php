@extends('layouts.app')

@section('content')
<style>
/* Adjust pagination to the right */
.dataTables_paginate {
    float: right;
}

/* Align the search box and pagination */
.dataTables_filter, .dataTables_paginate {
    display: inline-block;
}

/* Adjust search box position */
.dataTables_filter {
    float: right;
    margin-top: 10px;
}

/* Clickable rows */
.clickable-row {
    cursor: pointer;
}

.clickable-row td {
    transition: background-color 0.3s ease;
}

.clickable-row:hover {
    background-color: #f5f5f5;
}
</style>

<div class="container">
    <h1 class="mb-4">Liste des Fournisseurs</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('fournisseurs.archive') }}" class="btn btn-secondary">Voir les Archives</a>
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary">Ajouter un Fournisseur</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($fournisseurs->isEmpty())
        <div class="alert alert-warning">
            Aucune donnée disponible.
        </div>
    @else
        <h2>Fournisseurs Actifs</h2>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste des Fournisseurs</h6>
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
                            @foreach($fournisseurs as $fournisseur)
                                <tr>
                                    <td>
                                        <a href="{{ route('fournisseurs.show', $fournisseur->id) }}">
                                            {{ $fournisseur->nom }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer ce fournisseur ?')">Supprimer</button>
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
        "pageLength": 10,
        "lengthMenu": [10, 25, 50, 100],
        "language": {
            "search": "Rechercher:",
            "lengthMenu": "Afficher _MENU_ entrées",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "infoEmpty": "Aucune entrée disponible",
            "infoFiltered": "(filtrée de _MAX_ entrées au total)",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            }
        }
    });
});
</script>
@endsection

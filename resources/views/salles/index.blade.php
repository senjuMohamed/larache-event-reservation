@extends('layouts.app')

@section('content')
<style>
    .dataTables_paginate {
        float: right;
    }

    .dataTables_filter, .dataTables_paginate {
        display: inline-block;
    }

    .dataTables_filter {
        float: right;
        margin-top: 10px;
    }

    .clickable-row {
        cursor: pointer;
    }

    .clickable-row td {
        transition: background-color 0.3s ease;
    }

    .clickable-row:hover {
        background-color: #f5f5f5;
    }

    .badge {
        margin-right: 5px;
        margin-bottom: 5px;
    }
</style>

<div class="container">
    <h1 class="mb-4">Liste des Salles</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('salles.archive') }}" class="btn btn-secondary">Archives</a>
        <a href="{{ route('salles.create') }}" class="btn btn-primary">Ajouter une Salle</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    @if($salles->isEmpty())
        <div class="alert alert-warning" role="alert">Aucune donnée disponible.</div>
    @else
        <h2>Salles Actives</h2>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Salles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Capacité</th>
                                <th>Prix</th>
                                <th>Services Associés</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salles as $salle)
                                <tr class="clickable-row" data-href="{{ route('salles.show', $salle->id) }}">
                                    <td>{{ $salle->nom }}</td>
                                    <td>{{ $salle->capacite }}</td>
                                    <td>{{ number_format($salle->prix, 2) }} €</td>
                                    <td>
                                        @if($salle->produits->isNotEmpty())
                                            @foreach($salle->produits as $produit)
                                                <span class="badge badge-info">{{ $produit->nom }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge badge-secondary">Aucun service associé</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('salles.edit', $salle->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('salles.destroy', $salle->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cette salle ?')">Supprimer</button>
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
                "infoFiltered": "(filtré à partir de _MAX_ entrées)",
                "paginate": {
                    "previous": "Précédent",
                    "next": "Suivant"
                }
            }
        });

        // Make rows clickable
        $(".clickable-row").click(function(e) {
            if (!$(e.target).closest('a, button').length) {
                window.location = $(this).data("href");
            }
        });
    });
</script>
@endsection
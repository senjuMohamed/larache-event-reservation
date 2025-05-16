@extends('layouts.app')

@section('content')
<style>
    .dataTables_filter {
        float: right;
        margin-top: 10px;
    }
</style>

<div class="container">
    <!-- Title -->
    <h1 class="mb-4">Liste des Clients</h1>

    <!-- Success or Error Message -->
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Button for adding a client -->
    <div class="d-flex justify-content-between mb-3">
    <a href="{{ route('clients.archive') }}" class="btn btn-secondary">Archives</a>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">Ajouter un Client</a>
    </div>

    <!-- Check if there are any clients -->
    @if($clients->isEmpty())
        <div class="alert alert-warning" role="alert">
            Aucun client trouvé.
        </div>
    @else
        <h2>Clients</h2>
        <!-- DataTable Integration -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom Complet</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Mobile</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->nom_complet }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->telephone }}</td>
                                    <td>{{ $client->mobile }}</td>
                                    <td>
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">Voir</a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-secondary btn-sm">Historique</a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
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
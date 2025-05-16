@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="my-4">Détails du Service</h1>
    
    <table class="table table-bordered">
        <tr>
            <th>Produit</th>
            <td>{{ $service->produit->nom }}</td>
        </tr>
        <tr>
            <th>Salle</th>
            <td>{{ $service->salle->nom }}</td>
        </tr>
    </table>

    <a href="{{ route('services.index') }}" class="btn btn-primary">Retour à la liste</a>
</div>
@endsection

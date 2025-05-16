@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Détails de la Salle: {{ $salle->nom }}</h1>

    <div class="card mt-4">
        <div class="card-header">
            Informations sur la Salle
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Nom:</strong> {{ $salle->nom }}</li>
                <li class="list-group-item"><strong>Capacité:</strong> {{ $salle->capacite }}</li>
                <li class="list-group-item"><strong>Prix:</strong> {{ $salle->prix }} €</li>
            </ul>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('salles.index') }}" class="btn btn-secondary">Retour à la liste</a>
        <a href="{{ route('salles.edit', $salle->id) }}" class="btn btn-warning">Modifier</a>
    </div>
</div>
@endsection
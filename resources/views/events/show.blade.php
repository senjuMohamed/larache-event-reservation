@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Événement: {{ $event->nom }}</h1>

        <div class="mb-3">
            <strong>Nom: </strong> {{ $event->name }}
        </div>
        <div class="mb-3">
            <strong>Date de debut: </strong> {{ $event->start_date }}
        </div>
        <div class="mb-3">
            <strong>Date de fin: </strong> {{ $event->end_date }}
        </div>
        <div class="mb-3">
            <strong>Description: </strong> {{ $event->description }}
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous supprimer cet événement ?')">Supprimer</button>
            </form>
            <div class="mb-3">
        <a href="{{ route('events.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>          </div>
    </div>
@endsection

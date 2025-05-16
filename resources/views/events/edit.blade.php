
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Modifier l'Événement: {{ $event->name }}</h1>

        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Nom de l'Événement</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $event->name) }}" required>
            </div>

            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $event->start_date) }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $event->end_date) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        </form>

        <div class="mb-3">
        <a href="{{ route('events.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
    @endsection

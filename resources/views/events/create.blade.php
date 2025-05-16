
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Ajouter un Événement</h1>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="datetime-local" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="datetime-local" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
            <div class="mb-3">
        <a href="{{ route('events.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>  
        </form>
    </div>
    @endsection
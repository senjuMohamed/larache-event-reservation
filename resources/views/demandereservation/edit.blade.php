@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('demandereservation.update', $demandereservation->id) }}">
    @csrf
    @method('PUT')

    <!-- Client Selection -->
    <div class="form-group">
        <label for="client_id">Client</label>
        <select name="client_id" id="client_id" class="form-control">
            @foreach($clients as $client)
                <option value="{{ $client->id }}" @if($client->id == $demandereservation->client_id) selected @endif>{{ $client->nom_complet }}</option>
            @endforeach
        </select>
    </div>

    <!-- Event Selection -->
    <div class="form-group">
        <label for="event_id">Événement</label>
        <select name="event_id" id="event_id" class="form-control" required>
            <option value="">Select an event</option>
            @foreach($events as $event)
        <option value="{{ $event->id }}">{{ $event->name }}</option> <!-- Assuming 'name' is the column for event name -->
    @endforeach
        </select>
    </div>

    <!-- Salle Selection -->
    <div class="form-group">
        <label for="salle_id">Salle</label>
        <select name="salle_id" id="salle_id" class="form-control">
            @foreach($salles as $salle)
                <option value="{{ $salle->id }}" @if($salle->id == $demandereservation->salle_id) selected @endif>{{ $salle->nom }}</option>
            @endforeach
        </select>
    </div>

    <!-- Status Input -->
    <div class="form-group">
        <label for="status">Statut</label>
        <input type="text" name="status" id="status" class="form-control" value="{{ $demandereservation->status }}" required>
    </div>

    <!-- Date Reservation Input -->
    <div class="form-group">
        <label for="date_reservation">Date de Réservation</label>
        <input type="datetime-local" name="date_reservation" id="date_reservation" class="form-control" value="{{ $demandereservation->date_reservation->format('Y-m-d\TH:i') }}" required>
    </div>

    <button type="submit" class="btn btn-warning mt-3">Mettre à jour</button>
    <div class="mb-3">
        <a href="{{ route('demandereservation.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>  
</form>
@endsection
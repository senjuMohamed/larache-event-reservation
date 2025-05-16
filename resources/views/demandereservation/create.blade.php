@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une nouvelle Demande de Réservation</h1>

        <form action="{{ route('demandereservation.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" id="client_id" class="form-control">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom_complet }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="event_id">Événement</label>
                <select name="event_id" id="event_id" class="form-control" required>
                    <option value="">Select an event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="salle_id">Salle</label>
                <select name="salle_id" id="salle_id" class="form-control">
                    @foreach($salles as $salle)
                        <option value="{{ $salle->id }}">{{ $salle->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dynamically Loaded Produits Selection -->
            <div class="form-group">
                <label for="produits">Produits</label>
                <select name="produits[]" id="produits" class="form-control" multiple>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Statut</label>
                <input type="text" name="status" id="status" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date_reservation">Date de Réservation</label>
                <input type="datetime-local" name="date_reservation" id="date_reservation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Créer la Demande</button>

            <div class="mb-3">
                <a href="{{ route('demandereservation.index') }}" class="btn btn-primary">Retour à l'Index</a>
            </div>  
        </form>
    </div>
@endsection

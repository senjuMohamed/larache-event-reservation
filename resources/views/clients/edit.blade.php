
@extends('layouts.app')
@section('content')
   <h1>Modifier le Client</h1>
    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Nom Complet Field -->
        <div class="mb-3">
            <label class="form-label">Nom Complet :</label>
            <input type="text" name="nom_complet" value="{{ $client->nom_complet }}" class="form-control" required>
        </div>
        
        <!-- Email Field -->
        <div class="mb-3">
            <label class="form-label">Email :</label>
            <input type="email" name="email" value="{{ $client->email }}" class="form-control" required>
        </div>

        <!-- Téléphone Field -->
        <div class="mb-3">
            <label class="form-label">Téléphone :</label>
            <input type="text" name="telephone" value="{{ $client->telephone }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">mobile :</label>
            <input type="text" name="mobile" value="{{ $client->mobile }}" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between mb-3">
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <div class="mb-3">
        <a href="{{ route('clients.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
</div>
  
    </form>
    @endsection
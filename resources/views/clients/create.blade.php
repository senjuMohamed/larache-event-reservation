@extends('layouts.app')
@section('content')
  <h1>Ajouter un Client</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        
        <!-- Nom Complet Field -->
        <div class="mb-3">
            <label class="form-label">Nom Complet :</label>
            <input type="text" name="nom_complet" class="form-control" required>
        </div>
        
        <!-- Email Field -->
        <div class="mb-3">
            <label class="form-label">Email :</label>
            <input type="email" name="email" class="form-control" >
        </div>

        <!-- Téléphone Field -->
        <div class="mb-3">
            <label class="form-label">Téléphone :</label>
            <input type="text" name="telephone" class="form-control" >
        </div>

        <div class="mb-3">
            <label class="form-label">Mobile :</label>
            <input type="text" name="mobile" class="form-control" >
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
        <div class="mb-3">
        <a href="{{ route('clients.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>  
    </form>
    @endsection
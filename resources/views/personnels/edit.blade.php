@extends('layouts.app')
@section('content')
<h1>Modifier l'Employé</h1>
<form action="{{ route('personnels.update', $personnel->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Nom Field -->
    <div class="mb-3">
        <label class="form-label">Nom :</label>
        <input type="text" name="nom" value="{{ $personnel->nom }}" class="form-control" required>
    </div>
    
    <!-- Téléphone Field -->
    <div class="mb-3">
        <label class="form-label">Téléphone :</label>
        <input type="text" name="telephone" value="{{ $personnel->telephone }}" class="form-control" required>
    </div>

    <!-- Mobile Field -->
    <div class="mb-3">
        <label class="form-label">Mobile :</label>
        <input type="text" name="mobile" value="{{ $personnel->mobile }}" class="form-control" required>
    </div>

    <!-- Email Field -->
    <div class="mb-3">
        <label class="form-label">Email :</label>
        <input type="email" name="email" value="{{ $personnel->email }}" class="form-control" required>
    </div>
    
    <!-- Role Field -->
    <div class="mb-3">
        <label class="form-label">Rôle :</label>
        <input type="text" name="role" value="{{ $personnel->role }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <div class="mb-3">
        <a href="{{ route('personnels.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
</form>
@endsection
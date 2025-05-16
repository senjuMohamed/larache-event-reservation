@extends('layouts.app')
@section('content')
<h1>Modifier le Fournisseur</h1>
<form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label class="form-label">Nom:</label>
        <input type="text" name="nom" value="{{ $fournisseur->nom }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Téléphone:</label>
        <input type="text" name="telephone" value="{{ $fournisseur->telephone }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mobile:</label>
        <input type="text" name="mobile" value="{{ $fournisseur->mobile }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" name="email" value="{{ $fournisseur->email }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <div class="mb-3">
        <a href="{{ route('fournisseurs.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>
</form>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Salle: {{ $salle->nom }}</h1>

    <form action="{{ route('salles.update', $salle->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $salle->nom) }}" required>
        </div>

        <div class="form-group">
            <label for="capacite">Capacité</label>
            <input type="number" name="capacite" id="capacite" class="form-control" value="{{ old('capacite', $salle->capacite) }}" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $salle->prix) }}" required>
        </div>

        <!-- Produits as services selection -->
        <div class="form-group">
            <label for="produits">Services (Produits)</label>
            <select name="produits[]" id="produits" class="form-control" multiple>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}" 
                        {{ in_array($produit->id, $salle->produits->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $produit->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <div class="mb-3">
            <a href="{{ route('salles.index') }}" class="btn btn-secondary">Retour à l'Index</a>
        </div>  
    </form>
</div>
@endsection

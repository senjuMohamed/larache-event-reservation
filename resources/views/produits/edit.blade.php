@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Modifier le Produit</h1>
    
    <form action="{{ route('produits.update', $produit) }}" method="POST">        
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Nom du Produit</label>
            <input type="text" name="nom" class="form-control" value="{{ $produit->nom }}" required>
        </div>
        
        <div class="form-group">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" value="{{ $produit->prix }}" required>
        </div>

        <div class="form-group">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ $produit->type }}" required>
        </div>

        <div class="form-group">
            <label>Catégorie</label>
            <select name="category_id" class="form-control">
                <option value="">Choisir une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $produit->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nom }}
                    </option>  <!-- Assumes CategoryProduit has 'name' field -->
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <div class="mb-3">
        <a href="{{ route('produits.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>      </form>
</div>
@endsection

@extends('layouts.app')
@section('content')
<form action="{{ route('produits.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nom du Produit</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Type du Produit</label>
        <select name="type" class="form-control" required>
            <option value="">Choisir le type</option>
            <option value="{{ \App\Enums\ProductType::SERVICE }}">Service</option>
            <option value="{{ \App\Enums\ProductType::STOCKABLE }}">Stockable</option>
        </select>
    </div>
    
    <div class="form-group">
        <label>Prix</label>
        <input type="number" name="prix" class="form-control" required>
    </div>

    <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                    @endforeach
                </select>
            </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection
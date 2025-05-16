@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Ajouter un Service</h1>
    
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="produit_id">Produit</label>
            <select name="produit_id" id="produit_id" class="form-control" required>
                <option value="" disabled selected>Select Produit</option>
                @foreach ($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="salle_id">Salle</label>
            <select name="salle_id" id="salle_id" class="form-control" required>
                <option value="" disabled selected>Select Salle</option>
                @foreach ($salles as $salle)
                    <option value="{{ $salle->id }}">
                        {{ $salle->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <textarea name="prix" id="prix" class="form-control" rows="3" placeholder="Enter prix" required></textarea>
        </div>

        <!-- Description Field -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter description" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Créer Service</button>
    </form>
</div>
@endsection

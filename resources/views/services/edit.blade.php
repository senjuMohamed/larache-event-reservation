@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Modifier Service</h1>
    
    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="produit_id">Produit</label>
            <select name="produit_id" id="produit_id" class="form-control" required>
                <option value="" disabled>Select Produit</option>
                @foreach ($produits as $produit)
                    <option value="{{ $produit->id }}" {{ $produit->id == $service->produit_id ? 'selected' : '' }}>
                        {{ $produit->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="salle_id">Salle</label>
            <select name="salle_id" id="salle_id" class="form-control" required>
                <option value="" disabled>Select Salle</option>
                @foreach ($salles as $salle)
                    <option value="{{ $salle->id }}" {{ $salle->id == $service->salle_id ? 'selected' : '' }}>
                        {{ $salle->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Prix</label>
            <textarea name="prix" id="prix" class="form-control" rows="3">{{ $service->prix ?? '' }}</textarea>
        </div>

        <!-- Description Field Added -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $service->description ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Modifier Service</button>
    </form>
</div>
@endsection

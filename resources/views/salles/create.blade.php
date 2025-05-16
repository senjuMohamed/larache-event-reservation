@extends('layouts.app')

@section('content')
<!-- head: below existing links -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@4.0.1/dist/css/multi-select-tag.min.css">
<div class="container">
    <h1>Ajouter une Salle</h1>

    <form action="{{ route('salles.store') }}" method="POST">
        @csrf

        <!-- Nom Field -->
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <!-- Capacité Field -->
        <div class="form-group">
            <label for="capacite">Capacité</label>
            <input type="number" name="capacite" id="capacite" class="form-control" required>
        </div>

        <!-- Prix Field -->
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" name="prix" id="prix" class="form-control" required>
        </div>

        <!-- Produits (Services) Field with Select Dropdown -->
        <div class="form-group">
            <label for="produits">Produits (Type Service)</label>
            <select name="produits[]" id="produits" class="form-control" multiple>
                @foreach($produits as $produit)
                    @if($produit->type == 'service')
                        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                    @endif
                @endforeach
            </select>
            <small class="form-text text-muted">Select multiple products (services) from the list.</small>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>

        <!-- Back to Index Button -->
        <div class="mb-3">
            <a href="{{ route('salles.index') }}" class="btn btn-secondary">Retour à l'Index</a>
        </div>
    </form>
</div>
<!-- End of <body> -->
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@4.0.1/dist/js/multi-select-tag.min.js"></script>
<script>
    var tagSelector = new MultiSelectTag('produits', {
        maxSelection: 5,              // default unlimited.
        required: true,               // default false.
        placeholder: 'Search tags',   // default 'Search'.
        onChange: function(selected) { // Callback when selection changes.
            console.log('Selection changed:', selected);
        }
    });
</script>
@endsection

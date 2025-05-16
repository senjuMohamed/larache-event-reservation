<h1>Trashed Products</h1>
@foreach ($produits as $produit)
    <div>
        <h3>{{ $produit->nom }} (Deleted)</h3>
        <p>{{ $produit->type }}</p>
        <p>{{ $produit->prix }} €</p>
        <form action="{{ route('produits.restore', $produit->id) }}" method="POST">
            @csrf
            <button type="submit">Restore</button>
        </form>
        <form action="{{ route('produits.forceDelete', $produit->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Permanently Delete</button>
        </form>
    </div>
@endforeach
```
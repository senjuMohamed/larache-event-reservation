

@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Purchase</h2>

    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="fournisseur_id" class="form-label">Fournisseur</label>
            <select name="fournisseur_id" class="form-control" required>
                @foreach($fournisseurs as $fournisseur)
                <option value="{{ $fournisseur->id }}" {{ $purchase->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                    {{ $fournisseur->nom }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $purchase->date }}" required>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total Amount</label>
            <input type="number" name="total" class="form-control" step="0.01" value="{{ $purchase->total }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Purchase</button>
        <div class="mb-3">
        <a href="{{ route('purchases.index') }}" class="btn btn-primary">Retour à l'Index</a>
    </div>  
    </form>
</div>
@endsection

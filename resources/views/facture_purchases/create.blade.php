@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Facture for Purchase #{{ $purchase->id }}</h2>

    <form action="{{ route('facture_purchases.store', ['purchase' => $purchase->id]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="total_price">Montant Total</label>
            <input type="number" class="form-control" id="total_price" name="total" value="{{ $purchase->total_price }}" readonly>
            <!-- Hidden input to store the actual Montant Total value for easy reference in JS -->
            <input type="hidden" id="hidden-total_price" value="{{ $purchase->total_price }}">
            <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">
        </div>

        <div class="form-group">
            <label for="montant_paye">Montant A Payer</label>
            <input type="number" class="form-control" id="montant_paye" name="montant_paye" value="{{ old('montant_paye', 0) }}" min="0" step="0.01" required>
            @error('montant_paye')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reste">Reste à Payer</label>
            <input type="number" class="form-control" id="reste" name="reste" value="{{ $purchase->total_price }}" readonly>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Validate</button>
        </div>
    </form>

</div>

<script>
    // Dynamically calculate Reste à Payer as the user inputs Montant A Payer
    document.getElementById('montant_paye').addEventListener('input', function() {
        var montantTotal = parseFloat(document.getElementById('hidden-total_price').value); // Get the hidden total price
        var montantPaye = parseFloat(this.value) || 0;

        // Ensure Montant A Payer is within valid range
        if (montantPaye > montantTotal) {
            this.setCustomValidity('Montant payé cannot exceed the total amount.');
        } else {
            this.setCustomValidity('');
        }

        // Update Reste à Payer dynamically
        var reste = montantTotal - montantPaye;
        document.getElementById('reste').value = reste.toFixed(2);
    });
</script>
@endsection

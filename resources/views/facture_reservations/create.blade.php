@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Facture for demande #{{ $demande->id }}</h2>

    <form action="{{ route('facture_reservations.store', ['demande' => $demande->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="demande_id" value="{{ $demande->id }}">
    
        <div class="form-group">
        <input type="number" class="form-control" id="total_price" name="total" value="{{ $demande->total_price }}" readonly>

            <label for="total_price">Montant Total</label>
            <input type="number" class="form-control" id="total_price" name="total" value="{{ $prixTotal }}" readonly>
            <!-- Hidden input to store the actual Montant Total value for easy reference in JS -->
            <input type="hidden" id="hidden-total_price" value="{{ $prixTotal }}">
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
            <input type="number" class="form-control" id="reste" name="reste" value="{{ $prixTotal }}" readonly>
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

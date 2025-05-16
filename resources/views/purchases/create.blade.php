@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Purchase</h2>

    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="fournisseur_id" class="form-label">Fournisseur</label>
            <select name="fournisseur_id" id="fournisseur_id" class="form-control" required>
                <option value="">Select a Fournisseur</option>
                @foreach($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                        {{ $fournisseur->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="purchase_date" class="form-label">Date</label>
            <input type="date" name="purchase_date" class="form-control" required>
        </div>

        <h4>Products</h4>
        <table class="table table-bordered" id="product-container">
            <thead>
                <tr>
                    <th>Product (Price)</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Tax</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="product-line">
                    <td>
                        <select name="produits[]" class="form-control product-select" required>
                            <option value="">Select a Product</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}" data-price="{{ $produit->prix }}">
                                    {{ $produit->nom }} ({{ $produit->prix }} MAD)
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="quantites[]" class="form-control quantity-input" placeholder="Quantity" min="1" required value="1">
                    </td>
                    <td>
                        <input type="number" name="unit_prices[]" class="form-control unit-price" step="0.01" readonly value="0.00">
                    </td>
                    <td>
                    <select name="taxes[]" class="form-control product-tax" required>
                        <option value="0">No Tax</option>
                        @foreach($taxes as $tax)
                            <option value="{{ $tax->amount }}">{{ $tax->amount }}%</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                        <input type="number" name="total_prices[]" class="form-control total-price" step="0.01" readonly value="0.00">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-line">X</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="add-product" class="btn btn-primary">Add Product</button>

        <div class="mt-3">
            <label for="grand_total" class="form-label">Total Amount (Including Tax)</label>
            <input type="number" name="grand_total" id="grand_total" class="form-control" step="0.01" readonly>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Purchase</button>
        <div class="mb-3">
            <a href="{{ route('purchases.index') }}" class="btn btn-primary">Retour à l'Index</a>
        </div>  
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function updateTotal() {
        let grandTotal = 0;
        document.querySelectorAll(".product-line").forEach(row => {
            let totalPrice = parseFloat(row.querySelector(".total-price").value) || 0;
            grandTotal += totalPrice;
        });
        document.getElementById("grand_total").value = grandTotal.toFixed(2);
    }

    function updatePriceFields(row) {
        let selectedOption = row.querySelector(".product-select option:checked");
        let unitPrice = selectedOption ? parseFloat(selectedOption.dataset.price) : 0;
        row.querySelector(".unit-price").value = unitPrice;
        
        let quantity = row.querySelector(".quantity-input").value || 1;
        let taxPercentage = row.querySelector(".product-tax").value || 0;
        
        // Calculate the total price for this product
        let totalWithoutTax = unitPrice * quantity;
        let totalWithTax = totalWithoutTax + (totalWithoutTax * (taxPercentage / 100));
        
        row.querySelector(".total-price").value = totalWithTax.toFixed(2);
        
        updateTotal();
    }

    document.getElementById("product-container").addEventListener("change", function (event) {
        let row = event.target.closest(".product-line");
        if (event.target.classList.contains("product-select") || event.target.classList.contains("quantity-input") || event.target.classList.contains("product-tax")) {
            updatePriceFields(row);
        }
    });

    // Handle the Add Product button click
    document.getElementById("add-product").addEventListener("click", function () {
        let tableBody = document.querySelector("#product-container tbody");
        let newRow = document.querySelector(".product-line").cloneNode(true);

        // Reset values for the new row
        newRow.querySelector(".product-select").value = "";
        newRow.querySelector(".quantity-input").value = 1;
        newRow.querySelector(".unit-price").value = "0.00";
        newRow.querySelector(".product-tax").value = "0";
        newRow.querySelector(".total-price").value = "0.00";
        
        // Append the new row to the table body
        tableBody.appendChild(newRow);
    });

    // Remove a product line
    document.getElementById("product-container").addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-line")) {
            event.target.closest(".product-line").remove();
            updateTotal();
        }
    });
});
</script>
@endsection

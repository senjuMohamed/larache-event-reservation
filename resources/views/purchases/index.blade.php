@extends('layouts.app')

@section('content')
<!-- Add DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<style>
    /* Adjust pagination to the right */
    .dataTables_paginate {
        float: right; /* Align pagination to the right */
    }

    /* Optional: Align the search box and pagination if needed */
    .dataTables_filter, .dataTables_paginate {
        display: inline-block;
    }

    /* Adjust search box position to the right */
    .dataTables_filter {
        float: right; /* Moves the search box to the right */
        margin-top: 10px; /* Adjust the top margin to align better */
    }

    /* Style for clickable table rows */
    .clickable-row {
        cursor: pointer;
    }

    .clickable-row td {
        transition: background-color 0.3s ease;
    }

    .clickable-row:hover {
        background-color: #f5f5f5; /* Light background on hover */
    }
</style>

<div class="container">
    <h2 class="mb-4">Purchases</h2>
    <div class="d-flex justify-content-between mb-3">
        <!-- Archives button stays on the right -->
        <a href="{{ route('purchases.archive') }}" class="btn btn-secondary">Archives</a>
        
        <!-- Add New Purchase button on the left -->
        <a href="{{ route('purchases.create') }}" class="btn btn-primary">Add New Purchase</a>
    </div>  
    <table id="purchasesTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fournisseur</th>
                <th>Date</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr class="clickable-row" data-href="{{ route('purchases.show', $purchase->id) }}">
                <td>{{ $purchase->id }}</td>
                <td>{{ $purchase->fournisseur->nom }}</td>
                <td>{{ $purchase->purchase_date }}</td>
                <td>{{ $purchase->total_price }} MAD</td>
                <td>
                    <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" style="display:inline;">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    
                    <!-- Add the button for viewing or adding the facture -->
                    @if($purchase->facturePurchases->isNotEmpty())
                        <a href="{{ route('facture_purchases.show', $purchase->facturePurchases->first()->id) }}" class="btn btn-success btn-sm">View Facture</a>
                    @else
                        <a href="{{ route('facture_purchases.create', $purchase->id) }}" class="btn btn-primary btn-sm">Create Facture</a>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#purchasesTable').DataTable();

        // Make rows clickable
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>

@endsection

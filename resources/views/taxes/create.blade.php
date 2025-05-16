@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Tax</h2>
    <form action="{{ route('taxes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Tax Amount (%)</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('taxes.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

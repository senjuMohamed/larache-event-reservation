@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tax Details</h1>
        <p><strong>ID:</strong> {{ $tax->id }}</p>
        <p><strong>Amount:</strong> {{ $tax->amount }}%</p>
        <a href="{{ route('taxes.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection

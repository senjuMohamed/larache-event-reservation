@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Taxes</h2>
    <div class="d-flex justify-content-between mb-3">
    <a href="{{ route('taxes.archive') }}" class="btn btn-secondary">Archives</a>
    <a href="{{ route('taxes.create') }}" class="btn btn-primary mb-3">Add Tax</a>
</div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount (%)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($taxes as $tax)
                <tr>
                    <td>{{ $tax->id }}</td>
                    <td>{{ $tax->amount }}%</td>
                    <td>
                        <a href="{{ route('taxes.edit', $tax) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('taxes.show', $tax) }}" class="btn btn-warning">Show</a>

                        <form action="{{ route('taxes.destroy', $tax) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

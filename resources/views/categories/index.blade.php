@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Categories</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
    </div>

    <table class="table table-bordered" id="categoriesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->nom }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#categoriesTable').DataTable();
    });
</script>
@endpush
